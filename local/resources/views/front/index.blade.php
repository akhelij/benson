<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
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
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <meta property="og:url" content="{{ request()->url() }}"/>
    @yield('og')
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="{{ asset('front/js/jquery.min.js') }}"></script>
	@if(!$isMobile)
	<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.multiscroll.css')}}" />	
	<script type="text/javascript" src="{{asset('js/jquery.multiscroll.js')}}"></script>	
	@endif	
	<link rel="stylesheet" type="text/css" href="{{asset('css/examples.css')}}" />		
	<script type="text/javascript" src="{{asset('js/jquery.easings.min.js')}}"></script>

	<script type="text/javascript">
	 $(document).ready(function() {
            $('#myContainer').multiscroll({
            	sectionsColor: ['#fefefe', '#fefefe', '#fefefe', '#fefefe', '#fefefe', '#fefefe', '#fefefe', '#fefefe'],
            	anchors: ['first', 'second', 'third', 'fourth', 'fifth','sixth','seventh','eighth'],
            	menu: '#menu',
            	navigation: true,
            	navigationTooltips: ['One', 'Two', 'Three','Four','Five','Six','Seven','Eight'],
            	loopBottom: true,
            	loopTop: true
            });
        });
    </script>
    <style>
        html{
        scroll-behavior: smooth;
      }
      body {
		
          font-family: antic-didone, serif; 
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
      #section9 > .col-md-3{
        min-height:210px !important;
      }
	  @media screen and (max-width: 500px) {
		#multiscroll-nav {
			display: none;
		}
		body{
			overflow: auto !important;
		}
		#content{
			margin-top:19%
		}
		.container{
			padding:0 !important;
			margin :0 !important;
		}
	}
   </style>
</head>
<body class="container">


	<section>
			
	<header >
	
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
					<li><a href="{{route('front.category.slug','belgha')}}"> > Babouches tradition        </a></li>
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
	<div id="myContainer" class=" hidden-sm hidden-xs">

		<div class="ms-left">
			
			<div class="ms-section" id="left1" style="background: transparent url('/bgs/shoot 9-1.jpg') no-repeat right; ">
				
			</div>

			<div class="ms-section" id="left2" style="background: transparent url('/bgs/oxford-derby-e1394474071111-crop-u1149.png') no-repeat right bottom;">
				<div class="p  p-padding" style="padding:0% 15% 10% 15%">
					<h1 > Expérience d'un demi siècle</h1>
					<p>
					Une expérience vieille de plus de 50 ans. Des maîtres artisans talentueux et dotés d’un savoir faire exceptionnel. 
					Benson Shoes est, depuis des décennies, un digne représentant du cousu Goodyear . 
					La diversité de nos modèles, la qualité de nos matières et le confort de nos chaussants font le succès de nos collections . 
					Notre ADN : offrir une gamme élégante et sobre allant de la chaussure classique au sneaker.
					</p>
					<p>        
					Benson Shoes est parvenu à affermir sa position sur le marché de la chaussure grâce au succès remporté par ses modèles 
					classiques et ses modèles sport auprès de sa cible jeune et moins jeune. La qualité et le cachet propre à la marque 
					résultent d’un long processus de fabrication.
					</p>
				</div> 
			</div>

			<div class="ms-section" id="left3" style="background: transparent url('/bgs/Authenticite1.png') no-repeat right center;">
				<div class="p p-padding">
					<h1>La Technique</h1>
					<div  style="background-color: #ffffff96; ">
					<p style="padding:5%">
						La vocation première de BENSON SHOES est artisanale, et elle a fait de la finesse du travail manuel son sacerdoce. La coupe des différentes parties de la chaussure (tige, doublure semelle, etc..) est intégralement effectuée à la main. Quant aux autres étapes d’assemblage et de couture, elles nécessitent elles aussi de nombreuses interventions manuelles. Par exemple, la trépointe est cousue à la tige et à la première de montage. Elle est ensuite retournée pour que l’ensemble soit cousu une deuxième fois à la semelle d’usure. Quant au remplissage de la cavité entre la semelle première et la semelle d’usure, il est assuré par un mélange à base de poudre de liège et de colle, ce qui permet aux porteurs de la marque d’apprécier une empreinte personnalisée au bout de quelques jours d’utilisation.
					
					</p>
					</div>
				
				</div>
			</div>
			<div class="ms-section" id="left4" style="background: transparent url('/bgs/green banner.jpg') no-repeat ;background-size:100% 100%">
				<h1 class="p-white" style="position: absolute;
				top: 15.9%;
				left: 86%;
				float: right;
				font-size: 42px;">Le De</h1>
				<div class="p-padding" style="padding:10% 20% 10% 20%">
					<div class="p-white p-center">
					<img   src="/bgs/goodyear welted - blanc.png" width="100px"> 
					</div>
					<h1 class="p-white" style="padding:5%">BENSON SHOES</h1> 
					<div class="p p-white">					
						
						<p class="p-white">
							Grâce à des concepteurs dédiés à la marque, et à leurs efforts permanents pour concilier modernité du design et tradition du procédé, BENSON SHOES présente des modèles au style unique et aux lignes pures, offrant à ses clients un choix adapté à leurs exigences de distinction et de confort.
					
								</p> 
					</div>
				</div>
			</div>
			<div class="ms-section" id="left5" style="background: transparent url('/bgs/accessoire-entretenir-chaussure-homme-cuir copie-crop-u1674.jpg') no-repeat right center ;">
				<div class="p p-padding">
					<h1 style="margin-top:-15%"> L'Entretien</h1>
				</div>
			</div>
			<div class="ms-section" id="left6">
				<div class="p p-center p-padding">
					<h1>le Savoir-Faire</h1>
				
					
					<h2 class="p-center">L'art et la matière</h2>
					<div class="p"> 
						<p>
							L’art authentique qu’exercent nos artisans est révélé grâce à la qualité irréprochable de nos matériaux. Nos cuirs, entre-autres, proviennent des meilleures tanneries Européennes. Pour assurer à nos clients une qualité irréprochable, des tests de laboratoire complets sont régulièrement opérés sur les matières principales. Au Maroc, pays où la maroquinerie est un art séculaire, la marque n’a eu de cesse d’enrichir l’industrie de la chaussure grâce à ses modèles haut de gamme, à la longévité prouvée.
						</p>
						</br>
						<p>
							La recherche des meilleurs matériaux constitue l’un des soucis majeurs de la société. Aussi prospecte-t-elle régulièrement les marchés européens afin de dénicher les meilleures peausseries. Le tri des peaux est confié à des spécialistes, chargés de trouver les pièces qui répondent parfaitement aux exigences de qualité et d’hygiène notamment auprès des tanneries françaises ayant fait leurs preuves dans le tannage des peausseries de veau.
						</p>
						
					</div>
				</div>
			</div>
			<div class="ms-section" id="left7">
				<div class="Gcontainer">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3323.657958926348!2d-7.643856000000001!3d33.588229!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3aa00134623231fe!2sBenson%20Shoes!5e0!3m2!1sfr!2sus!4v1576147456797!5m2!1sfr!2sus"  height="878" frameborder="0" style="border:0;" allowfullscreen="" style="width:100%"></iframe>
				</div>
			</div>
			<div class="ms-section" id="left8" style="background: transparent url('/bgs/left side map.jpg') no-repeat right ;">
				
			</div>
		</div>
		
		<div class="ms-right">
			{{--  --}}
			<div class="ms-section" id="right1"  style="background: transparent url('/bgs/shoot 9-2.jpg') no-repeat left ;">
				{{-- <img class="position_content" id="u1127_img" src="/images/logo.jpg" alt=""  width="250">  --}}
				<div style="margin-top : 20%;margin-left : -20%;">
					<h1 style="color:white; font-size:40px">Des souliers et des hommes...</h1>
					<a href="{{url('/category')}}" class="btn btn-lg btn-default">
						Voir la collection
					</a>
				</div>
			</div>

			<div class="ms-section" id="right2"  style="background: transparent url('/bgs/oxford-derby-e1394474071111-crop-u1154.png') no-repeat left  bottom;">
				<h1 style="margin-top:-35%"> L'Esprit</h1>
			</div>

			<div class="ms-section" id="right3" style="background: transparent url('/bgs/Authenticite2.png') no-repeat left center ;">
				<!--Block right3-->
			</div>
			<div class="ms-section" id="right4">
				<h1 style="position: absolute;
				float: left;
				color: black;
				font-size: 42px;
				top: 14.9%;">sign</h1>
				<div class="p" >
				<img style="float:left;width:80%" src="/bgs/d9664079799de868f1ee80260bac0159-crop-u1558.jpg" alt="" srcset="">
				<img style="float:left;width:80%" src="/bgs/d9664079799de868f1ee80260bac0159-crop-u1568.jpg" alt="" srcset="">
				<img style="float:left;width:80%" src="/bgs/d9664079799de868f1ee80260bac0159-crop-u1575.jpg" alt="" srcset="">
				</div>
			</div>
			<div class="ms-section" id="right5" style="background: transparent url('/bgs/accessoire-entretenir-chaussure-homme-cuir copie-crop-u1696.jpg') no-repeat left center;">
				<div class="p p-padding p-justify" style="padding-left:7%;padding-top:10%;background-color: #ffffff96;">
				
					<p>Pour l'entretien et la réparation de vos chaussures Benson, nos magasins de Casablanca et Rabat disposent d'un atelier de glaçage et de patine. Vous pouvez nous laisser vos chaussures usagées afin de leur redonner brillance et éclat.
					</p>
					<p>
					Pour un entretien du cuir, notre glaçage de renommée fera votre bonheur. Vous nous laisserez une paire vieillissante et vous récupérerez des chaussures que vous aurez à nouveau envie de porter. Le cuir sera décapé, nourri, traité puis lustré de manière à obtenir une belle brillance à l'arrière et au bout de vos chaussures.
					</p>
					<p>
					Concernant la patine, il s'agit de la coloration manuelle de vos paires neuves et moins neuves. Une belle couleur nuancée sera obtenue. Ces paires personnalisées pour vous sont uniques. Le travail manuel donne à chacune une touche différente.
					</p>
					<p>
					Quand vos semelles ou talons sont usés, le bon réflexe à avoir est de faire appel à l'un de nos ateliers. Une paire bien portée est toujours d'un extreme confort . Il est ainsi très intéressant de lui donner une seconde vie. La semelle sera entièrement décousue et retirée. Votre paire sera montée sur une nouvelle semelle de votre choix. Ce travail est suivi d'un entretien du cuir; vous aurez du mal à reconnaître vos chaussures !!
					</p>
					<p>
					N'hesitez pas à nous rendre visite, nos conseillers sont toujours à votre disposition pour répondre à vos demandes. Nous réalisons pour vous de belles collections, nous vous conseillons pour vos achats, et nous tenons à vous aider à garder vos chaussures dans un bel état et à faire vivre vos cuirs le plus longtemps possible.
					</p>
				</div>
			</div>
			<div class="ms-section" id="right6">
				<div class="Gcontainer">
					<iframe style="width:100%" height="878" src="https://www.youtube.com/embed/1RUInzHz544" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen ></iframe>
				</div>
			</div>
			<div class="ms-section" id="right7">
				<div class="p p-center">
			

					<h1 >MAGASINS</h1>
				
					<div  class="p-padding">
					<p >
					196 Bd d’Anfa (Rond Point Porte d’Anfa) - Casablanca
			
					Tél : +212 (05) 22 94 97 25
			
					Centre Commercial Marina LotB1. Bd Almohades - Casablanca
			
					Tél : ‎+212 80-8538477
			
					</p>
					*****
				</br>
					<p >
					3 RDC Avenue Imam Malik el youssoufia, Soussi Label Vie - Rabat
			
					Tél : +212 (05) 37 65 92 53
			
					
					</p>
					*****
				</br>
			
					
					<p >
					Résidence Al Tajmil place des nations - Tanger
			
					Tél : +212 (05) 39 32 26 15
					</p>
					<br>
					<a href="tel:+212660080505" class="btn btn-lg btn-default">Contactez nous</a>
				</div>
				</div>
			</div>
			<div class="ms-section" id="right8" style="background: transparent url('/bgs/right side map.jpg') no-repeat left ;">
				
			</div>
		</div>	
	</div>


	<div id="content" class="hidden-md hidden-lg" >

		<div class="row">

			<div   style="background: transparent url('/bgs/shoot 9.jpg') no-repeat;
			background-size: cover;
			height: 300px;
			text-align:center">
				<div>
					<h1 style="color:white;padding:5%;padding-top:30%;">Des souliers et des hommes...</h1>
					<a href="{{url('/category')}}" class="btn btn-md btn-default" style="margin-top:7%">
						Voir la collection
					</a>
				</div>
				{{-- <div class="text" style="padding-top:15%;text-align:center">
					<img class="position_content" id="u1127_img" src="/bgs/goodyear welted - blanc.png" alt=""  style="width:120px"> 
					<h1 style="margin-top : 5%;color:white;font-size: 1em;">Des souliers et des hommes...</h1>
				</div> --}}

			</div>
			
		</div>

		<div class="row">
			<div  style="background: transparent url('/bgs/oxford-derby.png') no-repeat bottom;background-size: 100%;
			height: 600px;padding:5%">
				<div class="p  p-padding" style="padding:0% 15% 10% 15%;text-align:center">
					<h1 > Expérience d'un demi siècle</h1>
					<p>
					Une expérience vieille de plus de 50 ans. Des maîtres artisans talentueux et dotés d’un savoir faire exceptionnel. 
					Benson Shoes est, depuis des décennies, un digne représentant du cousu Goodyear . 
					La diversité de nos modèles, la qualité de nos matières et le confort de nos chaussants font le succès de nos collections . 
					Notre ADN : offrir une gamme élégante et sobre allant de la chaussure classique au sneaker.
					</p>
					
				</div> 
			</div>
			
				
		</div>

		<div class="row">
			<div   style="background: transparent url('/bgs/Authenticite.png') no-repeat center;background-size: cover;padding:5%">
				<div class="p p-padding" style="padding:0% 15% 10% 15%;text-align:center">
					
					<div  style="background-color: #ffffff96; ">
					<p style="padding:5%">
						<h1>La Technique</h1>
						La vocation première de BENSON SHOES est artisanale, et elle a fait de la finesse du travail manuel son sacerdoce. La coupe des différentes parties de la chaussure (tige, doublure semelle, etc..) est intégralement effectuée à la main. Quant aux autres étapes d’assemblage et de couture, elles nécessitent elles aussi de nombreuses interventions manuelles. 
						{{-- Par exemple, la trépointe est cousue à la tige et à la première de montage. Elle est ensuite retournée pour que l’ensemble soit cousu une deuxième fois à la semelle d’usure. Quant au remplissage de la cavité entre la semelle première et la semelle d’usure, il est assuré par un mélange à base de poudre de liège et de colle, ce qui permet aux porteurs de la marque d’apprécier une empreinte personnalisée au bout de quelques jours d’utilisation. --}}
						
					</p>
					</div>
				
				</div>
			</div>
			
		</div>

		<div class="row">
			<div   style="background: transparent url('/bgs/green banner.jpg') no-repeat ;background-size:100% 100%">
				<div class="p-padding" style="padding:10% 20% 10% 20%">

					<div class="p-white p-center">
						<h1 class="p-white" style="font-size:42px;margin-top:7.5%">Le Design</h1>
					</div>
					
					<div class="p p-white">		
						<p class="p-white">
							Grâce à des concepteurs dédiés à la marque, et à leurs efforts permanents pour concilier modernité du design et tradition du procédé, BENSON SHOES présente des modèles au style unique et aux lignes pures, offrant à ses clients un choix adapté à leurs exigences de distinction et de confort.
						</p> 
					</div>

				</div>
			
				
			</div>
		</div>
		
		<div class="row">
			<div  style="padding:5%">
				<div class="p p-center p-padding">
					<h1>le Savoir-Faire</h1>				
					
					<h2 class="p-center">L'art et la matière</h2>

					<div class="p"> 
						<p>
							L’art authentique qu’exercent nos artisans est révélé grâce à la qualité irréprochable de nos matériaux. Nos cuirs, entre-autres, proviennent des meilleures tanneries Européennes. Pour assurer à nos clients une qualité irréprochable, des tests de laboratoire complets sont régulièrement opérés sur les matières principales. Au Maroc, pays où la maroquinerie est un art séculaire, la marque n’a eu de cesse d’enrichir l’industrie de la chaussure grâce à ses modèles haut de gamme, à la longévité prouvée.
						</p>						
					</div>

				</div>
			</div>
			
		</div>
		
		<div class="row">
			<div  >
				<div class="Gcontainer">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3323.657958926348!2d-7.643856000000001!3d33.588229!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3aa00134623231fe!2sBenson%20Shoes!5e0!3m2!1sfr!2sus!4v1576147456797!5m2!1sfr!2sus"  height="878" frameborder="0" style="border:0;" allowfullscreen="" style="width:100%"></iframe>
				</div>
			</div>
			<div  style="padding:5%">
				<div class="p p-center">
			

					<h1 >MAGASINS</h1>
				
					<div  class="p-padding">
					<p >
					196 Bd d’Anfa (Rond Point Porte d’Anfa) - Casablanca
			
					Tél : +212 (05) 22 94 97 25
			
					Centre Commercial Marina LotB1. Bd Almohades - Casablanca
			
					Tél : ‎+212 80-8538477
			
					</p>
					*****
				</br>
					<p >
					3 RDC Avenue Imam Malik el youssoufia, Soussi Label Vie - Rabat
			
					Tél : +212 (05) 37 65 92 53
			
					
					</p>
					*****
				</br>
			
					
					<p >
					Résidence Al Tajmil place des nations - Tanger
			
					Tél : +212 (05) 39 32 26 15
					</p>
					<br>
					<a href="tel:+212660080505" class="btn btn-lg btn-default">Contactez nous</a>
				</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div   style="background: transparent url('/bgs/left side map.jpg') no-repeat right ;">
				
			</div>
			<div   style="background: transparent url('/bgs/right side map.jpg') no-repeat left ;">
				
			</div>
		</div>
	</div>
	
		
	
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

<script>
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
</body>
</html>
