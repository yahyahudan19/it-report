<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IT Task Management and Reporting System for RSUD Karsa Husada Batu - Streamline IT operations, manage tasks, and enhance reporting efficiency with our comprehensive solution.">
    <meta name="keywords" content="IT management, task reporting, IT operations, RSUD Karsa Husada, IT task handling, IT reporting system">
    <meta name="author" content="RSUD Karsa Husada IT Team">
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>IT Task Management & Reporting | RSUD Karsa Husada Batu</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/jquery.dataTables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/css/vendors/select.bootstrap5.css')}}">
    <!-- Plugins css Ends-->
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
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Anything Here..." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{ asset('dashboard/assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{ asset('dashboard/assets/images/logo/logo_dark.png')}}" alt=""></a></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div class="notification-slider">
              <div class="d-flex h-100"> <img src="{{ asset('dashboard/assets/images/giftools.gif')}}" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light"> Our new update has been released.</span></h6><i class="icon-arrow-top-right f-light"></i>
              </div>
              <div class="d-flex h-100"><img src="{{ asset('dashboard/assets/images/giftools.gif')}}" alt="gif">
                <h6 class="mb-0 f-w-400"><span class="f-light">Something you love is now on sale! </span></h6><a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
              </div>
            </div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              <li class="language-nav">
                <div class="translate_wrapper">
                  <div class="current_lang">
                    <div class="lang"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">EN                               </span></div>
                  </div>
                  <div class="more_lang">
                    <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span></div>
                    <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                    <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
                    <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                    <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                    <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                    <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                  </div>
                </div>
              </li>
              <li class="fullscreen-body">                       <span>
                  <svg id="maximize-screen">
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#full-screen')}}"></use>
                  </svg></span></li>
              <li>                         <span class="header-search">
                  <svg>
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#search')}}"></use>
                  </svg></span></li>
              <li class="onhover-dropdown">
                <svg>
                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#star')}}"></use>
                </svg>
                <div class="onhover-show-div bookmark-flip">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="front">
                        <h6 class="f-18 mb-0 dropdown-title">Bookmark</h6>
                        <ul class="bookmark-dropdown">
                          <li>
                            <div class="row">
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="file-text"></i></div><span>Forms</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="user"></i></div><span>Profile</span>
                                </div>
                              </div>
                              <div class="col-4 text-center">
                                <div class="bookmark-content">
                                  <div class="bookmark-icon"><i data-feather="server"></i></div><span>Tables</span>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="text-center"><a class="flip-btn f-w-700 btn btn-primary w-100" id="flip-btn" href="#!">Add Bookmark</a></li>
                        </ul>
                      </div>
                      <div class="back">
                        <ul>
                          <li>
                            <div class="bookmark-dropdown flip-back-content">
                              <input type="text" placeholder="Search...">
                            </div>
                          </li>
                          <li><a class="f-w-700 d-block flip-back btn btn-primary w-100" id="flip-back" href="#!">Back</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <div class="mode">
                  <svg>
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#moon')}}"></use>
                  </svg>
                </div>
              </li>
              <li class="cart-nav onhover-dropdown">
                <div class="cart-box">
                  <svg>
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-ecommerce')}}"></use>
                  </svg><span class="badge rounded-pill badge-danger">2</span>
                </div>
                <div class="cart-dropdown onhover-show-div">
                  <h6 class="f-18 mb-0 dropdown-title">Cart</h6>
                  <ul>
                    <li>
                      <div class="d-flex"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('dashboard/assets/images/other-images/cart-img.jpg')}}" alt="">
                        <div class="flex-grow-1"><span>Furniture Chair for Home</span>
                          <div class="qty-box">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                              <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                            </div>
                          </div>
                          <h6 class="font-primary">$12.45</h6>
                        </div>
                        <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li>
                      <div class="d-flex"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('dashboard/assets/images/other-images/cart-img1.jpg')}}" alt="">
                        <div class="flex-grow-1"><span>Rest Well Chair</span>
                          <div class="qty-box">
                            <div class="input-group"><span class="input-group-prepend">
                                <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                              <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                                <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                            </div>
                          </div>
                          <h6 class="font-primary">$49.00</h6>
                        </div>
                        <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                      </div>
                    </li>
                    <li class="total">
                      <h6 class="mb-0">Order Total : <span class="f-right">$1000.00</span></h6>
                    </li>
                    <li class="text-center"><a class="d-block view-cart f-w-700 btn btn-primary w-100" href="cart.html">View Cart</a><a class="btn btn-primary view-checkout btn btn-primary w-100 f-w-700" href="checkout.html">Checkout</a></li>
                  </ul>
                </div>
              </li>
              <li class="onhover-dropdown">
                <div class="notification-box">
                  <svg>
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#notification')}}"></use>
                  </svg><span class="badge rounded-pill badge-success">4 </span>
                </div>
                <div class="onhover-show-div notification-dropdown">
                  <h6 class="f-18 mb-0 dropdown-title">Notifications</h6>
                  <ul>
                    <li class="b-l-primary border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Delivery processing</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                    <li class="b-l-success border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Order Complete</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                    <li class="b-l-secondary border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Tickets Generated</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                    <li class="b-l-warning border-4 toast default-show-toast align-items-center text-light border-0 fade show" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                      <div class="d-flex justify-content-between">
                        <div class="toast-body">
                          <p>Delivery Complete</p>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
                      </div>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="profile-nav onhover-dropdown pe-0 py-0">
                <div class="d-flex profile-media"><img class="b-r-10" src="{{ asset('dashboard/assets/images/dashboard/profile.png')}}" alt="">
                  <div class="flex-grow-1"><span>Emay Walter</span>
                    <p class="mb-0">Admin <i class="middle fa-solid fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="sign-up.html"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="mail-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="task.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                  <li><a href="add-user.html"><i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a href="login.html"><i data-feather="log-in"> </i><span>Log out</span></a></li>
                </ul>
              </li>
            </ul>
          </div>
          <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">yeah</div>
            </div>
            </div>
          </script>
          <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
          <div>
            <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{ asset('dashboard/assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{ asset('dashboard/assets/images/logo/logo_dark.png')}}" alt=""></a>
              <div class="back-btn"><i class="fa-solid fa-angle-left"></i></div>
              <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
            </div>
            <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('dashboard/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ asset('dashboard/assets/images/logo/logo-icon.png')}}" alt=""></a>
                    <div class="mobile-back text-end"><span>Back</span><i class="fa-solid fa-angle-right ps-2" aria-hidden="true"></i></div>
                  </li>
                  <li class="pin-title sidebar-main-title">
                    <div> 
                      <h6>Pinned</h6>
                    </div>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-1">General</h6>
                    </div>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i>
                    <label class="badge badge-light-primary">13</label><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-home')}}"></use>
                      </svg><span class="lan-3">Dashboard          </span></a>
                    <ul class="sidebar-submenu">
                      <li><a class="lan-4" href="index.html">Default</a></li>
                      <li><a class="lan-5" href="dashboard-02.html">Ecommerce</a></li>
                      <li><a href="dashboard-03.html">Online course</a></li>
                      <li><a href="dashboard-04.html">Crypto</a></li>
                      <li><a href="dashboard-05.html">Social</a></li>
                      <li><a href="dashboard-06.html">NFT</a></li>
                      <li> <a href="dashboard-07.html">School management</a></li>
                      <li> <a href="dashboard-08.html">POS</a></li>
                      <li>
                        <label class="badge badge-light-success">New</label><a href="dashboard-09.html">CRM</a>
                      </li>
                      <li>
                        <label class="badge badge-light-success">New</label><a href="dashboard-10.html">Analytics</a>
                      </li>
                      <li>
                        <label class="badge badge-light-success">New</label><a href="dashboard-11.html">HR</a>
                      </li>
                      <li>
                        <label class="badge badge-light-success">New</label><a href="dashboard-12.html">Projects</a>
                      </li>
                      <li>
                        <label class="badge badge-light-success">New</label><a href="dashboard-13.html">Logistics</a>
                      </li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-widget')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-widget')}}"></use>
                      </svg><span class="lan-6">Widgets</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="general-widget.html">General</a></li>
                      <li><a href="chart-widget.html">Chart</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-layout')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-layout')}}"></use>
                      </svg><span class="lan-7">Page layout</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="box-layout.html">Boxed</a></li>
                      <li><a href="layout-rtl.html">RTL</a></li>
                      <li><a href="layout-dark.html">Dark Layout</a></li>
                      <li><a href="hide-on-scroll.html">Hide Nav Scroll</a></li>
                      <li><a href="footer-light.html">Footer Light</a></li>
                      <li><a href="footer-dark.html">Footer Dark</a></li>
                      <li><a href="footer-fixed.html">Footer Fixed</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-8">Applications</h6>
                    </div>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"> </i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-project')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-project')}}"></use>
                      </svg><span>Projects        </span></a>
                    <ul class="sidebar-submenu">
                      <li>
                        <label class="badge badge-light-success">New</label><a href="project-details.html">Project Details</a>
                      </li>
                      <li><a href="project-list.html">Project List</a></li>
                      <li><a href="createnew.html">Create new</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="file-manager.html">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-file')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-file')}}"></use>
                      </svg><span>File manager</span></a></li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack">           </i><a class="sidebar-link sidebar-title link-nav" href="kanban.html">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-board')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-board')}}"></use>
                      </svg><span>kanban Board</span></a>
                    </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Default </h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">                                       
                        <svg class="stroke-icon">
                          <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Default      </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid default-dashboard">
            <div class="row widget-grid">
              <div class="col-xxl-4 col-sm-6 box-col-6"> 
                <div class="card profile-box">
                  <div class="card-body">
                    <div class="d-flex media-wrapper justify-content-between">
                      <div class="flex-grow-1"> 
                        <div class="greeting-user">
                          <h2 class="f-w-600">Welcome Emay Walter!</h2>
                          <p>Here whats happing in your account today</p>
                          <div class="whatsnew-btn"><a class="btn btn-outline-white" href="user-profile.html" target="_blank">View Profile</a></div>
                        </div>
                      </div>
                      <div>  
                        <div class="clockbox">
                          <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                            <g id="face">
                              <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                              <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                              <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                            </g>
                            <g id="hour">
                              <path class="hour-hand" d="M300.5 298V142"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="minute">
                              <path class="minute-hand" d="M300.5 298V67">   </path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="second">
                              <path class="second-hand" d="M300.5 350V55"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9">   </circle>
                            </g>
                          </svg>
                        </div>
                        <div class="badge f-10 p-0" id="txt"></div>
                      </div>
                    </div>
                    <div class="cartoon"><img class="img-fluid" src="{{ asset('dashboard/assets/images/dashboard/cartoon.svg')}}" alt="vector women with leptop"></div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-3"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card widget-1">
                      <div class="card-body">
                        <div class="widget-content">
                          <div class="widget-round secondary">
                            <div class="bg-round">
                              <svg>
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#c-revenue')}}"> </use>
                              </svg>
                              <svg class="half-circle svg-fill">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                              </svg>
                            </div>
                          </div>
                          <div> 
                            <h4>$<span class="counter" data-target="45195">0</span></h4><span class="f-light">Revenue</span>
                          </div>
                        </div>
                        <div class="font-success f-w-500"><i class="bookmark-search me-1" data-feather="trending-up"></i><span class="txt-success">+50%</span></div>
                      </div>
                    </div>
                    <div class="col-xl-12"> 
                      <div class="card widget-1">
                        <div class="card-body">
                          <div class="widget-content">
                            <div class="widget-round success">
                              <div class="bg-round">
                                <svg>
                                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#c-customer')}}"> </use>
                                </svg>
                                <svg class="half-circle svg-fill">
                                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                                </svg>
                              </div>
                            </div>
                            <div> 
                              <h4> <span class="counter" data-target="845">0</span>+</h4><span class="f-light">Customers</span>
                            </div>
                          </div>
                          <div class="font-danger f-w-500"><i class="bookmark-search me-1" data-feather="trending-down"></i><span class="txt-danger">-40%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-auto col-xl-3 col-sm-6 box-col-3"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card widget-1">
                      <div class="card-body"> 
                        <div class="widget-content">
                          <div class="widget-round warning">
                            <div class="bg-round">
                              <svg>
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#c-profit')}}"> </use>
                              </svg>
                              <svg class="half-circle svg-fill">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                              </svg>
                            </div>
                          </div>
                          <div> 
                            <h4> <span class="counter" data-target="80">0</span>%</h4><span class="f-light">Profit</span>
                          </div>
                        </div>
                        <div class="font-danger f-w-500"><i class="bookmark-search me-1" data-feather="trending-down"></i><span class="txt-danger">-20%</span></div>
                      </div>
                    </div>
                    <div class="col-xl-12"> 
                      <div class="card widget-1">
                        <div class="card-body"> 
                          <div class="widget-content">
                            <div class="widget-round primary">
                              <div class="bg-round">
                                <svg class="fill-primary">
                                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#c-invoice')}}"> </use>
                                </svg>
                                <svg class="half-circle svg-fill">
                                  <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#halfcircle')}}"></use>
                                </svg>
                              </div>
                            </div>
                            <div> 
                              <h4 class="counter" data-target="10905">0</h4><span class="f-light">Invoices</span>
                            </div>
                          </div>
                          <div class="font-success f-w-500"><i class="bookmark-search me-1" data-feather="trending-up"></i><span class="txt-success">+50%</span></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-auto col-xl-4 col-sm-6 box-col-4 ord-xl-5 box-ord-5">
                <div class="card">
                  <div class="card-header card-no-border pb-2">
                    <div class="header-top"> 
                      <h5>Visitors</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="visitorButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="visitorButton"><a class="dropdown-item" href="#!">Today</a><a class="dropdown-item" href="#!">Tomorrow</a><a class="dropdown-item" href="#!">Yesterday</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body visitor-chart pt-0">
                    <div class="common-flex">
                      <h6><span class="counter" data-target="98736">0</span>K</h6>
                      <div class="d-flex"> 
                        <p>( <span class="txt-success f-w-500 me-1">+0.4%</span>Than last week)</p>
                      </div>
                    </div>
                    <div id="visitor_chart"></div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-4 col-sm-6 ord-xl-1 ord-md-1 box-ord-1 box-col-6">
                <div class="card"> 
                  <div class="card-header card-no-border">
                    <div class="header-top"> 
                      <h5>Top Customers</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="customerButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="customerButton"><a class="dropdown-item" href="#!">Today</a><a class="dropdown-item" href="#!">Tomorrow</a><a class="dropdown-item" href="#!">Yesterday</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body main-customer-table px-0 pt-0">
                    <div class="recent-table table-responsive custom-scrollbar">
                      <table class="table" id="top-customer">
                        <thead> 
                          <tr>
                            <th></th>
                            <th>Customers</th>
                            <th>Total Purchase</th>
                            <th>Total Price</th>
                          </tr>
                        </thead>
                        <tbody> 
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard/user/2.jpg')}}" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Jane Cooper</a>
                                  <p class="mb-0 f-light">#452140</p>
                                </div>
                              </div>
                            </td>
                            <td>65 Purchases</td>
                            <td class="f-w-500 txt-success">$970.00</td>
                          </tr>
                          <tr> 
                            <td></td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard/user/3.jpg')}}" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Wade Warren</a>
                                  <p class="mb-0 f-light">#844967</p>
                                </div>
                              </div>
                            </td>
                            <td>42 Purchases</td>
                            <td class="f-w-500 txt-success">$300.00</td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard/user/4.jpg')}}" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Guy Hawkins</a>
                                  <p class="mb-0 f-light">#321489</p>
                                </div>
                              </div>
                            </td>
                            <td>38 Purchases</td>
                            <td class="f-w-500 txt-success">$900.00</td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard/user/5.jpg')}}" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Jake Spy</a>
                                  <p class="mb-0 f-light">#954687</p>
                                </div>
                              </div>
                            </td>
                            <td>23 Purchases</td>
                            <td class="f-w-500 txt-success">$300.00</td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard-9/user/1.png')}}" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Devin Jake</a>
                                  <p class="mb-0 f-light">#562778</p>
                                </div>
                              </div>
                            </td>
                            <td>12 Purchases</td>
                            <td class="f-w-500 txt-success">$500.00</td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard-9/user/2.png')}}" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Jacob Jones</a>
                                  <p class="mb-0 f-light">#589356</p>
                                </div>
                              </div>
                            </td>
                            <td>10 Purchases</td>
                            <td class="f-w-500 txt-success">$420.00</td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard-9/user/5.p')}}ng" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Jams Bone</a>
                                  <p class="mb-0 f-light">#589657</p>
                                </div>
                              </div>
                            </td>
                            <td>10 Purchases</td>
                            <td class="f-w-500 txt-success">$440.00</td>
                          </tr>
                          <tr>
                            <td> </td>
                            <td>
                              <div class="d-flex"><img class="img-fluid img-40 rounded-circle me-2" src="{{ asset('dashboard/assets/images/dashboard-9/user/3.p')}}ng" alt="user">
                                <div class="img-content-box"><a class="f-w-500" href="products-list.html">Mili Pais</a>
                                  <p class="mb-0 f-light">#589654</p>
                                </div>
                              </div>
                            </td>
                            <td>12 Purchases</td>
                            <td class="f-w-500 txt-success">$240.00</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xxl-5 col-lg-6 box-col-6 ord-xl-2 ord-md-3 box-ord-2">
                <div class="card">
                  <div class="card-header card-no-border">
                    <div class="header-top"> 
                      <h5>Sales Statistical Overview</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown custom-dropdown">
                          <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Year</button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#!">Day</a></li>
                            <li><a class="dropdown-item" href="#!">Month</a></li>
                            <li><a class="dropdown-item" href="#!">Year</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row m-0 overall-card">
                      <div class="col-12 p-0">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
                        <div class="chart-right">
                          <div class="row">
                            <div class="col-xl-12">
                              <div class="card-body p-0 statistical-card">
                                <ul class="d-flex m-b-15">
                                  <li>
                                    <h5 class="counter" data-target="19897">0</h5><span class="f-light">Total Cost</span>
                                  </li>
                                  <li>
                                    <h5>
                                       $<span class="counter" data-target="849058">0</span></h5><span class="f-light">Total Revenue</span>
                                  </li>
                                </ul>
                                <div class="current-sale-container">
                                  <div id="chart-currently"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 ord-xl-3 ord-md-4 box-ord-3">
                <div class="card monthly-header"> 
                  <div class="card-header card-no-border">
                    <div class="header-top"> 
                      <h5>Monthly Target</h5>
                      <div class="card-header-right-icon">
                        <div class="dropdown icon-dropdown">
                          <button class="btn dropdown-toggle" id="monthlyButton" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></button>
                          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="monthlyButton"><a class="dropdown-item" href="#!">Today</a><a class="dropdown-item" href="#!">Tomorrow</a><a class="dropdown-item" href="#!">Yesterday</a></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body"> 
                    <div class="monthly-target">
                      <div class="position-relative" id="monthly_target"></div>
                    </div>
                    <div class="target-content">
                      <p>Revenue Surges! Today's earnings soar to $3653, marking an impressive uptick from last month. Keep the momentum going!</p>
                      <div class="common-box">
                        <ul class="common-flex">
                          <li>
                            <h6>Revenue</h6><span class="common-space badge badge-light-success"> <i class="me-1" data-feather="trending-up"></i>$20k</span>
                          </li>
                          <li>
                            <h6>Target</h6><span class="common-space badge badge-light-danger"><i class="me-1" data-feather="trending-down"></i>$16k</span>
                          </li>
                          <li>
                            <h6>Today</h6><span class="common-space badge badge-light-success"><i class="me-1" data-feather="trending-up"></i>$1.6k</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
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
    <script src="{{ asset('dashboard/assets/js/clock.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/slick/slick.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/slick/slick.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/header-slick.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/dashboard/default.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/notify/index.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.select.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/select.bootstrap5.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead/typeahead.custom.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead-search/handlebars.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/typeahead-search/typeahead-custom.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('dashboard/assets/js/script.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/script1.js')}}"></script>
    <script src="{{ asset('dashboard/assets/js/theme-customizer/customizer.js')}}"></script>
  </body>
</html>