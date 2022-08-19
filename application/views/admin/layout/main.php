<?php $this->load->model('General_model');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- <title>Hound I Fast build Admin dashboard for any platform</title> -->
  <title><?php echo isset($page_title) ? $page_title : 'Admin' ?></title>
	<meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework"/>

	<!-- Favicon -->
	<!-- <link rel="shortcut icon" href="favicon.ico"> -->
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- Morris Charts CSS -->
    <link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

	<!-- Data table CSS -->
	<link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
  <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">

  <!--plugin css -->
  <link href="<?php echo base_url('asset/admin/'); ?>plugin/datetimepicker/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('asset/admin/'); ?>plugin/select2/css/select2.min.css" rel="stylesheet" type="text/css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<!-- Custom CSS -->
  <?php if($_SESSION['theme'] == 'dark'){ ?>
  <link href="<?php echo base_url('asset/admin/'); ?>dist/css/style.css" rel="stylesheet" type="text/css">
<?php }else{ ?>
  <link href="<?php echo base_url('asset/admin/'); ?>dist/css/style_light.css" rel="stylesheet" type="text/css">
<?php } ?>
<link rel="stylesheet" href="<?php echo base_url('asset/admin/'); ?>css/password.css" type="text/css" />
  <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

  <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&display=swap" rel="stylesheet"> -->

  <script type="text/javascript">
      var base_url='<?php echo base_url();?>';
  </script>
</head>

<body>
	<!-- Preloader -->
	<!-- <div class="preloader-it">
		<div class="la-anim-1"></div>
	</div> -->
	<!-- /Preloader -->
  <?php if($_SESSION['theme'] == 'dark'){ ?>
    <div class="wrapper theme-4-active pimary-color-red">
    <?php }else{?>
      <div class="wrapper theme-1-active pimary-color-red">
      <?php } ?>
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="#">
              <center>
							<img class="brand-img" src="<?php echo base_url(); ?>/asset/img/logo.png" style="height:40px; width:100px" alt="brand"/>
            </center>
						</a>
					</div>
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>

				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
        <form id="search_form" role="search" class="top-nav-search collapse pull-left" method="POST" action="<?php echo base_url()?>admin/consignment/trackorder" target="_blank">
					<div class="input-group">
						<input type="text" name="awb" class="form-control" placeholder="Enter Consignment number">
						<span class="input-group-btn">
						<button type="button" class="btn  btn-default" data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true"><i class="zmdi zmdi-search"></i></button>
						</span>
					</div>
				</form>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">

          <?php if($_SESSION['user_type'] == 'customer'){?>
          <!-- <li class="dropdown full-width-drp">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">COMPANY: <?php echo strtoupper($_SESSION['company']);?>   ||    EMAIL: <?php echo $_SESSION['email'];?></a>
						</li> -->
            <li class="dropdown full-width-drp">
  							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><?php echo strtoupper($_SESSION['company']);?></a>
  						</li>
          <?php }elseif ($_SESSION['user_type'] == 'admin') {?>
              <li class="dropdown full-width-drp">
    							<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">NAME: <?php echo strtoupper($_SESSION['name']);?>   ||    EMAIL: <?php echo $_SESSION['email'];?>   ||    BRANCH: <?php echo get_branchname($_SESSION['branch']);?></a> -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><?php echo strtoupper($_SESSION['name']);?></a>
    						</li>
            <?php } ?>

          <?php if($_SESSION['user_type'] == 'admin'){
            ?>
          <li class="dropdown alert-drp">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="zmdi zmdi-notifications top-nav-icon"></i><span class="top-nav-icon-badge"><?php echo get_allnotifcount(); ?></span></a>
							<ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
								<li>
									<div class="notification-box-head-wrap">
										<span class="notification-box-head pull-left inline-block">ticket notifications</span>
										<!-- <a class="txt-danger pull-right clear-notifications inline-block" onclick="allread();" href="javascript:void(0)"> clear all </a> -->
										<div class="clearfix"></div>
										<hr class="light-grey-hr ma-0">
									</div>
								</li>
								<li>
									<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 229px;"><div class="streamline message-nicescroll-bar" style="overflow: hidden; width: auto; height: 229px;">

                    <?php foreach (get_allnotif() as $key => $value): ?>
                    <div class="sl-item">
                      <?php if($value['subject'] == 'Merchant Profile Update'){?>
                        <a href="<?php echo base_url('admin/customer/review')?>">
                      <?php }else{ ?>
											<a href="<?php echo base_url('admin/tickets')?>" onclick="ticketRead(<?php echo $value['id'];?>);">
                      <?php } ?>
												<div class="icon bg-green">
													<i class="zmdi zmdi-flag"></i>
												</div>
												<div class="sl-content">
													<span class="inline-block capitalize-font  pull-left truncate head-notifications">
													<?php echo $value['subject'];?></span>
													<span class="inline-block font-11  pull-right notifications-time"><?php $newDateTime = date('h:i A', strtotime($value['timer'])); $newDateTime;?></span>
													<div class="clearfix"></div>
													<p class="truncate"><?php echo $value['description'];?></p>
												</div>
											</a>
										</div>
										<hr class="light-grey-hr ma-0">
                    <?php endforeach; ?>

									</div><div class="slimScrollBar" style="background: rgb(135, 135, 135); width: 4px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 0px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
								</li>
								<li>
									<div class="notification-box-bottom-wrap">
										<hr class="light-grey-hr ma-0">
										<a class="block text-center read-all" href="<?php echo base_url('admin/tickets')?>" onclick="allread();"> read all </a>
										<div class="clearfix"></div>
									</div>
								</li>
							</ul>
						</li>
<?php } ?>

					<li class="dropdown auth-drp">
            <?php if($_SESSION['user_type'] == 'customer'){
              if($_SESSION['logo'] != ""){?>
            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url('uploads/merchants/').$_SESSION['logo']; ?>" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
          <?php }else{?>
            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
          <?php
        }
      }elseif ($_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'branch'){ ?>
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
          <?php } ?>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">

							<li>
								<a href="<?php echo base_url('admin/home/logout');?>"><i class="zmdi zmdi-power"></i><span>Log Out</span></a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<li class="navigation-header">
					<span>Main</span>
					<i class="zmdi zmdi-more"></i>
				</li>

        <?php
        // if(isset($_SESSION['user_type'])){
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer_care'){
?>
        <li>
            <a href="<?php echo base_url('admin');?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
        </li>
        <?php
      }elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
      ?>
      <li>
          <a href="<?php echo base_url('merchant/dashboard');?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
      </li>
      <?php
    }
    ?>
        <?php
        // if(isset($_SESSION['user_type'])){
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'branch' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer_care'){
?>

<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
?>
<!-- <li>
    <a href="<?php echo base_url('admin/branch');?>" data-toggle="collapse" data-target="#financial_report_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Branch</span></div><div class="clearfix"></div></a>
</li> -->
<?php
}
?>

<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#transp"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Employee</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
    <ul id="transp" class="collapse collapse-level-1">
      <li>
          <a href="<?php echo base_url('admin/employee');?>">Official Details</a>
      </li>
      <li>
          <a href="<?php echo base_url('admin/delivery_person');?>">Transporter Details</a>
      </li>
      <li>
          <a href="<?php echo base_url('admin/delivery_person/track');?>" >Track Transporter</a>
      </li>
    </ul>
</li>

        <li>
            <a href="<?php echo base_url('admin/merchant');?>" data-toggle="collapse" data-target="#customer_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Customer</span></div><div class="clearfix"></div></a>
            <!-- <ul id="customer_dr" class="collapse collapse-level-1">
                <li>
                    <a href="<?php echo base_url('admin/merchant');?>">View</a>
                </li>
            </ul> -->
        </li>
        <!-- <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
?> -->
<!-- <li>
    <a href="<?php echo base_url('admin/discount');?>" data-toggle="collapse" data-target="#package_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Discount</span></div><div class="clearfix"></div></a>
</li> -->
<!-- <?php
}
?> -->
        <li>
            <a href="<?php echo base_url('admin/consignment');?>" data-toggle="collapse" data-target="#consignment_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Consignment</span></div><div class="clearfix"></div></a>
            <!-- <ul id="consignment_dr" class="collapse collapse-level-1">
                <li>
                    <a href="<?php echo base_url('admin/consignment');?>">View</a>
                </li>
            </ul> -->
        </li>

        <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer_care'){
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
?>
        <!-- <li>
            <a href="<?php echo base_url('admin/package');?>" data-toggle="collapse" data-target="#package_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Service Package</span></div><div class="clearfix"></div></a>
        </li> -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#add_data"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Services</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="add_data" class="collapse collapse-level-1">
                <li>
                    <a href="<?php echo base_url('admin/add_data/district');?>">District</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/add_data/police_station');?>">Zip code</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/package');?>" >Service Package</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/add_data/dimension');?>" >Dimension</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/discount');?>">Discount</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/shiping/database');?>"> Shipping Database </a>
                </li>
            </ul>
        </li>
        <?php
      }
      ?>
        <!-- <li>
            <a href="<?php echo base_url('admin/packing');?>" data-toggle="collapse" data-target="#packing_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Packing</span></div><div class="clearfix"></div></a>
        </li> -->

        <?php
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){

      }
      }
      ?>

      <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
?>
<!-- <li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#transfer"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text"> Parcel Transfer </span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
    <ul id="transfer" class="collapse collapse-level-1"> -->
        <!-- <li>
            <a href="<?php echo base_url('admin/transfer');?>">Transfer to Office</a>
        </li> -->
        <!-- <li>
            <a href="<?php echo base_url('admin/transfer/in');?>"> Transfer-in </a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/transfer/out');?>"> Transfer-out </a>
        </li>
    </ul>
</li> -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#assign_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Parcel Assignment</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="assign_dr" class="collapse collapse-level-1">
                <!-- <li>
                    <a href="<?php echo base_url('admin/assign_deliveryperson');?>">Single Assign</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/assign_deliveryperson/multiple');?>">Multiple Assign</a>
                </li> -->

                <li>
                    <a href="<?php echo base_url('admin/assign_deliveryperson/receive');?>">Receive Assignment</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/assign_deliveryperson/delivery');?>">Delivery Assignment</a>
                </li>
            </ul>
        </li>
        <?php
      }
      ?>

      <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){ ?>
        <li>
            <a href="<?php echo base_url('admin/tickets');?>" data-toggle="collapse" data-target="#packing_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Tickets    <span ><b>   ( <?php echo get_allnotifcountticket() ?> )</b></span></span></div><div class="clearfix"></div></a>
        </li>
      <?php } ?>


        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#cash_collection"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Cash Collection</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="cash_collection" class="collapse collapse-level-1">
                <li>
                    <a href="<?php echo base_url('admin/merchant_pay/cash_collection');?>">Transporter</a>
                </li>
                <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){ ?>
                <!-- <li>
                    <a href="<?php echo base_url('admin/merchant_pay/cash_collection_branch');?>">Branch</a>
                </li> -->
              <?php } ?>
            </ul>
        </li>

        <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){ ?>
        <!-- <li>
            <a href="<?php echo base_url('admin/merchant_pay/all');?>" data-toggle="collapse" data-target="#packing_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Merchant Payment</span></div><div class="clearfix"></div></a>
        </li> -->
      <?php } ?>

      <?php
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
      ?>
      <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#accounts"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Accounts</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="accounts" class="collapse collapse-level-1">

            <li>
            <a href="<?php echo base_url('admin/accounts');?>">	List of entry</a>
          </li>
          <li>
          <a href="<?php echo base_url('admin/accounts/expense');?>">	Expense List</a>
        </li>
              <li>
                  <a href="<?php echo base_url('admin/accounts/account_entry');?>">Account Input</a>
              </li>
              <li>
                  <a href="<?php echo base_url('admin/accounts/edit_voucher');?>">Edit Voucher</a>
              </li>
              <li>
                  <a href="<?php echo base_url('admin/accounts/accounts_list');?>">Account Report</a>
              </li>

          </ul>
      </li>
      <?php
      }
      ?>

      <?php if(isset($_SESSION['email']) && $_SESSION['email'] == 'muid@SPEEDYPORTER.com' || $_SESSION['email'] == 'radwan@SPEEDYPORTER.com'){ ?>
      <li>
          <a href="<?php echo base_url('admin/consignment/correct_cons');?>" data-toggle="collapse" data-target="#packing_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Parcel Correction</span></div><div class="clearfix"></div></a>
      </li>
    <?php } ?>

        <li>
            <!-- <a href="<?php echo base_url('admin/merchant_pay');?>" data-toggle="collapse" data-target="#packing_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Pay To Merchant</span></div><div class="clearfix"></div></a> -->
        </li>

        <?php
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
        ?>
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#report_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Report</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
            <ul id="report_dr" class="collapse collapse-level-1">
              <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'branch'  || $_SESSION['user_type'] == 'admin'){
              ?>


              <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'branch' || $_SESSION['user_type'] == 'admin'){
              ?>
              <li>
                <a href="<?php echo base_url('admin/report/consignment');?>">Consignment</a>
            </li>
            <li>
              <a href="<?php echo base_url('admin/report/cancel_parcel');?>">Cancel Parcel</a>
          </li>
            <li>
                <a href="<?php echo base_url('admin/report/delivery_report');?>">Delivery Report</a>
            </li>
              <li>
                <a href="<?php echo base_url('admin/report/cash_collection_report');?>">Cash Collection Report</a>
            </li>

            <li>
                <a href="<?php echo base_url('admin/report/branch_report');?>">Branch Report</a>
            </li>
            <!-- <li>
                <a href="<?php echo base_url('admin/report/delivery_report');?>">Delivery Report</a>
            </li> -->
            <li>
                <a href="<?php echo base_url('admin/report/delivery_charge');?>">Delivery Charge</a>
            </li>
            <?php
          }
          ?>
                <li>
                    <!-- <a href="<?php echo base_url('admin/report/delivery_status');?>">By Delivery Boy</a> -->
                </li>
                <li>
                    <!-- <a href="<?php echo base_url('admin/report/delivery_status_user');?>">By User</a> -->
                </li>
                <?php
              }
              ?>
                <li>
                    <a href="<?php echo base_url('admin/report/merchant_payout');?>">Merchant Payout</a>
                </li>
                <?php
            }
              ?>
              <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'branch'  || $_SESSION['user_type'] == 'admin'){
              ?>

                <?php
                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                ?>
                <li>
                    <!-- <a href="<?php echo base_url('admin/report/financial');?>">Financial Report</a> -->
                </li>
                <li>
                    <a href="<?php echo base_url('admin/report/partial');?>">Partial Report</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/report/transporter_copy');?>">Transporter copy</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/report/transporter_report');?>">Transporter Report</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/report/ticket_report');?>">Ticket Report</a>
                </li>

                <?php
              }
            }
              ?>
            </ul>
        </li>
        <?php
      }
      ?>

        <?php
        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
        ?>
        <li>
            <a href="<?php echo base_url('admin/user');?>" data-toggle="collapse" data-target="#user_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">User</span></div><div class="clearfix"></div></a>
            <!-- <ul id="user_dr" class="collapse collapse-level-1">
                <li>
                    <a href="<?php echo base_url('admin/user');?>">View</a>
                </li>
            </ul> -->
        </li>


        <?php
      }
      ?>
        <?php
      }
      ?>

      <?php
      // if(isset($_SESSION['user_type'])){
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
?>


<!-- <ul id="profile_dr" class="collapse collapse-level-1">
 <li>
     <a href="<?php echo base_url('merchant/profile/').$_SESSION['id'];?>">View</a>
 </li>
</ul> -->
<!-- </li> -->

<li>
<a href="<?php echo base_url('merchant/consignment');?>" data-toggle="collapse" data-target="#consignment_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Consignment</span></div><div class="clearfix"></div></a>
<!-- <ul id="consignment_dr" class="collapse collapse-level-1">
 <li>
     <a href="<?php echo base_url('merchant/consignment');?>">View</a>
 </li>
</ul> -->
</li>

<li>
<!-- <a href="<?php echo base_url('merchant/shiping/index/').$_SESSION['id'];?>" data-toggle="collapse" data-target="#report_drer"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Shipping</span></div><div class="clearfix"></div></a> -->
<!-- <ul id="report_drer" class="collapse collapse-level-1">
 <li>
     <a href="<?php echo base_url('merchant/shiping/index/').$_SESSION['id'];?>">List</a>
 </li>
</ul> -->
</li>

<li>
<a href="<?php echo base_url('merchant/ticket');?>" data-toggle="collapse" data-target="#report_drer"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Ticket</span></div><div class="clearfix"></div></a>
</li>

<!-- <li>
<a href="javascript:void(0);" data-toggle="collapse" data-target="#report_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Report</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
<ul id="report_dr" class="collapse collapse-level-1"> -->
 <li>
     <a href="<?php echo base_url('merchant/report/financial_report');?>" data-toggle="collapse" data-target="#report_financ"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Financial Report</span></div><div class="clearfix"></div></a>
 </li>
 <li>
     <a href="<?php echo base_url('merchant/report/payment_report');?>" data-toggle="collapse" data-target="#report_pymnt"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Payment</span></div><div class="clearfix"></div></a>
 </li>
<!-- </ul>
</li> -->

<?php
}
?>

<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery'){
?>
<li>
<a href="<?php echo base_url('admin/consignment');?>" data-toggle="collapse" data-target="#consignment_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Allotted Consignment</span></div><div class="clearfix"></div></a>
<!-- <ul id="consignment_dr" class="collapse collapse-level-1">
  <li>
      <a href="<?php echo base_url('admin/consignment');?>">View</a>
  </li>
</ul> -->
</li>

<li>
<a href="javascript:void(0);" data-toggle="collapse" data-target="#consignment_update"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Report</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
<ul id="consignment_update" class="collapse collapse-level-1">
  <li>
      <a href="<?php echo base_url('admin/report/delivery_status');?>">Delivery Status</a>
  </li>
</ul>
</li>
<?php
}
?>



<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#account"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Settings</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
    <ul id="account" class="collapse collapse-level-1">
      <?php
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
      ?>
      <li>
      <a href="<?php echo base_url('merchant/profile/').$_SESSION['id'];?>">Profile</a>
    </li>
    <?php
  }
  ?>
        <li>
            <a href="<?php echo base_url('admin/user/change_pass');?>">Change Password</a>
        </li>
        <li>
            <a href="<?php echo base_url('admin/general_setting');?>">General Setting</a>
        </li>

    </ul>
</li>


<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
?>
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#profile_update"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Review<span ><b>   ( <?php echo get_allnotifcountprofile() ?> )</b></span></span></span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
    <ul id="profile_update" class="collapse collapse-level-1">
      <li>
      <a href="<?php echo base_url('admin/customer/review');?>">Customer Profile</a>
    </li>

    </ul>
</li>
<?php
}
?>

<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer'){
?>
<li>
    <a href="<?php echo base_url('admin/support');?>" data-toggle="collapse" data-target="#support_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Support</span></div><div class="clearfix"></div></a>
</li>
<?php
}
?>


				<!-- <li>
					<a href="widgets.html"><div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span class="right-nav-text">widgets</span></div><div class="pull-right"><span class="label label-warning">8</span></div><div class="clearfix"></div></a>
				</li> -->
				<!-- <li><hr class="light-grey-hr mb-10"/></li> -->

			</ul>
		</div>
		<!-- /Left Sidebar Menu -->




		<!-- Right Sidebar Backdrop -->
		<div class="right-sidebar-backdrop"></div>
		<!-- /Right Sidebar Backdrop -->

        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container-fluid pt-25">
				<!-- Row -->
        <?php
        if(isset($content_head)) echo $content_head;
        ?>
        <p id="demo"></p>
        <?php echo $content; ?>
				<!-- Row -->
			</div>

			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<div class="col-sm-12">
						<p><script>document.write(new Date().getFullYear())</script> &copy; SPEEDYPORTER.com</p>
					</div>
				</div>
			</footer>
			<!-- /Footer -->

		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

	<!-- JavaScript -->

    <!-- jQuery -->
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Data table JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('asset/admin/'); ?>dist/js/dataTables-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/jquery.slimscroll.js"></script>

	<!-- simpleWeather JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/simpleweather-data.js"></script>

	<!-- Progressbar Animation JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/dropdown-bootstrap-extended.js"></script>

  <!-- Sparkline JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js
    "></script>

	<!-- Owl JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

	<!-- ChartJS JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/chart.js/Chart.min.js"></script>

	<!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/switchery/dist/switchery.min.js"></script>
  <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>

	<!-- Init JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/init.js"></script>
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/dashboard-data.js"></script>
  <!--plugin -->
  <script src="<?php echo base_url('asset/admin/'); ?>plugin/datetimepicker/moment-with-locales.js"></script>
  <script src="<?php echo base_url('asset/admin/'); ?>plugin/datetimepicker/jquery.datetimepicker.full.min.js"></script>
  <script src="<?php echo base_url('asset/admin/'); ?>dist/js/datepicker.js"></script>
  <script src="<?php echo base_url('asset/admin/'); ?>plugin/select2/js/select2.full.js"></script>
  <!-- <script src="<?php echo base_url('asset/admin/'); ?>dist/js/init.js"></script> -->
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>.



<!-- <script src='https://cdn.rawgit.com/pguso/jquery-plugin-circliful/master/js/jquery.circliful.min.js'></script> -->
<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js" ></script>

  <?php
  if(isset($js)){
      foreach($js as $v){
      ?>
      <script src="<?php echo base_url('asset/admin/js/'.$v.'.js');?>"></script>
          <?php
      }
  }
  ?>
</body>
<script type="text/javascript">
$(document).ready(function () {
  var userType ='<?php echo $_SESSION['user_type'] ;?>';
  console.log(userType);
  if(userType == 'delivery'){
  getLocation();
}
var url = window.location;

// Adds active on inner anchor and treeview anchor and treeview menu-open state to li
$('ul.nav a').filter(function () {
return this.href == url;
}).addClass('active').parent().parent().siblings().addClass('active').parent().addClass('menu-open');
});
</script>

<script>
var x = document.getElementById("demo");
var myVar;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
    myVar = setTimeout(getLocation, 60000);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  // x.innerHTML = "Latitude: " + position.coords.latitude +
  // "<br>Longitude: " + position.coords.longitude;
  var Latitude = position.coords.latitude;
   var Longitude= position.coords.longitude;
  console.log(Latitude);
  $.ajax({
    url: base_url+'admin/delivery_person/geoLocation',
    type: 'post',
    data: {Lat: Latitude, Long: Longitude},
    dataType: 'html',
    complete: function (response) {
      console.log("success");
    }
  });
}
</script>

<script>
function ticketRead(ticketid){
  $.ajax({
            url:base_url+'admin/tickets/isread',   //the page containing php script
            type: "post",    //request type,
            // dataType: 'json',
            data: {tkt : ticketid},
            success:function(result){
                // result = JSON.parse(result)
                console.log(result);
            }
        });
}

function allread(){
  var all = 'all';
  $.ajax({
            url:base_url+'admin/tickets/allread',   //the page containing php script
            type: "post",    //request type,
            // dataType: 'json',
            data: {tkt : all},
            success:function(result){
                // result = JSON.parse(result)
                console.log(result);
                location.reload();
            }
        });
}

// document.onkeydown = function(e) {
// if(event.keyCode == 123) {
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
// return false;
// }
// if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
// return false;
// }
// }
</script>
</html>
