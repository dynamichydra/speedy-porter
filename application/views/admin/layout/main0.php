<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($page_title) ? $page_title : 'Admin' ?></title>
        <meta name="description" content="Hound is a Dashboard & Admin Site Responsive Template by hencework." />
        <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Hound Admin, Houndadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
        <meta name="author" content="hencework"/>



        <!-- Morris Charts CSS -->
        <link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

        <!-- Data table CSS -->
        <link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>

        <link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
        <!--plugin css -->
        <link href="<?php echo base_url('asset/admin/'); ?>plugin/datetimepicker/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('asset/admin/'); ?>plugin/select2/css/select2.min.css" rel="stylesheet" type="text/css">
        <!-- Custom CSS -->
        <link href="<?php echo base_url('asset/admin/'); ?>dist/css/style.css" rel="stylesheet" type="text/css">
        <script type="text/javascript">
            var base_url='<?php echo base_url();?>';
        </script>
    </head>
    <!-- <script type="text/javascript">
    $(document).ready(function () {
var url = window.location;

// Adds active on inner anchor and treeview anchor and treeview menu-open state to li
$('ul.nav a').filter(function () {
    return this.href == url;
}).addClass('active').parent().parent().siblings().addClass('active').parent().addClass('menu-open');
});
    </script> -->

    <body>
        <!-- Preloader -->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!-- /Preloader -->
        <div id="mysidebar" class="wrapper theme-4-active pimary-color-red">
            <!-- Top Menu Items -->
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="mobile-only-brand pull-left">
                    <div class="nav-header pull-left">
                        <div class="logo-wrap">
                            <a href="index.html">
                                <img class="brand-img" src="<?php echo base_url(); ?>/asset/img/logo.png" style="height:40px; width:150px" alt="brand"/>
                                <!-- <span class="brand-text">Hound</span> -->
                            </a>
                        </div>
                    </div>
                    <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
                    <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                    <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>

                </div>
                <div id="mobile_only_nav" class="mobile-only-nav pull-right">
                    <ul class="nav navbar-right top-nav pull-right">

                        <li class="dropdown auth-drp">
                            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
                            <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                                <!-- <li>
                                    <a href="profile.html"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                                </li> -->
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
            <div  class="fixed-sidebar-left">
                <ul class="nav navbar-nav side-nav nicescroll-bar sidebar1">
                    <li class="navigation-header">
                        <span>Main</span>
                        <i class="zmdi zmdi-more"></i>
                    </li>
                    <?php
                    // if(isset($_SESSION['user_type'])){
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff'){
       ?>
                    <li>
                        <a href="<?php echo base_url('admin');?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
                    </li>
                    <?php
                  }else{
                  ?>
                  <li>
                      <a href="<?php echo base_url('merchant/dashboard');?>"><div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
                  </li>
                  <?php
                }
                ?>
                    <?php
                    // if(isset($_SESSION['user_type'])){
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
       ?>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#delivery_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Delivery person</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="delivery_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/delivery_person');?>">View</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#customer_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Merchant</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="customer_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/merchant');?>">View</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#consignment_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Consignment</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="consignment_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/consignment');?>">View</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#package_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Package</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="package_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/package');?>">View</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#assign_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Assign Delivery Person</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="assign_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/assign_deliveryperson');?>">View</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#packing_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Packing</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="packing_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/packing');?>">View</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#report_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Delivery Report</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="report_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/report/delivery_status');?>">Delivery Status</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/report/financial');?>">Financial Report</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#financial_report_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Branch</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="financial_report_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/branch');?>">view</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#user_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">User</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
                        <ul id="user_dr" class="collapse collapse-level-1">
                            <li>
                                <a href="<?php echo base_url('admin/user');?>">View</a>
                            </li>
                        </ul>
                    </li>
                    <?php
                  }
                  ?>

                  <?php
                  // if(isset($_SESSION['user_type'])){
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
     ?>

     <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#profile_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Profile</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
         <ul id="profile_dr" class="collapse collapse-level-1">
             <li>
                 <a href="<?php echo base_url('merchant/profile/').$_SESSION['id'];?>">View</a>
             </li>
         </ul>
     </li>

     <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#consignment_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Consignment</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
         <ul id="consignment_dr" class="collapse collapse-level-1">
             <li>
                 <a href="<?php echo base_url('merchant/consignment');?>">View</a>
             </li>
         </ul>
     </li>

     <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#report_drer"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Shipping</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
         <ul id="report_drer" class="collapse collapse-level-1">
             <li>
                 <a href="<?php echo base_url('merchant/shiping/index/').$_SESSION['id'];?>">List</a>
             </li>
         </ul>
     </li>

     <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#report_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Report</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
         <ul id="report_dr" class="collapse collapse-level-1">
             <li>
                 <a href="<?php echo base_url('merchant/shiping_history/index/').$_SESSION['id'];?>">Shipping History</a>
             </li>
             <li>
                 <a href="<?php echo base_url('merchant/report/financial_report');?>">Financial Report</a>
             </li>
         </ul>
     </li>

     <?php
   }
     ?>

           <?php
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery'){
      ?>
      <li>
          <a href="javascript:void(0);" data-toggle="collapse" data-target="#consignment_dr"><div class="pull-left"><i class="zmdi zmdi-shopping-basket mr-20"></i><span class="right-nav-text">Consignment</span></div><div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div><div class="clearfix"></div></a>
          <ul id="consignment_dr" class="collapse collapse-level-1">
              <li>
                  <a href="<?php echo base_url('admin/consignment');?>">View</a>
              </li>
          </ul>
      </li>
      <?php
      }
      ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /Left Sidebar Menu -->

            <!-- Right Sidebar Menu -->
            <div class="fixed-sidebar-right">
                <ul class="right-sidebar">
                    <li>
                        <div  class="tab-struct custom-tab-1">
                            <ul role="tablist" class="nav nav-tabs" id="right_sidebar_tab">
                                <li class="active" role="presentation"><a aria-expanded="true"  data-toggle="tab" role="tab" id="chat_tab_btn" href="#chat_tab">chat</a></li>
                                <li role="presentation" class=""><a  data-toggle="tab" id="messages_tab_btn" role="tab" href="#messages_tab" aria-expanded="false">messages</a></li>
                                <li role="presentation" class=""><a  data-toggle="tab" id="todo_tab_btn" role="tab" href="#todo_tab" aria-expanded="false">todo</a></li>
                            </ul>
                            <div class="tab-content" id="right_sidebar_content">
                                <div  id="chat_tab" class="tab-pane fade active in" role="tabpanel">
                                    <div class="chat-cmplt-wrap">
                                        <div class="chat-box-wrap">
                                            <div class="add-friend">
                                                <a href="javascript:void(0)" class="inline-block txt-grey">
                                                    <i class="zmdi zmdi-more"></i>
                                                </a>
                                                <span class="inline-block txt-dark">users</span>
                                                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                            <form role="search" class="chat-search pl-15 pr-15 pb-15">
                                                <div class="input-group">
                                                    <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn  btn-default"><i class="zmdi zmdi-search"></i></button>
                                                    </span>
                                                </div>
                                            </form>
                <div id="chat_list_scroll">
                    <div class="nicescroll-bar">
                        <ul class="chat-list-wrap">
                            <li class="chat-list">
                                <div class="chat-body">
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Clay Masse</span>
                                                <span class="time block truncate txt-grey">No one saves us but ourselves.</span>
                                            </div>
                                            <div class="status away"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Evie Ono</span>
                                                <span class="time block truncate txt-grey">Unity is strength</span>
                                            </div>
                                            <div class="status offline"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user2.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Madalyn Rascon</span>
                                                <span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
                                            </div>
                                            <div class="status online"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user3.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Mitsuko Heid</span>
                                                <span class="time block truncate txt-grey">I’m thankful.</span>
                                            </div>
                                            <div class="status online"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Ezequiel Merideth</span>
                                                <span class="time block truncate txt-grey">Patience is bitter.</span>
                                            </div>
                                            <div class="status offline"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Jonnie Metoyer</span>
                                                <span class="time block truncate txt-grey">Genius is eternal patience.</span>
                                            </div>
                                            <div class="status online"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user2.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Angelic Lauver</span>
                                                <span class="time block truncate txt-grey">Every burden is a blessing.</span>
                                            </div>
                                            <div class="status away"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user3.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Priscila Shy</span>
                                                <span class="time block truncate txt-grey">Wise to resolve, and patient to perform.</span>
                                            </div>
                                            <div class="status online"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <a  href="javascript:void(0)">
                                        <div class="chat-data">
                                            <img class="user-img img-circle"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user4.png" alt="user"/>
                                            <div class="user-data">
                                                <span class="name block capitalize-font">Linda Stack</span>
                                                <span class="time block truncate txt-grey">Our patience will achieve more than our force.</span>
                                            </div>
                                            <div class="status away"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="recent-chat-box-wrap">
                <div class="recent-chat-wrap">
                    <div class="panel-heading ma-0">
                        <div class="goto-back">
                            <a  id="goto_back" href="javascript:void(0)" class="inline-block txt-grey">
                                <i class="zmdi zmdi-chevron-left"></i>
                            </a>
                            <span class="inline-block txt-dark">ryan</span>
                            <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-more"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="chat-content">
                                <ul class="nicescroll-bar pt-20">
                                    <li class="friend">
                                        <div class="friend-msg-wrap">
                                            <img class="user-img img-circle block pull-left"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user.png" alt="user"/>
                                            <div class="msg pull-left">
                                                <p>Hello Jason, how are you, it's been a long time since we last met?</p>
                                                <div class="msg-per-detail text-right">
                                                    <span class="msg-time txt-grey">2:30 PM</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                    <li class="self mb-10">
                                        <div class="self-msg-wrap">
                                            <div class="msg block pull-right"> Oh, hi Sarah I'm have got a new job now and is going great.
                                                <div class="msg-per-detail text-right">
                                                    <span class="msg-time txt-grey">2:31 pm</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                    <li class="self">
                                        <div class="self-msg-wrap">
                                            <div class="msg block pull-right">  How about you?
                                                <div class="msg-per-detail text-right">
                                                    <span class="msg-time txt-grey">2:31 pm</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                    <li class="friend">
                                        <div class="friend-msg-wrap">
                                            <img class="user-img img-circle block pull-left"  src="<?php echo base_url('asset/admin/'); ?>dist/img/user.png" alt="user"/>
                                            <div class="msg pull-left">
                                                <p>Not too bad.</p>
                                                <div class="msg-per-detail  text-right">
                                                    <span class="msg-time txt-grey">2:35 pm</span>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="input-group">
                                <input type="text" id="input_msg_send" name="send-msg" class="input-msg-send form-control" placeholder="Type something">
                                <div class="input-group-btn emojis">
                                    <div class="dropup">
                                        <button type="button" class="btn  btn-default  dropdown-toggle" data-toggle="dropdown" ><i class="zmdi zmdi-mood"></i></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="javascript:void(0)">Action</a></li>
                                            <li><a href="javascript:void(0)">Another action</a></li>
                                            <li class="divider"></li>
                                            <li><a href="javascript:void(0)">Separated link</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="input-group-btn attachment">
                                    <div class="fileupload btn  btn-default"><i class="zmdi zmdi-attachment-alt"></i>
                                        <input type="file" class="upload">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="messages_tab" class="tab-pane fade" role="tabpanel">
        <div class="message-box-wrap">
            <div class="msg-search">
                <a href="javascript:void(0)" class="inline-block txt-grey">
                    <i class="zmdi zmdi-more"></i>
                </a>
                <span class="inline-block txt-dark">messages</span>
                <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-search"></i></a>
                <div class="clearfix"></div>
            </div>
            <div class="set-height-wrap">
                <div class="streamline message-box nicescroll-bar">
                    <a href="javascript:void(0)">
                        <div class="sl-item unread-message">
                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user.png" alt="avatar"/>
                            </div>
                            <div class="sl-content">
                                <span class="inline-block capitalize-font   pull-left message-per">Clay Masse</span>
                                <span class="inline-block font-11  pull-right message-time">12:28 AM</span>
                                <div class="clearfix"></div>
                                <span class=" truncate message-subject">Themeforest message sent via your envato market profile</span>
                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsu messm quia dolor sit amet, consectetur, adipisci velit</p>
                            </div>
                        </div>
                    </a>
                    <a href="javascript:void(0)">
                        <div class="sl-item">
                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="avatar"/>
                            </div>
                            <div class="sl-content">
                                <span class="inline-block capitalize-font   pull-left message-per">Evie Ono</span>
                                <span class="inline-block font-11  pull-right message-time">1 Feb</span>
                                <div class="clearfix"></div>
                                <span class=" truncate message-subject">Pogody theme support</span>
                                <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                            </div>
                        </div>
                    </a>
                    <a href="javascript:void(0)">
                        <div class="sl-item">
                            <div class="sl-avatar avatar avatar-sm avatar-circle">
                                <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user2.png" alt="avatar"/>
                            </div>
                            <div class="sl-content">
                                <span class="inline-block capitalize-font   pull-left message-per">Madalyn Rascon</span>
                                <span class="inline-block font-11  pull-right message-time">31 Jan</span>
                                                            <div class="clearfix"></div>
                                                            <span class=" truncate message-subject">Congratulations from design nominees</span>
                                                            <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="sl-item unread-message">
                                                        <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                            <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user3.png" alt="avatar"/>
                                                        </div>
                                                        <div class="sl-content">
                                                            <span class="inline-block capitalize-font   pull-left message-per">Ezequiel Merideth</span>
                                                            <span class="inline-block font-11  pull-right message-time">29 Jan</span>
                                                            <div class="clearfix"></div>
                                                            <span class=" truncate message-subject">Themeforest item support message</span>
                                                            <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="sl-item unread-message">
                                                        <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                            <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user4.png" alt="avatar"/>
                                                        </div>
                                                        <div class="sl-content">
                                                            <span class="inline-block capitalize-font   pull-left message-per">Jonnie Metoyer</span>
                                                            <span class="inline-block font-11  pull-right message-time">27 Jan</span>
                                                            <div class="clearfix"></div>
                                                            <span class=" truncate message-subject">Help with beavis contact form</span>
                                                            <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="sl-item">
                                                        <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                            <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user.png" alt="avatar"/>
                                                        </div>
                                                        <div class="sl-content">
                                                            <span class="inline-block capitalize-font   pull-left message-per">Priscila Shy</span>
                                                            <span class="inline-block font-11  pull-right message-time">19 Jan</span>
                                                            <div class="clearfix"></div>
                                                            <span class=" truncate message-subject">Your uploaded theme is been selected</span>
                                                            <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <div class="sl-item">
                                                        <div class="sl-avatar avatar avatar-sm avatar-circle">
                                                            <img class="img-responsive img-circle" src="<?php echo base_url('asset/admin/'); ?>dist/img/user1.png" alt="avatar"/>
                                                        </div>
                                                        <div class="sl-content">
                                                            <span class="inline-block capitalize-font   pull-left message-per">Linda Stack</span>
                                                            <span class="inline-block font-11  pull-right message-time">13 Jan</span>
                                                            <div class="clearfix"></div>
                                                            <span class=" truncate message-subject"> A new rating has been received</span>
                                                            <p class="txt-grey truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  id="todo_tab" class="tab-pane fade" role="tabpanel">
                                    <div class="todo-box-wrap">
                                        <div class="add-todo">
                                            <a href="javascript:void(0)" class="inline-block txt-grey">
                                                <i class="zmdi zmdi-more"></i>
                                            </a>
                                            <span class="inline-block txt-dark">todo list</span>
                                            <a href="javascript:void(0)" class="inline-block text-right txt-grey"><i class="zmdi zmdi-plus"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="set-height-wrap">
                                            <!-- Todo-List -->
                                            <ul class="todo-list nicescroll-bar">
                                                <li class="todo-item">
                                                    <div class="checkbox checkbox-default">
                                                        <input type="checkbox" id="checkbox01"/>
                                                        <label for="checkbox01">Record The First Episode</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="light-grey-hr"/>
                                                </li>
                                                <li class="todo-item">
                                                    <div class="checkbox checkbox-pink">
                                                        <input type="checkbox" id="checkbox02"/>
                                                        <label for="checkbox02">Prepare The Conference Schedule</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="light-grey-hr"/>
                                                </li>
                                                <li class="todo-item">
                                                    <div class="checkbox checkbox-warning">
                                                        <input type="checkbox" id="checkbox03" checked/>
                                                        <label for="checkbox03">Decide The Live Discussion Time</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="light-grey-hr"/>
                                                </li>
                                                <li class="todo-item">
                                                    <div class="checkbox checkbox-success">
                                                        <input type="checkbox" id="checkbox04" checked/>
                                                        <label for="checkbox04">Prepare For The Next Project</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="light-grey-hr"/>
                                                </li>
                                                <li class="todo-item">
                                                    <div class="checkbox checkbox-danger">
                                                        <input type="checkbox" id="checkbox05" checked/>
                                                        <label for="checkbox05">Finish Up AngularJs Tutorial</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="light-grey-hr"/>
                                                </li>
                                                <li class="todo-item">
                                                    <div class="checkbox checkbox-purple">
                                                        <input type="checkbox" id="checkbox06" checked/>
                                                        <label for="checkbox06">Finish Infinity Project</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <hr class="light-grey-hr"/>
                                                </li>
                                            </ul>
                                            <!-- /Todo-List -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /Right Sidebar Menu -->

            <!-- Main Content -->
            <div class="page-wrapper">
                <div class="container-fluid pt-25">
                    <?php
                    if(isset($content_head)) echo $content_head;
                    ?>
                    <?php echo $content; ?>
                    <!-- Row -->
                </div>

                <!-- Footer -->
                <footer class="footer container-fluid pl-30 pr-30">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>2020 &copy; SPEEDYPORTER.com</p>
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
        <script src="<?php echo base_url('asset/admin/'); ?>plugin/select2/js/select2.min.js"></script>
        <script src="<?php echo base_url('asset/admin/'); ?>dist/js/init.js"></script>
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

</html>


<script type="text/javascript">
$(document).ready(function () {
var url = window.location;

// Adds active on inner anchor and treeview anchor and treeview menu-open state to li
$('ul.nav a').filter(function () {
return this.href == url;
}).addClass('active').parent().parent().siblings().addClass('active').parent().addClass('menu-open');
});
</script>
