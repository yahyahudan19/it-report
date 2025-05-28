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
                    <label class="badge badge-light-primary">4</label><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-home')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-home')}}"></use>
                      </svg><span class="lan-3">Dashboard</span></a>
                      <ul class="sidebar-submenu">
                      <li><a class="lan-4" href="/dashboard">Default</a></li>
                      <li><a href="/dashboard/report">Report</a></li>
                      <li><a href="/dashboard/task">Task</a></li>
                      <li>
                        <label class="badge badge-light-success">Soon</label><a href="/dashboard/handling">Report Handling</a>
                      </li>
                    </ul>
                  </li>
                   @if (auth()->user()->role !== 'staff')
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Head Of Unit</h6>
                    </div>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-reports')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-reports')}}"></use>
                      </svg><span>Evaluation</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="/assessment/hou">Assessment</a></li>
                      <li><a href="/evaluation/hou">Evaluation</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/task/hou">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-task')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-task')}}"></use>
                      </svg><span>Task</span></a>
                    </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-learning')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-learning')}}"></use>
                      </svg><span>Department</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="/positions/hou">Positions</a></li>
                      <li><a href="/staff/hou">Staff</a></li>
                    </ul>
                  </li>
                  @endif
                  <li class="sidebar-main-title">
                    <div>
                      <h6>Applications</h6>
                    </div>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-reports')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-reports')}}"></use>
                      </svg><span>Evaluation</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="/assessment/my">My Assessment</a></li>
                      <li><a href="/evaluation/my">My Evaluation</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-error')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-error')}}"></use>
                      </svg><span>Report</span></a>
                    <ul class="sidebar-submenu">
                      <li><a href="/report">Report</a></li>
                      <li><a href="/handling">Handling</a></li>
                    </ul>
                  </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/task/my">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-task')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-task')}}"></use>
                      </svg><span>Task</span></a>
                    </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-10">Management</h6>
                    </div>
                  </li>
                 {{-- @if (auth()->user()->role !== 'staff') --}}
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/category">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-file')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-file')}}"></use>
                      </svg><span>Category</span></a>
                  </li>
                  {{-- @endif --}}
                  @if (auth()->user()->role == 'sys_admin')
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/users">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-user')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-user')}}"></use>
                      </svg><span>Users</span></a>
                    </li>
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/department">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-learning')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-learning')}}"></use>
                      </svg><span>Department</span></a>
                    </li>
                  @endif
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/location">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-maps')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-maps')}}"></use>
                      </svg><span>Location</span></a>
                    </li>
                  <li class="sidebar-main-title">
                    <div>
                      <h6 class="lan-11">Settings</h6>
                    </div>
                  </li>
                  @if (auth()->user()->role == 'sys_admin')
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/whatsapp">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-contact')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-contact')}}"></use>
                      </svg><span>Whatsapp Gateway</span></a>
                    </li>
                  @endif
                   <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="/profile">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-user')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-user')}}"></use>
                      </svg><span>Profile</span></a>
                    </li>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>