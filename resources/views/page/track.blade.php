<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Well-Well</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link href="/assets/website/css.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/website/bootstrap.css">
    <link rel="stylesheet" href="/assets/website/aos.css">
    <link rel="stylesheet" href="/assets/website/style.css">
</head>


<body>

    <div class="site-wrap" id="home-section">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>

        </div>

        <div id="sticky-wrapper" class="sticky-wrapper" style="height: 74.7px;">
            <header class="site-navbar js-sticky-header site-navbar-target" role="banner" style="">
                <div class="container">
                    <div class="row align-items-center position-relative">
                        <div class="site-logo">
                            <img width="115" height="70" src="/assets/images/logo.png" class="header_logo header-logo" alt="wellwell">
                            <h4><strong>WELL-WELL</strong></h4>
                        </div>
                        <div class="col-12">
                            <nav class="site-navigation text-right ml-auto " role="navigation">
                                <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                                    <li><a href="/home/#home-section" class="nav-link">Home</a></li>
                                    <li><a href="/home/#about-section" class="nav-link">About Us</a></li>
                                    <li><a href="track/1" class="nav-link active">Track</a></li>
                                    <li><a href="/ship-now" class="nav-link">Ship</a></li>

                                    <li><a href="/home/#service-solution" class="nav-link">Solution & Services</a></li>
                                    <li><a href="/home/#service-advance" class="nav-link">Help & Support</a></li>
                                    <li><a href="/home/#contact" class="nav-link">Contact Us</a></li>
                                    <li><a href="/login" class="nav-link">Login</a></li>
                                    <li><a href="/register" class="nav-link">Register</a></li>
                                    <li><a href="/home-arabic" class="nav-link">العربية</a></li>
                                    <!-- <li><a href="#" class="nav-link" onclick='changeToRTL()'>العربية</a></li> -->
                                </ul>
                            </nav>
                        </div>
                        <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-white"><span
                                    class="icon-menu h3"></span></a></div>
                    </div>
                </div>
            </header>
        </div>
        <div class="slider-area track_banner">
            <div class="slider-active slick-initialized slick-slider">

                <div class="slick-list draggable">
                    <div class="slick-track" style="opacity: 1; width: 1349px;">
                        <div class="single-slider slider-height d-flex align-items-center slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 1349px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-9 ">
                                        <form action="#" class="search-box">
                                            <div class="input-form">
                                                <input autocomplete="off" name="track_id" id="track_id" type="text" placeholder="Your Tracking ID" tabindex="0">
                                            </div>
                                            <div class="search-form">
                                                <a onclick="Tracking()" href="#" tabindex="0">Track &amp;
                                                    Trace</a>
                                            </div>
                                        </form>

                                        <div class="hero-pera">
                                            <p>For order status inquiry</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="track_page">
            @if(!empty($shipment))
            <h5 class="text-center"> #{{$id}}</h5>
            <!-- <div class="warning_box">
                <div class="d-flex">
                    <div>
                        <img class="img-fluid mr-3" src="/assets/website/exclamation-mark.png" height="20px" width="23px">
                    </div>
                    <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                </div>
            </div> -->

            <div class="w-100 w-md-50 mx-auto">
                <h3 class="text-center">
                    <!-- Scheduled delivery: <br> -->
                    @if($shipment->status == 0)
                        <span>Shipment Created</span>
                    @elseif($shipment->status == 1)
                        <span>Schedule for Pickup</span>
                    @elseif($shipment->status == 2)
                        <span>Packaege Collected</span>
                    @elseif($shipment->status == 3)
                        <span>Pickup Exception</span>
                    @elseif($shipment->status == 4)
                        <span>Transit In <b>{{$from_station->station}}</b></span>
                    @elseif($shipment->status == 6)
                        <span>Transit Out <b>{{$from_station->station}}</b></span>
                    @elseif($shipment->status == 11)
                        <span>Transit In <b>{{$to_station->station}}</b></span>
                    @elseif($shipment->status == 12)
                        <span>Transit Out <b>{{$to_station->station}}</b></span>
                    @elseif($shipment->status == 7)
                        <span>In the Van for Delivery</span>
                    @elseif($shipment->status == 8)
                        <span>Shipment Delivered</span>
                    @endif
                </h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form id="delivery_status">

                        <ul id="progressbar">
                        @if($shipment->status == 0)
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        @elseif($shipment->status == 2)
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                        @elseif($shipment->status >= 4 && $shipment->status < 8)
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                        @elseif($shipment->status == 8)
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                        @endif
                            
                        </ul>

                        <fieldset>
                            <h6 class="fs-subtitle">
                                @if($shipment->shipment_mode == 1)
                                <strong>STANDARD</strong>
                                @else 
                                <strong>EXPRESS</strong>
                                @endif
                             </h6>
                            <!-- <h5 class="">WINSTON SALEM, NC</h5> -->
                        <!-- </fieldset>
                        <fieldset>
                            <h3 class="fs-subtitle">Tell us something more about you</h3>
                        </fieldset>
                        <fieldset>
                            <h3 class="fs-subtitle">Tell us something more about you</h3>
                        </fieldset>
                        <fieldset>
                            <h3>sucuss</h3>
                        </fieldset> -->

                    </form>
                </div>
            </div>

            <div class="w-100 w-md-50 mx-auto">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6><strong>From:</strong></h6>
                        <p>@foreach($area as $area1)
                        @if($area1->id == $from_address->area_id)
                        {{$area1->city}}
                        @endif
                        @endforeach</p>
                        <p>@foreach($city as $city1)
                        @if($city1->id == $from_address->city_id)
                        {{$city1->city}}
                        @endif
                        @endforeach</p>
                    </div>
                    <div class="">
                        <h6><strong>To:</strong></h6>
                        <p>@foreach($area as $area1)
                        @if($area1->id == $to_address->area_id)
                        {{$area1->city}}
                        @endif
                        @endforeach</p>
                        <p>@foreach($city as $city1)
                        @if($city1->id == $to_address->city_id)
                        {{$city1->city}}
                        @endif
                        @endforeach</p>
                    </div>
                </div>
            </div>

            <!-- <div class="text-center mb-5">
                <h5 class="">Delivery options</h5>
                <p>This shipments delivery has been customized by the Recipient</p>
            </div> -->


            
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Status history</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Shipment Details</a>
                </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="mb-4">
                        <!-- <p class="track_date">Friday, July 10, 2021</p> -->
                        <table class="table">

                            <tbody>
                                @if($shipment->status >= 9 && $shipment->status < 11)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->delivery_exception_assign_date))}} {{date('H:m a',strtotime($shipment->delivery_exception_assign_time))}}</td>
                                    <td>
                                    {{$shipment->delivery_eception_category}}<br>
                                    {{$shipment->delivery_eception_remark}}
                                    </td>
                                </tr>
                                @endif
                                @if($shipment->status >= 8 && $shipment->status < 11)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->delivery_date))}} {{date('H:m a',strtotime($shipment->delivery_time))}}</td>
                                    <td>Shipment Delivered</td>
                                </tr>
                                @endif
                                @if($shipment->status >= 7 && $shipment->status < 11)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->van_scan_date))}} {{date('H:m a',strtotime($shipment->van_scan_time))}}</td>
                                    <td>In the Van for Delivery <b>{{$to_station->station}}</b></td>
                                </tr>
                                @endif
                                @if(6 <= $shipment->status && 12 >= $shipment->status)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->transit_out_date))}} {{date('H:m a',strtotime($shipment->transit_out_time))}}</td>
                                    <td>Transit Out <b>{{$to_station->station}}</b></td>
                                </tr>
                                @endif
                                @if(6 <= $shipment->status && 11 >= $shipment->status)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->transit_in_date))}} {{date('H:m a',strtotime($shipment->transit_in_time))}}</td>
                                    <td>Transit In <b>{{$to_station->station}}</b></td>
                                </tr>
                                @endif
                                @if($shipment->status >= 6)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->transit_out_date))}} {{date('H:m a',strtotime($shipment->transit_out_time))}}</td>
                                    <td>Transit Out <b>{{$from_station->station}}</b></td>
                                </tr>
                                @endif
                                @if($shipment->status >= 4)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->transit_in_date))}} {{date('H:m a',strtotime($shipment->transit_in_time))}}</td>
                                    <td>Transit In <b>{{$from_station->station}}</b></td>
                                </tr>
                                @endif
                                @if($shipment->status == 3)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->exception_assign_date))}} {{date('H:m a',strtotime($shipment->exception_assign_time))}}</td>
                                    <td>
                                    {{$shipment->eception_category}}<br>
                                    {{$shipment->eception_remark}}
                                    </td>
                                </tr>
                                @endif
                                @if($shipment->status >= 2)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->package_collect_date))}} {{date('H:m a',strtotime($shipment->package_collect_time))}}</td>
                                    <td>Packaege Collected</td>
                                </tr>
                                @endif
                                @if($shipment->status > 1)
                                <tr>
                                    <td>{{date('d-m-Y',strtotime($shipment->pickup_assign_date))}} {{date('H:m a',strtotime($shipment->pickup_assign_time))}}</td>
                                    <td>Schedule for Pickup</td>
                                </tr>
                                @endif
                                @if($shipment->status > 0)
                                <tr>
                                    <td>{{date('d-m-Y H:m a',strtotime($shipment->created_at))}}</td>
                                    <td>Shipment Created</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <table style="color: #000 !important;" class="table">
                          <thead>
                            <tr>
                                <th>Category</th>
                                <th>Info</th>
                                <th>Chargeable Weight</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($shipment_package as $row)
                            <tr>
                              <th scope="row">
                              @foreach($package_category as $cat)
                              @if($cat->id == $row->category)
                              {{$cat->category}}
                              @endif
                              @endforeach
                              </th>
                              <td>{{$row->description}}<br>
                                <b>Weight:</b> {{$row->weight}} kg<br>
                                <b>Dimensions:</b> {{$row->length}} cm x {{$row->width}} cm x {{$row->height}} cm
                              </td>
                              <td>{{$row->chargeable_weight}} Kg</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                </div>

            </div>
            </div>
            <div class="col-md-2"></div>
            </div>


            <div class="travel box">

            </div>
            <div class="shipment box">

            </div>
            @else 
            <div class="warning_box">
                <div class="d-flex">
                    <div>
                        <img class="img-fluid mr-3" src="/assets/website/exclamation-mark.png" height="20px" width="23px">
                    </div>
                    <p class="mb-0">No Data!</p>
                </div>
            </div>

            @endif
        </div>
    </div>
    <footer class="site-footer">
        <div class="container">
            <div class="row">


                <div class="col-md-5">
                    <div class="w-75">
                        <img loading="lazy" class="mb-4" src="https://wellwell.ae/wp-content/uploads/2021/01/white-logo-wellwell.png" alt="" width="98" height="94">

                        <p>We believe that our customer’s success is our secret to success
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <h2 class="footer-heading mb-4">USEFUL LINK</h2>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Contact </a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2 class="footer-heading mb-4">CONTACT US</h2>
                    <ul class="list-unstyled">
                        <li><a href="#">
                                Silver Wave Tower, Abu Dhabi City</a></li>
                        <li><a href="#">+971 56 994 9409</a></li>
                        <li><a href="#">info@wellwell.ae</a></li>

                    </ul>

                    <!-- <h2 class="footer-heading mb-4">Follow Us</h2>
                            <a href="#about-section" class="smoothscroll pl-0 pr-3"><span class="icon-facebook"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                            <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a> -->

                </div>



            </div>
            <div class="row text-center">
                <div class="col-md-12">
                    <div class="border-top pt-3">
                        <p class="copyright mb-0"><small>

                                Copyright 2021 © <strong>WellWell</strong>

                            </small></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
        <img src="/assets/website/up_arrow.png" class="" alt="" style="
        width: 23px;
        padding-top: 14px;
    "></a>

    <script src="/assets/website/jquery-3.js"></script>
    <script src="/assets/website/popper.js"></script>
    <script src="/assets/website/bootstrap.js"></script>
    <script src="/assets/website/owl.js"></script>
    <script src="/assets/website/jquery.js"></script>
    <script src="/assets/website/jquery_005.js"></script>
    <script src="/assets/website/jquery_004.js"></script>
    <script src="/assets/website/jquery_002.js"></script>
    <script src="/assets/website/jquery_003.js"></script>
    <script src="/assets/website/aos.js"></script>
    <script src="/assets/website/main.js"></script>

    <script async="" src="/assets/website/js"></script>
    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.4/swiper-bundle.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.4/swiper-bundle.min.js"></script>
    <script>

function Tracking(){
    var track_id = $('#track_id').val();
    if(track_id != ""){
        window.location.href="/track/"+track_id;
    }
}
        var current_fs, next_fs, previous_fs;
        var left, opacity, scale;
        var animating;

        $(".next").click(function() {
            if (animating) return false;
            animating = true;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();


            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            next_fs.show();

            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    scale = 1 - (1 - now) * 0.2;
                    left = (now * 50) + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },

                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function() {
            if (animating) return false;
            animating = true;
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");


            previous_fs.show();

            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {

                    scale = 0.8 + (1 - now) * 0.2;
                    left = ((1 - now) * 50) + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },

                easing: 'easeInOutBack'
            });
        });

        $(".submit").click(function() {
            return false;
        })
    </script>
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });
            // scroll body to 0px on click
            $('#back-to-top').click(function() {
                $('body,html').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        });
    </script>

</body>

</html>