<!DOCTYPE html>
<html lang="en">
<head>
  
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window,document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '180416476247234'); 
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" 
      src="https://www.facebook.com/tr?id=180416476247234&ev=PageView
      &noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
  
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-9325492-23"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ env('GOOGLE_ANALYTICS') }}');
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Chaussures haut de gamme pour homme, Benson Shoes est, depuis des décennies, un digne représentant du cousu Goodyear . La diversité de nos modèles, la qualité de nos matières et le confort de nos chaussants font le succès de nos collections">
    <meta name="keywords" content="Chaussures haut de gamme, chaussures anglaises, richelieus, mocassin, derby, sneaker, espadrille, chassures classe, benson, bensonshoes, men's oxfords shoes, women's oxfords shoes, dress shoes, monk shoes, english shoes, benson shoes, luxury shoes">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('front/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <link href="{{ asset('front/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
    <script src="{{ asset('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="icon" sizes="57x57" href="{{ asset('favicons/logo2.png')}}">
    @yield('css')

    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <meta property="og:url" content="{{ request()->url() }}"/>
    @yield('og')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    
<style>
   html{
    scroll-behavior: smooth;
  }
  body {
      position: relative;
      font-family: antic-didone, serif; 
  }
  .content{
    margin-top:5%
  }
  
  .space{
    margin-top:25%
  }
  #section1,#section2,#section3,#section4,#section5,#section6,#section7,#section8 {padding-top:50px;height:55em; }
  #sectionEmpty {padding-top:50px;height:55em; }
  #section4 {color: #ffffff;}
  .paragraphe {left: 857.6px;  top: 111.225px; width: 70%; margin:auto}
  .navbar{background:url('/bgs/green banner.jpg') no-repeat center; background-size : 100% 100%}
  .Gcontainer iframe,
  .Gcontainer object,
  .Gcontainer embed { width: 100%; }
  .sub-menu > li{ list-style:none }
</style>
</head>

<body class="boxed"  style="background: #f8f8f8;overflow-x:hidden">
    <div class="container" style="background: #f8f8f8">   

      <section  style="background: url('/bgs/green banner.jpg') no-repeat center;
      background-size: 100%;">
          
          <header>            
              <nav class="navbar navbar-inverse navbar-fixed-top">
                  <div class=" container ">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>                        
                      </button>
                      <a class="navbar-brand" href="/"><img src="{{asset('/bgs/LOGO.png')}}" alt="" srcset="" style="z-index:100"></a>
                    </div>
                    <div >
                      <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav hidden-xs hidden-sm pull-right">
                          <li data-menuanchor="second" id="s2"><a href="/#second">L'Esprit</a></li>
                          <li data-menuanchor="third" id="s3"><a href="/#third">La Technique</a></li>
                          <li data-menuanchor="fourth" id="s4"><a href="/#fourth">Le Design</a></li>
                          <li data-menuanchor="fifth" id="s5"><a href="/#fifth">L'entretien</a></li>         
                          <li data-menuanchor="sixth" id="s6"><a href="/#sixth">Le Savoir-Faire</a></li>
                          <li data-menuanchor="seventh" id="s7"><a href="/#seventh">Contact</a></li>
                          <li data-menuanchor="eighth" id="s8"><a href="/#eighth">Magasins Benson</a></li>
                          <li id="s9"><a href="/category">Voir la Collection & Commander</a></li>
                        </ul>
                        <ul class="nav navbar-nav hidden-lg hidden-md pull-left">
                          <li><a href="/"> > Accueil      </a></li>
                          <li><a href="{{route('front.category.slug','richelieus')}}"> > Richelieus      </a></li>
                          <li><a href="{{route('front.category.slug','bottes-bottines')}}"> > Boots & Bottines</a></li>
                          <li><a href="{{route('front.category.slug','derbys')}}"> > Derbys          </a></li>
                          <li><a href="{{route('front.category.slug','boucles')}}"> > Boucles         </a></li>
                          <li><a href="{{route('front.category.slug','mocassins')}}"> > Mocassins       </a></li>
                          <li><a href="{{route('front.category.slug','sneakers')}}"> > Sneakers        </a></li>
                          <li><a href="{{route('front.category.slug','belgha')}}"> > Babouches tradition   </a></li>
                          <li><a href="/category">Voir toute la Collection & Commander</a></li>
                        </ul>
                      </div>
                      <div  id="section9" style="display:none;color:#ffffff; z-index: -1;background: transparent url('/bgs/green banner.jpg') no-repeat ;background-size:100% 100%;position:absolute;top:100%;left:0%;width:100%;height:372px">
                        <div style="padding:5%">
                        <div class="col-md-3">
                          <div class="paragraphe paragraphe-color-white">
                            <h2>Collection</h2>
                            <br>
                          <ul class="sub-menu">
                            <li><a href="{{route('front.category.slug','richelieus')}}"> > Richelieus      </a></li>
                            <li><a href="{{route('front.category.slug','bottes-bottines')}}"> > Boots & Bottines</a></li>
                            <li><a href="{{route('front.category.slug','derbys')}}"> > Derbys          </a></li>
                            <li><a href="{{route('front.category.slug','boucles')}}"> > Boucles         </a></li>
                            <li><a href="{{route('front.category.slug','mocassins')}}"> > Mocassins       </a></li>
                            <li><a href="{{route('front.category.slug','sneakers')}}"> > Sneakers        </a></li>
                            <li><a href="{{route('front.category.slug','belgha')}}"> > Babouches tradition   </a></li>
                          </ul>
                          </div>
                        </div>
                        <div class="col-md-3 text-center" >
                        <div style="background-image:url('/bgs/saphir-main-img-01-buttonu46248-fr.jpg')" >
                          <a href="{{route('front.category.slug','accessoires')}}">
                            <div style="padding:  10%">
                            <h1>Accessoires</h1>
                            <div class="paragraphe paragraphe-color-white" >
                              <hr>
                            <p> Retrouvez les accessoires et les produits d’entretien pour vos chaussures en magasin !</p>
                            </div>
                            </div>
                          </a>
                        </div>
                        </div>
                        <div class="col-md-3  text-center">
                          <div style="background-image:url('/bgs/60216643_2288738204733767_5510413414083592192_o-buttonu26889-fr.jpg')">
                            <a href="#">
                              <div style="padding:10%">
                              <h1>Entretien</h1>
                                <div class="paragraphe paragraphe-color-white">
                                <hr/>
                                <p> Retrouvez les accessoires et les produits d’entretien pour vos chaussures en magasin !</p>
                                </div>
                              </div>
                            </a>
                          </div>
                        </div>
                        <div class="col-md-3  text-center">
                          <div style="background-image:url('/bgs/untitled-1.jpg')">
                            <a href="{{route('front.category.slug','nouvelle-arrivage')}}">
                              <div style="padding:9%">
                              <h1>Nouvelle Collection</h1>
                              <div class="paragraphe paragraphe-color-white">
                              <hr/>
                                <p> Une Collection pour un automne toute en style</p>
                              </div>
                              </div>
                            </a>
                          </div>
                        </div>
                      </div>
                      </div>
                    </div>
                  </div>
                </nav> 
          </header>
      </section>
      <div class="content">
        <div class="hidden-lg hidden-md space"></div>
        @yield('content')
      </div>
    </div>

    @include('layouts.front.footer')
       <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127885993-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-775985184');


        $('#currency').on('change', function(){

            $.ajax({
            url : 'https://www.benson-shoes.com/changeCurrency',
            type : 'POST',
            data : {"_token": "{{ csrf_token() }}","currency" : $(this).val()},
            success : function(response){ // code_html contient le HTML renvoyé
                location.reload();
            }

            });

        })

        setTimeout(function () {
            $('.alertApp').hide(500);
        },10000);
        $('.filtre').hover(function(){

            var indice = $(this).attr('id');
            $('#sub'+indice).show();
        }, function(){
            // change to any color that was previously used.
            var indice = $(this).attr('id');
            $('#sub'+indice).hide();
        })

        $("#shop").click(function(event){
            
            $("#linkToShop").click(); //opens contact form
        });
        $('#s9').hover(function(){
              $("#section9").show("300");
            })
            
            $('#s9').mouseleave(function(){
              if ($('#section9:hover').length == 0) {
                $("#section9").hide("300");
              }
            })
            $('#section9').mouseleave(function(){
              $("#section9").hide("300");
              
            })
        
</script>


    @yield('js')  

      
</body>
</html>
