<?php error_reporting(0);?>
<style>
.ui-corner-all {
  z-index: 9999999;
}
</style>
<h4> note:- please press <span style="color:red">ctrl+shift+R</span> before creating a consignment.</h4>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/consignment/createsave', array("id" => "creatconsignment-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($row) && $row['consignment_id'] != ""){
                  ?>
                  <div class="form-group col-md-12">
                          <label class="control-label mb-10 text-left">Consignment ID<span class="help"></span></label>
                          <input type="text" style="color:black" name="consignment_id" id="consignment_id" value="<?php echo (isset($row)) ? $row["consignment_id"] : ""; ?>" class="form-control" readonly>
                      </div>
                  <?php
                }else{
                ?>
                <div class="form-group col-md-12">
                        <label class="control-label mb-10 text-left">Consignment ID<span class="help"></span></label>
                        <input type="text" style="color:black" name="consignment_id" id="consignment_id" value="<?php echo (isset($autono)) ? $autono : ""; ?>" class="form-control" readonly>
                    </div>
                    <?php
                  }
                  ?>

                    <!-- <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Shipping address</label><span style="float:right;display:block;" id="myBtn" class="addnewshipping"><a href="#" data-toggle="modal" data-target="#responsive-modal">+Add New Shipping</a></span>

                        <input type="text" style="color:black" id="recipient_address_detail" required="" name="recipient_address_detail" placeholder="Receipient Details" class="form-control" value="" readonly>
                        <input type="hidden" id="recipient_address" required="" name="recipient_address" value="<?php echo (isset($row)) ? $row["recipient_address"] : " "; ?>">
                        <input type="hidden" id="customeridd" name="customer" value="<?php if(!empty($_SESSION) && $_SESSION['id'] != "") echo $_SESSION['id']?>">
                        <input type="hidden" name="shiping" id="shiping" value="<?php if(!empty($_SESSION) && $_SESSION['id'] != "") echo $_SESSION['id']?>">
                        <input type="hidden" name="service_area" id="service_area" value="">
                    </div> -->

                </div>
            </div>
        </div>

<h5 class="modal-title">Shipping Detais:-</h5>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="col-sm-6" style="margin-top: 5px;" id="recipient_name_div">
                      <label class="control-label mb-10 text-left">Recipient Name <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="text" class="form-control" required=""  placeholder="Recipient Name" value="" id="recipient_name" name="recipient_name" autocomplete="off">
                  </div>
                  <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Recipient Number <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="number" class="form-control recipient_number" data-tag="rcpnt_num" required="" placeholder="Recipient Number" value="" id="recipient_number"  name="recipient_number" autocomplete="off" minlength="11" maxlength="11" onfocusout="checkMobile();">
                      <input type="hidden" class="form-control"  required="" value="" id="recipient_data_id"  name="recipient_data_id" autocomplete="off">
                      <input type="hidden" id="customeridd" name="customer" value="<?php if(!empty($_SESSION) && $_SESSION['id'] != "") echo $_SESSION['id']?>">
                      <input type="hidden" name="shiping" id="shiping" value="<?php if(!empty($_SESSION) && $_SESSION['id'] != "") echo $_SESSION['id']?>">
                      <input type="hidden" name="service_area" id="service_area" value="">
                      <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
                  </div>
                  <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Recipient Address <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="text" id="recipient_address_shipping" required="" placeholder="street name/House no./road name etc." name="recipient_address_shipping" placeholder="recipient Address" class="form-control" autocomplete="off" value="">
                      <input type="hidden" id="recipient_address" required="" name="recipient_address" value="<?php echo (isset($row)) ? $row["recipient_address"] : "0"; ?>">
                  </div>
                    <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_dist">
                      <label class="control-label mb-10 text-left"> District <b style="color:red;">*</b><span class="help"></span></label>
                      <select id="district" required name="district" class="form-control select2 district-cls" >
                          <option value="">Select district</option>
                          <?php foreach ($district as $k => $v) { ?>
                          <option value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_ps">
                    <label class="control-label mb-10 text-left"> Zip code <b style="color:red;">*</b><span class="help"></span></label>
                    <select id="police_station" required name="police_station" class="form-control select2 police_station_cls" >
                      <option value="">Select district first</option>

                    </select>
                  </div>
                </div>
              </div>
            </div>
<h5 class="modal-title">Consignment Detais:-</h5>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Product ID / Merchant Order ID<span class="help"></span></label>
                        <input type="text" class="form-control"  placeholder="Have any particular product id ?" value="<?php echo (isset($row)) ? $row["product_id"] : ""; ?>" id="product_id" name="product_id" autocomplete="off">
                        <input type="hidden" name="parcel_type" value="parcel">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Category<span class="help"></span></label>
                        <select id="parcel_cat" name="parcel_cat" class="form-control select2" required>
                            <option value="">Select Category</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'accessories') { ?>selected <?php } ?> value="accessories">Accessories</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'cloths') { ?>selected <?php } ?> value="cloths">Cloths</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'cosmetics') { ?>selected <?php } ?> value="cosmetics">Cosmetics</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'electronics') { ?>selected <?php } ?> value="electronics">Electronics</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'fragile') { ?>selected <?php } ?> value="fragile">Fragile</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'grocery') { ?>selected <?php } ?> value="grocery">Grocery</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'liquid') { ?>selected <?php } ?> value="liquid">Liquid</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'shoe') { ?>selected <?php } ?> value="shoe">Shoe</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'others') { ?>selected <?php } ?> value="others">Others</option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                      <h3>Total Calculation:-</h3><br>
                      <!-- <h5>Parcel Price : -                  <span id = "tprice_product" style="float:right">0</span></h5> -->
                      <h5>Cash Collection : -                  <span id = "tcash_collect" style="float:right">0</span></h5>
                    </div>
                  </div>
                    <div class="form-group col-md-12">
                      <div class="form-group col-md-4" style="display:none;">
                          <label class="control-label mb-10 text-left"> No of items <span class="help"></span></label>
                          <input type="number" min="1" max="1" id="no_of_items" required="" name="no_of_items" placeholder="Total no of items" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["no_of_items"] : "1"; ?>">
                      </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Weight (<b>Kg</b>)<span class="help"></span></label>
                        <input type="number" class="form-control productWeight" required="" min="1" max="5"  placeholder="Product weight" value="<?php echo (isset($row)) ? $row["product_weight"] : ""; ?>" id="product_weight" name="product_weight" autocomplete="off">
                        <input type="hidden" id="package_name" name="package_name" value="<?php if(!empty($_SESSION) && $_SESSION['package'] != ""){ echo $_SESSION['package'];}else{echo '15';}?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel price<span class="help"></span></label>
                        <input type="number" class="form-control" required=""  placeholder="Product Price" value="<?php echo (isset($row)) ? $row["product_price"] : ""; ?>" id="product_price" name="product_price" autocomplete="off">
                        <small style="margin-left: -5px;"><span style="color:red;">Note:- </span> If the parcel price is found wrong, No demurrage will be settled in case of parcel missing/damage.</small>
                        <input type="hidden" name="package_price" value="">
                    </div>

                    <div class="form-group col-md-4">
                      <h5>Delivery Charge : -                  <span id = "td_charge" style="float:right">0</span></h5><br>
                      <h5>COD Charge : -                  <span id = "tcod_charge" style="float:right">0</span></h5>
                    </div>
                  </div>
                    <div class="form-group col-md-12">

                      <div class="form-group col-md-4" style="display:none;">
                          <label class="control-label mb-10 text-left">DC Payment method<span class="help"></span></label>
                          <select id="payment_method" name="payment_method" class="form-control select2" required>
                              <!-- <option value="">Select payement method</option> -->
                              <option <?php if(!empty($row) && $row['payment_method'] == 'merch_will_pay') { ?>selected <?php } ?> value="merch_will_pay">I Will Pay</option>
                              <!-- <option <?php if(!empty($row) && $row['payment_method'] == 'merch_paid') { ?>selected <?php }?> value="merch_paid">I Paid</option> -->
                              <option <?php if(!empty($row) && $row['payment_method'] == 'cod') { ?>selected <?php } ?> value="cod" selected>Customer Will Pay</option>
                          </select>
                      </div>

                    <!-- <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Delivery Charge<span class="help"></span></label>
                        <input type="text"  class="form-control" required=""  placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["package_price"] : ""; ?>" id="package_price" name="package_price" autocomplete="off">
                        <label  style="font-size: 10px;">Including service charge</label>
                    </div> -->



                  </div>
                    <div class="form-group col-md-12">
                      <div class="form-group col-md-4" style="display:none;">
                          <label class="control-label mb-10 text-left"> Promo code <span class="help"></span></label>
                          <select id="promo_code" name="promo_code" class="form-control select2 promo-cls" >
                            <option value="">Select promo</option>

                          </select>

                          <div id='responses_promo' style="color:yellow;"class='col-xs-12'></div>
                          <div id='responses_promo_error' style="color:red;" class='col-xs-12'></div>
                          <div id='responses_promo_final' style="color:green;" class='col-xs-12'></div>
                      </div>
                      <!-- <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Parcel Delivery date <span class="help"></span></label>
                          <input type="text" id="delivery_date" required="" name="delivery_date" value="<?php echo (isset($row))  ? $row["delivery_date"] = date( "d-m-Y", strtotime($row["delivery_date"])) : ""; ?>" class="form-control datepicker" placeholder="m/d/y">
                      </div> -->
                    <!-- <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Delivery time<span class="help"></span></label>
                        <select id="delivery_time" name="delivery_time" class="form-control select2" >
                              <option  value="">Select time</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == 'any') { ?>selected <?php } ?> value="any">Any</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '08:00AM - 09:00AM') { ?>selected <?php } ?> value="08:00AM - 09:00AM">08:00AM - 09:00AM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '09:00AM - 10:00AM') { ?>selected <?php } ?> value="09:00AM - 10:00AM">09:00AM - 10:00AM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '10:00AM - 11:00AM') { ?>selected <?php } ?> value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '11:00AM - 12:00PM') { ?>selected <?php } ?> value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '12:00PM - 01:00PM') { ?>selected <?php } ?> value="12:00PM - 01:00PM">12:00PM - 01:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '01:00PM - 02:00PM') { ?>selected <?php } ?> value="01:00PM - 02:00PM">01:00PM - 02:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '02:00PM - 03:00PM') { ?>selected <?php } ?> value="02:00PM - 03:00PM">02:00PM - 03:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '03:00PM - 04:00PM') { ?>selected <?php } ?> value="03:00PM - 04:00PM">03:00PM - 04:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '04:00PM - 05:00PM') { ?>selected <?php } ?> value="04:00PM - 05:00PM">04:00PM - 05:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '05:00PM - 06:00PM') { ?>selected <?php } ?> value="05:00PM - 06:00PM">05:00PM - 06:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '06:00PM - 07:00PM') { ?>selected <?php } ?> value="06:00PM - 07:00PM">06:00PM - 07:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '07:00PM - 08:00PM') { ?>selected <?php } ?> value="07:00PM - 08:00PM">07:00PM - 08:00PM</option>

                        </select>
                    </div> -->
                    <?php $tomorrow = date("Y-m-d", strtotime('tomorrow')); ?>
                    <input type="hidden" name="delivery_date" value="<?php echo $tomorrow;?>">
                    <input type="hidden" name="delivery_time" value="any">
                    <input type="hidden" id="extra_amount" name="extra_amount" value="">


                   </div>

                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total price (Product) <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_price_product" required="" name="total_price_product" class="form-control totalProductPrice" placeholder="Total price of product" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_price_product"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total price (Delivery) <span class="help"></span></label>
                       <input type="text" id="total_price" style="color:black;" readonly required="" name="total_price" class="form-control" placeholder="Total price of delivery" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_price"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total Weight <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_weight" required="" name="total_weight" class="form-control" placeholder="Total weight of the product" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_weight"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total Cod Charge <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_cod_charge" required="" name="total_cod_charge" class="form-control" placeholder="Total % cod charge applicable" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_cod_charge"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Grand Total<span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="grand_total" required="" name="grand_total" class="form-control" placeholder="Total % cod charge applicable" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_cod_charge"] : "0"; ?>">
                       <input type="hidden" id="dcccharge" name="dcccharge" value="">
                       <input type="hidden" id="excharge" name="excharge" value="">
                   </div>

                   <div class="form-group col-md-12">
                     <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Cash Collection Amount <span class="help"></span></label>
                          <input type="number" id="cash_collect" name="cash_collect" placeholder="Cash to be collected" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["cash_collection"] : ""; ?>" required>
                      </div>
                     <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Notes <span class="help"></span></label>
                          <input type="text" id="instructions" name="instructions" placeholder="Instructions if any" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["instructions"] : ""; ?>">
                      </div>

                      <div class="form-group col-md-4">
                        <hr>
                        <h5>Total Payable Amount: -                  <span id = "tpayable_amount" style="float:right">0</span></h5>
                      </div>

                   <div class="form-group col-md-4">
                   </div>
                   <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){ ?>
                   <div class="form-group col-md-4">
                       <label class="control-label mb-10 text-left"> Branch <span class="help"></span></label>
                       <select id="branch" name="branch" class="form-control select2" required>
                           <option value="">Select Office</option>
                           <?php foreach ($branch as $k => $v) { ?>
                           <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($row['branch']) && $v['id'] == $row['branch'])?'selected':'');?>><?php echo $v['name']; ?></option>
                           <?php } ?>
                       </select>
                   </div>
                 <!-- </div> -->
               <?php }
               ?>

               <div class="form-group text-center">
               <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
               <button type="submit" class="btn btn-info btn-rounded">Create</button>
               <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
             </div>
             </div>

                </div>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>

<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
<script>
var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"
var deliveryType = "<?php echo (isset($row))?$row['delivery_type']:0;  ?>"
var pickup = "<?php echo (isset($row))?$row['pickup_address']:0;  ?>"
var recipientAddress = "<?php echo (isset($row))?$row['recipient_address']:0;  ?>"
</script>
