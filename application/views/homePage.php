<!DOCTYPE html>
<html>

<head>
    <title><?php echo $page_title ; ?></title>
    <meta charset="utf-8" />
    <!-- Page Loader - Needs to be placed in header for loading at top of all content -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/pace.min.js"></script>
    <link href="<?php echo base_url(); ?>/asset/css/pace-loading-bar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asset/css/animate.shipping.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asset/css/ShippingIcon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asset/css/bootstrap.css">
    <!--Owl-->
    <link href="<?php echo base_url(); ?>/asset/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/asset/css/owl.theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/asset/css/owl.transitions.css" rel="stylesheet">
    <!-- Main Style -->
    <link rel="stylesheet" id="main-style" type="text/css" href="<?php echo base_url(); ?>/asset/css/style.css">
</head>

<body class="blue page-loading">
    <!-- Section Start - Header -->
    <section class='header' id='header'>
        <!-- Header Top Bar - Start -->
        <div class="topbar-wrap">
            <div class="container">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 logo-area">
                    <div class="logo">
                        <div>
                            <!-- <i class="icon icon-logo white"></i> -->
                            <a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>/asset/img/logo.png" alt="TL Ecpress bd"/ style="height:55px; width:216px;"></a>
                        </div>
                        <!-- <span class="name">SHIPPING</span> -->
                        <!-- <span class="small">Logistics & Transport</span> -->
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 col-sm-7 col-xs-5 menu-area">
                    <!-- Menu Top Bar - Start -->
                    <div class="topbar">
                        <div class="menu">
                            <div class="primary inviewport animated delay2" data-effect="">
                                <div class='cssmenu dokume_menu'>
                                    <!-- Menu - Start -->
                                    <!-- <ul class='menu-ul'>
                                        <li class='has-sub'>
                                            <a href='<?php echo base_url(); ?>'>Home </a>
                                        </li>

                                        <li class='has-sub'>
                                            <a href='<?php echo base_url('home/about_us');?>'>About Us </a>

                                        </li>

                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
                           ?>
                                        <li class='has-sub'>
                                            <a href='<?php echo base_url('merchant/dashboard');?>'>Dashboard </a>

                                        </li>
                           <li class='has-sub'>
                                            <a href='<?php echo base_url('home/logout');?>'>Logout </a>

                                        </li>
                                    <?php
                                   }else{ ?>
                                        <li class='has-sub'>
                                            <a href='<?php echo base_url('home/track'); ?>'>Tracking </a>

                                        </li>
                                        <li class='has-sub'>
                                            <a href='<?php echo base_url('login'); ?>'>Login </a>

                                        </li>
                                        <?php
                                    }
                                    ?>
                                    </ul> -->
                                    <!-- Menu - End -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Menu Top Bar - End -->
                    <!-- Mobile Menu - Start -->
                    <div class="menu-mobile col-xs-10 pull-right cssmenu">
                        <i class="icon icon-menu menu-toggle"></i>
                        <ul class="menu" id='parallax-mobile-menu'>
                        </ul>
                    </div>
                    <!-- Mobile Menu - End -->
                </div>
            </div>
        </div>
        <!-- Header Top Bar - End -->
        <div class="header-bg ">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 slantbar hidden-xs"></div>
            <!-- Header Tracking Box - Start -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 white-wrap hidden-xs">
                <div class="white-box">
                    <div class="track-order">
                        <div class="track-logo transition">
                            <i class="icon icon-logo"></i>
                        </div>
                        <h3 class="box-heading">Track Your Order</h3>
                        <p class="box-tagline">ENTER YOUR TRACK ID FOR INSTANT SEARCH</p>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-0 col-xs-offset-0">
                            <form method='post' action="<?php echo base_url('home/track_order')?>" class="track-form">
                                <input type="text" name='track-input' placeholder="Track ID" required>
                                <button style="display:contents;" type='submit' class='btnSave'><i class="icon icon-magnify"></i></button>
                                <!-- <i class="icon icon-magnify"></i> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Tracking Box - End -->
            <!-- Header Content Slide - Start -->
            <div style="position:relative;display:inline-block;width:100%;height:auto;">
                <img src="<?php echo base_url(); ?>/asset/img/banner-1.jpg" alt="Header Image" class="img-responsive">
                <div class="bg-overlay"></div>
                <div class="main-wrap">
                    <div class="container">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 main-content">
                            <h1><?php echo $banner_title ; ?></h1>
                            <div class="play-area">
                                <div>
                                    <a class="fancybox-media" href="http://www.youtube.com/watch?v=1zclkA9PkFQ"><i class="icon icon-play"></i></a>
                                </div>
                                <span class="small">Watch Video</span>
                                <span class="title">Fast and Secure Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header Content Slide - End -->
            <!-- Header Social Icons - Start -->
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 social-wrap hidden-xs">
                <div class="social-box">
                    <div class="social-icons-wrap">
                        <a href="#"><i class="icon icon-facebook text-on-primary"></i></a>
                        <a href="#"><i class="icon icon-twitter text-on-primary"></i></a>
                        <a href="#"><i class="icon icon-google-plus text-on-primary"></i></a>
                    </div>
                </div>
            </div>
            <!-- Header Social Icons - End -->
        </div>
    </section>
    <!-- Section End - Header -->

    <!-- Section Start - Major Services -->
    <section class='major-services gray-boxes' id='major-services'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Major Services</h1>
                <div class="headul"></div>
                <p class="subheading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <!-- Service - Start -->
                <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 service inviewport animated delay1" data-effect="fadeInUp">
                    <div class="service-wrap">
                        <div class="pic">
                            <img alt="service-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/service-1.jpg">
                            <div class="info-layer transition">
                                <a class="btn btn-primary fancybox" title="Air Freight Service" data-fancybox-group="service-gallery" href="<?php echo base_url(); ?>/asset/img/service-1.jpg"><i class="icon icon-image-area"></i></a>
                            </div>
                            <div class="more">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                        <div class="info">
                            <h4 class="title">Air Freight</h4>
                            <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                        </div>
                    </div>
                </div>
                <!-- Service - End -->
                <!-- Service - Start -->
                <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 service inviewport animated delay2" data-effect="fadeInUp">
                    <div class="service-wrap">
                        <div class="pic">
                            <img alt="service-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/service-2.jpg">
                            <div class="info-layer transition">
                                <a class="btn btn-primary fancybox" title="Roadway Freight Service" data-fancybox-group="service-gallery" href="<?php echo base_url(); ?>/asset/img/service-2.jpg"><i class="icon icon-image-area"></i></a>
                            </div>
                            <div class="more">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                        <div class="info">
                            <h4 class="title">Roadway Freight</h4>
                            <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                        </div>
                    </div>
                </div>
                <!-- Service - End -->
                <!-- Service - Start -->
                <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 service inviewport animated delay3" data-effect="fadeInUp">
                    <div class="service-wrap">
                        <div class="pic">
                            <img alt="service-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/service-3.jpg">
                            <div class="info-layer transition">
                                <a class="btn btn-primary fancybox" title="Ocean Freight Service" data-fancybox-group="service-gallery" href="<?php echo base_url(); ?>/asset/img/service-3.jpg"><i class="icon icon-image-area"></i></a>
                            </div>
                            <div class="more">
                                <a href="#">Read More</a>
                            </div>
                        </div>
                        <div class="info">
                            <h4 class="title">Ocean Freight</h4>
                            <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                        </div>
                    </div>
                </div>
                <!-- Service - End -->
            </div>
        </div>
    </section>
    <!-- Section End - Major Services -->
    <!-- Section Start - Tracking App -->
    <section class='bg-lightgray' id='tracking-app-mobile'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Tracking App</h1>
                <div class="headul"></div>
                <p class="subheading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <div class="features-wrap">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="row">
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay1" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-air6"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Air Freight</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay2" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-boat17"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Ocean Freight</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 right-align feature inviewport animated delay3" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-delivery18"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Road Freight</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="app-phones">
                            <img src="<?php echo base_url(); ?>/asset/img/phone-white-blue.png" class="img-responsive phone-white style-dependent" alt="phone white">
                            <img src="<?php echo base_url(); ?>/asset/img/phone-black-blue.png" class="img-responsive phone-black style-dependent" alt="phone black">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="row">
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay1" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-packages2"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Warehousing</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay2" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-commercial15"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Contract Logistics</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                            <!-- Feature - Start -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left-align feature inviewport animated delay3" data-effect="fadeInUp">
                                <div class="icon-wrap">
                                    <i class="icon icon-delivery27"></i>
                                </div>
                                <div class="info">
                                    <h5 class="title">Consulting Services</h5>
                                    <p>We provide quality logistic and transport services.</p>
                                </div>
                            </div>
                            <!-- Feature - End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Tracking App -->
    <!-- Section Start - Worldwide Centres -->
    <section class='bg-black' id='worldwide'>
        <div class="container">
            <div class="row">
                <h1 class="heading text-white">Worldwide Centres</h1>
                <div class="headul"></div>
                <p class="subheading text-white">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <div class="worldwide col-md-12 col-xs-12">
                    <div class="map">
                        <img src="<?php echo base_url(); ?>/asset/img/map.png" class="img-responsive" alt="Map image">
                    </div>
                    <div class="map-locations inviewport animated delay2" data-effect="fadeIn">
                        <img src="<?php echo base_url(); ?>/asset/img/map-locations-blue.png" class="img-responsive style-dependent" alt="Map Locations">
                    </div>
                    <div class="map-connect inviewport animated delay6" data-effect="fadeIn">
                        <img src="<?php echo base_url(); ?>/asset/img/map-connect-blue.png" class="img-responsive style-dependent" alt="Map Connections">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Worldwide Centres -->
    <!-- Section Start - Company Updates -->
    <section id='company-updates'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Company Updates</h1>
                <div class="headul"></div>
                <p class="subheading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <div class="news-blocks">
                    <!-- Service - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 news_small inviewport animated delay1" data-effect="fadeInUp">
                        <div class="news-wrap row">
                            <div class="pic col-md-3 col-xs-3 col-sm-3 col-lg-3">
                                <img alt="news-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/news-1.jpg">
                            </div>
                            <div class="info col-md-9 col-xs-9 col-sm-9 col-lg-9">
                                <div class="date">21st October 2015</div>
                                <h5 class="title">Freight & Logistics Award</h5>
                                <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                            </div>
                        </div>
                    </div>
                    <!-- Service - End -->
                    <!-- Service - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 news_small inviewport animated delay2" data-effect="fadeInUp">
                        <div class="news-wrap row">
                            <div class="pic col-md-3 col-xs-3 col-sm-3 col-lg-3">
                                <img alt="news-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/news-2.jpg">
                            </div>
                            <div class="info col-md-9 col-xs-9 col-sm-9 col-lg-9">
                                <div class="date">21st October 2015</div>
                                <h5 class="title">Freight & Logistics Award</h5>
                                <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                            </div>
                        </div>
                    </div>
                    <!-- Service - End -->
                    <!-- Service - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 news_small inviewport animated delay1" data-effect="fadeInUp">
                        <div class="news-wrap row">
                            <div class="pic col-md-3 col-xs-3 col-sm-3 col-lg-3">
                                <img alt="news-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/news-3.jpg">
                            </div>
                            <div class="info col-md-9 col-xs-9 col-sm-9 col-lg-9">
                                <div class="date">21st October 2015</div>
                                <h5 class="title">Freight & Logistics Award</h5>
                                <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                            </div>
                        </div>
                    </div>
                    <!-- Service - End -->
                    <!-- Service - Start -->
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 news_small inviewport animated delay2" data-effect="fadeInUp">
                        <div class="news-wrap row">
                            <div class="pic col-md-3 col-xs-3 col-sm-3 col-lg-3">
                                <img alt="news-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/news-4.jpg">
                            </div>
                            <div class="info col-md-9 col-xs-9 col-sm-9 col-lg-9">
                                <div class="date">21st October 2015</div>
                                <h5 class="title">Freight & Logistics Award</h5>
                                <p>We offer a comprehensive range of air air-freight forwarding services that has a good major airports..</p>
                            </div>
                        </div>
                    </div>
                    <!-- Service - End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Company Updates -->
    <!-- Section Start - Testimonials -->
    <section class='testimonials parallax ' id='testimonials'>
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row">
                <h1 class="heading">Testimonials</h1>
                <div class="headul"></div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="row">
                        <!-- Testimonials Carousel - Start -->
                        <ul id="testimonial-carousel" class="owl-carousel">
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-1">
		              Shipping Logistics is one of the top logistics providers in the industry. and first class customer service and live by the 'Never Say Never' attitude to accomplish every mission.	              </h5>
                                <div class="testi_by">
                                    <div class="pic">
                                        <img src="<?php echo base_url(); ?>/asset/img/avatar-1.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">Kate Douglas</div>
                                    <div class="company">Company Co. In.</div>
                                </div>
                                <!-- <div class="tweet_by">Kate Douglas</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-2">
		              Asunt in anim uis aute irure dolor in reprehenderit in voluptate cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cun proident, sunt in anim id est laborum.	              </h5>
                                <div class="testi_by">
                                    <div class="pic">
                                        <img src="<?php echo base_url(); ?>/asset/img/avatar-2.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">Jim Arthur</div>
                                    <div class="company">Company Co. In.</div>
                                </div>
                                <!-- <div class="tweet_by">Jim Arthur</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-1">
		              Shipping Logistics is one of the top logistics providers in the industry. and first class customer service and live by the 'Never Say Never' attitude to accomplish every mission.	              </h5>
                                <div class="testi_by">
                                    <div class="pic">
                                        <img src="<?php echo base_url(); ?>/asset/img/avatar-1.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">Kate Douglas</div>
                                    <div class="company">Company Co. In.</div>
                                </div>
                                <!-- <div class="tweet_by">Kate Douglas</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                            <!-- Testimonial - Start -->
                            <li class="">
                                <h5 class="testi" data-id="testi-2">
		              Asunt in anim uis aute irure dolor in reprehenderit in voluptate cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cun proident, sunt in anim id est laborum.	              </h5>
                                <div class="testi_by">
                                    <div class="pic">
                                        <img src="<?php echo base_url(); ?>/asset/img/avatar-2.jpg" alt="User Avatar Image">
                                    </div>
                                    <div class="name">Jim Arthur</div>
                                    <div class="company">Company Co. In.</div>
                                </div>
                                <!-- <div class="tweet_by">Jim Arthur</div>
	              <div class="tweet_time">1 day ago</div> -->
                            </li>
                            <!-- Testimonial - End -->
                        </ul>
                        <!-- Testimonials Carousel - End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Testimonials -->
    <!-- Section Start - Service Estimate -->

    <!-- Section End - Service Estimate -->
    <!-- Section Start - Our Clients -->
    <section class='clients bg-primary white-text' id='clients'>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <h1 class="heading left-align">Our Clients</h1>
                    <div class="headul left-align"></div>
                    <p class="subheading left-align">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay1" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="<?php echo base_url(); ?>/asset/img/client-1.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay2" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="<?php echo base_url(); ?>/asset/img/client-2.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay3" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="<?php echo base_url(); ?>/asset/img/client-3.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                    <!-- Client Image - Start -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 client inviewport animated delay4" data-effect="fadeInUp">
                        <h4><img alt="client-logo" src="<?php echo base_url(); ?>/asset/img/client-4.png" class="img-responsive"></h4>
                    </div>
                    <!-- Client Image - End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Our Clients -->
    <!-- Section Start - Get In Touch -->
    <section class='contact contact-small' id='contactg'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Get In Touch</h1>
                <div class="headul"></div>
                <p class="subheading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <!-- Contact Form - Start -->
                    <div class='row'>
                        <form id="contactfrm" action='<?php echo base_url('home/contact_mail')?>' method='post'>
                            <div class='col-xs-6'>
                                <input type='text' name="name" placeholder='name' class='transition' id='c_name'>
                            </div>
                            <div class='col-xs-6'>
                                <input type='text' name="email" placeholder='email' class='transition' id='c_email'>
                            </div>
                            <div class='col-xs-12'>
                                <textarea class='transition'name="message" placeholder='message' id='c_message'></textarea>
                            </div>
                            <div id='responses_email' style="color:green;"class='col-xs-12'></div>
                            <div id='responses_email_error' style="color:red;" class='col-xs-12'></div>
                            <div class='col-xs-4'>
                                <button type='submit' class='btn btn-primary transition' id='cd_send'>Send Message</button>
                            </div>
                        </form>
                    </div>
                    <!-- Contact Form - End -->
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <div class="contact-info">
                        <i class="icon icon-envelope"></i>
                        <div class="title">Email</div>
                        <div class="value">contact@SPEEDYPORTER.com</div>
                    </div>
                    <div class="contact-info">
                        <i class="icon icon-phone"></i>
                        <div class="title">Phone</div>
                        <div class="value">+09 09876 54321</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Get In Touch -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="row">
            <div id="contact-map" class="gmap"></div>
        </div>
    </div>


        <!-- Section Start - Footer -->
    <section class='footer bg-black parallax ' id='footer'>
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row">
                <!-- Text Widget - Start -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 text-widget inviewport animated delay1" data-effect="fadeInUp">
                    <div class="logo">
                        <div>
                            <a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>/asset/img/logo.png" style="height:55px; width:216px;" alt="SPEEDYPORTER.com"/></a>
                        </div>

                    </div>
                    <p>This is a unique & creatively designed layout built in HTML+Photoshop with a modern look. All the files are well organized and named as per content. Its very easy to change any part.</p>
                    <p>This is unique & creatively designed layout in HTML form.</p>
                </div>
                <!-- Text Widget - End -->
                <!-- News Widget - Start -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 news-widget inviewport animated delay2" data-effect="fadeInUp">
                    <h4>News</h4>
                    <div class="headul left-align"></div>
                    <div class="news-wrap row">
                        <div class="pic col-md-3 col-xs-3 col-sm-3 col-lg-3">
                            <img alt="news-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/news-1.jpg">
                        </div>
                        <div class="info col-md-9 col-xs-9 col-sm-9 col-lg-9">
                            <h5 class="title"><a href='#'>ROAD FREIGHT AND LOGISTICS AWARD OF THE YEAR</a></h5>
                            <div class="date">21st October 2015</div>
                        </div>
                    </div>
                    <div class="news-wrap row">
                        <div class="pic col-md-3 col-xs-3 col-sm-3 col-lg-3">
                            <img alt="news-image" class="img-responsive" src="<?php echo base_url(); ?>/asset/img/news-2.jpg">
                        </div>
                        <div class="info col-md-9 col-xs-9 col-sm-9 col-lg-9">
                            <h5 class="title"><a href='#'>AIR FREIGHT AND LOGISTICS AWARD OF THE YEAR</a></h5>
                            <div class="date">21st October 2015</div>
                        </div>
                    </div>
                </div>
                <!-- News Widget - End -->
                <!-- Contact Widget - Start -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 contact-widget inviewport animated delay3" data-effect="fadeInUp">
                    <h4>Contact</h4>
                    <div class="headul left-align"></div>
                    <p>Lorance Road 542B,
                        <br>Tailstoi Town 5248 MT,
                        <br>Wordwide Country
                        <br>NY, 13027</p>
                    <p>Email: contact@SPEEDYPORTER.com
                        <br> Phone: +09 09876 54321</p>
                </div>
                <!-- Contact Widget - End -->
            </div>
        </div>
        <!-- Copyright Bar - Start -->
        <div class="copyright">
            <div class="col-md-12">
                <div class="container">
                    <div class="">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 message inviewport animated delay1" data-effect="fadeInUp">
                            <span class="">&copy; <script>document.write(new Date().getFullYear())</script> All Rights Reserved.</span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 social">
                            <a href="#" class="inviewport animated delay1" data-effect="fadeInUp"><i class="icon icon-facebook text-on-primary"></i></a>
                            <a href="#" class="inviewport animated delay2" data-effect="fadeInUp"><i class="icon icon-twitter text-on-primary"></i></a>
                            <a href="#" class="inviewport animated delay3" data-effect="fadeInUp"><i class="icon icon-dribbble text-on-primary"></i></a>
                            <a href="#" class="inviewport animated delay4" data-effect="fadeInUp"><i class="icon icon-google-plus text-on-primary"></i></a>
                            <a href="#" class="inviewport animated delay5" data-effect="fadeInUp"><i class="icon icon-youtube-play text-on-primary"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright Bar - End -->

    </section>
    <!-- Section End - Footer -->
    <script type="text/javascript">
    var base_url = '<?php echo base_url();?>';
    </script>
    <!-- Javascript & CSS Files moved to bottom of page for faster loading -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>/asset/js/jquery.viewportchecker.min.js"></script>
    <!--Owl-->
    <script src="<?php echo base_url(); ?>/asset/js/owl.carousel.min.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script>
    <!-- <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyArv9ALhBv6ihfhABHEAkFg0-JHywhtgjM&amp;sensor=false"></script> -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/gmap.js"></script>
    <!--Fancybox -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/jquery.fancybox-media.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asset/css/jquery.fancybox.css" media="screen" />
    <!-- Main JS -->
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/main.js"></script>
    <script src="//dokume.net/platform/js/class/publicBackend.js"></script>
    <script src="<?php echo base_url(); ?>/asset/frontend/routing/signals.js"></script>
       <script src="<?php echo base_url(); ?>/asset/frontend/routing/hasher.min.js"></script>
       <script src="<?php echo base_url(); ?>/asset/frontend/routing/crossroads.min.js"></script>
       <script src="<?php echo base_url(); ?>/asset/frontend/routing/routing.js"></script>
    <script src="<?php echo base_url(); ?>/asset/frontend/cms.js"></script>
    <script src="<?php echo base_url(); ?>/asset/frontend/common.js"></script>
    <script src="<?php echo base_url(); ?>/asset/frontend/home.js"></script>

    <script type="text/javascript">
$(function(){
    // member registration form submit
    $('#contactfrm').submit(function(e) {
        e.preventDefault();

        // $('button#btnSave').text('Loading...');

        var url = $(this).attr('action');
        var postData = $(this).serialize();
        console.log(postData);
        $.post(url, postData, function (o) {
            // $("html, body").animate({ scrollTop: 0 }, 500);
            if (o.msg_succ) {
                // $('#div_succ').show();
                $('#responses_email').html(o.msg_succ);
                setTimeout(function() {
                    $('#div_succ').hide();
                    window.location.reload();
                }, 1500);
            } else {
              console.log(o.msg_err);
                // $('#div_err').show();
                $('#responses_email_error').html(o.msg_err);
                setTimeout(function() {
                    $('#div_err').hide();
                }, 2000);
            }

            // $('button#btnSave').text('Send Message');
        }, 'json');
    });
})
</script>
</body>

</html>
