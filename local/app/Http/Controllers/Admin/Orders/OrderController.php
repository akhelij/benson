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
    function fillSpace($val, $lenght, $space,$after = false){
        while(strlen($val) < $lenght){
            if($after)
                $val .= $space;
            else
                $val = $space.$val;
        }
        return $val;
    }
    public function index()

    {
         $zone = " ";
        // try {
            //$orders = (array) DB::select( DB::raw("select o.reference as 'Numero de commande',o.id as 'Numero_de_la_ligne',o.created_at as 'Date de saisie',a.address_1 as 'Address de livraison',c.name as 'Nom Complet',a.zip as 'CP',a.city_id as 'VIL',a.country_id as 'PAY', a.phone as 'TEL', c.email as 'MAIL' FROM orders as o, customers as c, addresses as a where o.customer_id = c.id and o.address_id = a.id order by o.created_at desc limit 10") );
            $order = Order::latest()->limit(1)->get()[0];
            $order->invoice = 323;
            // #POR#
            // O
            // Numéro de séquence
            $numerocommande = $this->fillSpace($order->invoice, 6, "0");
            $lignecommande      = "00";              

            $numeroclientfact   =  $this->fillSpace($order->customer->id, 6, "0");
            $codeadressefact    =  "00";            
            $numeroclientliv    =  $numeroclientfact;
            $codeadresseliv     =  "00";
            $saison = $this->fillSpace("", 4, " ",true);
            //zone
            $modereglement = "COD ";
            if($order->payment_method_id == 3)
                $modereglement = "CMI ";
            $delaireglement = $this->fillSpace("", 4, " ",true);
            $jourecheance = $this->fillSpace("", 2, " ",true);

            $modeexpedition = "FRE";
            if($order->courier_id == 1)
                $modeexpedition = "DHL ";
                
            $port = $condspec1 = $condspec2 = $representant1 =$representant2 = $this->fillSpace("", 4, " ",true);
            $tauxrepresentant1 = $tauxrepresentant2 = $this->fillSpace("", 13, " ",true);
            $datecommande = date('dmy',strtotime($order->created_at));
            $reference = $this->fillSpace($order->reference, 20, "0",false);
            $type = " ";
            //zone
            $unite = $this->fillSpace("", 4, " ",true);
            $zone2 = $this->fillSpace("", 8, " ",true);
            $ligneproduit = $this->fillSpace("", 4, " ",true);
            $x = "X";
            $zone3 = $this->fillSpace("", 97, " ",true);
            
            $montantport =  $zone4 = $remisecomp1 = $remisecomp2 = $this->fillSpace("", 13, " ",true);
            
            $griffe = $this->fillSpace("", 4, " ",true);
            $tarif = $this->fillSpace("", 4, " ",true);
            $devise = "MAD ";
            $delaifabrication = $this->fillSpace("", 4, " ",true);
            $prioritelivraison = $this->fillSpace("", 4, " ",true);
            $datelivraison = $this->fillSpace("0", 6, " ",true);
            $remisecommande = $remisefinannee = $this->fillSpace(".00", 13, "0",false);
           
            // "000000";
            $pocmd = $this->fillSpace("", 60, " ",true);
                     

            $entete = "#POR#O000000001"./*+15*/
            /*16*/$numerocommande./*+6*/
            /*22*/$lignecommande./*+2*/
            /*24*/$numeroclientfact./*+6*/
            /*30*/$codeadressefact./*+2*/
            /*32*/$numeroclientliv./*+6*/
            /*38*/$codeadresseliv./*+2*/
            /*40*/$saison./*+4*/
            /*44*/$zone./*+1*/
            /*45*/$modereglement./*+4*/
            /*49*/$delaireglement./*+4*/
            /*53*/$jourecheance./*+2*/
            /*55*/$modeexpedition.$port.$condspec1.$condspec2.$representant1.$representant2./*+24*/
            /*79*/$tauxrepresentant1.$tauxrepresentant2./*+26*/
            /*105*/$datecommande./*+6*/
            /*111*/$reference./*+20*/
            /*131*/$type.$zone./*+2*/
            /*133*/$unite.
            /*137*/$zone2.
            /*145*/$ligneproduit.
            /*149*/$x./*+1*/
            /*150*/$zone3./*+97*/
            /*247*/$montantport./*+13*/         
            /*260*/$zone4./*+13*/   
            /*273*/$remisecomp1./*+13*/   
            /*286*/$remisecomp2./*+13*/   
            /*299*/$griffe./*+4*/   
            /*303*/$tarif.
            /*307*/$devise./*+4*/
            /*311*/$delaifabrication./*+4*/
            /*315*/$prioritelivraison./*+4*/
            /*319*/$datelivraison./*+6*/
            /*325*/$remisecommande./*+13*/
            /*338*/$remisefinannee./*+13*/
            /*338*/"000000"./*+6*/
            /*338*/$pocmd."\n";

            $lignes = "";            
            foreach($order->products as $key => $product){

                    // #POR#
                    // O
                    // Numéro de séquence
                    //$numerocommande
                    //$lignecommande
                    //$numeroclientfact
                    //$codeadressefact
                    //$numeroclientliv
                    //$codeadresseliv
                    //saison
                    $sku = "1234567890123";//codebarre

                    $reference = $this->fillSpace($product->sku, 6, "0",false);
                    
                    $modele = $this->fillSpace($product->name, 10, " ",true);                    
                                       
                    $version = $this->fillSpace("", 4, " ",true);
                    $taille = $this->fillSpace("", 4, " ",true);                    
                    $commentaire = $this->fillSpace("", 30, " ",true);
                   
                    $quantite = $this->fillSpace($product->pivot->quantity, 5, "0",false);
                    
                    $prixht = number_format((float) ($product->price - ($product->price * (20/100))), 2, '.', '');
                    $prixht = $this->fillSpace( $prixht ,13,"0",false);

                    $taux = $this->fillSpace("20.00",13,"0",false);

                    $prixttc = $this->fillSpace($product->price,13,"0",false);
                    $zone1 = $this->fillSpace("", 8, " ",true);
                    $codeassort = $this->fillSpace("", 4, " ",true);
                    $nombreassort = $this->fillSpace("", 13, "0",true);
                    $zone2 = $this->fillSpace("", 5, " ",true);
                    $unitedeprod = $this->fillSpace("", 4, " ",true);
                    $zone3 = $this->fillSpace("", 35, " ",true);
                    $griffe = $this->fillSpace("", 4, " ",true);
                    $tarif = $this->fillSpace("", 4, " ",true);
                    $devise = "MAD ";
                    $delaifabrication = $this->fillSpace("", 4, " ",true);
                    $prioritefabrication = $this->fillSpace("", 2, " ",true);
                    $datelivdebut = $datelivfin = $this->fillSpace("", 6, " ",true);
                    $remisecmd = $remisefinannee = $this->fillSpace(".00", 13, "0",false);
                    //000000
                
                    

                $ligne = "#POR#O000000001".
                /*16*/$numerocommande./*+6*/
                /*22*/$lignecommande./*+2*/
                /*24*/$numeroclientfact./*+6*/
                /*30*/$codeadressefact./*+2*/
                /*32*/$numeroclientliv./*+6*/
                /*38*/$codeadresseliv./*+2*/
                /*38*/$saison.
                /*44*/$sku.
                /*57*/$reference.            
                /*63*/$modele.
                /*73*/$version.
                /*77*/$taille.
                /*81*/$commentaire.
                /*111*/$quantite.
                /*116*/$prixht.
                /*129*/$taux.
                /*142*/$prixttc.
                /*155*/$zone1.$codeassort.$nombreassort.$zone2.
                $unitedeprod.$zone3.$griffe.$tarif.$devise.$delaifabrication.$prioritefabrication
                .$datelivdebut.$datelivfin.$remisecmd.$remisefinannee."000000";
                
                $lignes .= $ligne."\n";

            }

            

            // #POR#
            // O
            // Numéro de séquence
            //$numerocommande
            //$lignecommande
            $datesaisie = $datecommande;
            $debut = "#POD#O000000001".$numerocommande;
            $debut .= $this->fillSpace($lignecommande,6,"0",false);
            $debut .= $datesaisie;
            $clientfacture = "";
            $nom = "F/NOM/".$order->customer->name;
            $clientfacture .= $debut.$nom."\n";
            $rue = "F/RUE/".$order->address->address_1;
            $clientfacture .= $debut.$rue."\n";
            $cp = "F/CP/".$order->address->zip;   
            $clientfacture .= $debut.$cp."\n";             
            $vil = "F/VIL/".$order->address->city_id;  
            $clientfacture .= $debut.$vil."\n";       
            $pay = "F/PAY/".$order->address->country_id;  
            $clientfacture .= $debut.$pay."\n";
            $eta = "F/ETA/".$order->address->province_id;
            $clientfacture .= $debut.$eta."\n";
            $tel = "F/TEL/".$order->address->phone;
            $clientfacture .= $debut.$tel."\n";
            $mail = "F/MAIL/".$order->customer->email;
            $clientfacture .= $debut.$mail."\n";
            $dev = "F/DEV/MAD";
            $clientfacture .= $debut.$dev."\n";
            
            $clientliv =  str_replace("F/", "L/", $clientfacture);
            
            Storage::put('orders/orders'.$order->Numero_de_la_ligne.'.txt', $entete.$lignes.$clientfacture.$clientliv.'EOF');
            $content = file_get_contents(storage_path('app').'\orders\orders.txt');
            
            dd($content);

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

