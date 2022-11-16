<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title ; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/plugins/bootstrap-3.3.6/css/bootstrap.min.css">
        <!-- Bootstrap Select Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/plugins/bootstrap-select-1.10.0/dist/css/bootstrap-select.min.css">
        <!-- Fonts Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/plugins/font-awesome-4.6.1/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/plugins/font-elegant/elegant.css">
        <!-- OwlCarousel2 Slider Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/plugins/owl.carousel.2/assets/owl.carousel.css">


        <!-- Animate Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/css/animate.css">

        <!-- Main Css -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/new/css/theme.css">

    </head>
    <body id="home">



        <!-- Main Wrapper -->
        <main class="wrapper">

            <!-- Header -->
            <header class="header-main">

                <!-- Header Topbar -->
                <div class="top-bar font2-title1 white-clr">
                    <div class="theme-container container">
                        <div class="row">
                            <!-- <div class="col-md-6 col-sm-5">
                                <ul class="list-items fs-10">
                                    <li><a href="#">sitemap</a></li>
                                    <li class="active"><a href="#">Privacy</a></li>
                                    <li><a href="#">Pricing</a></li>
                                </ul>
                            </div> -->
                            <div class="col-md-6 col-sm-7 fs-12">
                                <p class="contact-num">  <i class="fa fa-phone"></i> Call us now: <span class="" style="color: #eb5c58"> +880-1756-390-370 </span> </p>
                            </div>
                        </div>
                    </div>
                    <a data-toggle="modal" href="#login-popup" class="sign-in fs-12 theme-clr-bg"> sign in </a>
                </div>
                <!-- /.Header Topbar -->

                <!-- Header Logo & Navigation -->
                <nav class="menu-bar font2-title1">
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-logo" href="#"> <img src="<?php echo base_url(); ?>asset/new/img/logo/logo-black.png" alt="logo" /> </a>
                            </div>
                            <div class="col-md-10 col-sm-10 fs-15">
                                <div id="navbar" class="collapse navbar-collapse no-pad">
                                    <ul class="navbar-nav theme-menu">
                                        <li class="<?php echo ($page_name=='home')?'active':'';?>">
                                            <a href="<?php echo base_url();?>" class="" role="button" aria-haspopup="true" >Home </a>
                                        </li>
                                        <li class="<?php echo ($page_name=='about')?'active':'';?>"> <a  href="<?php echo base_url('about_us');?>">about</a> </li>
                                        <li class="<?php echo ($page_name=='tracking')?'active':'';?>"> <a href="<?php echo base_url('tracking');?>"> tracking </a> </li>
                                        <li class="<?php echo ($page_name=='pricing')?'active':'';?>"> <a href="<?php echo base_url('pricing');?>"> pricing </a> </li>
                                        <li class="<?php echo ($page_name=='contact')?'active':'';?>"> <a href="<?php echo base_url('contact');?>"> contact </a> </li>
                                        <li><span class="search fa fa-search theme-clr transition"> </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- /.Header Logo & Navigation -->

            </header>
            <!-- /.Header -->

            <!-- Content Wrapper -->
            <article>
            <?php echo $content;?>
            </article>
            <!-- /.Content Wrapper -->

            <!-- Footer -->
            <footer>
                <div class="footer-main pad-80 white-clr">
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 footer-widget">
                                <a href="#"> <img class="logo" alt="#" src="<?php echo base_url(); ?>asset/new/img/logo/logo-white.png" style="width: 170px;">  </a>
                                <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInUp;font-weight: 300;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                                        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat.</p>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 footer-widget">
                                        <h2 class="title-1 fw-900">quick links</h2>
                                        <ul>
                                            <li> <a href="#">sitemap</a> </li>
                                            <li> <a href="#">pricing</a> </li>
                                            <li> <a href="#">payment method</a> </li>
                                            <li> <a href="#">support</a> </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-6 footer-widget">
                                        <h2 class="title-1 fw-900">important links</h2>
                                        <ul>
                                            <li> <a href="#">themeforest</a> </li>
                                            <li> <a href="#">envato</a> </li>
                                            <li> <a href="#">audiojungle</a> </li>
                                            <li> <a href="#">videohibe</a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-3 col-md-4 col-sm-6 footer-widget">
                                <h2 class="title-1 fw-900">get in touch</h2>
                                <ul class="social-icons list-inline">
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".20s"> <a href="#" class="fa fa-facebook"></a> </li>
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".25s"> <a href="#" class="fa fa-twitter"></a> </li>
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".30s"> <a href="#" class="fa fa-google-plus"></a> </li>
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".35s"> <a href="#" class="fa fa-linkedin"></a> </li>
                                </ul>
                                <ul class="payment-icons list-inline">
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".20s"> <a href="#"> <img alt="#" src="<?php echo base_url(); ?>asset/new/img/icons/payment-1.png" /> </a> </li>
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".25s"> <a href="#"> <img alt="#" src="<?php echo base_url(); ?>asset/new/img/icons/payment-2.png" /> </a> </li>
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".30s"> <a href="#"> <img alt="#" src="<?php echo base_url(); ?>asset/new/img/icons/payment-3.png" /> </a> </li>
                                    <li class="wow fadeIn" data-wow-offset="50" data-wow-delay=".35s"> <a href="#"> <img alt="#" src="<?php echo base_url(); ?>asset/new/img/icons/payment-4.png" /> </a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom">
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <p> © Copyright 2022, All rights reserved </p>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                <p> Design and <span class="theme-clr fa fa-heart"></span>  by <a href="#" class="main-clr"> Rendement Technologies </a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- /.Footer -->


        </main>
        <!-- / Main Wrapper -->

        <!-- Top -->
        <div class="to-top theme-clr-bg transition"> <i class="fa fa-angle-up"></i> </div>

        <!-- Popup: Login -->
        <div class="modal fade login-popup" id="login-popup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <a class="close close-btn" data-dismiss="modal" aria-label="Close"> x </a>

                <div class="modal-content">
                    <div class="login-wrap text-center">
                        <h2 class="title-3"> sign in </h2>
                        <p> Sign in to <strong> <span class="theme-clr">Speedy</span> <span style="color: #eb5c58;">Porter</span> </strong> for getting all details </p>

                        <div class="login-form clrbg-before">
                            <!-- <form class="login"> -->
                            <form action='<?php echo base_url('login/login_check'); ?>' method='post' id ='login-form'>
                                <div class="form-group"><input type="text" placeholder="Email address" name="email" id="email" class="form-control"></div>
                                <div class="form-group"><input type="password" placeholder="Password" name="password" id="password" class="form-control"></div>
                                <input type='hidden' name="base_url" id="base_url" value="<?php echo base_url();?>">
                                <div class="form-group">
                                    <button class="btn-1 btn btn-dark btnSave" type="submit"> Sign in now </button>
                                </div>
                            </form>
                            <a href="#" class="gray-clr"> Forgot Passoword? </a>
                        </div>
                    </div>
                    <div class="create-accnt">
                        <a href="#" class="white-clr"> Don’t have an account? </a>
                        <h2 class="title-2"> <a href="<?php echo base_url('register');?>" class="green-clr under-line">Create a free account</a> </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Popup: Login -->

        <!-- Search Popup -->
        <div class="search-popup">
            <div>
                <div class="popup-box-inner">
                    <form>
                        <input class="search-query" type="text" placeholder="Search and hit enter" />
                    </form>
                </div>
            </div>
            <a href="javascript:void(0)" class="close-search"><i class="fa fa-close"></i></a>
        </div>
        <!-- / Search Popup -->

        <!-- Main Jquery JS -->
        <script src="<?php echo base_url(); ?>asset/new/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <!-- Bootstrap JS -->
        <script src="<?php echo base_url(); ?>asset/new/plugins/bootstrap-3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Bootstrap Select JS -->
        <script src="<?php echo base_url(); ?>asset/new/plugins/bootstrap-select-1.10.0/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
        <!-- OwlCarousel2 Slider JS -->
        <script src="<?php echo base_url(); ?>asset/new/plugins/owl.carousel.2/owl.carousel.min.js" type="text/javascript"></script>
        <!-- Sticky Header -->
        <script src="<?php echo base_url(); ?>asset/new/js/jquery.sticky.js"></script>
        <!-- Wow JS -->
        <script src="<?php echo base_url(); ?>asset/new/plugins/WOW-master/dist/wow.min.js" type="text/javascript"></script>
        <!-- Data binder -->
        <script src="<?php echo base_url(); ?>asset/new/plugins/data.binder.js/data.binder.js" type="text/javascript"></script>

        <!-- Slider JS -->


        <!-- Theme JS -->
        <script src="<?php echo base_url(); ?>asset/new/js/theme.js" type="text/javascript"></script>

        <!-- <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
    $(function(){
        // member registration form submit
        $('#login-form').submit(function(e) {
            e.preventDefault();

            $('button#btnSave').text('Loading...');

            var site_url = $('#base_url').val();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            console.log(postData);
            $.post(url, postData, function (o) {
                // $("html, body").animate({ scrollTop: 0 }, 500);
                console.log(o.success);
                if (o.success == true) {
                  if (o.pass_updated == 1) {
                    swal({
                          title: "Success!",
                          text: "Successfully signed in!",
                          icon: "success",
                          // button: "Aww yiss!",
                        });
                    window.setTimeout(function() {
                        window.location.replace(site_url+"merchant/dashboard");
                        }, 1000);
                      }else{
                        swal({
                              title: "Success!",
                              text: "Successfully signed in! please Update your password",
                              icon: "success",
                              // button: "Aww yiss!",
                            });
                        window.setTimeout(function() {
                            window.location.replace(site_url+"admin/user/change_pass");
                            }, 1000);
                      }
                } else {
                    swal({
                          title: "Failure!",
                          text: "Email or Password didn't match!",
                          icon: "error",
                          button: "Try again",
                        });
                }

                $('button#btnSave').text('Save');
            }, 'json');
        });
    })
</script>
    </body>
</html>
