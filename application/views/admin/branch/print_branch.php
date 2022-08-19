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
                  <div class="to"><b>Branch Details :</b></div>
                  <h2 class="name"><?php echo $merchant[0]['name'] ?></h2>
                  <div class="address">Address:- <?php echo $merchant[0]['address'] ?></div>
                  <div class="address">Email:- <?php echo $merchant[0]['email'] ?></div>
                  <div class="address">Phone:- <?php echo $merchant[0]['phone'] ?></div>
                  <?php $dist_name = $this->branch_model->get_where_all('district', [' id' => $merchant[0]['district'],'status' => "active"]);?>
                  <div class="address">District:- <?php echo $dist_name[0]['district_name'] ?></div>
                  <?php $p_name = $this->branch_model->get_where_all('police_station', [' id' => $merchant[0]['police_station'],'status' => "active"]);?>
                  <div class="address">Zip code:- <?php echo $p_name[0]['station_name'] ?></div>
                  <?php if($merchant[0]['cp_station'] != ""){ ?>
                  <?php $covering_stations = [];
                   $c_stations = explode(",",$merchant[0]['cp_station']);
                  foreach ($c_stations as $key => $value) {
                   $p_name = $this->branch_model->get_where_all('police_station', [' id' => $value,'status' => "active"]);
                   array_push($covering_stations,$p_name[0]['station_name']);
                 }
                 $cov_stations = implode(",",$covering_stations);
                   ?>
                  <div class="address">Zonal Area:- <?php echo $cov_stations; ?></div>
                  <?php
                }else{?>
                  <div class="address">Zonal Area:- N/A</div>
                  <?php
                }
                ?>
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
