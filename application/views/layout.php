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
    <script type="text/javascript">
    var base_url = '<?php echo base_url();?>';
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/asset/js/jquery.min.js"></script>
    <script src="//dokume.net/platform/js/class/publicBackend.js"></script>
    <script src="<?php echo base_url(); ?>/asset/frontend/cms.js"></script>
    <script src="<?php echo base_url(); ?>/asset/frontend/common.js"></script>
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

            <!-- Header Content Slide - Start -->
            <div style="position:relative;display:inline-block;width:100%;height:130px;">
                <img src="<?php echo base_url(); ?>/asset/img/banner-1.jpg" alt="Header Image" class="img-responsive" style="height:130px;">
                  <div class="bg-overlay"></div>

            </div>
            <!-- Header Content Slide - End -->
            <!-- Header Social Icons - Start -->

            <!-- Header Social Icons - End -->
        </div>
    </section>
    <!-- Section End - Header -->

<?php $this->load->view($layout_page); ?>

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
    <!-- Javascript & CSS Files moved to bottom of page for faster loading -->

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

</body>

</html>
