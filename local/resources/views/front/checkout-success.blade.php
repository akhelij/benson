@extends('layouts.front.app')
<style>
   .navbar {
   display: none;
   }
 </style>
@section('content')
    <div class="container product-in-cart-list">
        <div class="row">
            <div class="col-md-12">
                <hr>
                <p class="alert alert-success">Votre commande à été valider! <a href="{{ route('catalog') }}">Afficher plus!</a></p>
                <?php
                die('hi');
                $postParams = array();
                foreach ($_POST as $key => $value){
                    array_push($postParams, $key);				
                    echo "<tr><td>" . $key ."</td><td>" . $value . "</td></tr>";
                }
                
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
                if($retrievedHash == $actualHash )	{
                    echo "<h4>HASH is successfull</h4>"  . " <br />\r\n";	
                }else {
                    echo "<h4>Security Alert. The digital signature is not valid.</h4>"  . " <br />\r\n";
                }		
            ?>
            </div>
        </div>
    </div>
@endsection