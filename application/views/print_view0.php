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
                <div>Company address</div>
                <div>Mobile: +91 0123456789</div>
                <div>Website: www.SPEEDYPORTER.com</div>
                <div>Facebook: www.facebook.com/SPEEDYPORTER </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                  <div class="to"><b>Merchant Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['company'] ?></h2>
                  <div class="address"><?php echo $merchant[0]['name'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address_2'] ?></div>
                  <?php if($consignment[0]['product_id'] != ""){
                    $productid = $consignment[0]['product_id'];
                  }else{
                    $productid = "N/A";
                  }?>
                  <div class="address">Product ID: <?php echo $productid; ?></div>
                  <div class="address"><?php echo $merchant[0]['phone'] ?></div>
                </div>
                <div id="location">
                    <div id="position">
                    <div class="to"><b>Shipping Details :</b></div>
                    <h2 class="name"><?php echo $customer[0]['recipient_name'] ?></h2>
                    <div class="address"><?php echo $customer[0]['recipient_address'] ?></div>
                    <div class="address"><?php echo $customer[0]['recipient_address_2'] ?></div>
                    <div class="address">Land Mark: <?php echo $customer[0]['recipient_landmark'] ?></div>
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
              <h3>Date: <?php echo $consignment[0]['delivery_date'] ?></h3>
              <h3>Consignment ID: <?php echo $consignment[0]['consignment_id'] ?></h3>
              <p>Total Taka: <?php echo $consignment[0]['cash_collection'] ?></p>
              <p style="padding-left: 220px;">
              Invoice was created using SPEEDYPORTER.com
            </p>
            </div>
          </div>
        <!-- </center> -->
        </main>


        <header class="clearfix">
            <div id="logo">
                <img src="<?php echo base_url(); ?>/asset/img/logo.png">
                <div id='detail'>
                <h2>Merchant Copy</h2>
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
                <!-- <h2 class="name" style="color:red;"><?php echo $merchant[0]['company'] ?></h2>
                <h2 class="name">Merchant : <?php echo $merchant[0]['name'] ?></h2>
                <div><?php echo $merchant[0]['address'] ?><?php echo $merchant[0]['address_2'] ?></div>
                <div><?php echo $merchant[0]['phone'] ?></div>
                <div><a href=""><?php echo $merchant[0]['email'] ?></a></div> -->
                <!-- <div>GSTIN: GST54841210</div> -->
                <div>Company address</div>
                <div>Mobile: +91 012345678</div>
                <div>Website: www.SPEEDYPORTER.com</div>
                <div>Facebook: www.facebook.com/SPEEDYPORTER </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                  <div class="to"><b>Merchant Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['company'] ?></h2>
                  <div class="address"><?php echo $merchant[0]['name'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address_2'] ?></div>
                  <?php if($consignment[0]['product_id'] != ""){
                    $productid = $consignment[0]['product_id'];
                  }else{
                    $productid = "N/A";
                  }?>
                  <div class="address">Product ID: <?php echo $productid; ?></div>
                  <div class="address"><?php echo $merchant[0]['phone'] ?></div>
                  <!-- <div class="email"><a href="<?php echo $customer[0]['recipient_name'] ?>"><?php echo $customer[0]['recipient_name'] ?></a></div> -->
                  <!-- <div>GSTIN: GST615484120</div> -->
                </div>
                <div id="location">
                    <div id="position">
                    <div class="to"><b>Shipping Details :</b></div>
                    <h2 class="name"><?php echo $customer[0]['recipient_name'] ?></h2>
                    <div class="address"><?php echo $customer[0]['recipient_address'] ?></div>
                    <div class="address"><?php echo $customer[0]['recipient_address_2'] ?></div>
                    <div class="address">Land Mark: <?php echo $customer[0]['recipient_landmark'] ?></div>
                    <div class="address"><?php echo $customer[0]['recipient_number'] ?></div>
                    <!-- <div class="address">City: <?php echo $customer[0]['recipient_city'] ?></div>
                    <div class="address">Pincode: <?php echo $customer[0]['recipient_postalcode'] ?></div> -->
                    <!-- <div class="email"><a href="<?php echo $customer[0]['recipient_name'] ?>"><?php echo $customer[0]['recipient_name'] ?></a></div> -->
                    <!-- <div>GSTIN: GST615484120</div> -->
                    </div>

                </div>
            </div>
            <!-- <hr>
            <hr>
            <div id="amount">
               <div id="consignment">
                    <h2 class="name">Consignment ID: <?php echo $consignment[0]['consignment_id'] ?></h2>
                </div>
                <div id="cash">
                    <h2 class="name">CASH : <?php echo $consignment[0]['grand_total'] ?></h2>

                </div>
            </div> -->
            <hr>
            <!-- <center> -->
              <div>
              <div id = "barcode">
            <img src="<?php echo base_url(); ?>tes.png">
          </div>
            <div id="thanks">
              <h3>Date: <?php echo $consignment[0]['delivery_date'] ?></h3>
              <h3>Consignment ID: <?php echo $consignment[0]['consignment_id'] ?></h3>
              <p>Total Taka: <?php echo $consignment[0]['cash_collection'] ?></p>
              <p style="padding-left: 220px;">
              Invoice was created using SPEEDYPORTER.com
            </p>
            </div>
          </div>
        <!-- </center> -->
        </main>

        <header class="clearfix">
            <div id="logo">
                <img src="<?php echo base_url(); ?>/asset/img/logo.png">
                <div id='detail'>
                <h2>Office Copy</h2>
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
                <div>Company address</div>
                <div>Mobile: +91 0123456789</div>
                <div>Website: www.SPEEDYPORTER.com</div>
                <div>Facebook: www.facebook.com/SPEEDYPORTER </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                  <div class="to"><b>Merchant Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['company'] ?></h2>
                  <div class="address"><?php echo $merchant[0]['name'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address_2'] ?></div>
                  <?php if($consignment[0]['product_id'] != ""){
                    $productid = $consignment[0]['product_id'];
                  }else{
                    $productid = "N/A";
                  }?>
                  <div class="address">Product ID: <?php echo $productid; ?></div>
                  <div class="address"><?php echo $merchant[0]['phone'] ?></div>
                </div>
                <div id="location">
                    <div id="position">
                    <div class="to"><b>Shipping Details :</b></div>
                    <h2 class="name"><?php echo $customer[0]['recipient_name'] ?></h2>
                    <div class="address"><?php echo $customer[0]['recipient_address'] ?></div>
                    <div class="address"><?php echo $customer[0]['recipient_address_2'] ?></div>
                    <div class="address">Land Mark: <?php echo $customer[0]['recipient_landmark'] ?></div>
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
              <h3>Date: <?php echo $consignment[0]['delivery_date'] ?></h3>
              <h3>Consignment ID: <?php echo $consignment[0]['consignment_id'] ?></h3>
              <p>Total Taka: <?php echo $consignment[0]['cash_collection'] ?></p>
              <p style="padding-left: 220px;">
              Invoice was created using SPEEDYPORTER.com
            </p>
            </div>
          </div>
        <!-- </center> -->
        </main>

        <header class="clearfix">
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                  <div class="to"><b>Merchant Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['company'] ?></h2>
                  <div class="address"><?php echo $merchant[0]['name'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address'] ?></div>
                  <div class="address"><?php echo $merchant[0]['address_2'] ?></div>
                  <?php if($consignment[0]['product_id'] != ""){
                    $productid = $consignment[0]['product_id'];
                  }else{
                    $productid = "N/A";
                  }?>
                  <div class="address">Product ID: <?php echo $productid; ?></div>
                  <div class="address"><?php echo $merchant[0]['phone'] ?></div>
                </div>
                <div id="location">
                    <div id="position">
                    <div class="to"><b>Shipping Details :</b></div>
                    <h2 class="name"><?php echo $customer[0]['recipient_name'] ?></h2>
                    <div class="address"><?php echo $customer[0]['recipient_address'] ?></div>
                    <div class="address"><?php echo $customer[0]['recipient_address_2'] ?></div>
                    <div class="address">Land Mark: <?php echo $customer[0]['recipient_landmark'] ?></div>
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
              Date: <?php echo $consignment[0]['delivery_date'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Consignment ID: <?php echo $consignment[0]['consignment_id'] ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              Total Taka: <?php echo $consignment[0]['cash_collection'] ?></h3>
            </div>
        <!-- </center> -->
        </main>

        <!-- <footer>
            Invoice was created using SPEEDYPORTER.com
        </footer> -->

    </body>
</html>
