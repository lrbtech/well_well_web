
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Well-Well</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <!-- <link href="/assets/website/css.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="/assets/website/bootstrap.css">
    <link rel="stylesheet" href="/assets/website/aos.css">
    <link rel="stylesheet" href="/assets/website/style.css">
    <style>

    </style>
</head>


<body class="body_rtl" data-spy="scroll" data-target=".site-navbar-target" data-offset="300" data-aos-easing="slide" data-aos-duration="800" data-aos-delay="0">

    <div class="site-wrap" id="home-section">
        <nav class="header__nav nav-bar sidebar_toggle">
            <div class="toggle-menu">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="#home-section" class="nav-link active">الرئيسية</a></li>
                <li><a href="#about-section" class="nav-link">من نحن</a></li>
                <li><a href="/track/1" class="nav-link">تتبع الطلب</a></li>
                <li><a href="/ar-ship-now" class="nav-link">الشحن</a></li>

                <li><a href="#service-solution" class="nav-link">الحلول والخدمات</a></li>
                <li><a href="#service-advance" class="nav-link">المساعدة والدعم</a></li>
                <li><a href="#contact" class="nav-link">اتصل بنا</a></li>

                <li><a href="/login" class="nav-link">تسجيل الدخول</a></li>
                <li><a href="/register" class="nav-link">تسجيل</a></li>

                <li><a href="/home" class="nav-link">English</a></li>
            </ul>
        </nav> 
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
                                    <li><a href="#home-section" class="nav-link active">الرئيسية</a></li>
                                    <li><a href="#about-section" class="nav-link">من نحن</a></li>
                                    <li><a href="/track/1" class="nav-link">تتبع الطلب</a></li>
                                    <li><a href="/ar-ship-now" class="nav-link">الشحن</a></li>

                                    <li><a href="#service-solution" class="nav-link">الحلول والخدمات</a></li>
                                    <li><a href="#service-advance" class="nav-link">المساعدة والدعم</a></li>
                                    <li><a href="#contact" class="nav-link">اتصل بنا</a></li>

                                    <li><a href="/login" class="nav-link">تسجيل الدخول
                                    </a></li>
                                    <li><a href="/register" class="nav-link">تسجيل</a></li>

                                    <li><a href="/home" class="nav-link">English</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-white"><span
                                    class="icon-menu h3"></span></a></div>
                    </div>
                </div>
            </header>
        </div>


        <div class="slider-area ">
            <div class="slider-active slick-initialized slick-slider">

                <div class="slick-list draggable">
                    <div class="slick-track" style="opacity: 1; width: 1349px;">
                        <div class="single-slider slider-height d-flex align-items-center slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 1349px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                            <video src="/assets/app-assets/video/auth-bg.mp4" autoplay loop playsinline muted></video>
                            <div class="video_overlay"></div>
                            <div class="container banner_content">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-9 aos-init" data-aos="fade-left" data-aos-delay="">
                                        <div class="hero__caption">
                                            {{-- <h1>آمنة &amp; موثوق <span>جمارك</span> حلول!</h1> --}}
                                            <h1>حلول لوجستية آمنة وموثوقة </h1>
                                        </div>

                                        <form action="#" class="search-box">
                                            <div class="input-form">
                                                <input autocomplete="off" name="track_id" id="track_id" type="text" placeholder="Your Tracking ID" tabindex="0">
                                            </div>
                                            <div class="search-form">
                                                <a onclick="Tracking()" href="#" tabindex="0">تتبع الشحنة</a>
                                            </div>
                                        </form>

                                        <div class="hero-pera">
                                            <p>الاستعلام عن حالة الشحنة.</p>
                                            {{-- <p>الاستعلام عن حالة الشحنة.</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- <div class="slider-area ">
            <div class="slider-active slick-initialized slick-slider">

                <div class="slick-list draggable">
                    <div class="slick-track" style="opacity: 1; width: 1349px;">
                        <div class="single-slider slider-height d-flex align-items-center slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="0" style="width: 1349px; position: relative; left: 0px; top: 0px; z-index: 999; opacity: 1;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-9 aos-init" data-aos="fade-left" data-aos-delay="">
                                        <div class="hero__caption">
                                            <h1>آمنة &amp; موثوق <span>جمارك</span> حلول!</h1>
                                        </div>

                                        <form action="#" class="search-box">
                                            <div class="input-form">
                                                <input autocomplete="off" name="track_id" id="track_id" type="text" placeholder="معرف التتبع الخاص بك" tabindex="0">
                                            </div>
                                            <div class="search-form">
                                                <a onclick="Tracking()" href="#" tabindex="0">المسار &amp;
                                                    أثر</a>
                                            </div>
                                        </form>

                                        <div class="hero-pera">
                                            <p>للاستعلام عن حالة الطلب</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="categories-area" id="service-advance">
            <div class="site-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="section-tittle text-center mb-50">
                                <span>مــــــــــا</span>
                                <h2>يميزنا عن الآخرين</h2>
                                {{-- <span>ميزة الخدمات</span>
                                <h2>بماذا نحن متميزون؟</h2> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 aos-init" data-aos="fade-right" data-aos-delay="">
                            <div class="single-cat text-center mb-50">
                                <div class="cat-icon mb-4">
                                    <img src="/web_site_image/24-7.png" title="" alt="" class="" height="50px">
                                </div>
                                <div class="cat-cap">
                                    <h5>
                                        الاستجابة المستمرة خلال 24/7</h5>
                                    {{-- <p>خدمة عملاء على مدار الساعة / طوال الأسبوع

                                        فريق خدمة العملاء لدينا متوفر على مدار الساعة، طوال أيام الأسبوع لتلبية احتياجاتك </p> --}}
                                        <p>فريق خدمة العملاء لدينا متوفر على مدار الساعة، طوال أيام الأسبوع لتلبية احتياجاتك والإجابة على أي استفسارات وتقديم الدعم الفني واللوجستي في أي وقت تحتاج فيه للمساعدة.
</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-cat text-center mb-50">
                                <div class="cat-icon mb-4">
                                    <img src="/web_site_image/email-clipart.png" title="" alt="" class="" height="50px">
                                </div>
                                <div class="cat-cap">
                                    <h5>
                                        التسليم في الوقت المحدد</h5>
                                    {{-- <p>لقد آخذنا على عاتقنا مسؤولية تسليم الشحنات الخاصة بك في الوقت المحدد وذلك من خلال موظفينا المحترفين وأسطول التوصيل الخاص بنا، هذا بالإضافة إلى استخدام أحدث التقنيات 
                                        في عالم التوصيل والشحن.</p> --}}
                                        <p>لقد آخذنا على عاتقنا مسؤولية تسليم الشحنات الخاصة بك في الوقت المحدد وذلك من خلال موظفينا المحترفين وأسطول التوصيل الخاص بنا، بالإضافة إلى استخدام أحدث التقنيات في عالم التوصيل والشحن.
</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 aos-init" data-aos="fade-left" data-aos-delay="">
                            <div class="single-cat text-center mb-50">
                                <div class="cat-icon mb-4">
                                    <img src="/web_site_image/world.png" title="" alt="" class="" height="50px">
                                </div>
                                <div class="cat-cap">
                                    <h5>ميزة “Well protect”</h5>
                                    {{-- <p>تشعر بالقلق بشأن فقد أو تلف الطرود والشحنات؟ ، مع خدمة
                                        "Well Protect" من ول ول اكسبرس، لن يعود هناك داعي للقلق مرة أخرى حيث تستطيع شحن طرودك بسهولة وراحة بال، ونحن نقوم بحمايتها من التلف والضياع.</p> --}}
                                <p>تشعر بالقلق بشأن فقد أو تلف الطرود والشحنات؟ ، مع خدمة "Well Protect" من ول ول اكسبرس، لن يعود هناك داعي للقلق مرة أخرى حيث تستطيع شحن طرودك بسهولة وراحة بال، ونحن نقوم بحمايتها من التلف والضياع.
</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="about-low-area" id="about-section">
            <div class="site-section" style="background-color: #ececec;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 aos-init" data-aos="fade-right" data-aos-delay="">
                            <div class="about-img ">
                                <div class="about-font-img">
                                    <img src="/web_site_image/home-page-image-1 (1).png" alt="">
                                </div>
                                <div class="about-back-img d-none d-lg-block">
                                    <img src="/web_site_image/home-page-image-1 (1).png" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 aos-init" data-aos="fade-left" data-aos-delay="">
                            <div class="about-caption mb-50">

                                <div class="section-tittle mb-35">
                                    <span>من نحن</span>
                                    <h2>نؤمن أن نجاح عملائنا هو سر نجاحنا</h2>
                                </div>
                                <p>نؤمن أن نجاح عملائنا هو سر نجاحنا</p>
                                <p>تهدف شركة ويل ويل للشحن إلى تقديم مجموعة متنوعة ومرنة من الحلول الخدمية، التي نلبي من خلالها كافة الاحتياجات في مجالات الشحن الداخلي والدولي والخدمات اللوجستية. هذا بالإضافة إلى دعم عملائنا في تحسين مستوى النمو التجاري والتوسع بأعمالهم، وذلك من 
                                    خلال فريق عملنا المختص والمدرب لتولي جميع المتطلبات الشحن.</p>
                                <p style="text-align: justify;">أما بالنسبة لعملائنا الذين لا يملكوأما بالنسبة لعملائنا الذين لا يملكون حسابًا في WELL WELL Express ، الحلول المصممة خصيصًا لتلبية متطلباتهم في كل من الشحن المحلي والدولي.
                                </p>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="service-area " id="service-solution">
            <div class="site-section">
                <div class="container">
                    <div class="section-tittle text-center mb-50">
                        <span>خدماتنا</span>
                        <h2>ماذا نقدم لكم؟</h2>
                    </div>

                    <div class="swiper-container home-blog-area aos-init" data-aos="fade-up" data-aos-delay="">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="home-blog-single">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="/web_site_image/4-1.png" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-caption">
                                        <h4>خدمة WELLDOM</h4>
                                        <p mb-0>مجموعة متكاملة من حلول الشحن المحلية.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="home-blog-single">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="/web_site_image/5.png" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-caption">
                                        <h4>خدمة WELLLINK</h4>
                                        <p mb-0>مجموعة متكاملة من حلول الشحن الدولي.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="home-blog-single">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="/web_site_image/6.png" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-caption">
                                        <h4>خدمة WELLPREMIUM</h4>
                                        <p mb-0>بناء الحلول وفقا لاحتياجات العملاء.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="home-blog-single">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="/web_site_image/4-1.png" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-caption">
                                        <h4>خدمة WELLDOM</h4>
                                        <p mb-0>مصممة لمجموعة كاملة من حلول الشحن المحلية</p>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="home-blog-single">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="/web_site_image/5.png" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-caption">
                                        <h4>خدمة WELLLINK</h4>
                                        <p mb-0>مصممة لمجموعة كاملة من حلول الشحن الدولي.</p>

                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="home-blog-single">
                                    <div class="blog-img-cap">
                                        <div class="blog-img">
                                            <img src="/web_site_image/6.png" alt="">
                                        </div>
                                    </div>
                                    <div class="blog-caption">
                                        <h4>خدمة WELLPREMIUM</h4>
                                        <p mb-0>بناء الحلول وفقا لاحتياجات العملاء.</p>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="contactus-area " id="contact">
        <div class="site-section">
            <div class="container">
                <div class="section-tittle text-center mb-50">
                    <span>اتصل بنا</span>
                    <h2>ابقى على تواصل</h2>
                </div>
                <div class="row">
                    <div class="col-lg-5 col-md-12 aos-init" data-aos="fade-right" data-aos-delay="">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3630.4100054347887!2d54.3736304149479!3d24.505891284222432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e67557dedff27%3A0x63d3e4b36042bfea!2sSilver%20Wave%20Tower!5e0!3m2!1sen!2sin!4v1612256956595!5m2!1sen!2sin" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    <div class="col-lg-4 col-md-12 py-5 pt-lg-0 aos-init" data-aos="fade-left" data-aos-delay="">
                        <form class="form-contact contact_form" action="" method="post" id="contactForm" novalidate="novalidate">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder=" أدخل رسالة"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="name" id="name" type="text" placeholder="أدخل أسمك">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control valid" name="email" id="email" type="email" placeholder="البريد الإلكتروني">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="subject" id="subject" type="text" placeholder="أدخل الموضوع">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">إرسال</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-12 our-info-area bg-transparent" data-aos="fade-left" data-aos-delay="">
                        <div class="single-info mb-4">
                            <div class="info-icon">
                                <img src="/assets/website/call.png" height="25" width="25" alt="">
                            </div>
                            <div class="info-caption">
                                {{-- <p>اتصل بنا</p> --}}
                                <span dir="ltr">+02 444 2254 </span>
  
                                {{-- <span><img src="/assets/images/whatsapp.png" width="20px">+05 044 24579 </span> --}}
                                {{-- <span> <img src="/assets/images/whatsapp.png" width="20px"></span> --}}
                            </div>
                        </div>
                        <div class="single-info mb-4">
                            <div class="info-icon">
                                <img src="/assets/images/whatsapp.png" height="25" width="25" alt="">
                            </div>
                            <div class="info-caption">
                    
  
                                <span dir="ltr">+05 044 24579 </span>
                                {{-- <span> <img src="/assets/images/whatsapp.png" width="20px"></span> --}}
                            </div>
                        </div>
                        <div class="single-info mb-4">
                            <div class="info-icon">
                                <img src="/assets/website/clock.png" height="35" width="35" alt="">
                            </div>
                            <div class="info-caption">
                                {{-- <p>ساعات العمل</p> --}}
                                <span>السبت - الخميس 8 صباحا حتى 6 مساءا</span>
                            </div>
                        </div>
                        <div class="single-info">
                            <div class="info-icon">
                                <img src="/assets/website/location.png" height="30" width="30" alt="">
                            </div>
                            <div class="info-caption">
                               	{{-- الموقع --}}
                                   <span>برج سيلفر ويف ، مدينة أبوظبي</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <footer class="site-footer">
        <div class="container">
            <div class="row">


                <div class="col-md-5">
                    <div class="w-75">
                        <img loading="lazy" class="mb-4" src="assets/images/white-logo-wellwell.png" alt="" width="98" height="94">

                        <p>نؤمن أن نجاح عملائنا هو سر نجاحنا
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <h2 class="footer-heading mb-4">روابط مفيدة</h2>
                    <ul class="list-unstyled">
                          
                        <li><a href="#home-section">الرئيسية</a></li>
                        <li><a href="#about-section">من نحن</a></li>
                        <li><a href="#service-solution">خدماتنا</a></li>
                        <li><a href="#contact">اتصل بنا </a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h2 class="footer-heading mb-4">اتصل بنا</h2>
                    <ul class="list-unstyled">
                        <li><a href="#">
                            برج سيلفر ويف ، مدينة أبوظبي</a></li>
                        <li><a href="#" dir="ltr">+02 444 2254</a></li>
                        <li><a href="#" dir="ltr">+971 5044 24579 <img src="/assets/images/whatsapp.png" width="20px"></a></li>
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

                                Copyright 2021 © <strong>WellWell</strong><br> Crafted With <img src="/assets/images/heart.png" width="30px"> <a href="https://lrbinfotech.com" target="_blank">LRB INFOTECH</a>

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

    <!-- Initialize Swiper -->
    <script>
function Tracking(){
    var track_id = $('#track_id').val();
    if(track_id != ""){
        window.location.href="/track/"+track_id;
    }
}
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                767: {
                    slidesPerView: 3,
                },
                600: {
                    slidesPerView: 2,
                },
                320: {
                    slidesPerView: 1,
                },
            }
        });
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
    <script>
        var toggleButton = document.querySelector('.toggle-menu');
        var navBar = document.querySelector('.nav-bar');
        toggleButton.addEventListener('click', function() {
            navBar.classList.toggle('toggle');
        });
    </script>
    
</body>

</html>