

    <footer class="footer-section footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="padding:3%;border-right: 1px white solid">
                
                   <h3 style="color:white"> TERMES & CONDITIONS </h3>
                       <ul>
                            <li> <a href="{{ url('terms-of-use') }}">PAIEMENT SÉCURISÉ </a></li>
                            <li>
                                    <a href="{{ url('terms-of-use') }}">LIVRAISONS</a>
                            </li>
                            <li>
                                    <a href="{{ url('terms-of-use') }}">RETOURS ET ÉCHANGES</a>
                            </li>
                            <li>
                                    <a href="{{ url('terms-of-use') }}">MENTIONS LEGALES</a>
                            </li>
                       </ul>
                       <br>
                       <img src="{{url('images/cmi_3.png')}}" alt="" class=" hidden-xs"  style="margin-left: -10%;
                       height: 75px;">
          
            </div>
            <div class="col-md-3" style="padding:3%;">
                
                    <h3 style="color:white"> S’INSCRIRE À LA NEWSLETTER </h3>
                        <div class="form-group">
                            <input class="" type="email" name="newsletter" id="newsletter" placeholder="Votre email">
                            <button class="btn btn-default btn-xs" type="submit">ENVOYER</button>
                        </div>
                    <h3 style="color:white;margin-top: 25%"> SUIVEZ NOUS </h3>
                        <ul class="footer-social" >
                                <li> <a href="https://www.facebook.com/BensonShoesPageOfficelle/"> <i class="fa fa-facebook" aria-hidden="true"></i>  </a> </li>
                                <li> <a href="https://twitter.com/bensonshoes"> <i class="fa fa-twitter" aria-hidden="true"></i>   </a> </li>
                                <li> <a href="https://www.instagram.com/benson_shoes/"> <i class="fa fa-instagram" aria-hidden="true"></i>  </a> </li>
                                <li> <a href="https://www.youtube.com/channel/UCu4TbnRtyyKO9XlQN8_zcCA"> <i class="fa fa-youtube" aria-hidden="true"></i>  </a> </li>
                        </ul>
           
             </div>
             
             <div class="col-md-3" style="padding:3%;">
                
                    <h3 style="color:white"> SERVICE CLIENTS </h3>
                    <ul>
                            <li> 
                                <a href="tel:+212522949725">+212 5229-49725</a>
                            </li>
                            <li>
                                <a href="tel:+212660080505">  +212 6600-80505</a>
                            </li>
                            <li>
                                <a href="mailto:+shop@benson-shoes.com"> shop@benson-shoes.com</a>
                            </li>
                    </ul>
           
                    <h3 style="color:white;margin-top: 15%"> HORAIRES </h3>
                    <ul>
                            <li> 
                                    LUN-SAM: du 09:00 à 20:00
                            </li>
                            <li>
                                    DIM: FERMÉ
                            </li>
                            
                    </ul>
           
                    
             </div>
             <div class="col-md-3" style="padding:3%;">
                    <div class="Gcontainer">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3323.657958926348!2d-7.643856000000001!3d33.588229!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3aa00134623231fe!2sBenson%20Shoes!5e0!3m2!1sfr!2sus!4v1576147456797!5m2!1sfr!2sus"  height="300" frameborder="0" style="border:0;" allowfullscreen="" style="width:100%"></iframe>
                    </div>
             </div>
            <div class="col-md-8 text-center">
        
           
               <div >  
                    <p >&copy; <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> | All Rights Reserved</p>
                </div> 

            
            </div>
            
        </div>
    </div>
</footer>

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
 <script>
    AOS.init();
  </script>