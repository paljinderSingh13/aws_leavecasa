<!DOCTYPE html>
<!--[if IE 8]>          <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>          <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->  <html class=""> <!--<![endif]-->
<head>
    <base href="{{ asset('html') }}/">
    <!-- Page Title -->
    <title>Leavecasa Signup</title>
    
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Leave Casa">
    <meta name="author" content="SoapTheme">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Theme Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,200,300,500' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/animate.min.css">
    
    <!-- Main Style -->
    <link id="main-style" rel="stylesheet" href="css/style.css">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Updated Styles -->
    <link rel="stylesheet" href="css/updates.css">
    
    <!-- Responsive Styles -->
    <link rel="stylesheet" href="css/responsive.css">
    
    <!-- CSS for IE -->
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie.css" />
    <![endif]-->
    
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
    <![endif]-->
</head>
<body class="soap-login-page style1 body-blank">
    <div id="page-wrapper" class="wrapper-blank">
        <header id="header" class="navbar-static-top">
            <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle blue-bg">Mobile Menu Toggle</a>
            <div class="container">
                <h1 class="logo">
                    
                </h1>
            </div>
            <nav id="mobile-menu-01" class="mobile-menu collapse menu-color-blue">
                <ul id="mobile-primary-menu" class="menu">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li >
                        <a href="javascript:void(0)">About</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">Contact us</a>
                    </li>
                </ul>

            </nav>
        </header>
        @yield('content')
        <footer id="footer">
            <div class="footer-wrapper">
                <div class="container">
                    <nav id="main-menu" role="navigation" class="inline-block hidden-mobile">
                        <ul class="menu">
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0)">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0)">About Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0)">Contact Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0)">Sign In</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="javascript:void(0)">Sigup</a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        <p>&copy; 2018 Leavecasa</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Javascript -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.noconflict.js"></script>
    <script type="text/javascript" src="js/modernizr.2.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.placeholder.js"></script>
    <script type="text/javascript" src="js/jquery-ui.1.10.4.min.js"></script>
    
    <!-- Twitter Bootstrap -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    
    <script type="text/javascript">
        var enableChaser = 0;
    </script>
    <!-- parallax -->
    <script type="text/javascript" src="js/jquery.stellar.min.js"></script>
    
    <!-- waypoint -->
    <script type="text/javascript" src="js/waypoints.min.js"></script>

    <!-- load page Javascript -->
    <script type="text/javascript" src="js/theme-scripts.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    
</body>
</html>

