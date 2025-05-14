@extends('layouts.template')

@section('title')
  Dashboard
@endsection

@section('plugins-head')

@endsection

@section('content')
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
            <li class="breadcrumb-item active">Default </li>
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
                  <h2 class="f-w-600">Welcome {{ auth()->user()->name }}!</h2>
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
                      <path class="minute-hand" d="M300.5 298V67"> </path>
                      <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                    </g>
                    <g id="second">
                      <path class="second-hand" d="M300.5 350V55"></path>
                      <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
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
@endsection

@section('plugins-last')
<script src="{{ asset('dashboard/assets/js/clock.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/dashboard/default.js')}}"></script>

<script src="{{ asset('dashboard/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/datatable/datatables/dataTables.select.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/datatable/datatables/select.bootstrap5.js')}}"></script>
<script src="{{ asset('dashboard/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
@endsection