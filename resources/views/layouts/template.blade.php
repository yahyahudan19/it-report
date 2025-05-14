<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IT Task Management and Reporting System for RSUD Karsa Husada Batu - Streamline IT operations, manage tasks, and enhance reporting efficiency with our comprehensive solution.">
    <meta name="keywords" content="IT management, task reporting, IT operations, RSUD Karsa Husada, IT task handling, IT reporting system">
    <meta name="author" content="RSUD Karsa Husada IT Team">
    <link rel="icon" href="{{ asset('dashboard/assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('dashboard/assets/images/favicon.png')}}" type="image/x-icon">
    <title>@yield('title') | IT Task Management & Reporting </title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/slick-theme.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/scrollbar.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/select.bootstrap5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/sweetalert2.css')}}">
    <!-- Plugins css Ends-->
    @yield('plugins-head')
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{ asset('dashboard/assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/responsive.css')}}">
  </head>
  <body onload="startTime()"> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader-index"> <span></span></div>
      <svg>
        <defs></defs>
        <filter id="goo">
          <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
          <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
        </filter>
      </svg>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      @include('layouts.header')
      <!-- Page Header Ends -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        @include('layouts.sidebar')
        <!-- Page Sidebar Ends-->
        @yield('content')
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright <span class="year-update"> </span> © SIRS RSUD Karsa Husada Batu  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
   

    <!-- Global Script -->

    <!-- latest jquery-->
    <script src="{{ asset('dashboard/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('dashboard/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('dashboard/assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('dashboard/assets/js/scrollbar/simplebar.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/scrollbar/custom.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('dashboard/assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('dashboard/assets/js/sidebar-menu.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/sidebar-pin.js')}}"></script>

    
    <script src="{{ asset('dashboard/assets/js/slick/slick.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/slick/slick.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/header-slick.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/notify/index.js')}}"></script>
 
    <script src="{{ asset('dashboard/assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead/typeahead.custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead-search/handlebars.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <!-- Plugins JS Ends-->

    @yield('plugins-last')
    <!-- Theme js-->
    <script src="{{ asset('dashboard/assets/js/script.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/script1.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/theme-customizer/customizer.js')}}"></script>
  </body>
</html>