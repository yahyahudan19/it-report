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
                  <li class="sidebar-main-title">
                    <div>
                      <h6>App</h6>
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
                      <li><a href="/assessment">Assessment</a></li>
                      <li><a href="/evaluation">Evaluation</a></li>
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
                  <li class="sidebar-list"><i class="fa-solid fa-thumbtack"></i><a class="sidebar-link sidebar-title link-nav" href="kanban.html">
                      <svg class="stroke-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#stroke-task')}}"></use>
                      </svg>
                      <svg class="fill-icon">
                        <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg#fill-task')}}"></use>
                      </svg><span>Task</span></a>
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