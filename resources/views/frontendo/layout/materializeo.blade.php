<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="-1">
  <title>LeaveCasa - The Best Spot to Make Your Holiday Plans</title>
 <link rel = "icon" type = "image/png" href = "{{ url('/images/90.png')}}">
  <!-- CSS  -->
{{--   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="{{ asset(env('FPATH').'materialize/js/materialize.js') }}"></script>
 
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
     

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
  <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        var CURRENT_ROUTE = {!! json_encode(request()->route()->getName()) !!};
        var CSRF_TOKEN = '{{ csrf_token() }}';
        
    </script>
    <script type="text/javascript">
// $(window).load(function() {
//     $(".loader").fadeOut("slow");
// });
</script>
<script type="text/javascript">
$(document).ready(function(){
   // $('input').val('');
  // $("form").on("submit", function(){
  //   $(".loader").fadeIn();
  // });//submit
  $('#dropdowner').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false,
        hover: true,
        gutter: 0, 
        belowOrigin: true, // Displays dropdown below the button
        stopPropagation: false 
        }); 
        
       
        
        $('.sel_tab').click(function(){
            var status = $(this).attr('id');
            if(status == 'statustab'){
                    $('#flight-status').show();
                    $('#flights-tab').hide();
                    $('#hotels-tab').hide();
                    $('#bus-tab').hide();
                }else if(status == 'flighttab'){
                    $('#flight-status').hide();
                    $('#flights-tab').show();
                    $('#hotels-tab').hide();
                    $('#bus-tab').hide();
                }else if(status == 'bustab'){
                    $('#flight-status').hide();
                    $('#flights-tab').hide();
                    $('#hotels-tab').hide();
                    $('#bus-tab').show();    
                }
                else if(status == 'hoteltab'){
                    $('#flight-status').hide();
                    $('#flights-tab').hide();
                    $('#hotels-tab').show();
                    $('#bus-tab').hide();    
                }
                else{
                    $('#flight-status').hide();
                    $('#flights-tab').hide();
                    $('#hotels-tab').show();
                    $('#bus-tab').hide();
                }
            });
       

  $('ul li .sel_tab').click(function(){
    $('li .sel_tab').removeClass("active");
    $(this).addClass("active");
});

});  
</script>

</head>
<body>
 {{--  <div class="loader"></div> --}}
	@include('frontend.component.header')
    @yield('content')
   @include('frontend.component.login_signup')
   
	@include('frontend.component.footer')
  <script src="{{ asset(env('FPATH').'materialize/js/materialize.min.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/init.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/website.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/visa.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/nouislider.js') }}"></script>
  <script src="{{ asset(env('FPATH').'materialize/js/nouislider.min.js') }}"></script>
  <script src="{{ asset(env('FPATH').'v2.9\js\nifty.min.js') }}"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.0.4/wNumb.min.js'></script>

  
  @yield('script')
  @if(!empty($address))
    <script src="{{ asset(env('FPATH').'materialize/js/country_state_city.js') }}"></script>
  @endif
  {{-- <script src="{{ asset('materialize/js/first.js') }}"></script> --}}
  @if(!empty($search))
    <script src="{{ asset(env('FPATH').'materialize/js/search.js') }}"></script>
  @endif

  <script src="{{ asset(env('FPATH').'materialize/js/custom.js') }}"></script>
   <script src="{{ asset(env('FPATH').'materialize/js/notify.js') }}"></script>
<script type="text/javascript">
//   $(window).on('load', function() {
//     setTimeout(function() {
//       $('body').addClass('loaded');
// }, 200);
//   });

  $('form').each(function() {
    this.reset();
});

 

</script>

</body>
</html>