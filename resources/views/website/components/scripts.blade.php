<!-- Javascript -->
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery.noconflict.js"></script>
<script type="text/javascript" src="js/modernizr.2.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="js/jquery.placeholder.js"></script>
<script type="text/javascript" src="js/jquery-ui.1.10.4.min.js"></script>

<!-- Twitter Bootstrap -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- load revolution slider scripts -->
<script type="text/javascript" src="components/revolution_slider/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="components/revolution_slider/js/jquery.themepunch.revolution.min.js"></script>

<!-- load BXSlider scripts -->
<script type="text/javascript" src="components/jquery.bxslider/jquery.bxslider.min.js"></script>

<!-- Flex Slider -->
<script type="text/javascript" src="components/flexslider/jquery.flexslider.js"></script>

<!-- parallax -->
<script type="text/javascript" src="js/jquery.stellar.min.js"></script>

<!-- parallax -->
<script type="text/javascript" src="js/jquery.stellar.min.js"></script>

<!-- waypoint -->
<script type="text/javascript" src="js/waypoints.min.js"></script>

<!-- load page Javascript -->
<script type="text/javascript" src="js/theme-scripts.js"></script>
<script type="text/javascript" src="{{ asset('js/notify.js?ref='.rand(1111,9999)) }}"></script>
<script type="text/javascript" src="{{ asset('js/signup.js?ref='.rand(1111,9999)) }}"></script>
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/bootstrap3-typeahead.js"></script>
<input type="hidden" name="cities_clist" value='{!! App\Model\BusBookingSource::getCitiesName() !!}'>
<script type="text/javascript">
    tjq(document).ready(function() {
        runTypehead();
        var $citiesInput = tjq(".cities_from");
        var data = JSON.parse(tjq('input[name=cities_clist]').val());
        $citiesInput.typeahead({
          source: data,
          autoSelect: true,
          afterSelect: function(data){
            tjq('input[name=bus_from]').val(data.id);
          }
        });

        var $citiesInput = tjq(".cities_to");
        var data = JSON.parse(tjq('input[name=cities_clist]').val());
        $citiesInput.typeahead({
          source: data,
          autoSelect: true,
          afterSelect: function(data){
            tjq('input[name=bus_to]').val(data.id);
          }
        });
        tjq('.revolution-slider').revolution(
        {
            dottedOverlay:"none",
            delay:8000,
            startwidth:1170,
            startheight:646,
            onHoverStop:"on",
            hideThumbs:10,
            fullWidth:"on",
            forceFullWidth:"on",
            navigationType:"none",
            shadow:0,
            spinner:"spinner4",
            hideTimerBar:"on",
        });
    });

    function runTypehead(){
        var $input = tjq(".typeahead");
        $input.typeahead({
          source: {!! App\Model\IndiaAirportCitiesCode::city_codes_in_json() !!},
          autoSelect: true
        });
    }
</script>
@if(session()->get('success') != '')
    <script type="text/javascript">
        $.notify("{{ session()->get('success') }}", "success");
    </script>
@endif

@if(session()->get('error') != '')
    <script type="text/javascript">
        $.notify("{{ session()->get('error') }}", "error");
    </script>
@endif
<script type="text/javascript" src="{{ asset('js/website.js?ref='.rand(1111,9999)) }}"></script>

@section('scripts')

@show