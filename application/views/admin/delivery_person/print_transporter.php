<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Branch Details</title>
        <!-- <link rel="stylesheet" href="<?php echo base_url('asset/css/'); ?>print_style.css" media="all" /> -->
    </head>
    <body class="container">
      <center>
        <header class="clearfix">
            <div id="logo">
                <img width="10%" src="<?php echo base_url(); ?>/asset/img/logo.png">
                <!-- <h3>Branch details</h3> -->
              </div>
            <!-- </div> -->
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
                  <div class="to"><b>Transporter Details :</b></div>
                  <h2 class="name"><?php echo $transporter[0]['name'] ?></h2>
                  <?php if($transporter[0]['photo'] != ""){ ?>
                  <div class="address"><img style="width:10%" src = "<?php echo base_url("uploads/delivery_person/").$transporter[0]['photo']?>"</div>
                <?php } ?>
                  <div class="address">Transporter Unique ID:- <?php echo $transporter[0]['transporter_id'] ?></div>
                  <div class="address">ID:- <?php echo $transporter[0]['id_type'] ?>/<?php echo $transporter[0]['nid'] ?></div>
                  <div class="address">Phone:- <?php echo $transporter[0]['phone'] ?></div>
                  <div class="address">Email:- <?php echo $transporter[0]['email'] ?></div>
                  <div class="address">Address:- <?php echo $transporter[0]['address'] ?></div>
                  <div class="address">User Type:- <?php echo $transporter[0]['user_type'] ?></div>
                  <div class="address">Transporte Type:- <?php echo $transporter[0]['transporter_id'] ?></div>
                  <?php $office = $this->delivery_person_model->get_where_all('branch', [' id' => $transporter[0]['office'],'status' => "active"]); ?>
                  <div class="address">Office:- <?php echo $office[0]['name']; ?></div>
                  <?php if($transporter[0]['doc'] != ""){ ?>
                  <div class="address">Uploaded DOC:- <a href="<?php echo base_url('uploads/delivery_person')."/".$transporter[0]['doc']; ?>" class="btn btn-success btn-icon-anim btn-square list-button" title="Print" target="_blank">click</a></div>
                <?php } ?>
                </div>
            </div>
            <!-- <hr> -->
            <!-- <center> -->
              <!-- <div>
              <div id = "barcode">
            <img src="<?php echo base_url(); ?>tes.png">
          </div>
            <div id="thanks">
              <h3>Date: <?php echo $consignment[0]['delivery_date'] ?></h3>
              <h3>Consignment ID: <?php echo $consignment[0]['consignment_id'] ?></h3>
              <p>Total Taka: <?php echo $consignment[0]['amounttocollect'] ?></p>
              <p style="padding-left: 220px;">
              Invoice was created using SPEEDYPORTER.com
            </p>
            </div>
          </div> -->
        <!-- </center> -->
        </main>

        <!-- <footer>
            Invoice was created using SPEEDYPORTER.com
        </footer> -->
      </center>
    </body>
</html>
