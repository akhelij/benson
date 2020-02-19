<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Shop\Addresses\Address;
use App\Shop\Addresses\Repositories\Interfaces\AddressRepositoryInterface;
use App\Shop\Addresses\Requests\CreateAddressRequest;
use App\Shop\Addresses\Requests\UpdateAddressRequest;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\Request;

use App\Shop\Customers\Customer;

class CustomerAddressController extends Controller
{
    private $addressRepo;
    private $customerRepo;
    private $countryRepo;
    private $cityRepo;

    public function __construct(
        AddressRepositoryInterface $addressRepository,
        CustomerRepositoryInterface $customerRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository
    ) {
        $this->addressRepo = $addressRepository;
        $this->customerRepo = $customerRepository;
        $this->countryRepo = $countryRepository;
        $this->cityRepo = $cityRepository;
    }

    /**
     * @param int $customerId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(int $customerId)
    {

        $customer = $this->customerRepo->findCustomerById($customerId);

        return view('front.customers.addresses.list', [
            'customer' => $customer,
            'addresses' => $customer->addresses,
        ]);
    }

    /**
     * @param int $customerId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(int $customerId)
    {
        $customerId = $customerId / 15212;

        return view('front.customers.addresses.create', [
            'customers' => $this->customerRepo->listCustomers(),
            'customer' => $this->customerRepo->findCustomerById($customerId),
        ]);
    }

    /**
     * @param CreateAddressRequest $request
     * @param int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateAddressRequest $request, int $customerId)
    {
        $request['customer'] = $customerId;
        $this->addressRepo->createAddress($request->except('_token', '_method'));
        
        $request->session()->flash('message', 'Addresse ajouter avec succés');
        return redirect()->route('cart.index');
    }

    /**
     * @param UpdateAddressRequest $request
     * @param int $customerId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(UpdateAddressRequest $request, int $addressId)
    {
        $address = Address::find($addressId/1994);
        $address->phone = $request->input('phone');
        $address->address_1 = $request->input('address_1');
        $address->zip = $request->input('zip');
        $address->city_id = $request->input('city');
        $address->province_id = $request->input('province');
        $address->country_id = $request->input('country');
        $address->save();

        $request->session()->flash('message', 'Modification des informations de livraison réussie');
        return redirect()->route('cart.index');
    }

    public function deleteAddress(Request $request)
    {
        $addressId = $request->input("addressId");
        Address::destroy($addressId);
        return redirect()->route('accounts');

    }
}
