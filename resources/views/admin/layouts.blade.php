<!DOCTYPE html>

  @if(Auth::guard('admin')->user()->lang == 'english')
  <html lang="en" dir="ltr">
  @else
  <html lang="en" dir="rtl">
  @endif
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="/assets/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/favicon/favicon-32x32.png" type="image/x-icon">
    <title>WellWell Admin Dashboard</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/animate.css">
    <!-- Plugins css start-->
    <link href="{{asset('autocomplete/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
    @yield('extra-css')
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/app-assets/css/color-2.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toastr/toastr.css')}}">

    
    
    <style>
      .hide{
       display:none
      }
      span.badge.badge-pill.badge-warning {
    position: absolute;
    top: 10px;
    right: 50px !important;
}
    </style>
  </head>
  @if(Auth::guard('admin')->user()->lang == 'english')
  <body main-theme-layout="ltr">
  @else
  <body main-theme-layout="rtl">
  @endif
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="typewriter">
        {{-- <h1>{{$language[243][Auth::guard('admin')->user()->lang]}} {{$language[244][Auth::guard('admin')->user()->lang]}}..</h1>
          --}}
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right">
          <div class="main-header-left text-center">
            <div class="logo-wrapper"><a href="/admin/dashboard"><img src="/assets/images/logo.png" alt="" width="80px"></a></div>
          </div>
          <div class="mobile-sidebar">
            <div class="media-body text-right switch-sm">
              <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
            </div>
          </div>
          <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar">               </i></div>
          <div class="nav-right col pull-right right-menu">
            <ul class="nav-menus">

              <li>
                <form class="form-inline search-form" action="/admin/shipment-track" method="POST">
                {{ csrf_field() }}
                  <div class="form-group">
                    <div class="Typeahead Typeahead--twitterUsers">
                      <div class="u-posRelative">
                        <input autocomplete="off" class="Typeahead-input form-control-plaintext" id="search_input" type="text" name="search_input" placeholder="Track your Shipment...">
                        <div class="spinner-border Typeahead-spinner" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                        <a onclick="searchShipment()">
                          <span class="d-sm-none mobile-search" >
                          <i data-feather="search1" ></i>
                          </span>
                        </a>
                      </div>
                      <div class="Typeahead-menu"></div>
                    </div>
                  </div>
                </form>
              </li>

              <li>
                  <div class="form-group">
                    <div class="Typeahead Typeahead--twitterUsers">
                      <div class="u-posRelative">
                        <select style="top:10px !important;" class="form-control" id="languages" name="languages">
                        <option value="english" <?php if(Auth::guard('admin')->user()->lang == 'english') { ?> selected="selected"<?php } ?>>En</option>
                        <option value="arabic" <?php if(Auth::guard('admin')->user()->lang == 'arabic') { ?> selected="selected"<?php } ?>>Ar</option>
                        </select>
                      </div>
                      <div class="Typeahead-menu"></div>
                    </div>
                  </div>
              </li>

              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>

              <!-- <li class="onhover-dropdown"><img class="img-fluid img-shadow-warning" src="/assets/app-assets/images/dashboard/bookmark.png" alt="">
                <div class="onhover-show-div bookmark-flip">
                  <div class="flip-card">
                    <div class="flip-card-inner">
                      <div class="front">
                        <ul class="droplet-dropdown bookmark-dropdown">
                          <li class="gradient-primary text-center">
                            <h5 class="f-w-700">Bookmark</h5><span>Bookmark Icon With Grid</span>
                          </li>
                          <li>
                            <div class="row">
                              <div class="col-4 text-center"><i data-feather="file-text"></i></div>
                              <div class="col-4 text-center"><i data-feather="activity"></i></div>
                              <div class="col-4 text-center"><i data-feather="users"></i></div>
                              <div class="col-4 text-center"><i data-feather="clipboard"></i></div>
                              <div class="col-4 text-center"><i data-feather="anchor"></i></div>
                              <div class="col-4 text-center"><i data-feather="settings"></i></div>
                            </div>
                          </li>
                          <li class="text-center">
                            <button class="flip-btn" id="flip-btn">Add New Bookmark</button>
                          </li>
                        </ul>
                      </div>
                      <div class="back">
                        <ul>
                          <li>
                            <div class="droplet-dropdown bookmark-dropdown flip-back-content">
                              <input type="text" placeholder="search...">
                            </div>
                          </li>
                          <li>
                            <button class="d-block flip-back" id="flip-back">Back</button>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li> -->

              <!-- <li class="onhover-dropdown"><img class="img-fluid img-shadow-secondary" src="/assets/app-assets/images/dashboard/like.png" alt="">
                <ul class="onhover-show-div droplet-dropdown">
                  <li class="gradient-primary text-center">
                    <h5 class="f-w-700">Grid Dashboard</h5><span>Easy Grid inside dropdown</span>
                  </li>
                  <li>
                    <div class="row">
                      <div class="col-sm-4 col-6 droplet-main"><i data-feather="file-text"></i><span class="d-block">Content</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><i data-feather="activity"></i><span class="d-block">Activity</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><i data-feather="users"></i><span class="d-block">Contacts</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><i data-feather="clipboard"></i><span class="d-block">Reports</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><i data-feather="anchor"></i><span class="d-block">Automation</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><i data-feather="settings"></i><span class="d-block">Settings</span></div>
                    </div>
                  </li>
                  <li class="text-center">
                    <button class="btn btn-primary btn-air-primary">Follows Up</button>
                  </li>
                </ul>
              </li> -->
              
              <!-- <li class="onhover-dropdown"><img class="img-fluid img-shadow-warning" src="/assets/app-assets/images/dashboard/notification.png" alt="">
                <ul class="onhover-show-div notification-dropdown">
                  <li class="gradient-primary">
                    <h5 class="f-w-700">Notifications</h5><span>You have 6 unread messages</span>
                  </li>
                  <li>
                    <div class="media">
                      <div class="notification-icons bg-success mr-3"><i class="mt-0" data-feather="thumbs-up"></i></div>
                      <div class="media-body">
                        <h6>Someone Likes Your Posts</h6>
                        <p class="mb-0"> 2 Hours Ago</p>
                      </div>
                    </div>
                  </li>
                  <li class="pt-0">
                    <div class="media">
                      <div class="notification-icons bg-info mr-3"><i class="mt-0" data-feather="message-circle"></i></div>
                      <div class="media-body">
                        <h6>3 New Comments</h6>
                        <p class="mb-0"> 1 Hours Ago</p>
                      </div>
                    </div>
                  </li>
                  <li class="bg-light txt-dark"><a href="#">0 </a> notification</li>
                </ul>
              </li> -->

              <!-- <li><a class="right_side_toggle" href="#"><img class="img-fluid img-shadow-success" src="/assets/app-assets/images/dashboard/chat.png" alt=""></a></li> -->

              <li class="onhover-dropdown"> 
                <span class="media user-header">
                @if(Auth::guard('admin')->user()->profile_image != '')
                  <img style="width:50px !important;" class="img-fluid" src="/upload_files/{{Auth::guard('admin')->user()->profile_image}}" alt="">
                @else 
                  <img style="width:50px !important;" class="img-fluid" src="/assets/app-assets/images/dashboard/user.png" alt="">
                @endif
                </span>
                <ul class="onhover-show-div profile-dropdown">
                  <li class="gradient-primary">
                    <h5 class="f-w-600 mb-0">
                    <a href="/admin/change-profile-image">{{ Auth::guard('admin')->user()->name }}</a>
                    </h5>
                    <!-- <span>Web Designer</span> -->
                  </li>
                  <li><a href="/admin/change-password"><i data-feather="user"> </i>Change Password</a></li>
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <i data-feather="settings"> </i>Log Out</li> 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </ul>
              </li>

            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
          </div>
          <script id="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
          <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="iconsidebar-menu">
          <div class="sidebar">
            <ul class="iconMenu-bar custom-scrollbar">

              <!-- @if($role_get->id == 2 || $role_get->id == 3 || $role_get->id == 4)
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Customer</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Customer Status</li>
                  <li class="view-customer"><a class="view-customer" href="/admin/view-customer">View Customer</a></li>
                </ul>
              </li>
              @elseif($role_get->id == 5)
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Shipment</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Shipments</li>
                  <li class="new-shipment-request"><a class="new-shipment-request" href="/admin/new-shipment-request">New Shipment Request</a></li>
                  <li class="schedule-for-pickup"><a class="schedule-for-pickup" href="/admin/schedule-for-pickup">Schedule for Pickup</a></li>
                  <li class="pickup-exception"><a class="pickup-exception" href="/admin/pickup-exception">Pickup Exception</a></li>
                  <li class="package-collected"><a class="package-collected" href="/admin/package-collected">Package Collected</a></li>
                  <li class="transit-in"><a class="transit-in" href="/admin/transit-in">Transit In</a></li>
                  <li class="transit-out"><a class="transit-out" href="/admin/transit-out">Transit Out</a></li>
                  <li class="ready-for-delivery"><a class="ready-for-delivery" href="/admin/ready-for-delivery">Ready for Delivery</a></li>
                  <li class="delivery-exception"><a class="delivery-exception" href="/admin/delivery-exception">Delivery Exception</a></li>
                  <li class="shipment-delivered"><a class="shipment-delivered" href="/admin/shipment-delivered">Shipment Delivered</a></li>
                  <li class="cancel-request"><a class="cancel-request" href="/admin/cancel-request">Cancel Request</a></li>
                  <li class="shipment"><a class="shipment" href="/admin/shipment">All Shipment List</a></li>
                </ul>
              </li>
              @else  
              @endif-->

              
              <li>
                <a class="bar-icons" href="/admin/dashboard"><i class="pe-7s-home"></i><span>{{$language[1][Auth::guard('admin')->user()->lang]}}</span></a>
                <!-- <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Dashboard</li>
                  <li class="dashboard"><a class="dashboard" href="/admin/dashboard">Dashboard</a></li>
                </ul> -->
              </li>

              @if($role_get->all_customer == 'on' || $role_get->new_customer == 'on' || $role_get->sales_team == 'on' || $role_get->accounts_team == 'on')
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>{{$language[8][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[8][Auth::guard('admin')->user()->lang]}}</li>

                  @if($role_get->all_customer == 'on')
                  <li class="view-customer"><a class="view-customer" href="/admin/view-customer">{{$language[172][Auth::guard('admin')->user()->lang]}} {{$language[8][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif
                  @if($role_get->new_customer == 'on')
                  <li class="registration-customer"><a class="registration-customer" href="/admin/registration-customer">{{$language[169][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif
                  @if($role_get->sales_team == 'on')
                  <li class="sales-customer"><a class="sales-customer" href="/admin/sales-customer">{{$language[170][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif
                  @if($role_get->accounts_team == 'on')
                  <li class="accounts-customer"><a class="accounts-customer" href="/admin/accounts-customer">{{$language[171][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                </ul>
              </li>
              @endif

              @if($role_get->create_shipment == 'on' || $role_get->create_special_shipment == 'on' || $role_get->all_shipment == 'on' || $role_get->revenue_exception == 'on' || $role_get->cancel_shipment == 'on' || $role_get->shipment_hold == 'on')

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-cart"></i><span>{{$language[18][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[18][Auth::guard('admin')->user()->lang]}}</li>
                  
                  <li class="shipment-excel"><a class="shipment-excel" href="/admin/shipment-excel">Upload Excel</a></li>

                  @if($role_get->create_shipment == 'on')
                  <li class="new-shipment"><a class="new-shipment" href="/admin/new-shipment">{{$language[173][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->create_special_shipment == 'on')
                  <li class="special-shipment"><a class="special-shipment" href="/admin/special-shipment">{{$language[305][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  <!-- <li class="guest-shipment"><a class="guest-shipment" href="/admin/guest-shipment">Create Guest Shipment</a></li> -->

                  @if($role_get->all_shipment == 'on')
                  <li class="shipment"><a class="shipment" href="/admin/shipment">{{$language[174][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  @if($role_get->revenue_exception == 'on')
                  <li class="revenue-exception"><a class="revenue-exception" href="/admin/revenue-exception">{{$language[175][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->cancel_shipment == 'on')
                  <li class="cancel-request"><a class="cancel-request" href="/admin/cancel-request">{{$language[176][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  @if($role_get->shipment_hold == 'on')
                  <li class="hold-request"><a class="hold-request" href="/admin/hold-request">{{$language[301][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                </ul>
              </li>
              @endif

              @if($role_get->new_pickup_request == 'on' || $role_get->guest_pickup_request == 'on' || $role_get->today_bulk_pickup_request == 'on' || $role_get->future_bulk_pickup_request == 'on' || $role_get->pickup_assigned == 'on' || $role_get->pickup_exception == 'on' || $role_get->package_collected == 'on')
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-cart"></i><span>{{$language[57][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[57][Auth::guard('admin')->user()->lang]}}</li>
                  <!-- @if($role_get->new_pickup_request == 'on')
                  <li class="new-shipment-request"><a class="new-shipment-request" href="/admin/new-shipment-request">{{$language[177][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$new_shipment_request}}</span>
                  </a></li>
                  @endif -->
                  
                  @if($role_get->guest_pickup_request == 'on')
                  <li class="guest-pickup-request"><a class="guest-pickup-request" href="/admin/guest-pickup-request">{{$language[302][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$guest_pickup_request}}</span>
                  </a></li>
                  @endif

                  @if($role_get->today_bulk_pickup_request == 'on')
                  <li class="today-pickup-request"><a class="today-pickup-request" href="/admin/today-pickup-request">{{$language[303][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$today_pickup_request}}</span>
                  </a></li> 
                  @endif

                  @if($role_get->future_bulk_pickup_request == 'on')
                  <li class="future-pickup-request"><a class="future-pickup-request" href="/admin/future-pickup-request">{{$language[304][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$future_pickup_request}}</span>
                  </a></li>
                  @endif

                  @if($role_get->pickup_assigned == 'on')
                  <li class="schedule-for-pickup"><a class="schedule-for-pickup" href="/admin/schedule-for-pickup">{{$language[180][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$pickup_assigned}}</span>
                  </a></li>
                  @endif

                  @if($role_get->pickup_exception == 'on')
                  <li class="pickup-exception"><a class="pickup-exception" href="/admin/pickup-exception">{{$language[181][Auth::guard('admin')->user()->lang]}}
                  <span class="badge-pill badge-danger">{{$pickup_exception}}</span></a></li>
                  @endif

                  @if($role_get->package_collected == 'on')
                  <li class="package-collected"><a class="package-collected" href="/admin/package-collected">{{$language[182][Auth::guard('admin')->user()->lang]}}
                  <span class="badge-pill badge-danger">{{$package_collected}}</span></a></li>
                  @endif
                </ul>
              </li>
              @endif

              @if($role_get->transit_in == 'on' || $role_get->transit_out == 'on' || $role_get->package_at_station == 'on')

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-network"></i><span>{{$language[183][Auth::guard('admin')->user()->lang]}}</span></a> 
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[183][Auth::guard('admin')->user()->lang]}}</li> 
                  @if($role_get->transit_in == 'on')
                  <li class="transit-in"><a class="transit-in" href="/admin/transit-in">{{$language[184][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$transit_in}}</span></a></li> 
                  @endif

                  @if($role_get->transit_out == 'on')
                  <li class="transit-out"><a class="transit-out" href="/admin/transit-out">{{$language[185][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$transit_out}}</span></a></li>
                  @endif

                  @if($role_get->package_at_station == 'on')
                  <li class="package-at-station"><a class="package-at-station" href="/admin/package-at-station">{{$language[306][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$package_at_station}}</span></a></li>
                  @endif
                </ul>
              </li>
              @endif

              @if($role_get->van_for_delivery == 'on' ||$role_get->delivery_exception == 'on' ||$role_get->shipment_delivered == 'on' ||$role_get->today_delivery == 'on' ||$role_get->future_delivery == 'on' )
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-cart"></i><span>{{$language[89][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[89][Auth::guard('admin')->user()->lang]}}</li>
                  @if($role_get->van_for_delivery == 'on')
                  <li class="ready-for-delivery"><a class="ready-for-delivery" href="/admin/ready-for-delivery">{{$language[186][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$van_for_delivery}}</span></a></li>
                  @endif

                  @if($role_get->delivery_exception == 'on')
                   <li class="delivery-exception"><a class="delivery-exception" href="/admin/delivery-exception">{{$language[187][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$delivery_exception}}</span></a></li>
                  @endif

                  @if($role_get->shipment_delivered == 'on')
                  <li class="shipment-delivered"><a class="shipment-delivered" href="/admin/shipment-delivered">{{$language[188][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$shipment_delivered}}</span></a></li> 
                  @endif

                  @if($role_get->today_delivery == 'on')
                  <li class="today-delivery"><a class="today-delivery" href="/admin/today-delivery">{{$language[328][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$today_delivery}}</span></a></li>
                  @endif
                  @if($role_get->future_delivery == 'on')
                  <li class="future-delivery"><a class="future-delivery" href="/admin/future-delivery">{{$language[329][Auth::guard('admin')->user()->lang]}} <span class="badge-pill badge-danger">{{$future_delivery}}</span></a></li>
                  @endif
                </ul>
              </li>
              @endif

              @if($role_get->couriers == 'on' || $role_get->employees == 'on')
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>{{$language[189][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[189][Auth::guard('admin')->user()->lang]}}</li>
                  @if($role_get->couriers == 'on')
                  <li class="agent"><a class="agent" href="/admin/agent">{{$language[190][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                  @if($role_get->employees == 'on')
                  <li class="user"><a class="user" href="/admin/user">{{$language[191][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif
                  <!-- <li class="role"><a class="role" href="/admin/role">Department</a></li> -->
                </ul>
              </li>
              @endif


              @if($role_get->vehicle_create == 'on' || $role_get->vehicle_group == 'on' || $role_get->vehicle_type == 'on')
              <li>
                <span class="badge badge-pill badge-danger">0</span>
                <span class="badge badge-pill badge-warning">0</span>
              
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-car"></i><span>{{$language[307][Auth::guard('admin')->user()->lang]}} </span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[307][Auth::guard('admin')->user()->lang]}}</li>
                  @if($role_get->vehicle_create == 'on')
                  <li class="get-fleet"><a class="get-fleet" href="/admin/get-fleet">{{$language[310][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  @if($role_get->vehicle_group == 'on')
                  <li class="get-vehicle-group"><a class="get-vehicle-group" href="/admin/get-vehicle-group">{{$language[308][Auth::guard('admin')->user()->lang]}} </a></li> 
                  @endif

                  @if($role_get->vehicle_type == 'on')
                  <li class="get-vehicle-type"><a class="get-vehicle-type" href="/admin/get-vehicle-type">{{$language[309][Auth::guard('admin')->user()->lang]}} </a></li> 
                  @endif
                  
                  <!-- <li class="get-remainder"><a class="get-remainder" href="/admin/get-remainder">Remainder </a></li> -->
         
                </ul>
              </li>
              @endif
            
              @if($role_get->generate_invoice == 'on' || $role_get->guest_generate_invoice == 'on' || $role_get->invoice_history == 'on')
              <li>              
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-graph3"></i><span>{{$language[311][Auth::guard('admin')->user()->lang]}} </span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[312][Auth::guard('admin')->user()->lang]}}</li>
                  @if($role_get->generate_invoice == 'on')
                  <li class="generate-invoice"><a class="generate-invoice" href="/admin/generate-invoice">{{$language[313][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                  @if($role_get->guest_generate_invoice == 'on')
                  <li class="guest-generate-invoice"><a class="guest-generate-invoice" href="/admin/guest-generate-invoice">{{$language[314][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                  @if($role_get->invoice_history == 'on')
                  <li class="invoice-history"><a class="invoice-history" href="/admin/invoice-history">{{$language[315][Auth::guard('admin')->user()->lang]}} </a></li> 
                  @endif
                  
                </ul>
              </li>
              @endif


              @if($role_get->shipment_report == 'on' || $role_get->revenue_report == 'on' || $role_get->agent_report == 'on')
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-graph3"></i><span>{{$language[99][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[99][Auth::guard('admin')->user()->lang]}}</li>
                  @if($role_get->shipment_report == 'on')
                  <li class="shipment-report"><a class="shipment-report" href="/admin/shipment-report">{{$language[192][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                  @if($role_get->revenue_report == 'on')
                   <li class="revenue-report"><a class="revenue-report" href="/admin/revenue-report">{{$language[193][Auth::guard('admin')->user()->lang]}}</a></li>

                   <li class="all-revenue-report"><a class="all-revenue-report" href="/admin/all-revenue-report">Revenue Report Group</a></li> 
                  @endif
                  @if($role_get->agent_report == 'on')
                  <li class="agent-report"><a class="agent-report" href="/admin/agent-report">{{$language[316][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                </ul>
              </li>
              @endif

              @if($role_get->courier_team_cod_settlement_report == 'on' || $role_get->courier_team_guest_settlement_report == 'on' || $role_get->accounts_team_settlement_report == 'on' || $role_get->payments_out_report == 'on')
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-graph3"></i><span>{{$language[317][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[317][Auth::guard('admin')->user()->lang]}}</li>
                  
                  @if($role_get->courier_team_cod_settlement_report == 'on')
                  <li class="payments-in-report"><a class="payments-in-report" href="/admin/payments-in-report">{{$language[318][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  @if($role_get->courier_team_guest_settlement_report == 'on')
                  <li class="courier-team-guest-settlement"><a class="courier-team-guest-settlement" href="/admin/courier-team-guest-settlement">{{$language[330][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  <li class="view-agent-settlement"><a class="view-agent-settlement" href="/admin/view-agent-settlement">Agent Settlement</a></li> 

                  @if($role_get->accounts_team_settlement_report == 'on')
                  <li class="accounts-team-report"><a class="accounts-team-report" href="/admin/accounts-team-report">{{$language[319][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif
                  
                  @if($role_get->payments_out_report == 'on')
                  <li class="payments-out-report"><a class="payments-out-report" href="/admin/payments-out-report">{{$language[320][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  <li class="view-user-settlement"><a class="view-user-settlement" href="/admin/view-user-settlement">User Settlement</a></li> 

                </ul>
              </li>
              @endif

              @if($role_get->country == 'on' || $role_get->package_category == 'on' || $role_get->exception_category == 'on' || $role_get->complaint_request == 'on' || $role_get->station == 'on' || $role_get->financial_settings == 'on' || $role_get->common_price == 'on' || $role_get->terms_and_conditions == 'on' || $role_get->working_hours == 'on' || $role_get->languages == 'on' || $role_get->shipment_logs == 'on' || $role_get->system_logs == 'on' || $role_get->roles == 'on' || $role_get->system_logs == 'on' || $role_get->social_media_links == 'on')

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-config"></i><span>{{$language[132][Auth::guard('admin')->user()->lang]}}</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">{{$language[132][Auth::guard('admin')->user()->lang]}}</li>
                  @if($role_get->country == 'on')
                  <li class="country"><a class="country" href="/admin/country">{{$language[194][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  <!-- <li class="drop-point"><a class="drop-point" href="/admin/drop-point">Drop Point List</a></li> -->
                  @if($role_get->package_category == 'on')
                  <li class="package-category"><a class="package-category" href="/admin/package-category">{{$language[195][Auth::guard('admin')->user()->lang]}}</a></li> 
                  @endif

                  @if($role_get->exception_category == 'on')
                  <li class="exception-category"><a class="exception-category" href="/admin/exception-category">{{$language[196][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif
                  
                  @if($role_get->push_notification == 'on')
                  <li class="push-notification"><a class="push-notification" href="/admin/push-notification">{{$language[321][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->complaint_request == 'on')
                  <li class="complaint"><a class="complaint" href="/admin/complaint">{{$language[322][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->station == 'on')
                  <li class="station"><a class="station" href="/admin/station">{{$language[197][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->financial_settings == 'on')
                  <li class="settings"><a class="settings" href="/admin/settings">{{$language[198][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->common_price == 'on')
                  <li class="common-price"><a class="common-price" href="/admin/common-price">{{$language[199][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->terms_and_conditions == 'on')
                  <li class="terms-and-conditions"><a class="terms-and-conditions" href="/admin/terms-and-conditions">{{$language[323][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->social_media_links == 'on')
                  <li class="social-media-link"><a class="social-media-link" href="/admin/social-media-link">{{$language[324][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif
                  
                  @if($role_get->working_hours == 'on')
                  <li class="weeks"><a class="weeks" href="/admin/weeks">{{$language[325][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->languages == 'on')
                  <li class="languages"><a class="languages" href="/admin/languages">{{$language[200][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->shipment_logs == 'on')
                  <li class="user-logs"><a class="user-logs" href="/admin/user-logs">{{$language[201][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->system_logs == 'on')
                  <li class="system-logs"><a class="system-logs" href="/admin/system-logs">{{$language[298][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  @if($role_get->roles == 'on')
                  <li class="role"><a class="role" href="/admin/role">{{$language[300][Auth::guard('admin')->user()->lang]}}</a></li>
                  @endif

                  <li class="backup"><a class="backup" href="/admin/backup">DB Backup</a></li>
                </ul>
              </li>
              @endif
              
              
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->
        <!-- Right sidebar Start-->
        <!-- <div class="right-sidebar" id="right_side_bar">
          <div>
            <div class="container p-0">
              <div class="modal-header p-l-20 p-r-20">
                <div class="col-sm-8 p-0">
                  <h6 class="modal-title font-weight-bold">Contacts Status</h6>
                </div>
                <div class="col-sm-4 text-right p-0"><i class="mr-2" data-feather="settings"></i></div>
              </div>
            </div>
            <div class="friend-list-search mt-0">
              <input type="text" placeholder="search friend"><i class="fa fa-search"></i>
            </div>
            <div class="p-l-30 p-r-30">
              <div class="chat-box">
                <div class="people-list friend-list">
                  <ul class="list">
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/1.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Vincent Porter</div>
                        <div class="status"> Online</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/2.jpg" alt="">
                      <div class="status-circle away"></div>
                      <div class="about">
                        <div class="name">Ain Chavez</div>
                        <div class="status"> 28 minutes ago</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/8.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Kori Thomas</div>
                        <div class="status"> Online</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/4.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Erica Hughes</div>
                        <div class="status"> Online</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/5.jpg" alt="">
                      <div class="status-circle offline"></div>
                      <div class="about">
                        <div class="name">Ginger Johnston</div>
                        <div class="status"> 2 minutes ago</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/6.jpg" alt="">
                      <div class="status-circle away"></div>
                      <div class="about">
                        <div class="name">Prasanth Anand</div>
                        <div class="status"> 2 hour ago</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src=".//assets/app-assets/images/user/7.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Hileri Jecno</div>
                        <div class="status"> Online</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        @yield('section')
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                {{-- <p class="mb-0">{{$language[273][Auth::guard('admin')->user()->lang]}} © 2021 LRB INFO TECH. {{$language[274][Auth::guard('admin')->user()->lang]}}.</p> --}}
              </div>
              <div class="col-md-6">
                {{-- <p class="pull-right mb-0">{{$language[275][Auth::guard('admin')->user()->lang]}} & {{$language[276][Auth::guard('admin')->user()->lang]}}<i class="fa fa-heart"></i></p> --}}
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="/assets/app-assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/assets/app-assets/js/bootstrap/popper.min.js"></script>
    <script src="/assets/app-assets/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="/assets/app-assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/assets/app-assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="/assets/app-assets/js/sidebar-menu.js"></script>
    <script src="/assets/app-assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('autocomplete/jquery-ui.min.js') }}"></script>

    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
   
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/app-assets/js/script.js"></script>
    <!-- <script src="/assets/app-assets/js/theme-customizer/customizer.js"></script> -->
    <script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>
 @yield('extra-js')
    
    <!-- login js-->
    <!-- Plugin used-->
    <script>
  $('#languages').change(function(){
    var language = $('#languages').val();
    $.ajax({
      url : '/admin/change-language/'+language,
      type: "GET",
      success: function(data)
      {
          location.reload();
      }
    });
  });
  function searchShipment(){
    alert("ok")
    var search_input = $('#search_input').val();
    window.location.href="/admin/shipment-track/"+search_input;
    // $.ajax({
    //   url : '/admin/change-language/'+language,
    //   type: "GET",
    //   success: function(data)
    //   {
    //       location.reload();
    //   }
    // });
  }
    </script>
  </body>
</html>