<head>
    <!-- Page Title -->
    <title>LeaveCasa::Travel Portal</title>
    <base href="{{ asset('html') }}/">
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Travelo | Responsive HTML5 Travel Template">
    <meta name="author" content="SoapTheme">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Compiled and minified CSS -->
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!};
        var CURRENT_ROUTE = {!! json_encode(request()->route()->getName()) !!};
        var CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
</head>