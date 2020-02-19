@extends('layouts.front.app')

@section('content')
<style>
.form-control{
    color:black !important;
}
    /* Customize the label (the container) */
.container {
  display: block;
  position: relative;
  padding-left: 35px;
  /*margin-bottom: 12px;*/
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.container .inputCheck {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 15%;
  left: 0;
  height: 20px;
  width: 20px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.container:hover .inputCheck ~ .checkmark {
  background-color: #fff;
  border:1px solid blue;
}

/* When the radio button is checked, add a blue background */
.container .inputCheck:checked ~ .checkmark {
  background-color: blue;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.container .inputCheck:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.container .checkmark:after {
  top: 30%;
  left: 30% ;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}

.radiobtn{
margin:2%;
width:100%
}

.checked{

    z-index: 1;
    background-color: rgba(0,0,255,0.07);
    box-shadow: 0 0 0 1px blue, 0 0 0 1px blue inset !important;
    font-size: 18px;

}

.choice{
    position: relative;
    border-top: none;
    border-radius: 2px;
    box-shadow: 0 0 0 1px #dfdede, 0 0 0 1px #dfdede inset;
    cursor: default;
    height:60px;    
}

.edit {
    border: 1px dashed gray;
    border-radius:5px;
    margin-bottom: 2%;
    padding-right: 4%;
    padding-left: 4%;
    background-color: lightgray;
}
.edit > .block{
    margin: 0%;
    margin-top:1%;
    padding:1%
}


.edit > .block >  .box-footer {
    margin-bottom:3%;
}

</style>
        <div class="container product-in-cart-list " >
            @if(!empty($products) && !collect($products)->isEmpty())
                <div class="row"  style="margin:0;padding-bottom:20px;margin-top: 5%;"> 
                    <div class="box-body">
                        @include('layouts.errors-and-messages')
                    </div>
                    <div class="col-md-4">
                        <div class="row" style="margin:0">
                            <h2><b> Panier d'achat </b></h2>
                            <ol class="breadcrumb" style="border-radius:0;background-color:transparent">
                                <li><a href="{{ route('catalog') }}"> Collection</a></li>
                                <li class="active">Panier</li>
                            </ol>
                       
                            @foreach($products as $product)
                                <div class="row" style="margin-top:3%">
                                    <div class="col-xs-5">
                                        <a href="{{ route('front.get.product', [$product->product->slug]) }}" class="hover-border">
                                            @if(isset($product->cover))
                                                <img src="{{ asset("storage/$product->cover") }}" alt="{{ $product->name }}" class="img-responsive img-thumbnail">
                                            @else
                                                <img src="https://placehold.it/120x120" alt="" class="img-responsive img-thumbnail">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="col-xs-7">
                                       <form action="{{ route('cart.destroy', $product->rowId) }}" method="post" class="pull-right">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <button onclick="return confirm('Voulez vous vraiment retirer cet element de votre panier ?')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                        <b>{{ $product->name }}</b>
                                        <br/>
                                            Taille : @if($product->size == 0 ) --- @else {{ $product->size }} @endif
                                        <br/>
                                        <span class="pull-right">{{ $product->price }} {{$currency}}</span>
                                    <span> Qté : <input type="number" class="quantity" min="1" name="quantity" product="{{$product->rowId}}" value="{{ $product->qty }}" style="width:35px"/></span>
                                    </div>
                                    
                                    <!--  <form action="{{ route('cart.update', $product->rowId) }}" class="form-inline" method="post">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="put">
                                            <div class="form-group">
                                                <input type="text" name="quantity" value="{{ $product->qty }}" class="form-control" />
                                            </div>
                                            <button class="btn btn-default btn-block">Update</button>
                                        </form>
                                    
                                    @if(isset($shippingFee) && $shippingFee != 0)
                                    <tr>
                                        <td class="bg-warning">Shipping</td>
                                        <td class="bg-warning"></td>
                                        <td class="bg-warning"></td>
                                        <td class="bg-warning"></td>
                                        <td class="bg-warning"></td>
                                        <td class="bg-warning">{{$currency}} {{ $shippingFee }}</td>
                                    </tr>
                                    @endif
                                -->
                                    </div>
                            @endforeach
                            <div class="col-md-12">
                                <hr/>
                                <h3><b><span class="pull-right"><span class="total">{{ $total }}</span> {{$currency}}</span> Total</b></h3>
                                <br/>
                                <p>Il vous manque un produit ? <a href="{{route('catalog')}}"> Continuer mes achats</a></p>
                        
                            </div>
                        </div>                        

                    </div>
                    <!--
                    <div class="col-md-8" hidden>
                        <div class="row" style="margin:0">
                            <h2><b> Commander </b></h2>
                           <p>
                            Entrez votre adresse mail. Cette adresse sera utilisée pour vous renseigner sur l'avancement de votre commande.
                           </p>
                           <input type="email" name="email" id="email" placeholder="Votre adresse mail" class="form-control  form-control-lg" style="height:46px">
                           <div class="row" style="margin-top:3%">
                            <div class="col-md-6 pull-right" style="color:grey;line-height:1.5">
                               <i class="fa fa-lock"></i> Toutes les données sont transmises cryptées via une connexion TLS sécurisée.
                            </div>
                            <div class="col-md-6 ">
                                <button type="submit" class="btn  btn-primary btn-lg btn-submit" style="background-color: black;width:100%" ><i class="fa fa-cart-plus"></i> Commander
                                </button>
                            </div>
                           </div>
                           <h3 style="margin-top:5%"><b> Etapes suivantes</b></h3>
                           <hr/>
                           <p><b>Informations de paiement</b><br/>
                            Choisissez votre mode de paiement et entrez vos informations de paiement.
                           </p>
                           <p><b>Confirmation de commande</b><br/>
                                Passez votre commande et recevez un e-mail de confirmation.
                           </p>
                        </div>
                       
                    </div>
                -->
                    <div class="col-md-8" >
                        <div class="col-md-12" >
                                <!--<h2><b> Commander </b></h2>                                
                                <div class="col-md-1"><i class="fa fa-check-circle-o" style="font-size:56px"></i></div>
                                <div class="col-md-11"><b>Email</b><p>gmoail101@gmail.com <a href="#">Changer l'email</a></p></div>                           
                                <hr class="row">
                                -->
                                <!-- Choix du mode de paiement -->
                                <div class="col-md-12">
                                    <h2><b> Renseignements sur le paiement </b></h2>
                                    <p>Choisissez un mode de paiement pour votre commande :</p>
                                
                                    <div class="choice checked">
                                        <div class="col-md-12">
                                        
                                            <label class="container radiobtn">CMI
                                                <input type="checkbox" class="checkbox inputCheck"  id="cmdCmi" checked="checked">
                                                <span class="checkmark"></span>
                                            </label>
                                        
                                        </div>
                                    </div>
                                    <div class="choice">
                                        <div class="col-md-12">
                                            
                                                <label class="container radiobtn">Commande par téléphone
                                                    <input type="checkbox" class="checkbox inputCheck" id="cmdTel" >
                                                    <span class="checkmark"></span>
                                                </label>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="choice" choice = "paiement-a-la-livraison">
                                            <div class="col-md-12">
                                            
                                                <label class="container radiobtn">Paiement à la livraison
                                                    <input type="checkbox" class="checkbox inputCheck"   id="cmdLiv">
                                                    <span class="checkmark"></span>
                                                </label>
                                            
                                            </div>
                                    </div>
                                
                                </div>
                                <!-- Choix du mode de paiement -->
                                <!--instruction du paiement à la livraison -->
                                <div class="col-md-12 paiement-a-la-livraison"  style="margin-top:5%" hidden>
                                    <h3 ><b>    Instructions de paiement à la livraison</b></h3>

                                    
                                    <p><b>Payez en espèces dès que vous receverez votre commande.</b><br/>
                                    
                                    <p>- Soyez certain d'avoir le montant exact du paiement.</p>
                                    <p>- Nous acceptons uniquement le paiement en Dirham Marocain.</p>
                                    <hr/>
                                </div>
                                <!--instruction du paiement à la livraison -->
                                
                                @if(!Auth::check())
                                    <!-- Authentification -->
                                    <div class="col-md-12">                                        
                                            <form action="{{ route('cart.login') }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <div class="col-md-12">@include('layouts.errors-and-messages')</div>
                                            
                                                <h3 style="margin-top:5%"><b> Se connecter </b></h3>
                                                <p>Connectez-vous pour charger les informations necessaire pour votre commande  :</p>
                                        
                                                <hr>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" autofocus>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="password">Mot de passe</label>
                                                        <input type="password" name="password" id="password" value="" class="form-control" placeholder="******">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 pull-right" dir='rtl'>
                                                        <a href="{{route('password.request')}}">J'ai oublié mon mot de passe</a><br>
                                                        <a href="{{route('register')}}" class="text-center">Vous n'avez pas de compte ? Inscrivez vous.</a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="btn btn-primary btn-lg" id="card"  style="background-color:black">Connexion</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <hr/>  
                                    </div>
                                    <!-- Authentification -->

                                    <!-- guest mode -->
                                    <div class="col-md-12">
                                        <form action="{{ route('checkout.store') }}" method="post" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="text" name="courier" id="" value="1" hidden>
                                            <input type="text" name="payment" id="" value="3" hidden>
                                            <input type="text" name="billing_address" id="" value="0" hidden>
                                            <input type="text" name="passiveOrder" id="" value="0" hidden>
                                            
                                            <h3 style="margin-top:5%"><b> Continuer en tant qu'invité</b></h3>

                                            <p>Tous les champs sont requis sauf s'ils sont clairement marqués comme facultatifs.</p>
                                    
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label >Pays</label>
                                                    <input type="text" class="form-control" name="passive_country" placeholder="Maroc">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label >Email</label>
                                                    <input type="email" class="form-control" name="passive_email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group ">
                                                    <label >Nom complet</label>
                                                    <input type="text" class="form-control"  name="passive_name"  placeholder="Nom complet" >
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-md-offset-1">
                                                <div class="form-group ">
                                                    <label >Telephone</label>
                                                    <input type="text" class="form-control"  name="passive_phone" placeholder="Téléphone">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <label >Adresse</label>
                                                    <input type="text" class="form-control"  name="passive_address" placeholder="Adresse postale, appartement, suite, étage" name="billing_address">
                                                </div>
                                            </div>

                                            <div class="col-md-7">
                                                <div class="form-group ">
                                                <input type="text" class="form-control"  name="passive_city" placeholder="Ville">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-md-offset-1">
                                                <div class="form-group ">
                                                <input type="text" class="form-control" name="passive_zip" placeholder="Code postal">
                                                </div>
                                            </div>
                                            <div class=" col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="passive_province" placeholder="Etat">
                                                </div>
                                            </div>
                                    
                                            
                                            <button class="btn btn-primary pull-right btn-lg" id="card"  style="background-color:black"> Passer la commande</button>
                                                
                                            <a href="{{ route('checkout.success') }}" class="btn btn-primary" style="background-color:black;display:none">Passer la commande</a>
                                                
                                        </form>
                                    </div>
                                    <!-- guest mode -->
                                @else
                                
                                    @if(count($addresses) > 0)
                                        <?php  $address = $addresses[count($addresses)-1] ?>
                                            
                                                <!-- payment informations --> 
                                                <div class="col-md-12">
                                                    <form action="{{ route('checkout.store') }}" method="post" class="form-horizontal">
                                                        {{ csrf_field() }}
                                                        <input type="text" name="courier" id="" value="1" hidden>
                                                        <input type="text" name="payment" id="" value="3" hidden>
                                                        <input type="text" name="billing_address" id="" value="{{$address->id}}" hidden>
                                                        

                                                        <h3 style="margin-top:5%"> <a class="dropdown-item pull-right" href="{{ route('logout') }}" style="font-size:12px">Déconnexion</a>
                                                            <b> Informations de livraison</b></h3>
                                                        <div class="col-md-12">
                                                            <a class="pull-right" id="edit">Modifier</a>
                                                            <p><b>Nom complet : </b> {{ $customer->name }}</p>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <p><b>Email : </b> {{ $customer->email }}</p>
                                                        </div>
                                                        
                                                        <div class="col-md-12" >
                                                                <p><b>Téléphone : </b>{{ $address->phone }} </p>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <p>                                                        
                                                                <b> Adresse : </b>
                                                                {{ $address->address_1 }} {{ $address->address_2 }}
                                                                @if(!is_null($address->province_id) || !is_null($address->city_id))
                                                                        {{ $address->city_id }}  {{ $address->province_id }}  <br />
                                                                @endif
                                                                {{ $address->country_id }} {{ $address->zip }}
                                                            </p>
                                                        </div>
                                                        
                                                        <button class="btn btn-primary pull-right btn-lg" id="card"  style="background-color:black"> Passer la commande</button>
                                                            
                                                        <a href="{{ route('checkout.success') }}" class="btn btn-primary" style="background-color:black;display:none">Passer la commande</a>
                                                    </form>
                                                </div>
                                                <!-- payment informations --> 

                                                <!-- Edit address -->
                                                <div class="col-md-12 edit" hidden>
                                                    
                                                    <form action="{{url('editAddress/'.$address->id * 1994)}}" method="post"  class="block">
                                                        {{ csrf_field() }}
                                                            
                                                        
                                                        <label >Modifier vos informations de livraison</label>
                                                        <div class="col-md-12">
                                                            <div class="form-group ">
                                                                <input type="text" class="form-control"  name="phone" placeholder="Téléphone" value="{{ $address->phone }}">
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-12">
                                                            <div class="form-group ">
                                                                <input type="text" class="form-control"  name="address_1" placeholder="Adresse postale, appartement, suite, étage" name="billing_address"  value="{{ $address->address_1 }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group ">
                                                                <input type="text" class="form-control"  name="country" placeholder="Pays" name="billing_address"  value="{{ $address->country_id }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="form-group ">
                                                            <input type="text" class="form-control"  name="city" placeholder="Ville" value="{{ $address->city_id }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-md-offset-1">
                                                            <div class="form-group ">
                                                            <input type="text" class="form-control" name="zip" placeholder="Code postal"  value="{{ $address->zip }}">
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-12">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" name="province" placeholder="Etat"  value="{{ $address->province_id }}">
                                                            </div>
                                                        </div>
                                                        <div class="box-footer col-md-12">
                                                            <div class="form-group" >
                                                                <button type="submit" class="btn btn-primary btn-xs pull-right">Modifier</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Edit address -->
                                                
                                            
                                        

                                    @else
                                        <!-- Add new address -->
                                        <div class="col-md-12">
                                            
                                            <form action="{{ route('customer.address.store', $customer->id) }}" method="post" class="form-horizontal">
                                                {{ csrf_field() }}
                                                <h3 style="margin-top:5%"> <a class="dropdown-item pull-right" href="{{ route('logout') }}" style="font-size:12px">Déconnexion</a>
                                                    <b> Informations de livraison</b></h3>
                                                <div class="col-md-12">
                                                    <p><b>Nom complet : </b> {{ $customer->name }}</p>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <p><b>Email : </b> {{ $customer->email }}</p>
                                                </div>
                                                <br/><br/>
                                                <div class="alert alert-warning" style="margin-top:5%">Vous n'avez aucune adresse de livraison</div>
                                                <h3 style="margin-top:5%"><b> Ajouter une adresse de livraison</b></h3>
                                                <div class="col-md-12 add-address">
                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group ">
                                                            <label >Téléphone</label>
                                                            <input type="text" class="form-control"  name="phone" placeholder="Téléphone">
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-md-12">
                                                        <div class="form-group ">
                                                            <label >Adresse</label>
                                                            <input type="text" class="form-control"  name="address_1" placeholder="Adresse postale, appartement, suite, étage" name="billing_address">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7">
                                                        <div class="form-group ">
                                                        <input type="text" class="form-control"  name="city" placeholder="Ville">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-md-offset-1">
                                                        <div class="form-group ">
                                                        <input type="text" class="form-control" name="zip" placeholder="Code postal">
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="province" placeholder="Etat">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="box-footer col-md-12">
                                                    <div class="btn-group">
                                                        <button type="submit" class="btn btn-primary">Créer</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- Add new address -->
                                    @endif                               
                                @endif
                        </div>
                    </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <p class="alert alert-warning">Votre panier est vide. <a href="{{ route('catalog') }}">Acheter maintenant!</a></p>
                    </div>
                </div>
            @endif
        </div>
@endsection

@section('js')



<!-- Event snippet for Panier / Achat conversion page -->
<script>
  gtag('event', 'conversion', {
      'send_to': 'AW-775985184/b8lUCL7H6ZIBEKCwgvIC',
      'transaction_id': ''
  });
</script>
 <script type="text/javascript">
          

    $(".quantity").on('change',function(){   
        var quantity = $(this).val();

        var ajax = true;       
        
             $.ajax({

                type:'POST',

                url:"cart/"+$(this).attr('product'),

                data:{quantity:quantity, ajax:ajax,"_token": "{{ csrf_token() }}","_method": "put"},

                success:function(data){

                    console.log(data.total);
                    $('.total').text(data.total);
                }

            });
        
    });
    
     $('.thumb').click(function(){
         $('.thumb').each(function(){
             $(this).attr('style',"broder:none");
         })
         $(this).attr('style',"border:2px black solid");
         $('.first-view').attr('style',"background-image : url('"+$(this).attr('src')+"')");
     })

     $('.radiobtn').click(function(){
         $(".checkbox").each(function(){
             $(this).prop('checked', false);
         })
         $(this).find('.checkbox').prop('checked', true);
     })
     $('.choice').click(function(){
        $(".choice").each(function(){
             $(this).attr('class', 'choice');
         })
         $(this).attr('class','choice checked');
         if($(this).attr('choice') == "paiement-a-la-livraison")
         {
             $('.paiement-a-la-livraison').show(500);
         }else{
            $('.paiement-a-la-livraison').hide(); 
         }
         if($(this).find('input').attr('id') == "cmdTel"){
            $('input[name="payment"]').val(4);
         }else if($(this).find('input').attr('id') == "cmdLiv"){
            $('input[name="payment"]').val(2);
         }else if($(this).find('input').attr('id') == "cmdCmi"){
            $('input[name="payment"]').val(3);
         }
     });

     $('#edit').click(function(){
         if ($('.edit').is(":hidden")) {
            $(this).text("Annuler")
            $('.edit').show(500);
         }else if($(".edit").is(":visible")){
            $(this).text("Modifier")
            $('.edit').hide(500);
         }
     })

 </script>

@endsection