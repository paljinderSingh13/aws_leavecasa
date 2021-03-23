<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LeaveCasa - The Best Spot to Make Your Holiday Plans</title>
   <link rel = "icon" type = "image/png" href = "{{ url('/images/90.png')}}">

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
     

  <link href="{{ asset('materialize/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('materialize/css/materialize-stepper.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!-- <link href="{{ asset('materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/> -->
  <link href="{{ asset('materialize/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('materialize/css/eCommerce-products-page.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('materialize/css/style1.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('materialize/css/animate.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('materialize/css/nouislider.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('materialize/css/page-404.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('css/bus_booking.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        var CURRENT_ROUTE = {!! json_encode(request()->route()->getName()) !!};
        var CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
</head>
<body>
	
	@include('frontend.component.header')
    @yield('content')
</body>
<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  {{-- <script src="{{ asset('admin/js/lib/jquery/jquery.min.js') }}"></script> --}}
  <script src="{{ asset('materialize/js/materialize.js') }}"></script>
  <script src="{{ asset('materialize/js/init.js') }}"></script>
  <script src="{{ asset('materialize/js/website.js') }}"></script>
  <script src="{{ asset('materialize/js/nouislider.js') }}"></script>
  <script src="{{ asset('materialize/js/nouislider.min.js') }}"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.0.4/wNumb.min.js'></script>
  
  @yield('script')
  @if(!empty($address))
    <script src="{{ asset('materialize/js/country_state_city.js') }}"></script>
  @endif
  {{-- <script src="{{ asset('materialize/js/first.js') }}"></script> --}}
  @if(!empty($search))
    <script src="{{ asset('materialize/js/search.js') }}"></script>
  @endif

  <script src="{{ asset('materialize/js/custom.js') }}"></script>
  

</body>
</html>