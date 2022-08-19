<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Consignment No. <span class="help"></span></label>
                        <input type="text" id="cons_no"  name="cons_no"  class="form-control" value="">
                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" onclick="getConsDetail();" class="btn btn-info btn-rounded">Search</button>
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                    </div>

                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
    </div>
</div>



<div class="row" id="consDetailedView" style="display:none;">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <?php echo form_open_multipart('admin/consignment/save_correction', array("id" => "updatecons-form", "method" => "post","enctype" => "multipart/form-data")); ?>


                  <div class="form-group">
                      <div class="col-sm-6">
                        <h5>Merchant Details:-</h5>
                        <p id="merch_company"></p>
                        <p id="merch_name"></p>
                        <p id="merch_add"></p>
                        <p id="merch_cont"></p>
                      </div>
                      <div class="col-sm-6">
                        <h5>Shipping Details:-</h5>
                        <p id="ship_name"></p>
                        <p id="ship_add"></p>
                        <p id="ship_cont"></p>
                        <p>.</p>
                    </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 15px;">
                        <label class="control-label mb-10 text-left">Parcel Value <span class="help"></span></label>
                        <input type="text" id="total_price_product" name="total_price_product" value="" class="form-control" placeholder="Parcel Value" autocomplete="off" >
                      </div>
                      <div class="col-sm-6" style="margin-top: 15px;">
                      <label class="control-label mb-10 text-left"> Delivery Charge <span class="help"></span></label>
                      <input type="text" class="form-control" required=""  placeholder="Delivery charge" value="" id="total_price" name="total_price" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">COD Charge <span class="help"></span></label>
                        <input type="text" id="total_cod_charge" name="total_cod_charge" value="" class="form-control" placeholder="COD charge" autocomplete="off" >
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Cash Collection <span class="help"></span></label>
                      <input type="text" class="form-control" required=""  placeholder="Cash collection amount" value="" id="cash_collection_amount" name="cash_collection_amount" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                  <div class="col-sm-6" style="margin-top: 5px;">
                    <label class="control-label mb-10 text-left"> Status <span class="help"></span></label>
                    <select id="delivery_status" name="delivery_status" class="form-control select2" required>
                      <option value="pending">New</option>
                      <option value="in-transit">in-transit</option>
                      <option value="delivered">Delivered</option>
                      <option value="cancelled">Cancelled</option>
                      <option value="reschedule">Reschedule</option>
                      <option value="returned">Returned</option>
                    </select>
                  </div>
                  <div class="col-sm-6" style="margin-top: 5px;">
                  <label class="control-label mb-10 text-left"> Less Paid Amount <span class="help"></span></label>
                  <input type="text" class="form-control" required=""  placeholder="Less paid amount" value="" id="less_paid_return" name="less_paid_return" autocomplete="off">
                </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Collected Amount <span class="help"></span></label>
                      <input type="text" id="amount_paid" name="amount_paid" value="" class="form-control" placeholder="Collected amount" autocomplete="off" >
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px;">
                    <label class="control-label mb-10 text-left"> Return Charge <span class="help"></span></label>
                    <input type="text" class="form-control" required=""  placeholder="Return charge" value="" id="deduction_amount" name="deduction_amount" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Pay to merchant <span class="help"></span></label>
                      <input type="text" id="paytomerch" name="paytomerch" value="" class="form-control" placeholder="Pay to merchant" autocomplete="off" >
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px;">
                    <label class="control-label mb-10 text-left"> Reschedule date <span class="help"></span></label>
                    <input type="text" class="form-control datepicker" required=""  placeholder="1970-01-01" value="" id="new_deliverydate" name="new_deliverydate" autocomplete="off">
                  </div>
                </div>

                <div class="form-group">
                <div class="col-sm-6" style="margin-top: 5px;">
                  <label class="control-label mb-10 text-left"> Merchant payment status <span class="help"></span></label>
                  <select id="payment_status_merchant" name="payment_status_merchant" class="form-control select2" required>
                    <option value="due">Due</option>
                    <option value="paid">Paid</option>
                  </select>
                </div>

                <div class="col-sm-6" style="margin-top: 5px;">
                  <label class="control-label mb-10 text-left"> Cash Collection status <span class="help"></span></label>
                  <select id="collection_status" name="collection_status" class="form-control select2" required>
                    <option value="due">Due</option>
                    <option value="received">Received</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
              <div class="col-sm-6" style="margin-top: 5px;">
                <label class="control-label mb-10 text-left">payment status <span class="help"></span></label>
                <select id="payment_status" name="payment_status" class="form-control select2" required>
                  <option value="due">Due</option>
                  <option value="paid">Paid</option>
                  <option value="partial">Partial</option>
                </select>
              </div>

              <div class="col-sm-6" style="margin-top: 5px;">
                <label class="control-label mb-10 text-left">Deduction status <span class="help"></span></label>
                <select id="deduct_status" name="deduct_status" class="form-control select2" required>
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>
            </div>

            <div class="form-group">
                <div class="col-sm-6" style="margin-top: 5px;">
                  <label class="control-label mb-10 text-left">Deduction Amount <span class="help"></span></label>
                  <input type="number" id="deductamnt" name="deductamnt" value="" class="form-control" placeholder="Amount To Deduct" autocomplete="off" >
                </div>
            </div>

                  <div class="form-group text-center">
                    <div class="col-sm-12" style="margin-top: 50px;">
                      <input type="hidden" value="" id="id" name="id">
                      <input type="hidden" id="base_url" value="<?php echo base_url();?>">
                      <button type="submit" class="btn btn-info btn-rounded">Update</button>
                      <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                    </div>
                  </div>
                  <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
