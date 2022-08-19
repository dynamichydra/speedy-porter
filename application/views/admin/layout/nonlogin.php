<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>SPEEDY PORTER | Admin</title>
        <meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
        <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
        <meta name="author" content="hencework"/>

        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="icon" href="<?php echo base_url('asset/admin/');?>favicon.ico" type="image/x-icon">

        <!-- vector map CSS -->
        <link href="<?php echo base_url('asset/admin/');?>vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="<?php echo base_url('asset/admin/vendors/toastr/toastr.min.css'); ?>">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('asset/admin/');?>dist/css/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            var base_url='<?php echo base_url();?>';
        </script>
    </head>
    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->

        <div class="wrapper pa-0">
            <header class="sp-header">
                <div class="sp-logo-wrap pull-left">
                    <a href="index.html">
                        <img class="brand-img mr-10" src="<?php echo base_url(); ?>/asset/img/logo.png" style="height:50px; width:150px" alt="brand"/>
                        <!-- <span class="brand-text">Hound</span> -->
                    </a>
                </div>

                <div class="clearfix"></div>
            </header>

            <!-- Main Content -->
            <div class="page-wrapper pa-0 ma-0 auth-page">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="table-struct full-width full-height">
                        <div class="table-cell vertical-align-middle auth-form-wrap">
                            <div class="auth-form  ml-auto mr-auto no-float">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->
                </div>

            </div>
            <!-- /Main Content -->

        </div>
        <!-- /#wrapper -->

        <!-- JavaScript -->

        <!-- jQuery -->
        <script src="<?php echo base_url('asset/admin/');?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('asset/admin/');?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url('asset/admin/');?>vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

        <!-- Slimscroll JavaScript -->
        <script src="<?php echo base_url('asset/admin/');?>dist/js/jquery.slimscroll.js"></script>

        <!-- Init JavaScript -->
        <script src="<?php echo base_url('asset/admin/');?>dist/js/init.js"></script>

        <script src="<?php echo base_url('asset/admin/vendors/toastr/toastr.min.js'); ?>"></script>
        <script src="<?php echo base_url('asset/admin/js/common.js');?>"></script>
        <?php
        if(isset($param['js'])){
            ?>
            <script src="<?php echo base_url('asset/admin/js/'.$param['js'].'.js');?>"></script>
                <?php
        }
        ?>

    </body>
</html>
