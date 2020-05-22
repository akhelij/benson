<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
   
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/skins/skin-purple.min.css') }}">

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <!-- jQueryUI 1.12.1 -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('//cdn.ckeditor.com/4.8.0/standard/ckeditor.js') }}"></script>

   
    <style type="text/css">
        #search-btn {
            border: 1px solid #d2d6de;
        }
        #search-btn:hover {
            background: #605ca8;
            color: #eee;
        }
        .tab-content > .tab-pane {
            border: 1px solid #ddd;
            padding: 15px;
            border-top: none;
        }
        #search-btn {
            border: 1px solid #bbb;
        }
        #admin-search {
            margin-bottom: 15px;
        }
    </style>
    @yield('css')

    <link  sizes="57x57" href="{{ asset('favicons/logo2.png')}}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script type="text/javascript"> //<![CDATA[
var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.comodo.com/" : "http://www.trustlogo.com/");
document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]>
</script>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<noscript>
    <p class="alert alert-danger">
        You need to turn on your javascript. Some functionality will not work if this is disabled.
        <a href="https://www.enable-javascript.com/" target="_blank">Read more</a>
    </p>
</noscript>
<!-- Site wrapper -->
<div class="wrapper">
    @include('layouts.admin.header', ['user' => $user])

    @include('layouts.admin.sidebar', ['user' => $user])

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.admin.footer')

    @include('layouts.admin.control-sidebar')
</div>
<!-- ./wrapper -->

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('js/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/app.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('js/admin.js?v=0.1') }}"></script>
@yield('js')

</body>
</html>
