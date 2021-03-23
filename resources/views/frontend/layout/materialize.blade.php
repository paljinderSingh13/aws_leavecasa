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
    {{-- <script src="{{ asset('bootstrap/js/jquery-3.5.0.min.js') }}"></script> --}}
    <link href="{{ asset('bootstrap/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/bootstrap4/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/bootstrap4/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/main_styles.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/offers_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/styles/jquery-ui.css') }}">    
    <script src="{{ asset('bootstrap/js/jquery-3.2.1.min.js') }}"></script>

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
      @if(request()->route()->getName() =='index')
      @include('frontend.component.header')
      @else
      @include('frontend.component.headerAfter')
      @endif
      @yield('content')
      @if(!empty($tripType) && ($tripType == 'round'))
      @else
      @include('frontend.component.footer')
      @endif
    </div>
    @include('frontend.component.login_signup')
    
    <script src="{{ asset('bootstrap/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('bootstrap/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('bootstrap/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" ></script>
    <script src="{{ asset('bootstrap/styles/bootstrap4/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('bootstrap/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('bootstrap/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('bootstrap/js/customs.js') }}"></script>
    
    @yield('script')
    @if(!empty($address))
    <script src="{{ asset('materialize/js/country_state_city.js') }}"></script>
    @endif
    @if(!empty($search))
    <script src="{{ asset('materialize/js/search.js') }}"></script>
    @endif
    <script src="{{ asset('materialize/js/custom.js') }}"></script>
    <script src="{{ asset('materialize/js/notify.js') }}"></script>

    <script type="text/javascript">
      $('form').each(function() {
      this.reset();
      });
    </script>
  </body>
</html>