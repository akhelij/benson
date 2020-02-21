@extends('layouts.front.app')
<style>
   .navbar,.footer {
   display: none;
   }
 </style>
@section('content')

    <div class="container product-in-cart-list">
        <div class="row">
            <div class="col-md-12">
                <!-- Order canceled -->  
                <div class="col-md-12" style="text-align:center">
                    <h2 class="alert alert-danger">Vous avez annuler votre commande! </h2>
                    <hr>
                <h4>Avez-vous des questions sur votre commande?</h4>
                <p>Nous sommes là pour vous. Faites-nous savoir comment nous pouvons vous aider.</p>
                
                    <h4>Contactez-nous</h4>
                    <p>Par mail : shop@benson-shoes.com </p>
                    <P>Ou appelez le : 06 60 08 05 05</p>                        
            
                    Ou<br/>
                    <a href="{{route('catalog')}}" class="btn btn-primary btn-lg"  style="background-color:black">Revenir à la collection</a>
                 
                </div>
                <!-- Order canceled -->
               
        
            </div>
        </div>

    </div>
@endsection