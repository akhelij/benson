@if(!empty($products) && !collect($products)->isEmpty())
    <ul class="text-center list-unstyled">
          
        @foreach($products as $product)
        
            @if($product->status == 1)
            <a href="{{ route('front.get.product', str_slug($product->slug)) }}"    >
                <li class="col-md-3 col-sm-6 col-xs-12 " style="margin-bottom: 2%;"> 
                   
                    <div class="product-list">
                        <div class="single-product " style="background-image : url('{{ url("storage/$product->cover") }}');">
                            
                            @if(isset($product->categories[4]))
                            
                                <img src="{{url('images/new.png')}}" alt="" width="25px">
                            @endif
                            
                        
                            <div class="product-text" >
                            
                                
                                    <h4 class="margin-bottom"><b>{{ $product->name }}</b></h4>
                                        <div style="    max-height: 22px;  overflow: hidden;">{!! $product->description !!}  </div>  
                                    <h5 class="margin-bottom">Ref {{ $product->sku }}</h5>  
                                                                     
                                    <h5 class="margin-bottom">  <b> 
                                    @if($product->old_price !=null)
                                        {{ number_format($product->price * $currency_diff, 2) }}  {{$currency}}
                                        {{ number_format($product->old_price * $currency_diff, 2) }}  {{$currency}}                                  
                                    @else
                                    
                                    {{ number_format($product->price * $currency_diff, 2) }}  {{$currency}}
                                   
                                    @endif
                                    </b>
                                    </h5>
                                        
                            </div>
                            
                        
                        
                        </div>
                  </div>
                </li>
            </a>
            @endif
        @endforeach
        
            <div class="row">
                @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
                <div class="col-md-6">
                    <div class="pull-left">{{ $products->links() }}</div>
                </div>
                @endif
                <div class="col-md-6 pull-right">
                    <div class="pull-right"><a href="{{url('/category')}}" class="btn-lg btn  btn-default">Voir toute la collection</a></div>
                </div>
            </div>
       
    </ul>
@else
    <p class="alert alert-warning">Aucun produit n'est disponible.</p>
@endif