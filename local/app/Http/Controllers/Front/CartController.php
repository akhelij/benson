<?php



namespace App\Http\Controllers\Front;



use App\Http\Controllers\Controller;

use App\Shop\Carts\Repositories\Interfaces\CartRepositoryInterface;

use App\Shop\Carts\Requests\AddToCartRequest;

use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;

use App\Shop\Products\Product;

use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;

use App\Shop\Products\Repositories\ProductRepository;

use App\Shop\Products\Transformations\ProductTransformable;

use Gloudemans\Shoppingcart\CartItem;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

use App\Newsletter;

use App\Shop\Addresses\Repositories\Interfaces\AddressRepositoryInterface;

use App\Shop\Cart\Requests\CartCheckoutRequest;

use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;

use App\Shop\OrderDetails\OrderProduct;

use App\Shop\OrderDetails\Repositories\OrderProductRepository;

use App\Shop\Orders\Order;

use App\Shop\Orders\Repositories\Interfaces\OrderRepositoryInterface;

use App\Shop\PaymentMethods\Exceptions\PaymentMethodNotFoundException;

use App\Shop\PaymentMethods\Payment as PaypalPayment;

use App\Shop\PaymentMethods\Paypal\Exceptions\PaypalRequestError;

use App\Shop\PaymentMethods\Paypal\PaypalExpress;

use App\Shop\PaymentMethods\Repositories\Interfaces\PaymentMethodRepositoryInterface;

use App\Shop\Products\Size;

use Exception;

use Illuminate\Support\Collection;

use Mail;

use PayPal\Api\Payment;

use PayPal\Exception\PayPalConnectionException;

use Ramsey\Uuid\Uuid;

use App\Shop\Customers\Customer;

use App\Shop\Addresses\Address;



class CartController extends Controller

{

    use ProductTransformable;



    /**

     * @var CartRepositoryInterface

     */

  



    /**

     * @var ProductRepositoryInterface

     */

    

    private $cartRepo;

    private $courierRepo;

    private $paymentRepo;

    private $addressRepo;

    private $customerRepo;

    private $productRepo;

    private $orderRepo;

    private $paypal;

    private $courierId;

    private $currency_diff;

    public function __construct(

        CartRepositoryInterface $cartRepository,

        CourierRepositoryInterface $courierRepository,

        PaymentMethodRepositoryInterface $paymentMethodRepository,

        AddressRepositoryInterface $addressRepository,

        CustomerRepositoryInterface $customerRepository,

        ProductRepositoryInterface $productRepository,

        OrderRepositoryInterface $orderRepository

    ) {

        $this->cartRepo = $cartRepository;

        $this->courierRepo = $courierRepository;

        $this->paymentRepo = $paymentMethodRepository;

        $this->addressRepo = $addressRepository;

        $this->customerRepo = $customerRepository;

        $this->productRepo = $productRepository;

        $this->orderRepo = $orderRepository;

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        

        $currency_diff = 1;

        $currency = config('cart.currency');



        if (Session::has('currency')) {

            $currency = Session::get('currency');

            if (Session::get('currency') == "USD" || Session::get('currency') == "EUR") {

                $currency_diff = file_get_contents('http://free.currencyconverterapi.com/api/v5/convert?q=MAD_' . Session::get('currency') . '&compact=y');

                $currency_diff = explode("}", explode(":", $currency_diff)[2])[0];

            } else {

                Session::get('currency', "MAD");

            }



        }



        $cartProducts = $this->cartRepo->getCartItems()->map(function (CartItem $item) {

            
            $product = Product::findOrFail($item->id);
                
            $item->product = $this->transformProduct($product);

            $item->cover = $product->cover;

            return $item;



        });



        $courier = $this->courierRepo->findCourierById(request()->session()->get('courierId', 1));

        $shippingFee = $this->cartRepo->getShippingFee($courier);

        

        if(Auth::check()){

            $customer = $this->customerRepo->findCustomerById(Auth::id());



            $this->courierId = request()->session()->get('courierId', 1);

            $courier = $this->courierRepo->findCourierById($this->courierId);



            $shippingCost = $this->cartRepo->getShippingFee($courier);



            $addressId = request()->session()->get('addressId', 1);

            $paymentId = request()->session()->get('paymentId', 1);



            return view('front.carts.cart', [

                'customer' => $customer,

                'addresses' => $customer->addresses()->get(),

                'products' => $this->cartRepo->getCartItems(),

                'subtotal' => $this->cartRepo->getSubTotal(),

                'shipping' => $shippingCost,

                'shippingFee' => $shippingFee,

                'tax' => $this->cartRepo->getTax(),

                'total' => $this->cartRepo->getTotal(0, $shippingCost, null, true),

                'couriers' => $this->courierRepo->listCouriers(),

                'selectedCourier' => $this->courierId,

                'selectedAddress' => $addressId,

                'selectedPayment' => $paymentId,

                'payments' => $this->paymentRepo->listPaymentMethods(),

                'currency' => $currency,

                'currency_diff' => $this->currency_diff,

            ]);

        }else{
          
        return view('front.carts.cart', [

            'products' => $cartProducts,

            'subtotal' => $this->cartRepo->getSubTotal(),

            'tax' => $this->cartRepo->getTax(),

            'shippingFee' => $shippingFee,

            'total' => $this->cartRepo->getTotal(2, $shippingFee, null, true),

            'currency' => $currency,

            'currency_diff' => $currency_diff,

        ]);

       }

        

        

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  AddToCartRequest $request

     * @return \Illuminate\Http\Response

     */

    public function store(AddToCartRequest $request)

    {        

        

        $product = $this->productRepo->findProductById($request->input('product'));

        $size = $request->input('size');    

        $quantity = $request->input('quantity');

        $this->cartRepo->addToCart($product, $size, $quantity);

        

        if($request->input('ajax')!==null){

            return response()->json(['success'=>'Article ajouté au panier']);

        }else{            

            $request->session()->flash('message', 'Article ajouté au panier avec succès');

            return redirect()->route('cart.index');

        }

    }



    /**

     * Demande a newly created resource in storage.

     *

     * @param  AddToCartRequest $request

     * @return \Illuminate\Http\Response

     */



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

       

        if($request->input('ajax')!==null){

            $this->cartRepo->updateQuantityInCart($id, $request->input('quantity'));

            $total = $this->cartRepo->getTotal(2, 0, null, true);

            return response()->json(["total"=> $total]);

        }else{       

            $this->cartRepo->updateQuantityInCart($id, $request->input('quantity'));

            request()->session()->flash('message', 'Update cart successful');

            return redirect()->route('cart.index');

        }

        

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        $this->cartRepo->removeToCart($id);



        request()->session()->flash('message', 'Article retiré de votre panier avec succés');

        return redirect()->route('cart.index');

    }

}

