<!DOCTYPE html>
<html>
<head>

  @include('layouts.header')

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
  <!-- Font-Awesome CSS -->
  <link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('/css/fontawesome-all.css') }}">
  <!-- Animate -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}">
  <!-- Main Stylesheet -->
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('lib/magnific-popup/magnific-popup.css') }}">

  <style>
    .modal a {
      text-decoration: none;
      border-radius: 5px;
    }
        body::-webkit-scrollbar {
            width: 0.4em;
        }

        body::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color:#222222;
        } 

        body::-webkit-scrollbar-thumb {
            background-color:#666666;
            opacity: 0.6;
            border-radius: 10px;        
    }
  </style>

</head>

<body>
  
  @include('layouts.navbar')

  @yield('content')

  @include('layouts.footer')

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <script src="{{ asset('/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/js/jquery-migrate.min.js')}}"></script>
  <script src="{{ asset('/js/popper.min.js') }}"></script>
  <script src="{{ asset('/js/bootstrap.min.js') }}"></script>

  <script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/js/easing.min.js')}}"></script>
  <script src="{{ asset('/js/wow.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>

  <script src="{{ asset('/js/waypoints.min.js') }}"></script>
  <script src="{{ asset('/js/hoverIntent.js') }}"></script>
  <script src="{{ asset('/js/superfish.min.js') }}"></script>
  <script src="{{ asset('lib/magnific-popup/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('/js/main.js') }}"></script>

  @yield('custom_javascript')
  
</body>
</html>