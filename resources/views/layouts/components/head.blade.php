<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard | Leavecasa</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('/v2.9/css/bootstrap.min.css')}}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset(env('FPATH').'/v2.9/css/nifty.min.css')}}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset(env('FPATH').'/v2.9/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'/v2.9/plugins/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset(env('FPATH').'/v2.9/plugins/font-awesome/css/font-awesome.min.css')}}">

    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset(env('FPATH').'/v2.9/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <script src="{{ asset(env('FPATH').'/v2.9/plugins/pace/pace.min.js')}}"></script>
    
    <link href="{{ asset(env('FPATH').'/v2.9/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset(env('FPATH').'/v2.9/css/demo/nifty-demo.min.css')}}" rel="stylesheet">

    <!--DataTables [ OPTIONAL ]-->
    @section('css')
        <link href="{{ asset(env('FPATH').'v2.9/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/animate-css/animate.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/chosen/chosen.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/switchery/switchery.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/css-loaders/css/css-loaders.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/spinkit/css/spinkit.min.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/x-editable/css/bootstrap-editable.css')}}" rel="stylesheet">
        <link href="{{ asset(env('FPATH').'v2.9/plugins/x-editable/inputs-ext/address/address.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css?ref='.rand(10,9999)) }}">
        <!--Bootstrap Select [ OPTIONAL ]-->
        <link href="{{ asset(env('FPATH').'v2.9/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet">
        <!--Select2 [ OPTIONAL ]-->
        <link href="{{ asset(env('FPATH').'v2.9/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    @show
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        var CURRENT_ROUTE = {!! json_encode(request()->route()->getName()) !!};
        var CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
</head>