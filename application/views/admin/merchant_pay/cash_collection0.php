<!-- <style>
table tr:not(:last-child) td:first-child::first-letter {
  text-transform: uppercase;
}
</style> -->
<div class="row">
    <div class="col-sm-12">
      <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery'){
?>
        <?php echo form_open_multipart('admin/merchant_pay/getcollectionlisted', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>
      <?php }else{?>
      <?php echo form_open_multipart('admin/merchant_pay/cash_collection', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>
      <?php
    }
    ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <!-- <?php print_r($q);?> -->
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Status<span class="help"></span></label>
                        <select id="status" name="status" class="form-control select2" >
                            <option value="">Select status</option>
                            <?php foreach ($status as $k => $v) { ?>
                            <option   value="<?php echo $v['delivery_status']; ?>" <?php echo ((isset($src['status']) && $v['delivery_status'] == $src['status'])?'selected':'');?>><?php echo $v['delivery_status']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'delivery'){
              ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Transporter<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2" >
                            <option value="">Select person</option>
                            <?php foreach ($delivery_boy as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['customer_id']) && $v['id'] == $src['customer_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>" required>
                        <input type="hidden" value="<?php echo base_url();?>" name="base_url" id="base_url">
                        <input type="hidden" value="<?php echo $_SESSION['user_type']?>" name="userType" id="userType">
                        <input type="hidden" value="<?php print_r($src);?>" name="src_data[]">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date"  name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>" required>
                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" class="btn btn-info btn-rounded">Search</button>
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

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                          <table id="datable_1" class="table table-hover display  pb-30" >
                              <thead>
                                  <tr>
                                    <th>TRANSPORTER</th>
                                    <th>ORDER DATE</th>
                                    <th>CONSIGNMENT ID</th>
                                    <th>MERCHANT DETAILS</th>
                                    <th>SHIPPING DETAILS</th>
                                    <th>STATUS</th>
                                    <th>DELIVERY DATE</th>
                                    <th>AMOUNT TO COLLECT</th>
                                    <th>LESS PAID/PARTIAL RETURN AMOUNT</th>
                                    <th>COLLECTED AMOUNT</th>
                                    <th>ACTION</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $x = 0;
                                  foreach ($rows as $k => $v) {
                                    $x++;
                                      ?>
                                      <tr>
                                        <td><?php echo $v->dp_name; ?></td>
                                        <td><?php echo $v->order_date; ?></td>
                                        <td><?php echo $v->consignment_id; ?></td>
                                        <td>Company:<?php echo $v->cus_company; ?><br>Merchant Name:<?php echo $v->cus_name; ?><br>Contact:<?php echo $v->cus_contact; ?><br>Product ID:<?php echo $v->product_id; ?></td>
                                        <td>Recipient Name:<?php echo $v->recipient_name; ?><br>Address:<?php echo $v->recipient_address; ?><?php echo $v->recipient_city; ?><?php echo $v->recipient_postalcode; ?><br>Contact:<?php echo $v->recipient_number; ?></td>
                                        <td><?php echo ucfirst($v->delivery_status); ?></td>
                                        <td><?php echo $v->delivery_date; ?></td>
                                        <td><?php echo $v->cash_collection; ?></td>
                                        <td><?php echo $v->less_paid_return; ?></td>
                                        <td><?php echo $v->amount_paid; ?></td>
                                        <td><button type="button" data-toggle="modal" data-target="#myModal<?php echo $v->id; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button></td>
                                      </tr>

                                      <div id="myModal<?php echo $v->id; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Update Consignment</h4>
                                              <div class="row text-center alert alert-danger" id="div_err" style="display:none;"></div>
                                              <div class="row text-center alert alert-success" id="div_succ" style="display:none;"></div>
                                            </div>
                                            <div class="modal-body">

                                              <?php echo form_open_multipart('admin/report/changeStatusUpdate', array("id" => "statusUpdate-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                                              <div class="panel panel-default card-view">
                                                  <div class="panel-wrapper collapse in">
                                                      <div class="panel-body">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10 text-left"> Consignment ID <span class="help"></span></label>
                                                            <input style="color:black;" type="text" id="id<?php echo $x ?>" required="" name="id" value="<?php echo $v->consignment_id; ?>" readonly class="form-control" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label mb-10 text-left">Status<span class="help"></span></label>
                                                            <select id="status<?php echo $x ?>" name="status" class="form-control paymentStatus" onChange="dropBoxChng(<?php echo $x ?>);">
                                                                <option value="">select Status</option>
                                                                <!-- <option value="pending" <?php if($v->delivery_status == 'pending'){ echo "selected";}?>>Pending</option> -->
                                                                <option value="in-transit" <?php if($v->delivery_status == 'in-transit'){ echo "selected";}?>>In-transit</option>
                                                                <option value="delivered" <?php if($v->delivery_status == 'delivered'){ echo "selected";}?>>Delivered</option>
                                                                <option value="cancelled" <?php if($v->delivery_status == 'cancelled'){ echo "selected";}?>>Cancelled</option>
                                                                <option value="reschedule" <?php if($v->delivery_status == 'reschedule'){ echo "selected";}?>>Reschedule</option>
                                                                <option value="returned" <?php if($v->delivery_status == 'returned'){ echo "selected";}?>>Returned</option>
                                                            </select>
                                                        </div>
                                                        <div id="txtBox<?php echo $x ?>" class="form-group" style="display:none;">
                                                            <label class="control-label mb-10 text-left"> New Delivery Date <span class="help"></span></label>
                                                            <input type="text" id="new_date<?php echo $x ?>" name="new_date"  class="form-control new_date" value="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label mb-10 text-left"> detail <span class="help"></span></label>
                                                            <input type="text" id="detail<?php echo $x ?>" required="" name="detail"  class="form-control datetimepicker" >
                                                        </div>

                                                    <div id = "delivery_deduction<?php echo $x ?>" style="display:none;">
                                                    <div class="form-group">
                                                      <input type="checkbox" id="deduction<?php echo $x ?>" name="deduction" value="yes">
                                                       <label for="deduction"> <b style="color:red;">Deduct delivery charge</b> (Click for Yes)</label>
                                                    </div>
                                                  </div>

                                                    <div id="txtBoxPayment<?php echo $x ?>" class="form-group" style="display:none;">
                                                      <div class="form-group">
                                                          <label class="control-label mb-10 text-left"> Payment Type <span class="help"></span></label>
                                                          <select id="paymentStatus<?php echo $x ?>" name="paymentStatus" class="form-control paymentStatus" onChange="paymentBoxChng(<?php echo $x ?>);">
                                                              <option value=""> select </option>
                                                              <option value="paid" >Paid</option>
                                                              <option value="partial" >Partial</option>
                                                          </select>
                                                      </div>
                                                      <div id="paymenttxtBox<?php echo $x ?>" class="form-group" style="display:none;">
                                                          <label class="control-label mb-10 text-left"> Amount <span class="help"></span></label>
                                                            <input type="number" id="partial_amount<?php echo $x ?>" name="partial_amount"  class="form-control" value="">
                                                      </div>
                                                    </div>

                                                    <div id = "special_note<?php echo $x ?>" style="display:none;">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10 text-left"> Note <span class="help"></span></label>
                                                        <input type="text" id="note<?php echo $x ?>" name="note"  class="form-control" >
                                                    </div>
                                                  </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <!-- <div id="itemWrap">

                                                            </div>
-->

                                            </div>
                                            <div class="modal-footer">
                                              <button id="btnSave<?php echo $v->id; ?>" type="submit" class="btn btn-info btn-rounded" >update</button>
                                              <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                          </div>

                                        </div>
                                      </div>


                                      <?php
                                  }
                                  ?>


                                  </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    var userIS='<?php echo $_SESSION['user_type'];?>';
</script>
