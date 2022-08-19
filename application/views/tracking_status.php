<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/asset/new/css/tracking_style.css">
<section class="tracking_area">
  <div class="container px-1 px-md-4 py-5 mx-auto">
  <div class="card">
    <?php if(!empty($consignment_id)){?>
      <div class="row d-flex justify-content-between px-3 top">
          <div class="d-flex">
              <h5>Consignment No: <span class="text-primary font-weight-bold"><?php echo $consignment_id[0]['consignment_id']?></span></h5>
          </div>
          <div class="d-flex flex-column text-sm-right">
              <p class="mb-0">Expected Arrival <span><?php echo $consignment_id[0]['delivery_date']?></span></p>
              <!-- <p>USPS <span class="font-weight-bold">234094567242423422898</span></p> -->
          </div>
      </div> <!-- Add class 'active' to progress -->
      <div class="row d-flex justify-content-center">
          <div class="col-12">
              <ul id="progressbar" class="text-center">
                <?php if($consignment_id[0]['delivery_status'] == 'pending' && $consignment_id[0]['cons_status'] == 'received'){
                  $delstatus = 'Pickup Done';
                }else{
                  $delstatus = $consignment_id[0]['delivery_status'];
                }?>
                <?php if($delstatus == 'pending') {?>
                  <li class="active step0"></li>
                  <li class="step0"></li>
                  <li class="step0"></li>
                  <li class="step0"></li>
                <?php }elseif ($delstatus == 'Pickup Done') { ?>
                  <li class="active step0"></li>
                  <li class="active step0"></li>
                  <li class="step0"></li>
                  <li class="step0"></li>
                <?php }elseif ($delstatus == 'in-transit') { ?>
                  <li class="active step0"></li>
                  <li class="active step0"></li>
                  <li class="active step0"></li>
                  <li class="step0"></li>
                <?php }elseif ($delstatus == 'delivered') { ?>
                  <li class="active step0"></li>
                  <li class="active step0"></li>
                  <li class="active step0"></li>
                  <li class="active step0"></li>
                <?php } ?>
              </ul>
          </div>
      </div>
      <div class="row justify-content-between top">
          <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
              <div class="d-flex flex-column">
                  <p class="font-weight-bold">Order<br>Processed</p>
              </div>
          </div>
          <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
              <div class="d-flex flex-column">
                  <p class="font-weight-bold">Order<br>Received</p>
              </div>
          </div>
          <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
              <div class="d-flex flex-column">
                  <p class="font-weight-bold">Order<br>En Route</p>
              </div>
          </div>
          <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
              <div class="d-flex flex-column">
                  <p class="font-weight-bold">Order<br>Delivered</p>
              </div>
          </div>
      </div>
      <div class="row d-flex justify-content-between px-3 top">
      <div class="d-flex">
          <h5><span class="text-primary font-weight-bold">Consignment History: </span></h5>
      </div>
    </div>
      <div class="row d-flex justify-content-between px-3 top">
        <table class="table-striped" style="width:100%">
  <tr>
    <th>Status</th>
    <th>Event</th>
    <th style="float:right;">Date</th>
  </tr>
  <?php foreach ($consignment as $key => $v): ?>
  <tr>
    <td><?php if($v['consignment_status'] == ""){echo "New";}else{ echo $v['consignment_status'];}?></td>
    <td><?php echo $v['detail']?></td>
    <td style="float:right;"><?php echo $v['date']?></td>
  </tr>
  <?php endforeach; ?>
</table>
      </div>
    <?php }else{ ?>
      <center>
        <div class="wrong_awb" style="margin-top: 20px;">
        <i style="color:red;" class="fa fa-chain-broken fa-5x" aria-hidden="true"></i><br><br> <h4><b>#Oops invalid consignment no.</b></h4>
      </div>
      </center>

    <?php } ?>
  </div>
</div>
</section>
<?php
    echo $this->load->view('front/layout/subscribe', [], true);
?>
