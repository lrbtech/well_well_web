<!DOCTYPE html>
  @if(Auth::user()->lang == 'english')
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
  @if(Auth::user()->lang == 'english')
  <body main-theme-layout="ltr">
  @else
  <body main-theme-layout="rtl">
  @endif
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
              <!-- <li>
              <form class="form-inline search-form" action="/user/shipment-track" method="POST">
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
              </li> -->

               <li>
                  <div class="form-group">
                    <div class="Typeahead Typeahead--twitterUsers">
                      <div class="u-posRelative">
                        <select style="top:10px !important;width:70px !important;" class="form-control" id="language" name="language">
                        <option value="english" <?php if(Auth::user()->lang == 'english') { ?> selected="selected"<?php } ?>>En</option>
                        <option value="arabic" <?php if(Auth::user()->lang == 'arabic') { ?> selected="selected"<?php } ?>>Ar</option>
                        </select>
                      </div>
                      <div class="Typeahead-menu"></div>
                    </div>
                  </div>
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

              <li class="onhover-dropdown"> 
                <span class="media user-header">
                @if(Auth::user()->profile_image != '')
                 {{-- <i data-feather="settings"> </i></li> --}}
                  <img style="width:50px !important;" class="img-fluid" src="/upload_files/{{Auth::user()->profile_image}}" alt="">
                @else 
                 {{-- <i data-feather="settings"> </i></li> --}}
                  <img class="img-fluid" src="/assets/app-assets/images/dashboard/user.png" alt="">
                @endif
                </span>
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
          <ul class="sm pixelstrap custom-scrollbar" id="main-menu">
            <li>
              <div class="text-right mobile-back">Back<i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
            </li>
            
            <li class="dashboard">
              <a class="sidebar-header dashboard" href="/user/dashboard">
                <i data-feather="home"></i>
                <span> Dashboard</span>
              </a>
            </li>

            <li class="new-shipment">
              <a class="sidebar-header new-shipment" href="/user/new-shipment">
              <i data-feather="folder-plus"></i>
              <span> New Shipment</span>
              </a>
            </li>

            <li class="new-shipment">
              <a class="sidebar-header pending-shipment" href="/user/pending-shipment">
              <i data-feather="folder-plus"></i>
              <span> Pending Shipment</span>
              </a>
            </li>

            <li class="shipment">
              <a class="sidebar-header shipment" href="/user/shipment">
              <i data-feather="eye"></i>
              <span> View Shipment</span>
              </a>
            </li>
            
            <li class="profile">
              <a class="sidebar-header profile" href="/user/edit-profile">
              <i data-feather="settings"></i>
              <span> Profile</span>
              </a>
            </li>

            <li><a href="#" class="has-submenu" id="sm-1614352107947391-7" aria-haspopup="true" aria-controls="sm-1614352107947391-8" aria-expanded="false"> Report<span class="sub-arrow"></span></a>
              <ul id="sm-1614352107947391-8" role="group" aria-hidden="true" aria-labelledby="sm-1614352107947391-7" aria-expanded="false" class="sm-nowrap" style="width: auto; min-width: 10em; display: none; max-width: 20em; top: auto; left: 0px; margin-left: 0px; margin-top: 0px;">
                <li><a href="/user/shipment-report">Shipment Report</a></li>
                <li><a href="/user/revenue-report">Payment Report</a></li>
                <li><a href="/user/payments-in-report">Payments In Report</a></li>
                <li><a href="/user/settlement-details">Settlement Deatils</a></li>
                <li><a href="/user/invoice-history">Invoice History</a></li>
              </ul>
            </li>

            <li class="location-download">
              <a class="sidebar-header location-download" href="/user/excel-location-download">
              <i data-feather="settings"></i>
              <span> Location Download</span>
              </a>
            </li>

            <li class="location-download">
              <a target="_blank" class="sidebar-header location-download" href="/pdfview/api_integration.pdf">
              <i data-feather="eye"></i>
              <span> Api Integration</span>
              </a>
            </li>

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
      <div class="alert alert-danger dark" role="alert" style="text-align: center; margin-top: 100px;">
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
    <!-- <script src="/assets/app-assets/js/theme-customizer/customizer.js"></script> -->
    <script src="/assets/app-assets/js/jquery.drilldown.js"></script>
    <script src="/assets/app-assets/js/vertical-menu.js"></script>
    <script src="/assets/app-assets/js/megamenu.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
    <script src="{{ asset('assets/toastr/toastr.min.js')}}" type="text/javascript"></script>

    <script>
  $('#language').change(function(){
    var language = $('#language').val();
    $.ajax({
      url : '/user/change-language/'+language,
      type: "GET",
      success: function(data)
      {
          location.reload();
      }
    });
  });
    </script>
    
  </body>
</html>