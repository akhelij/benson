@extends('layouts.front.app')
<style>
   .navbar,.footer {
   display: none;
   }
 </style>
@section('content')
<?php
                    
    $postParams = array();
    Log::info('--------------------------------------------------------------------------------------');	
    Log::info('--------------------------------------------------------------------------------------');	    
    Log::info('------------------------------------New order done------------------------------------');		
    foreach ($_POST as $key => $value){
        array_push($postParams, $key);	
        
        Log::info($key.' ::: '.$value);			
    }
    Log::info('------------------------------------New order done------------------------------------');
    Log::info('--------------------------------------------------------------------------------------');	
    Log::info('--------------------------------------------------------------------------------------');	
    natcasesort($postParams);		

    $hashval = "";					
    foreach ($postParams as $param){				
        $paramValue = trim(html_entity_decode($_POST[$param], ENT_QUOTES, 'UTF-8')); 
        $escapedParamValue = str_replace("|", "\\|", str_replace("\\", "\\\\", $paramValue));	
            
        $lowerParam = strtolower($param);
        if($lowerParam != "hash" && $lowerParam != "encoding" )	{
            $hashval = $hashval . $escapedParamValue . "|";
        }
    }

    $storeKey = "TEST1234";
    $escapedStoreKey = str_replace("|", "\\|", str_replace("\\", "\\\\", $storeKey));	
    $hashval = $hashval . $escapedStoreKey;

    $calculatedHashValue = hash('sha512', $hashval);  
    $actualHash = base64_encode (pack('H*',$calculatedHashValue));

    $retrievedHash = $_POST["HASH"];
    
?>
    <div class="container product-in-cart-list">
        <div class="row">
            <div class="col-md-12">
                @if($retrievedHash == $actualHash)	
                <!-- Order succeded -->  
                <div class="col-md-12" style="text-align:center">
                    <h2 class="alert alert-danger">Votre commande à échouer! </h2>
                    <hr>
                <h4>Avez-vous des questions sur votre commande?</h4>
                <p>Nous sommes là pour vous. Faites-nous savoir comment nous pouvons vous aider.</p>
                
                    <h4>Contactez-nous</h4>
                    <p>Par mail : shop@benson-shoes.com </p>
                    <P>Ou appelez le : 06 60 08 05 05</p>                        
            
                    Ou<br/>
                    <a href="{{route('catalog')}}" class="btn btn-primary btn-lg"  style="background-color:black">Revenir à la collection</a>
                 
                </div>
                <!-- Order succeded -->
                @else 
                    <?php Log::info('---------------------------------With Hash Problem------------------------------------------'); ?>
                    <!-- Order succeded -->  
                    <div class="col-md-12" style="text-align:center">
                        <h2 class="alert alert-danger">Votre commande à échouer! </h2>
                        <hr>
                    <h4>Avez-vous des questions sur votre commande?</h4>
                    <p>Nous sommes là pour vous. Faites-nous savoir comment nous pouvons vous aider.</p>
                    
                        <h4>Contactez-nous</h4>
                        <p>Par mail : shop@benson-shoes.com </p>
                        <P>Ou appelez le : 06 60 08 05 05</p>                        
                
                        Ou<br/>
                        <a href="{{route('catalog')}}" class="btn btn-primary btn-lg"  style="background-color:black">Revenir à la collection</a>
                     
                    </div>
                    <!-- Order succeded -->
                @endif
        
            </div>
        </div>

    </div>
@endsection