<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/changeStatusUpdate', array("id" => "update-status-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> Consignment ID <span class="help"></span></label>
                        <input style="color:black;" type="text" id="id" required="" name="id" value="<?php echo $consignment[0]['consignment_id']?>" readonly class="form-control" >
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">status<span class="help"></span></label>
                        <select id="status" name="status" class="form-control paymentStatus" onChange="dropBoxChng();">
                            <option value="">Select status</option>
                            <option value="pending" <?php if($consignment[0]['delivery_status'] == 'pending'){ echo "selected";}?>>Pending</option>
                            <option value="in-transit" <?php if($consignment[0]['delivery_status'] == 'in-transit'){ echo "selected";}?>>In-transit</option>
                            <option value="delivered" <?php if($consignment[0]['delivery_status'] == 'delivered'){ echo "selected";}?>>Delivered</option>
                            <option value="cancelled" <?php if($consignment[0]['delivery_status'] == 'cancelled'){ echo "selected";}?>>Cancelled</option>
                            <option value="reschedule" <?php if($consignment[0]['delivery_status'] == 'reschedule'){ echo "selected";}?>>Reschedule</option>
                            <option value="returned" <?php if($consignment[0]['delivery_status'] == 'returned'){ echo "selected";}?>>Returned</option>
                        </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label mb-10 text-left">choose secondary status<span class="help"></span></label>
                            <select id="secondary_status" name="secondary_status" class="form-control paymentStatus select2">
                                <option value="">Select status</option>
                                <option value="Picked-up from" <?php if($consignment[0]['delivery_status'] == 'Picked-up from'){ echo "selected";}?>>Picked-up from</option>
                                <option value="Deposited to" <?php if($consignment[0]['delivery_status'] == 'Deposited to'){ echo "selected";}?>>Deposited to</option>
                            </select>
                            </div>
                        <div class="form-group col-md-3">
                            <label class="control-label mb-10 text-left">Branch<span class="help"></span></label>
                        <select id="branch" name="branch" class="form-control select2" >
                            <option value="">select branch</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option   value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div id="txtBoxPayment" class="form-group col-md-3" style="display:none;">
                      <div class="form-group col-md-6">
                          <label class="control-label mb-10 text-left"> Payment Type <span class="help"></span></label>
                          <select id="paymentStatus" name="paymentStatus" class="form-control paymentStatus" onChange="paymentBoxChng();">
                              <option value=""> select </option>

                              <option value="due" >Due</option>
                              <option value="paid" >Paid</option>
                              <option value="partial" >Partial</option>
                          </select>
                      </div>
                      <div id="paymenttxtBox" class="form-group col-md-6" style="display:none;">
                          <label class="control-label mb-10 text-left"> Amount <span class="help"></span></label>
                            <input type="text" id="partial_amount" name="partial_amount"  class="form-control" value="">
                      </div>
                    </div>

                    <div id="txtBox" class="form-group col-md-3" style="display:none;">
                        <label class="control-label mb-10 text-left"> New Delivery Date <span class="help"></span></label>
                        <input type="text" id="new_date" name="new_date"  class="form-control" value="<?php if($consignment[0]['new_deliverydate']!= "") echo $consignment[0]['new_deliverydate']?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left"> detail <span class="help"></span></label>
                        <input type="text" id="detail" required="" name="detail"  class="form-control datetimepicker" >
                    </div>

                    <div id = "special_note" style="display:none;">
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left"> Note <span class="help"></span></label>
                        <input type="text" id="note" name="note"  class="form-control" >
                    </div>
                  </div>
                    <!-- <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" >
                    </div> -->
                    <button style="float:right;" type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Update</button>

                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
          <?php echo form_close(); ?>
    </div>


                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Event</th>
                                        <!-- <th>Status</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($consignmentDetail)){
                                    foreach ($consignmentDetail as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?php echo $v['date'] ?></td>
                                            <td><?php echo $v['consignment_status'] ?></td>
                                            <td><?php echo $v['detail'] ?><?php if(!empty($v['branch'])){?><p style="color:red"><?php echo $v['branch']?></p><?php } ?></td>
                                            <!-- <td><?php echo $v['Status'] ?></td> -->

                                        </tr>


                                        <?php
                                    }
                                    }
                                    ?>


                                    </tbody>
                            </table>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    var userIS='<?php echo $_SESSION['user_type'];?>';
</script>
