<style>
    .descript > p  {
        margin-bottom: 5px !important;
    }
    .subtitle{
        margin-top: -8%;
        margin-left: 1%;
    }
    .secondarytitle{
        margin-bottom: 5px !important;
    }
 </style>
 
 <div class="alert alert-warning text-center">
    <p>Pour notre sécurité à tous, les boutiques sont momentanément fermées. Pour tout renseignement concernant les livraisons merci de contacter le: +212 6 60 08 05 05</p>
</div>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item text-dark "><a href="/" class="text-dark">Accueil</a></li>
        <li class="breadcrumb-item "><a href="{{route('front.category.slug',$product->categories[0]->slug)}}" class="text-dark">{{$product->categories[0]->name}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$product->sku}}</li>
    </ol>
</nav>
             <div class="row" >
                <div class="col-md-1">
                    <img src="{{ asset("storage/$product->cover") }}" alt="" width="75" class="margin-bottom thumb" style="border:2px black solid">
                    @if(isset($images) && !$images->isEmpty())
                        @foreach($images as $key=>$image)
                              <img src="{{ asset("storage/$image->src") }}" alt="" width="75" class="margin-bottom thumb" >
                        @endforeach
                    @endif  
                                    
                </div>
               <div class="col-md-8 first-view" style="background-image : url('{{ asset("storage/$product->cover") }}');">
                
               </div>
               
                <div class="col-md-3 " >
                     <div class="col-md-12 ">
                          <h1>
                             {{ $product->name }}                             
                         </h1>
                         <div class="subtitle">
                            @if($product->categories[0]->slug == "accessoires")
                                <small> {{ $product->sku }} </small>
                            @else
                                <small>Ref {{ $product->sku }} </small>
                            @endif
    
                            @if($product->old_price !=null)
                                <h4 >{{ number_format($product->price * $currency_diff, 2) }} {{$currency}}</h4>
                                <del>{{ number_format($product->old_price * $currency_diff, 2) }} {{$currency}}</del>
                            @else
                                <h4 >{{ number_format($product->price * $currency_diff, 2) }} {{$currency}}</del>
                            @endif
                        </div>
                          
                             <div class="descript">
                                 
                                 {!! $product->description !!}
                            </div>
                        
                                @if($product->categories[0]->slug!="accessoires")                                                    
                                    Couleur: <b>{{ $product->color }}</b><br/>                                               
                                    Couture: <b>{{ $product->construction }}</b><br/>
                                    Semelle: <b>{{ $product->sole }}</b>
                                @endif
                            
                         @if(session()->has('demande'))
                          <div class="text-center alert alert-success">
 
                                     <p> <i class="fa fa-stock"></i> Rupture du stock</p>
                                     <p>Nous reviendrons vers vous dés que la paire sera disponible</p>
                          </div>
                         
                         @endif
                        </div>
                        <div class="col-md-12 ">  
                            
                        <div style="margin-top: 5%">
                            @if(count($product_linked)>1)
                                <h4 class="secondarytitle">Autres couleurs : </h4>
                                @foreach ($product_linked as $item)
                                    @if($item->slug != $product->slug && $item->status != 0)
                                       @if($product->categories[0]->slug!="accessoires")
                                       
                                           <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
                                               <img src="{{ asset("storage/$item->cover") }}" style=" width:100px; height : 75px; border-color:white" class="bordered" >
                                           </a>
                                       @else
                                           @if(isset(explode("-",$item->slug)[1]))
                                           <div  style="background-color:{{explode("-",$item->slug)[1]}};margin-left : 1%">
                                               <a href="{{ route('front.get.product', str_slug($item->slug)) }}" >
                                                   <div style=" height : 40px"></div>
                                               </a>
                                           </div>
                                           @endif
                                       @endif
                                    @endif
                                @endforeach
                           @endif 
                        </div>
                        
                         <div style="margin-top: 5%">
                             
                            
                             @if($product->slug == "embauchoirs" || $product->categories[0]->slug!="accessoires")
                             
                           
 
                                 <h4 class="secondarytitle">Pointures : </h4>
 
                                 <select class="form-control size" style="padding: 2%">

                                     @if($product->type == "off")
                                     
                                    
                                         <?php $starter = 39;$starterUK = 5;?>
                                     @else
                                         <?php $starter = 34;$starterUK = 5;?>
                                     @endif
 
                                     @foreach ($product->sizes as $key => $size)
                                            
 
                                           @if($key % 2 == 0)
                                             
                                           <option value="{{$starter}}">{{ "UK ".$starterUK."| EU ".$starter}}  </option>
                                                  
                                         @else
                                           
                                            <option value="{{$starter+0.5}}">{{ "UK ".($starterUK+0.5)."| EU ".($starter+0.5) }}</option>
                                           
                                         
                                              <?php $starter = $starter + 1; $starterUK = $starterUK + 1 ?>
                                       @endif
                                    
                                     @endforeach
                                    
                                 </select>
 
                            
                             
                             @endif                           
                          
                            @include('layouts.errors-and-messages')
                            <!--<form action="{{ route('cart.store') }}"  method="post">-->
                                {{ csrf_field() }}
                                <div class="form-group " style="margin-top: 5%">
                                    
                                    <h4 class="secondarytitle">Quantité : </h4>
                                    <input type="number"
                                        style="width:100%;"
                                        min="1"
                                        class="form-control"
                                        name="quantity"
                                        id="quantity"
                                        placeholder="Quantité"
                                        value="1" />
                                    <input type="hidden" name="product" value="{{ $product->id }}" />
                                    <input type="hidden" name="size" id="size" @if($product->categories[0]->slug=="accessoires" && $product->slug != "embauchoirs")
                                        value="0" @else value="39" @endif />
                                </div>
                              
                                    <div class="alert alert-success alert-xs panier-success" style="display:none" >
                                        <i class="fa fa-check-circle"></i> Article ajouté au panier
                                    </div>
                            
                                    <button type="submit" class="btn  btn-primary btn-lg btn-submit" style="background-color: black; width : 100%" onclick="fbq('track', 'AddToCart');">
                                        <i class="fa fa-cart-plus"></i> 
                                        Ajouter au panier
                                    </button>
                              
                                    {{-- <button class="btn btn-inline-primary btn-lg" style="color:black;
                                    background-color: transparent;
                                    border: 1px dashed;"><a href="{{route('maintain')}}" style="color:black"> 
                                        <img src="{{asset('images/entretient.png')}}" alt="" height="65">
                                        Conseils d'entretien</a>
                                    </button> --}}
                                   
                                    
                                    <a href ="{{ route('cart.index') }}" class="btn  btn-default btn-lg goToCart" style="width : 100%;display:none;margin-top:5%"><i class="fa fa-cart"></i> Voir le panier
                                    </a>
                                <p id="alert-quantity" style="color:red;font-size:10px"></p>
                            <!--</form>-->
                            
                            </div>
                         </div>
                         
                         <div class=" col-md-12 share-block">
                             <p> <i class="fa fa-share-alt"></i> Partagez : </p>
                            {!! Share::currentPage()
                                ->facebook()
                                ->twitter()
                                ->telegram()
                                ->whatsapp(); 
                            !!}
                         </div>
                </div>
    
 
            </div>
<!--  @include('mailchimp::mailchimp')-->
 @section('css')
     <link rel="stylesheet" href="{{ asset('front/css/drift-basic.min.css') }}">
     <style type="text/css">
         .product-cover-wrap {
             border: 1px solid #eee;
         }
 
         .product-description {
             position: relative;
         }
 
         .excerpt {
             display: none;
         }
 
         .modal-dialog .modal-content {
             min-width: 800px;
         }
 
         .modal-dialog h1 {
             font-size: 18px;
             text-align: left;
             line-height: 24px;
         }
 
         .modal-dialog h1 small {
             display: block;
             padding-top: 10px;
         }
 
         .modal-dialog .description,
         .modal-dialog .excerpt {
             font-size: 14px;
             line-height: 16px;
             text-align: left;
         }
 
         .modal-dialog .description {
             display: none;
         }
 
         .modal-dialog #quantity {
             width: 85px;
         }
 
         .modal-dialog .modal-content {
             padding: 15px;
         }
 
         .modal-content .excerpt {
             display: block;
             text-align: left;
         }
 
         #thumbnails li {
             margin-bottom: 10px;
         }
 
         #thumbnails li img {
             width: 100px;
         }
 
         #thumbnails li a:hover img {
             border: 1px solid #d89522;
         }
     </style>
 @endsection
 @section('js')
 
    
     <script type="text/javascript" src="{{ asset('front/js/Drift.min.js') }}"></script>
     @if($product->slug != "embauchoirs" && $product->categories[0]->slug=="accessoires")
 
     <script type="text/javascript">
 
         $(document).ready(function () {
 
             var productPane = document.querySelector('.product-cover');
             var paneContainer = document.querySelector('.product-cover-wrap');
 
             new Drift(productPane, {
                 paneContainer: paneContainer,
                 inlinePane: false
             });
 
             $('#thumbnails li img').on('click', function () {
                 $('#main-image')
                         .attr('src', $(this).attr('src') +'?w=400')
                         .attr('data-zoom', $(this).attr('src') +'?w=1200');
             });
 
         });
 
         /*
         $('#quantity').on('change', function(){
 
             if($("#quantity").attr('max') == $("#quantity").val()){
 
                 $('#alert-quantity').text('Quantité maximum atteinte');
             }
             else if($("#quantity").val() > parseInt($("#quantity").attr('max'))){
                 $("#quantity").val($("#quantity").attr('max'));
                 $('#alert-quantity').text('Vous ne pouvez pas dépasser la quantité disponible');
             }
             else if($("#quantity").val() < 0){
                 $("#quantity").val($("#quantity").attr('min'));
                  $('#alert-quantity').text('');
             }
 
         });*/
     </script>
     @else
 <script type="text/javascript">
         $(document).ready(function () {
 
             var productPane = document.querySelector('.product-cover');
             var paneContainer = document.querySelector('.product-cover-wrap');
 
             new Drift(productPane, {
                 paneContainer: paneContainer,
                 inlinePane: false
             });
 
             $('#thumbnails li img').on('click', function () {
                 $('#main-image')
                         .attr('src', $(this).attr('src') +'?w=400')
                         .attr('data-zoom', $(this).attr('src') +'?w=1200');
             });
         });
 
         $('.size').on('change', function(){
             if($(this).attr('class')){
                 
                 $("#quantity").attr('max',$(this).attr('quantity'));
                 $("#quantity").attr('min',1);
                 $("#quantity").val(1);
 
                 $('#size').val($(this).val());
                 $('#alert-quantity').text('');
 
                 if($("#quantity").attr('max') == $("#quantity").val()){
                     $('#alert-quantity').text('Il ne reste qu\'une seule paire');
                 }
             }
         })
 
         $('#quantity').on('change', function(){
             if($("#quantity").attr('max') == 0)
             {
                 $("#quantity").val(0);
                 $('#alert-quantity').text('Veuillez choisir une pointure');
             }
             else if($("#quantity").attr('max') == $("#quantity").val()){
 
                 $('#alert-quantity').text('Quantité maximum atteinte');
             }
             else if($("#quantity").val() > parseInt($("#quantity").attr('max'))){
                 $("#quantity").val($("#quantity").attr('max'));
                 $('#alert-quantity').text('Vous ne pouvez pas dépasser la quantité disponible');
             }
             else if($("#quantity").val() < 0){
                 $("#quantity").val($("#quantity").attr('min'));
                  $('#alert-quantity').text('');
             }
 
         })
        /* */
         
     </script>
     @endif
     <script type="text/javascript">          

        $(".btn-submit").click(function(e){    
            e.preventDefault();
            var quantity = $("input[name=quantity]").val();

            var product = $("input[name=product]").val();

            var size = $("input[name=size]").val();

            var ajax = true;
            
                 $.ajax({

                    type:'POST',

                    url:"cart",

                    data:{quantity:quantity, product:product, size:size, ajax:ajax,"_token": "{{ csrf_token() }}"},

                    success:function(data){
                        console.log(data);
                        $('.panier-success').show("500").delay("2000").hide("500");
                        $('.goToCart').show();
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
     </script>
     <script src="{{ asset('front/js/share.js') }}"></script>
 @endsection