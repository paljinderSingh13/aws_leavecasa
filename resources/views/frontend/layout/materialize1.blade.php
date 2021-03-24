<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>LeaveCasa - The Best Spot to Make Your Holiday Plans</title>
 <link rel = "icon" type = "image/png" href = "{{ url('/images/90.png')}}">
 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="{{ asset(env('FPATH').'bootstrap/js/jquery-3.2.1.min.js') }}"></script>

<link href="{{ asset(env('FPATH').'bootstrap/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
  @if(request()->route()->getName() =='index')

<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/bootstrap4/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/bootstrap4/bootstrap-grid.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/bootstrap4/bootstrap-datepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/plugins/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/responsive.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/offers_responsive.css') }}"> 
<link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'bootstrap/styles/jquery-ui.css') }}">
  {{-- <link href="{{ asset(env('FPATH').'materialize/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/> --}}

  @else
  <link href="{{ asset(env('FPATH').'materialize/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet/less" type="text/css" href="{{ asset('materialize/css/style.less') }}" />
  <link href="{{ asset(env('FPATH').'materialize/css/materialize-stepper.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <!-- <link href="{{ asset('materialize/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/> -->
  <link href="{{ asset(env('FPATH').'materialize/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset(env('FPATH').'materialize/css/eCommerce-products-page.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset(env('FPATH').'materialize/css/style1.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset(env('FPATH').'materialize/css/animate.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset(env('FPATH').'materialize/css/nouislider.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset(env('FPATH').'materialize/css/page-404.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset(env('FPATH').'css/bus_booking.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script src="{{ asset(env('FPATH').'materialize/js/materialize.js') }}"></script>
  @endif
  <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        var CURRENT_ROUTE = {!! json_encode(request()->route()->getName()) !!};
        var CSRF_TOKEN = '{{ csrf_token() }}';
        
    </script>
   
<script type="text/javascript">
$(document).ready(function(){
  $('#dropdowner').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false,
        hover: true,
        gutter: 0, 
        belowOrigin: true,
        stopPropagation: false 
        }); 
        
});  
</script> 

</head>
<body>
<div class="super_container">
 @if(request()->route()->getName() !='index')
	@include('frontend.component.header')
  @endif
    @yield('content')
  </div>
   @include('frontend.component.login_signup')
  @if(request()->route()->getName() =='index')
<script src="{{ asset(env('FPATH').'bootstrap/js/jquery-ui.js') }}"></script>
<script src="{{ asset(env('FPATH').'bootstrap/styles/bootstrap4/bootstrap.min.js') }}"></script>
 <script src="{{ asset(env('FPATH').'bootstrap/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset(env('FPATH').'bootstrap/styles/bootstrap4/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset(env('FPATH').'bootstrap/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
<script src="{{ asset(env('FPATH').'bootstrap/plugins/easing/easing.js') }}"></script>
<script src="{{ asset(env('FPATH').'bootstrap/js/customs.js') }}"></script>

  @else
	@include('frontend.component.footer')
  <script src="{{ asset(env('FPATH').'materialize/js/materialize.min.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/init.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/website.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/nouislider.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/nouislider.min.js') }}"></script>
  <script src="{{ asset(env('FPATH').'v2.9\js\nifty.min.js') }}"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.0.4/wNumb.min.js'></script>
@endif
 
  @yield('script')
  @if(!empty($address))
    <script src="{{ asset(env('FPATH').'materialize/js/country_state_city.js') }}"></script>
  @endif
  @if(!empty($search))
    <script src="{{ asset(env('FPATH').'materialize/js/search.js') }}"></script>
  @endif


  <script src="{{ asset(env('FPATH').'materialize/js/custom.js') }}"></script>
   <script src="{{ asset(env('FPATH').'materialize/js/notify.js') }}"></script>
<script type="text/javascript">

  $('form').each(function() {
    this.reset();
});

 

</script>
</body>
</html>