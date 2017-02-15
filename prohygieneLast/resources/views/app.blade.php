<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Blog Prohygiene</title>
<link rel="shortcut icon" href="http://blogprohygiene.staging.vnstudios.io/wp-content/uploads/2014/12/favicon.ico" type="image/x-icon">


    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">

    <!-- Related styles of various icon packs and javascript plugins -->
    <link rel="stylesheet" href="{{URL::asset('css/plugins.css')}}">

    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">

    <!-- Load a specific file here from css/themes/ folder to alter the default theme of the template -->

    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
   
    <!-- END Stylesheets -->

    <!-- Modernizr (browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it, eg IE8) -->
    <!--<script src="{{URL::asset('js/vendor/modernizr-2.7.1-respond-1.4.2.min.js')}}"></script>-->
     
      


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
                <a class="navbar-brand" href="#">Prohygiene</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span style="color:white !important">{{ Auth::user()->name }}</span><span style="color:white !important" class="caret"></span></a>
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
                                    <li><a href="{{ route('panel') }}"><i class="gi gi-download"></i>Descargar Excel</a></li>
                                   
                                      @if(Auth::user()->email=='admin@vnstudios.com')
                                      
                                      <li><a href="{{ route('periodoIndex') }}"><i class="gi gi-edit"></i>Periodo</a></li>
                                      <li><a href="{{ route('cursoIndex')}}"><i class="gi gi-edit"></i>Curso</a></li>
                                      <li><a href="{{ route('categoriaIndex')}}"><i class="gi gi-edit"></i>categorias</a></li>
                                      <li><a href="{{ route('tablaWPtermsIndex')}}"><i class="gi gi-edit"></i>tabla wp_terms</a></li>
                                      <li><a href="{{ route('tablelogIndex')}}"><i class="gi gi-edit"></i>tabla log</a></li>
                                      <li><a href="{{ route('userscategories')}}"><i class="gi gi-user"></i>usuarios categorias</a></li>
                                      <li><a href="{{ route('destinatarioIndex')}}"><i class="gi gi-user"></i>Destinatarios</a></li>
                                      <li><a href="{{ route('capacitadorIndex')}}"><i class="gi gi-user"></i>Capacitador</a></li>
                                      @endif
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
            
            <!-- END Pre Page Content -->

            <!-- Page Content -->
            <div id="page-content">
               @yield('content')
            </div>
        </div>
        <!-- END Page Container -->


        <!--script-->
         <script src="{{URL::asset('js/vendor/jquery-1.11.0.min.js')}}"></script>
        <!-- Bootstrap.js -->
        <script src="{{URL::asset('js/bootstrap.js')}}"></script>
         @stack('script-footer');

        <!--script-->


        
    </body>
    </html>

 

  