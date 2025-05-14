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
             
              <li class="fullscreen-body">                       <span>
                  <svg id="maximize-screen">
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#full-screen')}}"></use>
                  </svg></span></li>
              <li>                         <span class="header-search">
                  <svg>
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#search')}}"></use>
                  </svg></span>
              </li>
             
              <li>
                <div class="mode">
                  <svg>
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#moon')}}"></use>
                  </svg>
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
                  <div class="flex-grow-1"><span>{{ auth()->user()->name }}</span>
                    <p class="mb-0">{{ auth()->user()->role }} <i class="middle fa-solid fa-angle-down"></i></p>
                  </div>
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="sign-up.html"><i data-feather="user"></i><span>Account </span></a></li>
                  <li><a href="mail-box.html"><i data-feather="mail"></i><span>Inbox</span></a></li>
                  <li><a href="task.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                  <li><a href="/setting"><i data-feather="settings"></i><span>Settings</span></a></li>
                  <li><a href="/logout"><i data-feather="log-in"> </i><span>Log out</span></a></li>
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