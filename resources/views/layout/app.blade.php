<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="ADOS" content="">
    <meta name="Reparation" content="">
    <meta name="Panafricanism" content="">
    <meta name="Black motion" content="">
    <meta name="LeBron James" content="">
    <meta name="Rap" content="">
    <meta name="Music" content="">
    <meta name="Hip Hop" content="">
    <meta name="Black Culture" content="">
    

    <title>{{ config('app.name') }}</title> 
       
    <!-- Favicon -->
    <link rel="icon" href="images/favicon.png" type="image/png" /> 
    
    <!--Bootstrap and Other Vendors-->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/vendors/bootstrap-select/css/bootstrap-select.min.css" media="screen">
    
    <!--Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    
  
    <link rel="stylesheet" href="/css/default/style.css">
    <link rel="stylesheet" href="/css/responsive/responsive.css">
    <link rel="stylesheet" href="/css/custom.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    

    
</head>
<body class="home" style="color: rgba(22,91,81) !important;"> 
    @if(session()->has('status'))
        <script>
            alert("{{ session()->get('status') }}");
        </script>

     @endif
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/"><img src="/images/logo.png" height="50" width="80"></a>
                <button type="button" class="navbar-toggle collapsed" style="background: rgb(22,91,81) !important;" data-toggle="collapse" data-target="#middle-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="middle-menu">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/" class="dropdown-toggle">
                            <span class="home_variation_icon"></span>Home
                        </a>
                    </li>
                    <li>
                        <a href="/questions" class="dropdown-toggle">
                            <span class="video_menu_icon"></span>Discussions
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="extra_pages_icon"></span>Pages
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="/#aboutUs">About Us</a></li>
                            <li><a href="/contact-us">Contact Us</a></li>
                            <li><a href="#newsletter">Newsletter</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->            
            <ul class="nav navbar-nav navbar-right login_drop">
                @if(!Auth::check())
                    <li><a href="/login"><span class="login_icon"></span> Sign In</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="login_icon"></span> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="/home"><i class="fa fa-home"></i> Dashboard</a></li>
                           <li><a href="/profile"><i class="fa fa-user"></i> Profile</a></li> 
                           <li>
                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-lock"></i> Sign Out
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            
                            
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!-- /.container-fluid -->
    </nav>
    
    @yield('content')
    
    <!--jQuery, Bootstrap and other vendor JS-->
    
    <!--jQuery-->
    <script src="/js/jquery-3.2.1.min.js"></script>

    @yield('js')

    <script src="/js/bootstrap-filestyle.js"></script>
    
    <script src="/js/newsletter.js"></script>

    
    <!--Bootstrap JS-->
    <script src="/js/bootstrap.min.js"></script>
    
    <!--jScroll-->
    <script src="/js/jquery.jscroll.min.js"></script>
    
    <!--Magnific Popup-->
    <script src="/js/jquery.magnific-popup.min.js"></script>
    
    <!--Bootstrap Select-->
    <script src="/vendors/bootstrap-select/js/bootstrap-select.min.js"></script>
    
    <!--Theme JS-->
    <script src="/js/theme.js"></script>
    <script src="/js/dashboard.js"></script>
</body>


</html>