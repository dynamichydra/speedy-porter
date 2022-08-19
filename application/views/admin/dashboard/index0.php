<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'branch'){
?>

<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/dashboard', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office_id" name="office_id" class="form-control select2" >
                            <option value="">Select Office</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
          <?php echo form_close(); ?>
    </div>
</div>

<!-- Row -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $today_new_order[0]['total_order'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">TOTAL ORDER</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_cancelled[0]['total_cancelled_till_date'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">PARCEL CANCELLED</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
    ?>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_received[0]['total_receved'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">PARCEL RECEIVED</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $new_order[0]['total_order_today'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">NEW ORDER</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /Row -->

<!-- Row -->
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_in_transit[0]['total_intransit'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">PARCEL IN-TRANSIT</span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                  <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_delivery[0]['total_delivery_till_date'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">PARCEL DELIVERED</span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                  <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_rescheduled[0]['total_reschedule'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">PARCEL RESCHEDULED</span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                  <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <?php
  }
  ?>

    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-yellow">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_pending[0]['total_pending_till_date'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel To Deliver</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_returned[0]['total_return'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">PARCEL RETURNED</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                    <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
<hr class="dashboard_partition">
<!-- Row -->
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $paidAmount[0]['paidAmount'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">Cash Collection</span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                  <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $cash_due[0]['cashDueAmount'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">Cash Collection Due </span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                  <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $paidAmount_tomerchant[0]['toatl_paid_merchant'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Merchant Payment</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $mp_due; ?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Merchant Payment Due</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                    <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
<!-- Row -->
<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $sumdcpaid; ?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Delivery Charge Collection</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $sumdcdue; ?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Delivery Charge Due</span>
                                </div>
                                <!-- <div class="col-xs-11 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $cashin[0]['cash_in'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">CASH-IN</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom ">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $cashout[0]['cash_out'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">CASH-OUT</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
          <div class="panel panel-default card-view pa-0 custom-change">
              <div class="panel-wrapper collapse in">
                  <div class="panel-body pa-0">
                      <div class="sm-data-box bg-custom ">
                          <div class="container-fluid">
                              <div class="row">
                                  <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                      <span class="txt-light block counter"><span class="counter-anim"><?php echo $balance;?></span></span>
                                      <span class="weight-500 uppercase-font txt-light block">Balance</span>
                                  </div>
                                  <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                      <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                                  </div> -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  <?php
}
?>
<!-- /Row -->
<?php
}
?>

<!-- for merchant section  -->
<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'red'){
?>
<h3>Dashboard Section is under maintenance,we will be back soon! sorry for the inconvinience caused.</h3>
<?php
}
?>

<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
?>
<!-- <h3 style="color:red;">This Software is in Beta Version, In Case Of Any Issue Please Contact SPEEDYPORTER Office: 01401333000</h3> -->
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/dashboard', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
          <?php echo form_close(); ?>
    </div>
</div>
<!-- Row -->
<div class="row">
  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom ">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_order[0]['total_order'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">Total Order</span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                  <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_cancelled[0]['total_cancelled_till_date'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel Cancelled</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                    <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_received[0]['total_receved'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel Received</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $today_new_order[0]['total_order_today'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">New Order</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- /Row -->

<!-- Row -->
<div class="row">

  <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="panel panel-default card-view pa-0 custom-change">
          <div class="panel-wrapper collapse in">
              <div class="panel-body pa-0">
                  <div class="sm-data-box bg-custom">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_intransit[0]['total_intransit'];?></span></span>
                                  <span class="weight-500 uppercase-font txt-light block">Parcel In-Transit</span>
                              </div>
                              <!-- <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                  <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                              </div> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_delivery[0]['total_delivery_till_date'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel Delivered</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_reschedule[0]['total_reschedule'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel Rescheduled</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_returned[0]['total_return'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel Returned</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
<hr class="dashboard_partition">
<!-- Row -->
<div class="row">

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter">TK. <span class="counter-anim"><?php echo $total_sales[0]['totalsales'] ?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total Sales</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <?php if($_SESSION['id'] == 143){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 207){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 299){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 140){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 333){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 204){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 145){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 160){
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  } else if($_SESSION['id'] == 324){
                                    $totalpaid = round($total_paid[0]['totalpaid']+1388);
                                    $add = "";
                                  } else if($_SESSION['id'] == 152){
                                    $totalpaid = round($total_paid[0]['totalpaid']+128);
                                    $add = "";
                                  } else{
                                    $totalpaid = round($total_paid[0]['totalpaid']);
                                    $add = "";
                                  }
                                  ?>
                                    <span class="txt-light block counter">TK. <span class="counter-anim"><?php echo "$totalpaid";?></span><?php echo "$add";?></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total Received Amount</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                  <?php if($_SESSION['id'] == 143){
                                    $totaldcpaid = round($total_dcpaid-480);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 207){
                                    $totaldcpaid = round($total_dcpaid-900);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 299){
                                    $totaldcpaid = round($total_dcpaid-933);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 140){
                                    $totaldcpaid = round($total_dcpaid-1935);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 333){
                                    $totaldcpaid = round($total_dcpaid-3921);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 204){
                                    $totaldcpaid = round($total_dcpaid);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 145){
                                    $totaldcpaid = round($total_dcpaid-1241);
                                    $adddc = "";
                                  } else if($_SESSION['id'] == 160){
                                    $totaldcpaid = round($total_dcpaid-791);
                                    $adddc = "";
                                  }
                                  //  else if($_SESSION['id'] == 152){
                                  //   $totaldcpaid = round($total_dcpaid+128);
                                  //   $adddc = "";
                                  // }
                                  else{
                                    $totaldcpaid = round($total_dcpaid);
                                    $adddc = "";
                                  }
                                  ?>
                                    <span class="txt-light block counter">TK. <span class="counter-anim"><?php echo $totaldcpaid ;?></span><?php echo $adddc ;?></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total DC Paid</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                    <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0 custom-change">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-custom">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-11 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter">TK. <span class="counter-anim"><?php echo $total_due; ?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total Due Amount</span>
                                </div>
                                <!-- <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->
<?php
}
?>
<!-- for merchant section end -->

<?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery'){
?>
<!-- Row -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-pink">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_deliveries[0]['totaldeliveries'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Parcel Delivered</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-male-female txt-light data-right-rep-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-brown">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_deliveries_today[0]['totaldeliveries_today'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total Deliveries Today</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-redo txt-light data-right-rep-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-yellow">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_pending[0]['total_pending_till_date'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total Order pending</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                    <i class="zmdi zmdi-file txt-light data-right-rep-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box bg-red">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                    <span class="txt-light block counter"><span class="counter-anim"><?php echo $total_cancelled[0]['total_cancelled_till_date'];?></span></span>
                                    <span class="weight-500 uppercase-font txt-light block">Total Order cancelled</span>
                                </div>
                                <div class="col-xs-6 text-center  pl-0 pr-0 pt-25  data-wrap-right">
                                    <div id="sparkline_4" style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
  </div>
<!-- Row -->
<?php
}
?>

<!-- Row -->
<!-- <div class="row">
    <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">social campaigns</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <a href="#" class="pull-left inline-block full-screen mr-15">
                        <i class="zmdi zmdi-fullscreen"></i>
                    </a>
                    <div class="pull-left inline-block dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                        <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>Edit</a></li>
                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>Delete</a></li>
                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Campaign</th>
                                        <th>Client</th>
                                        <th>Changes</th>
                                        <th>Budget</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="txt-dark weight-500">Facebook</span></td>
                                        <td>Beavis</td>
                                        <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>2.43%</span></span></td>
                                        <td>
                                            <span class="txt-dark weight-500">$1478</span>
                                        </td>
                                        <td>
                                            <span class="label label-primary">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="txt-dark weight-500">Youtube</span></td>
                                        <td>Felix</td>
                                        <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>1.43%</span></span></td>
                                        <td>
                                            <span class="txt-dark weight-500">$951</span>
                                        </td>
                                        <td>
                                            <span class="label label-danger">Closed</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="txt-dark weight-500">Twitter</span></td>
                                        <td>Cannibus</td>
                                        <td><span class="txt-danger"><i class="zmdi zmdi-caret-down mr-10 font-20"></i><span>-8.43%</span></span></td>
                                        <td>
                                            <span class="txt-dark weight-500">$632</span>
                                        </td>
                                        <td>
                                            <span class="label label-default">Hold</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="txt-dark weight-500">Spotify</span></td>
                                        <td>Neosoft</td>
                                        <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>7.43%</span></span></td>
                                        <td>
                                            <span class="txt-dark weight-500">$325</span>
                                        </td>
                                        <td>
                                            <span class="label label-default">Hold</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="txt-dark weight-500">Instagram</span></td>
                                        <td>Hencework</td>
                                        <td><span class="txt-success"><i class="zmdi zmdi-caret-up mr-10 font-20"></i><span>9.43%</span></span></td>
                                        <td>
                                            <span class="txt-dark weight-500">$258</span>
                                        </td>
                                        <td>
                                            <span class="label label-primary">Active</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Advertising & Promotions</h6>
                </div>
                <div class="pull-right">
                    <a href="#" class="pull-left inline-block refresh mr-15">
                        <i class="zmdi zmdi-replay"></i>
                    </a>
                    <div class="pull-left inline-block dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
                        <ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
                            <li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div>
                        <canvas id="chart_2" height="253"></canvas>
                    </div>
                    <div class="label-chatrs mt-30">
                        <div class="inline-block mr-15">
                            <span class="clabels inline-block bg-yellow mr-5"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Active</span>
                        </div>
                        <div class="inline-block mr-15">
                            <span class="clabels inline-block bg-red mr-5"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Closed</span>
                        </div>
                        <div class="inline-block">
                            <span class="clabels inline-block bg-green mr-5"></span>
                            <span class="clabels-text font-12 inline-block txt-dark capitalize-font">Hold</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

<script>
$(document).ready(function() {



    $(".select2").select2();

    $('#from_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });
    $('#to_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });


} );
</script>
