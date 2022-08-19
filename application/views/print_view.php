<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <link rel="stylesheet" href="<?php echo base_url('asset/css/'); ?>print_style.css" media="all" />
    </head>
    <body class="container">
        <header class="clearfix">
            <div id="logo">
                <img src="<?php echo base_url(); ?>/asset/img/logo.png">
                <div id='detail'>
                <h2>Customer Copy</h2>
                <?php if($consignment[0]['branch'] != ''){
                 $branch_office = $this->report_model->get_where_all('branch', [' id' => $consignment[0]['branch']]);?>
                <h3><?php echo $branch_office[0]['name'];?></h3>
              <?php }else{ ?>
                <h3>No Branch Available</h3>
              <?php
            }
            ?>
              </div>
            </div>
            <div id="company">
                <div>Mobile: +91 012345678</div>
                <div>Website: www.SPEEDYPORTER.com</div>
                <div>Facebook: www.facebook.com/SPEEDYPORTER </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client" style=" width:150px;">
                  <div class="to"><b>Merchant Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['company'] ?></h2>
                  <div class="address"><?php echo $merchant[0]['phone'] ?></div>
                  <?php if($consignment[0]['product_id'] != ""){
                    $productid = $consignment[0]['product_id'];
                  }else{
                    $productid = "N/A";
                  }?>
                  <div class="address">Product ID: <?php echo $productid; ?></div>
                </div>
                <div id="location" style="width:50%;height:auto;">
                    <div id="position">
                    <div class="to"><b>Shipping Details :</b></div>
                    <h2 class="name"><?php echo $customer[0]['recipient_name'] ?></h2>
                    <div class="address"><?php echo $customer[0]['recipient_address'] ?>,<?php echo $district[0]['district_name'] ?></div>
                    <!-- <div class="address"><?php echo $customer[0]['recipient_address_2'] ?></div> -->
                    <!-- <div class="address">Land Mark: <?php echo $customer[0]['recipient_landmark'] ?></div> -->
                    <div class="address"><?php echo $customer[0]['recipient_number'] ?></div>
                    <!-- <div class="address">City: <?php echo $customer[0]['recipient_city'] ?></div>
                    <div class="address">Pincode: <?php echo $customer[0]['recipient_postalcode'] ?></div> -->
                    </div>

                </div>
            </div>
            <hr>
            <!-- <center> -->
              <div>
              <div id = "barcode">
            <img src="<?php echo base_url(); ?>tes.png">
          </div>
            <div id="thanks">
              <h3>Date: <?php $dt = new DateTime($consignment[0]['timestamp']);echo $dt->format('d,M Y'); ?></h3>
              <h3>Consignment ID: <?php echo $consignment[0]['consignment_id'] ?></h3>
              <p>Total Taka: <?php echo $consignment[0]['cash_collection'] ?></p>

            </div>
          </div>
        <!-- </center> -->
        </main>

        <header class="clearfix">
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client" style=" width:150px;">
                  <div class="to"><b>Merchant Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['company'] ?></h2>
                  <div class="address"><?php echo $merchant[0]['phone'] ?></div>
                  <?php if($consignment[0]['product_id'] != ""){
                    $productid = $consignment[0]['product_id'];
                  }else{
                    $productid = "N/A";
                  }?>
                  <div class="address">Product ID: <?php echo $productid; ?></div>
                </div>
                <div id="location" style="width:50%;height:auto;">
                    <div id="position">
                    <div class="to"><b>Shipping Details :</b></div>
                    <h2 class="name"><?php echo $customer[0]['recipient_name'] ?></h2>
                    <div class="address"><?php echo $customer[0]['recipient_address'] ?>,<?php echo $district[0]['district_name'] ?></div>
                    <!-- <div class="address"><?php echo $customer[0]['recipient_address_2'] ?></div> -->
                    <!-- <div class="address">Land Mark: <?php echo $customer[0]['recipient_landmark'] ?></div> -->
                    <div class="address"><?php echo $customer[0]['recipient_number'] ?></div>
                    <!-- <div class="address">City: <?php echo $customer[0]['recipient_city'] ?></div>
                    <div class="address">Pincode: <?php echo $customer[0]['recipient_postalcode'] ?></div> -->
                    </div>

                </div>
            </div>
            <hr>
            <!-- <center> -->
            <div style="float:left;">
              <h3>Transporter Copy &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Date: <?php $dt = new DateTime($consignment[0]['timestamp']);echo $dt->format('d,M Y'); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Consignment ID: <?php echo $consignment[0]['consignment_id'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Total Taka: <?php echo $consignment[0]['cash_collection'] ?></h3>
            </div>
            <!-- <p style="padding-left: 220px;width:250px;"> -->
            <p>
            Note:- <?php echo $consignment[0]['instructions'] ?>
          </p>
        <!-- </center> -->
        </main>

        <!-- <footer>
            Invoice was created using SPEEDYPORTER.com
        </footer> -->

    </body>
</html>
