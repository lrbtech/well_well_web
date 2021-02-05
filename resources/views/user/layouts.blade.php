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
    <title>WellWell Customer Dashboard</title>
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
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/vertical-menu.css">
    
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/style.css">
    <link id="color" rel="stylesheet" href="/assets/app-assets/css/color-2.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/assets/app-assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toastr/toastr.css')}}">

    
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
  <div class="page-wrapper vertical">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right">
          <div class="main-header-left text-center">
            <div class="logo-wrapper"><a href="/"><img src="/assets/images/logo.png" alt="" width="100px"></a></div>
          </div>
          <div class="mobile-sidebar d-none">
            <div class="media-body text-right switch-sm">
              <label class="switch ml-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-align-center font-primary" id="sidebar-toggle"><line x1="18" y1="10" x2="6" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="18" y1="18" x2="6" y2="18"></line></svg></label>
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
                        <input autocomplete="off" class="Typeahead-input form-control-plaintext" id="demo-input" type="text" name="q" placeholder="Search Your Logistics">
                        <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><span class="d-sm-none mobile-search"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></span>
                      </div>
                      <div class="Typeahead-menu"></div>
                    </div>
                  </div>
                </form>
              </li>
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a></li>

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
                              <div class="col-4 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></div>
                              <div class="col-4 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></div>
                              <div class="col-4 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg></div>
                              <div class="col-4 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg></div>
                              <div class="col-4 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-anchor"><circle cx="12" cy="5" r="3"></circle><line x1="12" y1="22" x2="12" y2="8"></line><path d="M5 12H2a10 10 0 0 0 20 0h-3"></path></svg></div>
                              <div class="col-4 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></div>
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
              </li>
              <li class="onhover-dropdown"><img class="img-fluid img-shadow-secondary" src="/assets/app-assets/images/dashboard/like.png" alt="">
                <ul class="onhover-show-div droplet-dropdown">
                  <li class="gradient-primary text-center">
                    <h5 class="f-w-700">Grid Dashboard</h5><span>Easy Grid inside dropdown</span>
                  </li>
                  <li>
                    <div class="row">
                      <div class="col-sm-4 col-6 droplet-main"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg><span class="d-block">Content</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg><span class="d-block">Activity</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg><span class="d-block">Contacts</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><span class="d-block">Reports</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-anchor"><circle cx="12" cy="5" r="3"></circle><line x1="12" y1="22" x2="12" y2="8"></line><path d="M5 12H2a10 10 0 0 0 20 0h-3"></path></svg><span class="d-block">Automation</span></div>
                      <div class="col-sm-4 col-6 droplet-main"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg><span class="d-block">Settings</span></div>
                    </div>
                  </li>
                  <li class="text-center">
                    <button class="btn btn-primary btn-air-primary">Follows Up</button>
                  </li>
                </ul>
              </li>  -->

              <!-- <li class="onhover-dropdown"><img class="img-fluid img-shadow-warning" src="/assets/app-assets/images/dashboard/notification.png" alt="">
                <ul class="onhover-show-div notification-dropdown">
                  <li class="gradient-primary">
                    <h5 class="f-w-700">Notifications</h5><span>You have 0 unread messages</span>
                  </li>
                  <li>
                    <div class="media">
                      <div class="notification-icons bg-success mr-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up mt-0"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg></div>
                      <div class="media-body">
                        <h6>Someone Likes Your Posts</h6>
                        <p class="mb-0"> 2 Hours Ago</p>
                      </div>
                    </div>
                  </li>
                  <li class="pt-0">
                    <div class="media">
                      <div class="notification-icons bg-info mr-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle mt-0"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg></div>
                      <div class="media-body">
                        <h6>3 New Comments</h6>
                        <p class="mb-0"> 1 Hours Ago</p>
                      </div>
                    </div>
                  </li> 
                  <li class="bg-light txt-dark"><a href="#">All </a> notification</li>
                </ul>
              </li> -->

              <!-- <li><a class="right_side_toggle" href="#"><img class="img-fluid img-shadow-success" src="/assets/app-assets/images/dashboard/chat.png" alt=""></a></li> -->

              <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="/assets/app-assets/images/dashboard/user.png" alt=""></span>
                <ul class="onhover-show-div profile-dropdown">
                  <li class="gradient-primary">
                    <h5 style="color: #fff !important;" class="f-w-600 mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                  </li>
                  <li>
                    <a href="/user/change-password"><i data-feather="settings"></i>Change Password</a>
                  </li>
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
            <div class="d-lg-none mobile-toggle pull-right"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></div>
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
      @if(Auth::user()->status == 4)
      <!-- vertical menu start-->
      <div class="vertical-menu-main">
        <nav id="main-nav">
          <!-- Sample menu definition-->
          <ul class="sm pixelstrap custom-scrollbar" id="main-menu" data-smartmenus-id="16111720102752585">
            <li>
              <div class="text-right mobile-back">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
            </li>
            {{-- <li><a href="#" class="has-submenu" id="sm-16111720102752585-1" aria-haspopup="true" aria-controls="sm-16111720102752585-2" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home font-primary"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Dashboard<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-2" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-1" aria-expanded="false" class="sm-nowrap" style="width: auto; min-width: 10em; display: none; max-width: 20em; top: auto; left: 0px; margin-left: 0px; margin-top: 0px;">
                <li><a href="index.html">Default</a></li>
                <li><a href="dashboard-crypto.html">Crypto</a></li>
                <li><a href="dashboard-ecommerce.html">Ecommerce</a></li>
              </ul>
            </li> --}}
            
            <li>
              <a class="sidebar-header" href="/user/dashboard">
                <i data-feather="home"></i>
                <span> Dashboard</span>
              </a>
            </li>

            <li>
              <a class="sidebar-header" href="/user/new-shipment">
              <i data-feather="folder-plus"></i>
              <span> New Shipment</span>
              </a>
            </li>

            <li>
              <a class="sidebar-header" href="/user/shipment">
              <i data-feather="eye"></i>
              <span> View Shipment</span>
              </a>
            </li>
            
            <li>
              <a class="sidebar-header" href="/user/edit-profile">
              <i data-feather="settings"></i>
              <span> Profile</span>
              </a>
            </li>

            {{-- <li><a href="#" class="has-submenu" id="sm-16111720102752585-3" aria-haspopup="true" aria-controls="sm-16111720102752585-4" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay font-primary"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg> Widgets<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-4" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-3" aria-expanded="false">
                <li><a href="general-widget.html">General</a></li>
                <li><a href="chart-widget.html">Chart</a></li>
              </ul>
            </li>
            <li><a class="sidebar-header" href="../starter-kit/index.html"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-anchor font-primary"><circle cx="12" cy="5" r="3"></circle><line x1="12" y1="22" x2="12" y2="8"></line><path d="M5 12H2a10 10 0 0 0 20 0h-3"></path></svg><span> Starter kit</span></a></li>
            <li><a href="#" class="has-submenu" id="sm-16111720102752585-5" aria-haspopup="true" aria-controls="sm-16111720102752585-6" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout font-primary"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg> Menu Options<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-6" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-5" aria-expanded="false">
                <li class="active"><a href="hide-on-scroll.html">Hide menu on Scroll</a></li>
                <li><a class="current" href="vertical.html">Vertical Menu</a></li>
                <li><a href="mega-menu.html">Mega Menu</a></li>
                <li><a href="fix-header.html">Fix header</a></li>
              </ul>
            </li>
            <li><a href="#" class="has-submenu" id="sm-16111720102752585-7" aria-haspopup="true" aria-controls="sm-16111720102752585-8" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-primary"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg> Builder<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-8" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-7" aria-expanded="false">
                <li><a href="form-builder-1.html">Form Builder 1</a></li>
                <li><a href="button-builder.html">Button Builder</a></li>
              </ul>
            </li>
            <li><a href="#" class="has-submenu" id="sm-16111720102752585-9" aria-haspopup="true" aria-controls="sm-16111720102752585-10" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder font-primary"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg> Components<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-10" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-9" aria-expanded="false">
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-11" aria-haspopup="true" aria-controls="sm-16111720102752585-12" aria-expanded="false"><span> Base</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-12" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-11" aria-expanded="false">
                    <li><a href="state-color.html">State color</a></li>
                    <li><a href="typography.html">Typography</a></li>
                    <li><a href="helper-classes.html">helper classes</a></li>
                    <li><a href="grid.html">Grid</a></li>
                    <li><a href="tag-pills.html">Tag &amp; pills</a></li>
                    <li><a href="progress-bar.html">Progress</a></li>
                    <li><a href="modal.html">Modal</a></li>
                    <li><a href="alert.html">Alert</a></li>
                    <li><a href="popover.html">Popover</a></li>
                    <li><a href="tooltip.html">Tooltip</a></li>
                    <li><a href="loader.html">Spinners</a></li>
                    <li><a href="dropdown.html">Dropdown</a></li>
                    <li><a href="#" class="has-submenu" id="sm-16111720102752585-13" aria-haspopup="true" aria-controls="sm-16111720102752585-14" aria-expanded="false">Tabs<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-14" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-13" aria-expanded="false">
                        <li><a href="tab-bootstrap.html">Bootstrap Tabs</a></li>
                        <li><a href="tab-material.html">Line Tabs</a></li>
                      </ul>
                    </li>
                    <li><a href="according.html">According</a></li>
                    <li><a href="navs.html">Navs</a></li>
                    <li><a href="list.html">Lists</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-15" aria-haspopup="true" aria-controls="sm-16111720102752585-16" aria-expanded="false"><span> Advance</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-16" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-15" aria-expanded="false">
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
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-17" aria-haspopup="true" aria-controls="sm-16111720102752585-18" aria-expanded="false"><span>Animation</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-18" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-17" aria-expanded="false">
                    <li><a href="animate.html">Animate</a></li>
                    <li><a href="scroll-reval.html">Scroll Reveal</a></li>
                    <li><a href="AOS.html">AOS animation</a></li>
                    <li><a href="tilt.html">Tilt Animation</a></li>
                    <li><a href="wow.html">Wow Animation</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-19" aria-haspopup="true" aria-controls="sm-16111720102752585-20" aria-expanded="false"><span>Icons</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-20" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-19" aria-expanded="false">
                    <li><a href="flag-icon.html">Flag icon</a></li>
                    <li><a href="font-awesome.html">Fontawesome Icon</a></li>
                    <li><a href="ico-icon.html">Ico Icon</a></li>
                    <li><a href="themify-icon.html">Thimify Icon</a></li>
                    <li><a href="whether-icon.html">Whether Icon</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header" href="buttons.html"><span>Buttons</span></a></li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-21" aria-haspopup="true" aria-controls="sm-16111720102752585-22" aria-expanded="false"><span>Forms</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-22" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-21" aria-expanded="false">
                    <li><a href="#" class="has-submenu" id="sm-16111720102752585-23" aria-haspopup="true" aria-controls="sm-16111720102752585-24" aria-expanded="false">Form Controls<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-24" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-23" aria-expanded="false">
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="base-input.html">Base Inputs</a></li>
                        <li><a href="radio-checkbox-control.html">Checkbox &amp; Radio</a></li>
                        <li><a href="input-group.html">Input Groups</a></li>
                        <li><a href="megaoptions.html">Mega Options</a></li>
                      </ul>
                    </li>
                    <li><a href="#" class="has-submenu" id="sm-16111720102752585-25" aria-haspopup="true" aria-controls="sm-16111720102752585-26" aria-expanded="false">Form Widgets<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-26" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-25" aria-expanded="false">
                        <li><a href="datepicker.html">Datepicker</a></li>
                        <li><a href="time-picker.html">Timepicker</a></li>
                        <li><a href="datetimepicker.html">Datetimepicker </a></li>
                        <li><a href="daterangepicker.html">Daterangepicker </a></li>
                        <li><a href="touchspin.html">Touchspin</a></li>
                        <li><a href="select2.html">Select2</a></li>
                        <li><a href="switch.html">Switch</a></li>
                        <li><a href="typeahead.html">Typeahead</a></li>
                        <li><a href="clipboard.html">Clipboard</a></li>
                      </ul>
                    </li>
                    <li><a href="font-awesome.html" class="has-submenu" id="sm-16111720102752585-27" aria-haspopup="true" aria-controls="sm-16111720102752585-28" aria-expanded="false">Form Layout<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-28" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-27" aria-expanded="false">
                        <li><a href="default-form.html">Default Forms</a></li>
                        <li><a href="form-wizard.html">Form Wizard 1</a></li>
                        <li><a href="form-wizard-two.html">Form Wizard 2</a></li>
                        <li><a href="form-wizard-three.html">Form Wizard 3</a></li>
                        <li><a href="form-wizard-four.html">Form Wizard 4</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-29" aria-haspopup="true" aria-controls="sm-16111720102752585-30" aria-expanded="false"><span>Tables</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-30" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-29" aria-expanded="false">
                    <li><a href="#" class="has-submenu" id="sm-16111720102752585-31" aria-haspopup="true" aria-controls="sm-16111720102752585-32" aria-expanded="false">Bootstrap Tables<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-32" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-31" aria-expanded="false">
                        <li><a href="bootstrap-basic-table.html">Basic Tables</a></li>
                        <li><a href="bootstrap-sizing-table.html">Sizing Tables</a></li>
                        <li><a href="bootstrap-border-table.html">Border Tables</a></li>
                        <li><a href="bootstrap-styling-table.html">Styling Tables</a></li>
                        <li><a href="table-components.html">Table components</a></li>
                      </ul>
                    </li>
                    <li><a href="#" class="has-submenu" id="sm-16111720102752585-33" aria-haspopup="true" aria-controls="sm-16111720102752585-34" aria-expanded="false">Data Tables<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-34" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-33" aria-expanded="false">
                        <li><a href="datatable-basic-init.html">Basic Init</a></li>
                        <li><a href="datatable-advance.html">Advance Init</a></li>
                        <li><a href="datatable-styling.html">Styling</a></li>
                        <li><a href="datatable-AJAX.html">AJAX</a></li>
                        <li><a href="datatable-server-side.html">Server Side</a></li>
                        <li><a href="datatable-plugin.html">Plug-in</a></li>
                        <li><a href="datatable-API.html">API</a></li>
                        <li><a href="datatable-data-source.html">Data Sources</a></li>
                      </ul>
                    </li>
                    <li><a href="#" class="has-submenu" id="sm-16111720102752585-35" aria-haspopup="true" aria-controls="sm-16111720102752585-36" aria-expanded="false">Extension Data Tables<span class="sub-arrow"></span></a>
                      <ul class="sidebar-submenu" id="sm-16111720102752585-36" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-35" aria-expanded="false">
                        <li><a href="datatable-ext-autofill.html">Auto Fill</a></li>
                        <li><a href="datatable-ext-basic-button.html">Basic Button</a></li>
                        <li><a href="datatable-ext-col-reorder.html">Column Reorder</a></li>
                        <li><a href="datatable-ext-fixed-header.html">Fixed Header</a></li>
                        <li><a href="datatable-ext-html-5-data-export.html">HTML 5 Export</a></li>
                        <li><a href="datatable-ext-key-table.html">Key Table</a></li>
                        <li><a href="datatable-ext-responsive.html">Responsive</a></li>
                        <li><a href="datatable-ext-row-reorder.html">Row Reorder</a></li>
                        <li><a href="datatable-ext-scroller.html">Scroller</a></li>
                      </ul>
                    </li>
                    <li><a href="jsgrid-table.html">Js Grid Tables</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-37" aria-haspopup="true" aria-controls="sm-16111720102752585-38" aria-expanded="false"><span>Cards</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-38" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-37" aria-expanded="false">
                    <li><a href="basic-card.html">Basic Card</a></li>
                    <li><a href="theme-card.html">Theme Card</a></li>
                    <li><a href="tabbed-card.html">Tabbed Card</a></li>
                    <li><a href="dragable-card.html">Draggable Card</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-39" aria-haspopup="true" aria-controls="sm-16111720102752585-40" aria-expanded="false"><span>Charts</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-40" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-39" aria-expanded="false">
                    <li><a href="chart-google.html">Google Chart</a></li>
                    <li><a href="chart-sparkline.html">sparkline chart</a></li>
                    <li><a href="chart-flot.html">Flot Chart</a></li>
                    <li><a href="chart-morris.html">Morris Chart</a></li>
                    <li><a href="chartjs.html">chatjs Chart</a></li>
                    <li><a href="chartist.html">chatist Chart</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-41" aria-haspopup="true" aria-controls="sm-16111720102752585-42" aria-expanded="false"><span>Maps</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-42" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-41" aria-expanded="false">
                    <li><a href="map-js.html">Map Js</a></li>
                    <li><a href="vector-map.html">Vector Maps</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-43" aria-haspopup="true" aria-controls="sm-16111720102752585-44" aria-expanded="false"><span>Editors</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-44" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-43" aria-expanded="false">
                    <li><a href="summernote.html">Summer Note</a></li>
                    <li><a href="ckeditor.html">CK editor</a></li>
                    <li><a href="simple-MDE.html">MDE editor</a></li>
                    <li><a href="ace-code-editor.html">ACE code editor</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#" class="has-submenu" id="sm-16111720102752585-45" aria-haspopup="true" aria-controls="sm-16111720102752585-46" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase font-primary"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg> Apps<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-46" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-45" aria-expanded="false">
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-47" aria-haspopup="true" aria-controls="sm-16111720102752585-48" aria-expanded="false"><span>Users</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-48" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-47" aria-expanded="false">
                    <li><a href="user-profile.html">Users Profile</a></li>
                    <li><a href="edit-profile.html">Users Edit</a></li>
                    <li><a href="user-cards.html">Users Cards</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-49" aria-haspopup="true" aria-controls="sm-16111720102752585-50" aria-expanded="false"><span>Calender</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-50" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-49" aria-expanded="false">
                    <li><a href="calendar.html">Full Calender Basic</a></li>
                    <li><a href="calendar-event.html">Full Calender Events </a></li>
                    <li><a href="calendar-advanced.html">Full Calender Advance </a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-51" aria-haspopup="true" aria-controls="sm-16111720102752585-52" aria-expanded="false"><span>Gallery</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-52" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-51" aria-expanded="false">
                    <li><a href="gallery.html">Gallery Grid</a></li>
                    <li><a href="gallery-with-description.html">Gallery Grid with Desc</a></li>
                    <li><a href="gallery-masonry.html">Masonry Gallery</a></li>
                    <li><a href="masonry-gallery-with-disc.html">Masonry Gallery Desc</a></li>
                    <li><a href="gallery-hover.html">Hover Effects</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-53" aria-haspopup="true" aria-controls="sm-16111720102752585-54" aria-expanded="false"><span>Email</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-54" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-53" aria-expanded="false">
                    <li><a href="email-application.html">Email App</a></li>
                    <li><a href="email-compose.html">Email Compose</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-55" aria-haspopup="true" aria-controls="sm-16111720102752585-56" aria-expanded="false"><span> Blog</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-56" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-55" aria-expanded="false">
                    <li><a href="blog.html">Blog Details</a></li>
                    <li><a href="blog-single.html">Blog Single</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-57" aria-haspopup="true" aria-controls="sm-16111720102752585-58" aria-expanded="false"><span>chat</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-58" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-57" aria-expanded="false">
                    <li><a href="chat.html">Chat App</a></li>
                    <li><a href="chat-video.html">Video chat              </a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header" href="support-ticket.html"><span>Support Ticket</span></a></li>
                <li><a class="sidebar-header" href="to-do.html"><span>To-Do</span></a></li>
                <li><a class="sidebar-header" href="../index.html"><span>Landing page</span></a></li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-59" aria-haspopup="true" aria-controls="sm-16111720102752585-60" aria-expanded="false"><span>Ecommerce</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-60" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-59" aria-expanded="false">
                    <li><a href="product.html">Product</a></li>
                    <li><a href="product-page.html">Product page</a></li>
                    <li><a href="list-products.html">Product list</a></li>
                    <li><a href="payment-details.html">Payment Details</a></li>
                    <li><a href="invoice-template.html">Invoice</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header" href="pricing.html"><span> Pricing</span></a></li>
              </ul>
            </li>
            <li><a href="#" class="has-submenu" id="sm-16111720102752585-61" aria-haspopup="true" aria-controls="sm-16111720102752585-62" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-plus font-primary"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><line x1="9" y1="15" x2="15" y2="15"></line></svg> Pages<span class="sub-arrow"></span></a>
              <ul id="sm-16111720102752585-62" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-61" aria-expanded="false">
                <li><a class="sidebar-header" href="sample-page.html"><span> Sample page</span></a></li>
                <li><a class="sidebar-header" href="search.html"><span>Search Website</span></a></li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-63" aria-haspopup="true" aria-controls="sm-16111720102752585-64" aria-expanded="false"><span> Error Page</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-64" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-63" aria-expanded="false">
                    <li><a href="error-400.html">Error 400</a></li>
                    <li><a href="error-404.html">Error 404</a></li>
                    <li><a href="error-500.html">Error 500</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-65" aria-haspopup="true" aria-controls="sm-16111720102752585-66" aria-expanded="false"><span> Authentication</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-66" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-65" aria-expanded="false">
                    <li><a href="login.html">Login Simple</a></li>
                    <li><a href="signup.html">Register Simple </a></li>
                    <li><a href="forget-password.html">Forget Password</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header has-submenu" href="#" id="sm-16111720102752585-67" aria-haspopup="true" aria-controls="sm-16111720102752585-68" aria-expanded="false"><span>Coming Soon</span><span class="sub-arrow"></span></a>
                  <ul class="sidebar-submenu" id="sm-16111720102752585-68" role="group" aria-hidden="true" aria-labelledby="sm-16111720102752585-67" aria-expanded="false">
                    <li><a href="comingsoon.html">Coming Simple</a></li>
                    <li><a href="comingsoon-bg-img.html">Coming with Bg Image </a></li>
                    <li><a href="comingsoon-bg-video.html">Coming with Bg video</a></li>
                  </ul>
                </li>
                <li><a class="sidebar-header" href="maintenance.html"><span> Maintenance</span></a></li>
              </ul>
            </li> --}}
          </ul>
        </nav>
      </div>
      <!-- vertical menu ends-->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Right sidebar Start-->
        <div class="right-sidebar" id="right_side_bar">
          <div>
            <div class="container p-0">
              <div class="modal-header p-l-20 p-r-20">
                <div class="col-sm-8 p-0">
                  <h6 class="modal-title font-weight-bold">Contacts Status</h6>
                </div>
                <div class="col-sm-4 text-right p-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></div>
              </div>
            </div>
            <div class="friend-list-search mt-0">
              <input type="text" placeholder="search friend"><i class="fa fa-search"></i>
            </div>
            <div class="p-l-30 p-r-30">
              <div class="chat-box">
                <div class="people-list friend-list">
                  <ul class="list">
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/1.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Vincent Porter</div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/2.jpg" alt="">
                      <div class="status-circle away"></div>
                      <div class="about">
                        <div class="name">Ain Chavez</div>
                        <div class="status"> 28 minutes ago</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/8.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Kori Thomas</div>
                        <div class="status"> Online</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/4.jpg" alt="">
                      <div class="status-circle online"></div>
                      <div class="about">
                        <div class="name">Erica Hughes</div>
                        <div class="status"> Online</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/5.jpg" alt="">
                      <div class="status-circle offline"></div>
                      <div class="about">
                        <div class="name">Ginger Johnston</div>
                        <div class="status"> 2 minutes ago</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/6.jpg" alt="">
                      <div class="status-circle away"></div>
                      <div class="about">
                        <div class="name">Prasanth Anand</div>
                        <div class="status"> 2 hour ago</div>
                      </div>
                    </li>
                    <li class="clearfix"><img class="rounded-small user-image" src="./../assets/images/user/7.jpg" alt="">
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
        <!-- Right sidebar Ends-->
      @yield('section')
      </div>
      @else
      <div class="alert alert-danger dark" role="alert" style="    text-align: center;
    margin-top: 100px;">
                      <p>
                        <?php 
                        if(Auth::user()->status == 0){
                          echo "Please Verify Your Account";
                        }else{
                          echo "Your Account is Under Verification, Please Wait!";
                        }

                        ?>
                      </p>

      </div>
      @endif
                    </div>

    <script src="/assets/app-assets/js/jquery-3.5.1.min.js"></script>
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
    <script src="/assets/app-assets/js/vertical-menu.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/assets/app-assets/js/script.js"></script>
    <script src="/assets/app-assets/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>

    
  </body>
</html>