
<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->




<head>
    <meta charset="utf-8">
<title>CAME | Mapa Argentina Productiva</title>

	<link rel="icon" type="image/png" href="{{URL::asset('img/icon.png')}}" sizes="57x57">


    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="img/icon_crc.png">
    
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">

    <!-- Related styles of various icon packs and javascript plugins -->


    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">

    <!-- Load a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
   @stack('css')
    <!-- END Stylesheets -->


    <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
   
<script src="{{URL::asset('js/jquery.js')}}"></script>
        <!-- Bootstrap.js -->
        <script src="{{URL::asset('js/bootstrap.js')}}"></script>

        <!-- Jquery plugins and custom javascript code -->
            
    

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAKAhYtwWh1bDZxldsKSRnNfdXyCEyLf4o&libraries=places"></script>




</head>

<!-- Body -->
<!-- In the PHP version you can set the following options from the config file -->
<!-- Add the class .hide-side-content to <body> to hide side content by default -->
<body>

  
   <!-- Page Container -->
   <!-- In the PHP version you can set the following options from the config file -->
   <!-- Add the class .full-width for a full width page -->
   <div id="page-container" class="full-width">
    <!-- Header -->
    <!-- In the PHP version you can set the following options from the config file -->
    <!-- Add the class .navbar-fixed-top or .navbar-fixed-bottom for a fixed header on top or bottom respectively -->
    <!-- If you add the class .navbar-fixed-top remember to add the class .header-fixed-top to <body> element! -->
    <!-- If you add the class .navbar-fixed-bottom remember to add the class .header-fixed-bottom to <body> element! -->
    <!-- <header class="navbar navbar-inverse navbar-fixed-top"> -->
    <!-- <header class="navbar navbar-inverse navbar-fixed-bottom"> -->
 <header class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">CAME|Mapa</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span style="color:white !important">{{ Auth::user()->nombre }}</span><span style="color:white !important" class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ URL('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    
    

               </header>  
                    <!-- END Header -->

                    <!-- Left Sidebar -->
                    <!-- In the PHP version you can set the following options from the config file -->
                    <!-- Add the class .sticky for a sticky sidebar -->
                    <aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
                <!--
                Wrapper for scrolling functionality
                Used only if the .sticky class added above. You can remove it and you will have a sticky sidebar
                without scrolling enabled when you set the sidebar to be sticky
            -->
            <div class="side-scrollable">
                <!-- Mini Profile  aqui van los botones del mini profiles-->
               
                <!-- END Mini Profile -->
              
                <!-- Sidebar Tabs aqui va lo de botones de  arriba de navegacion nav-->
                <div class="sidebar-tabs-con">
                 
                    <div class="tab-content">
                        <div class="tab-pane active" id="side-tab-menu">
                            <!-- Primary Navigation //aui va las aciones del menu-->
                            <nav id="primary-nav">
                                <ul>
                                    
                                    <!-- aqui va los link del menu-->
                                    <li><a href="{{ route('indexRubro') }}"><i class="glyphicon glyphicon-bookmark"></i>Rubros</a></li>
                                    <li><a href="{{ route('indexEntidad') }}"><i class="glyphicon glyphicon-list-alt"></i>Entidades</a></li>
                                    <li><a href="{{ route('indexNegocio') }}"><i class="glyphicon glyphicon-signal"></i>Negocios</a></li>
                                    <li><a href="{{ route('indexUser') }}"><i class="glyphicon glyphicon-user"></i>Usuarios</a></li>
                                
                                    
                                    
                                    
                                </ul>
                                
                                
                            </nav>
                            <!-- END Primary Navigation -->
                        </div>
                        
                    </div>
                    <!-- END Sidebar Tabs -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </aside>
            <!-- END Left Sidebar -->

            <!-- Pre Page Content -->
            <div id="pre-page-content">
                <h1><i class="gi themed-color"></i><br><small></small></h1>
            </div>
            <!-- END Pre Page Content -->

            <!-- Page Content -->
            <div id="page-content">
               @yield('content')
            </div>
        </div>
        <!-- END Page Container -->

        <!-- Scroll to top link, check main.js - scrollToTop() -->
        <a href="#" id="to-top"><i class="fa fa-chevron-up"></i></a>

 
       @yield('script')
       @stack('script-footer')
     
        
    </body>
    </html>

 

  