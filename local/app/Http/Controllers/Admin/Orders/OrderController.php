<?php



namespace App\Http\Controllers\Admin\Orders;



use App\Http\Controllers\Controller;

use App\Shop\Addresses\Repositories\Interfaces\AddressRepositoryInterface;

use App\Shop\Addresses\Transformations\AddressTransformable;

use App\Shop\Couriers\Courier;

use App\Shop\Couriers\Repositories\CourierRepository;

use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;

use App\Shop\Customers\Customer;

use App\Shop\Customers\Repositories\CustomerRepository;

use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;

use App\Shop\OrderStatuses\OrderStatus;

use App\Shop\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;

use App\Shop\OrderStatuses\Repositories\OrderStatusRepository;

use App\Shop\Orders\Order;

use App\Shop\Orders\Repositories\Interfaces\OrderRepositoryInterface;

use App\Shop\PaymentMethods\Repositories\Interfaces\PaymentMethodRepositoryInterface;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class OrderController extends Controller

{

    use AddressTransformable;



    private $orderRepo;

    private $courierRepo;

    private $addressRepo;

    private $customerRepo;

    private $orderStatusRepo;

    private $paymentRepo;



    public function __construct(

        OrderRepositoryInterface $orderRepository,

        CourierRepositoryInterface $courierRepository,

        AddressRepositoryInterface $addressRepository,

        CustomerRepositoryInterface $customerRepository,

        OrderStatusRepositoryInterface $orderStatusRepository,

        PaymentMethodRepositoryInterface $paymentMethodRepository

    ) {

        $this->orderRepo = $orderRepository;

        $this->courierRepo = $courierRepository;

        $this->addressRepo = $addressRepository;

        $this->customerRepo = $customerRepository;

        $this->orderStatusRepo = $orderStatusRepository;

        $this->paymentRepo = $paymentMethodRepository;

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        // try {
        //     $orders = (array) DB::select( DB::raw("select o.reference as 'Numero de commande',o.id as 'Numero_de_la_ligne',o.created_at as 'Date de saisie',a.address_1 as 'Address de livraison',c.name as 'Nom Complet',a.zip as 'CP',a.city_id as 'VIL',a.country_id as 'PAY', a.phone as 'TEL', c.email as 'MAIL' FROM orders as o, customers as c, addresses as a where o.customer_id = c.id and o.address_id = a.id order by o.created_at desc limit 10") );
        //     foreach($orders as $order){
        //         $products= Order::find($order->Numero_de_la_ligne)->products;
        //         foreach($products as $key => $product){
        //             $sku = $product->sku;
        //             $name = $product->name;
        //             $color = $product->color;
        //             $size = $product->pivot->size;
        //             $quantity = $product->pivot->quantity;
        //             $order->products[$key] = compact('sku','name','color','size','quantity');
        //         }
                
        //     }
        //     Storage::put('orders/orders'.$order->Numero_de_la_ligne.'.txt', print_r($orders, true));
        //     $content = file_get_contents(storage_path('app').'\attempt1.txt');
        
        
        // } catch (\Exception $e) {
        //     Log::notice('Error on txt creation.', ['Error' => $e]);
        // }

        $list = $this->orderRepo->listOrders('created_at', 'desc');

        

        if (request()->has('q')) {

            $list = $this->orderRepo->searchOrder(request()->input('q') ?? '');

        }

      

        $orders = $this->orderRepo->paginateArrayResults($this->transFormOrder($list), 10);

        

        return view('admin.orders.list', ['orders' => $orders]);

    }



    /**

     * Display the specified resource.

     *

     * @param  int  $id

     * @return \Illuminate\Http\Response

     */

    public function show(int $id)

    {

       

        $order = $this->orderRepo->findOrderById($id);

        

        $order->courier = $this->courierRepo->findCourierById($order->courier_id);

      //  dump($this->addressRepo->findAddressById($order->address_id)); die();

        $order->address = $this->addressRepo->findAddressById($order->address_id);

       

        

        return view('admin.orders.show', [

            'order' => $order,

            'items' => $this->orderRepo->findProducts($order),

            'customer' => $this->customerRepo->findCustomerById($order->customer_id),

            'currentStatus' => $this->orderStatusRepo->findOrderStatusById($order->order_status_id),

            'payment' => $this->paymentRepo->findPaymentMethodById($order->payment_method_id),

        ]);



    }



    public function update(int $id)

    {

        $order = Order::find($id);

        $order->order_status_id = 7;

        $items = $this->orderRepo->findProducts($order);



        $order->save();

        $order = $this->orderRepo->findOrderById($id);

        $order->courier = $this->courierRepo->findCourierById($order->courier_id);

        $order->address = $this->addressRepo->findAddressById($order->address_id);



        return view('admin.orders.show', [

            'order' => $order,

            'items' => $this->orderRepo->findProducts($order),

            'customer' => $this->customerRepo->findCustomerById($order->customer_id),

            'currentStatus' => $this->orderStatusRepo->findOrderStatusById($order->order_status_id),

            'payment' => $this->paymentRepo->findPaymentMethodById($order->payment_method_id),

        ]);



    }

    /**

     * Generate order invoice

     *

     * @param int $id

     * @return mixed

     */

    public function generateInvoice(int $id)

    {

        $order = Order::where("invoice", '!=', 'null')->orderBy('created_at', 'desc')->first();

        $lastinvoice = $order->invoice;



        $order = $this->orderRepo->findOrderById($id);

        if ($order->invoice == null) {

            $order->invoice = $lastinvoice + 1;

            $order->save();

        }



        $data = [

            'order' => $order,

            'products' => $order->products,

            'customer' => $order->customer,

            'courier' => $order->courier,

            'address' => $this->transformAddress($order->address),

            'status' => $order->orderStatus,

            'payment' => $order->paymentMethod,

            'invoice' => $order->invoice,

        ];



        $pdf = app()->make('dompdf.wrapper');

        $pdf->loadView('invoices.orders', $data)->stream();

        return $pdf->stream();

    }



    /**

     * @param Collection $list

     * @return array

     */

    private function transFormOrder(Collection $list)

    {

        $courierRepo = new CourierRepository(new Courier());

        $customerRepo = new CustomerRepository(new Customer());

        $orderStatusRepo = new OrderStatusRepository(new OrderStatus());



        return $list->transform(function (Order $order) use ($courierRepo, $customerRepo, $orderStatusRepo) {

            $order->courier = $courierRepo->findCourierById($order->courier_id);

            $order->customer = $customerRepo->findCustomerById($order->customer_id);

            $order->status = $orderStatusRepo->findOrderStatusById($order->order_status_id);

            return $order;

        })->all();

    }



     

}

