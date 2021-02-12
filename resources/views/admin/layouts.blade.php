<!DOCTYPE html>
<html lang="en">
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
    </style>
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="typewriter">
        <h1>Welcome to WellWell..</h1>
         
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
                <form class="form-inline search-form" action="#" method="get">
                  <div class="form-group">
                    <div class="Typeahead Typeahead--twitterUsers">
                      <div class="u-posRelative">
                        <input autocomplete="off" class="Typeahead-input form-control-plaintext" id="demo-input" type="text" name="q" placeholder="Search Your Product...">
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                      </div>
                      <div class="Typeahead-menu"></div>
                    </div>
                  </div>
                </form>
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

              <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="/assets/app-assets/images/dashboard/user.png" alt=""></span>
                <ul class="onhover-show-div profile-dropdown">
                  <li class="gradient-primary">
                    <h5 class="f-w-600 mb-0">{{ Auth::guard('admin')->user()->name }}</h5>
                    <!-- <span>Web Designer</span> -->
                  </li>
                  <li><a href="/admin/change-password"><i data-feather="user"> </i>Change Password</a></li>
                  <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <i data-feather="settings"> </i>LogOut</li>
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
              {{-- <li><a class="bar-icons" href="javascript:void(0)">
                  <!--img(src='/assets/app-assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>General    </span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Dashboard</li>
                  <li><a href="index.html">Default</a></li>
                  <li><a href="dashboard-crypto.html">Crypto</a></li>
                  <li><a href="dashboard-ecommerce.html">Ecommerce</a></li>
                  <li class="iconbar-header sub-header">Widgets</li>
                  <li><a href="general-widget.html">General widget</a></li>
                  <li><a href="chart-widget.html">Chart widget</a></li>
                  <li class="iconbar-header sub-header">starter-kit</li>
                  <li><a href="../starter-kit/index.html">starter-kit   </a></li>
                </ul>
              </li>
              <li><a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-portfolio"></i><span>UI Kits</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Ui Elements</li>
                  <li><a href="state-color.html">State color</a></li>
                  <li><a href="typography.html">Typography</a></li>
                  <li><a href="buttons.html">Buttons        </a></li>
                  <li><a href="avatars.html">Avatars</a></li>
                  <li><a href="helper-classes.html">helper classes</a></li>
                  <li><a href="grid.html">Grid</a></li>
                  <li><a href="tag-pills.html">Tag & pills</a></li>
                  <li><a href="progress-bar.html">Progress</a></li>
                  <li><a href="modal.html">Modal</a></li>
                  <li><a href="alert.html">Alert</a></li>
                  <li><a href="popover.html">Popover</a></li>
                  <li><a href="tooltip.html">Tooltip</a></li>
                  <li><a href="loader.html">Spinners</a></li>
                  <li><a href="dropdown.html">Dropdown</a></li>
                  <li><a href="tab-bootstrap.html">Bootstrap Tabs</a></li>
                  <li><a href="tab-material.html">Line Tabs</a></li>
                  <li><a href="according.html">Accordion</a></li>
                  <li><a href="navs.html">Navs</a></li>
                  <li><a href="list.html">Lists</a></li>
                  <li><a href="scrollable.html">Scrollable</a></li>
                  <li><a href="tree.html">Tree view</a></li>
                  <li><a href="bootstrap-notify.html">Bootstrap Notify</a></li>
                  <li><a href="rating.html">Rating</a></li>
                  <li><a href="dropzone.html">dropzone</a></li>
                  <li><a href="tour.html">Tour</a></li>
                  <li><a href="sweet-alert2.html">SweetAlert2</a></li>
                  <li><a href="modal-animated.html">Animated Modal</a></li>
                  <li><a href="owl-carousel.html">Owl Carousel</a></li>
                  <li><a href="ribbons.html">Ribbons</a></li>
                  <li><a href="pagination.html">Pagination</a></li>
                  <li><a href="steps.html">Steps</a></li>
                  <li><a href="breadcrumb.html">Breadcrumb</a></li>
                  <li><a href="range-slider.html">Range Slider</a></li>
                  <li><a href="image-cropper.html">Image cropper</a></li>
                  <li><a href="sticky.html">Sticky</a></li>
                  <li class="iconbar-header sub-header">Icons</li>
                  <li><a href="flag-icon.html">Flag icon</a></li>
                  <li><a href="font-awesome.html">Fontawesome Icon</a></li>
                  <li><a href="ico-icon.html">Ico Icon</a></li>
                  <li><a href="themify-icon.html">Thimify Icon</a></li>
                  <li><a href="feather-icon.html">Feather icon</a></li>
                  <li><a href="whether-icon.html">Whether Icon</a></li>
                  <li><a href="simple-line-icon.html">Simple line Icon</a></li>
                  <li><a href="material-design-icon.html">Material Design Icon</a></li>
                  <li><a href="pe7-icon.html">pe7 icon</a></li>
                  <li><a href="typicons-icon.html">Typicons icon</a></li>
                  <li><a href="ionic-icon.html">Ionic icon</a></li>
                </ul>
              </li> --}}
              {{-- <li><span class="badge badge-pill badge-danger">Hot</span><a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-diamond"></i><span>Perk UI</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Animation</li>
                  <li><a href="animate.html">Animate</a></li>
                  <li><a href="scroll-reval.html">Scroll Reveal</a></li>
                  <li><a href="AOS.html">AOS animation</a></li>
                  <li><a href="tilt.html">Tilt Animation</a></li>
                  <li><a href="wow.html">Wow Animation</a></li>
                  <li class="iconbar-header sub-header">Menu Options</li>
                  <li><a href="hide-on-scroll.html">Hide menu on Scroll</a></li>
                  <li><a href="vertical.html">Vertical Menu</a></li>
                  <li><a href="mega-menu.html">Mega Menu</a></li>
                  <li><a href="fix-header.html">Fix header</a></li>
                  <li><a href="fix-header&amp;sidebar.html">Fix Header & sidebar</a></li>
                  <li class="iconbar-header sub-header">Cards</li>
                  <li><a href="basic-card.html">Basic Card</a></li>
                  <li><a href="theme-card.html">Theme Card</a></li>
                  <li><a href="tabbed-card.html">Tabbed Card</a></li>
                  <li><a href="dragable-card.html">Draggable Card</a></li>
                  <li class="iconbar-header sub-header">Builders</li>
                  <li> <a href="button-builder.html">Button Builder</a></li>
                  <li><a href="form-builder-1.html">Form Builder</a></li>
                </ul>
              </li> --}}
              {{-- <li><a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-note2"></i><span>Forms</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Form Controls</li>
                  <li><a href="form-validation.html">Form Validation</a></li>
                  <li><a href="base-input.html">Base Inputs</a></li>
                  <li><a href="radio-checkbox-control.html">Checkbox & Radio</a></li>
                  <li><a href="input-group.html">Input Groups</a></li>
                  <li><a href="megaoptions.html">Mega Options</a></li>
                  <li class="iconbar-header sub-header">Form Widgets</li>
                  <li><a href="datepicker.html">Datepicker</a></li>
                  <li><a href="time-picker.html">Timepicker</a></li>
                  <li><a href="datetimepicker.html">Datetimepicker</a></li>
                  <li><a href="daterangepicker.html">Daterangepicker</a></li>
                  <li><a href="touchspin.html">Touchspin</a></li>
                  <li><a href="select2.html">Select2</a></li>
                  <li><a href="switch.html">Switch</a></li>
                  <li><a href="typeahead.html">Typeahead</a></li>
                  <li><a href="clipboard.html">Clipboard</a></li>
                  <li class="iconbar-header sub-header">Form Layout</li>
                  <li><a href="default-form.html">Default Forms</a></li>
                  <li><a href="form-wizard.html">Form Wizard 1</a></li>
                  <li><a href="form-wizard-two.html">Form Wizard 2</a></li>
                  <li><a href="form-wizard-three.html">Form Wizard 3</a></li>
                  <li><a href="form-wizard-four.html">Form Wizard 4</a></li>
                </ul>
              </li> --}}

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
                <a class="bar-icons" href="/admin/dashboard"><i class="pe-7s-id"></i><span>Dashboard</span></a>
                <!-- <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Dashboard</li>
                  <li class="dashboard"><a class="dashboard" href="/admin/dashboard">Dashboard</a></li>
                </ul> -->
              </li>

              @if(Auth::guard('admin')->user()->view_customer == 'on')
              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Customer</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Customer</li>
                  <li class="view-customer"><a class="view-customer" href="/admin/view-customer">View Customer</a></li>
                </ul>
              </li>
              @endif

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Shipment</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Shipments</li>
                  @if(Auth::guard('admin')->user()->new_shipment == 'on')
                  <li class="new-shipment"><a class="new-shipment" href="/admin/new-shipment">New Shipment</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->new_shipment_request == 'on')
                  <li class="new-shipment-request"><a class="new-shipment-request" href="/admin/new-shipment-request">New Shipment Request</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->schedule_for_pickup == 'on')
                  <li class="schedule-for-pickup"><a class="schedule-for-pickup" href="/admin/schedule-for-pickup">Schedule for Pickup</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->pickup_exception == 'on')
                  <li class="pickup-exception"><a class="pickup-exception" href="/admin/pickup-exception">Pickup Exception</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->package_collected == 'on')
                  <li class="package-collected"><a class="package-collected" href="/admin/package-collected">Package Collected</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->transit_in == 'on')
                  <li class="transit-in"><a class="transit-in" href="/admin/transit-in">Transit In</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->transit_out == 'on')
                  <li class="transit-out"><a class="transit-out" href="/admin/transit-out">Transit Out</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->ready_for_delivery == 'on')
                  <li class="ready-for-delivery"><a class="ready-for-delivery" href="/admin/ready-for-delivery">Ready for Delivery</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->delivery_exception == 'on')
                  <li class="delivery-exception"><a class="delivery-exception" href="/admin/delivery-exception">Delivery Exception</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->shipment_delivered == 'on')
                  <li class="shipment-delivered"><a class="shipment-delivered" href="/admin/shipment-delivered">Shipment Delivered</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->cancel_request == 'on')
                  <li class="cancel-request"><a class="cancel-request" href="/admin/cancel-request">Cancel Request</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->all_shipment == 'on')
                  <li class="shipment"><a class="shipment" href="/admin/shipment">All Shipment List</a></li>
                  @endif
                </ul>
              </li>

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Employees</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Employees</li>
                  @if(Auth::guard('admin')->user()->agent == 'on')
                  <li class="agent"><a class="agent" href="/admin/agent">Agent List</a></li>
                  @endif
                  @if(Auth::guard('admin')->user()->employee == 'on')
                  <li class="user"><a class="user" href="/admin/user">Employee List</a></li>
                  @endif
                  <!-- <li class="role"><a class="role" href="/admin/role">Department</a></li> -->
                </ul>
              </li>

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Report</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Report</li>
                  @if(Auth::guard('admin')->user()->shipment_report == 'on')
                  <li class="shipment-report"><a class="shipment-report" href="/admin/shipment-report">Shipment Report</a></li>
                  @endif
                  @if(Auth::guard('admin')->user()->revenue_report == 'on')
                  <li class="revenue-report"><a class="revenue-report" href="/admin/revenue-report">Revenue Report</a></li>
                  @endif
                </ul>
              </li>

              <li>
                <a class="bar-icons" href="javascript:void(0)"><i class="pe-7s-id"></i><span>Settings</span></a>
                <ul class="iconbar-mainmenu custom-scrollbar">
                  <li class="iconbar-header">Settings</li>
                  @if(Auth::guard('admin')->user()->country == 'on')
                  <li class="country"><a class="country" href="/admin/country">Country List</a></li>
                  @endif

                  <!-- <li class="drop-point"><a class="drop-point" href="/admin/drop-point">Drop Point List</a></li> -->
                  @if(Auth::guard('admin')->user()->package_category == 'on')
                  <li class="package-category"><a class="package-category" href="/admin/package-category">Package Category List</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->exception_category == 'on')
                  <li class="exception-category"><a class="exception-category" href="/admin/exception-category">Exception Category List</a></li>
                  @endif

                  <!-- <li class="push-notification"><a class="push-notification" href="/admin/push-notification">Push Notification</a></li> -->
                  @if(Auth::guard('admin')->user()->station == 'on')
                  <li class="station"><a class="station" href="/admin/station">Station List</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->financial_settings == 'on')
                  <li class="settings"><a class="settings" href="/admin/settings">Financial Settings</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->common_price == 'on')
                  <li class="common-price"><a class="common-price" href="/admin/common-price">Common Price</a></li>
                  @endif

                  @if(Auth::guard('admin')->user()->language == 'on')
                  <li class="languages"><a class="languages" href="/admin/languages">Languages</a></li>
                  @endif
                </ul>
              </li>

              
              
            </ul>
          </div>
        </div>
        <!-- Page Sidebar Ends-->
        <!-- Right sidebar Start-->
        <div class="right-sidebar" id="right_side_bar">
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
        </div>
        @yield('section')
        <!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright © 2021 LRB INFO TECH. All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <p class="pull-right mb-0">Hand-crafted & made with<i class="fa fa-heart"></i></p>
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
    @yield('extra-js')
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/app-assets/js/script.js"></script>
    <script src="/assets/app-assets/js/theme-customizer/customizer.js"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>

    
    <!-- login js-->
    <!-- Plugin used-->
    
  </body>
</html>