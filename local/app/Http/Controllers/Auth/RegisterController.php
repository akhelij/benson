<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Shop\Customers\Customer;
use App\Shop\Carts\Repositories\Interfaces\CartRepositoryInterface;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Shop\Customers\Requests\RegisterCustomerRequest;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    private $customerRepo;

    /**
     * Create a new controller instance.
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(CustomerRepositoryInterface $customerRepository,CartRepositoryInterface $cartRepository)
    {
        $this->cartRepo = $cartRepository;        
        $this->middleware('guest');
        $this->customerRepo = $customerRepository;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return Customer
     */
    protected function create(array $data)
    {
        return $this->customerRepo->createCustomer($data);

    }

    /**
     * @param RegisterCustomerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterCustomerRequest $request)
    {
        $customer = $this->create($request->except('_method', '_token'));
        Auth::login($customer);
        session(['panier'=> $this->cartRepo->getCartItems()]);
        return redirect(url()->previous());
    }

    public function verify(Request $request)
    {
        $customer = Customer::where("remember_token", "=", $request->token)->firstOrFail();

        $customer->email_verified_at = 1;

        $customer->save();

        return redirect()->route('home');
    }
}
