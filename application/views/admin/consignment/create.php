<?php error_reporting(0);?>
<style>
.ui-corner-all {
  z-index: 9999999;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/consignment/createsave', array("id" => "creatconsignment-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($row) && $row['consignment_id'] != ""){
                  ?>
                  <div class="form-group col-md-6">
                          <label class="control-label mb-10 text-left">Consignment ID<span class="help"></span></label>
                          <input type="text" style="color:black" name="consignment_id" id="consignment_id" value="<?php echo (isset($row)) ? $row["consignment_id"] : ""; ?>" class="form-control" readonly>
                      </div>
                  <?php
                }else{
                ?>
                <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Consignment ID<span class="help"></span></label>
                        <input type="text" style="color:black" name="consignment_id" id="consignment_id" value="<?php echo (isset($autono)) ? $autono : ""; ?>" class="form-control" readonly>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Existing Customer</label></label><span style="float:right;display:block;" id="addMerchantBtn" class="addnewmerchant"><a href="#" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg" class="model_img img-responsive">+Add New Customer</a></span>
                        <select id="customer" name="customer" class="form-control  customer-cls" >
                            <option value="">Select Customer</option>
                            <?php foreach ($customer as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['customer'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['company']; ?>,<?php echo $v['name']; ?>, phone:<?php echo $v['phone']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label mb-10 text-left">Customer Details<span class="help"></span></label>
                        <select id="shiping" name="shiping" class="form-control select2" >
                          <option value="">Select address</option>

                        </select>
                    </div>

                    <!-- <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Shipping address</label><span style="float:right;display:block;" id="myBtn" class="addnewshipping"><a href="#" data-toggle="modal" data-target="#responsive-modal">+Add New Shipping</a></span>

                        <input type="text" id="recipient_address_detail" required="" name="recipient_address_detail" placeholder="Receipient Details" class="form-control" autocomplete="off" value="<?php echo (isset($recipient_address)) ? $recipient_address[0]["recipient_address"] : " "; ?>">
                        <input type="hidden" id="recipient_address" required="" name="recipient_address" placeholder="Receipient Details" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["recipient_address"] : " "; ?>">
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
                      <input type="text" class="form-control" required=""  placeholder="Recipient Name" value="<?php echo (isset($recipient_address)) ? $recipient_address[0]["recipient_name"] : ""; ?>" id="recipient_name" name="recipient_name" autocomplete="off">
                  </div>

                  <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Recipient Number <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="number" class="form-control recipient_number" data-tag="rcpnt_num" required="" placeholder="Recipient Number" value="<?php echo (isset($recipient_address)) ? $recipient_address[0]["recipient_number"] : ""; ?>" id="recipient_number"  name="recipient_number" autocomplete="off">
                      <input type="hidden" class="form-control"  required="" value="<?php echo (isset($recipient_address)) ? $recipient_address[0]["id"] : ""; ?>" id="recipient_data_id"  name="recipient_data_id" autocomplete="off">
                      <input type="hidden" id="recipient_address" required="" name="recipient_address" placeholder="Receipient Details" class="form-control" autocomplete="off" value="0">
                  </div>


                  <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Recipient Address <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="text" id="recipient_address_shipping" required="" placeholder="street name/House no./road name etc." name="recipient_address_shipping" placeholder="recipient Address" class="form-control" autocomplete="off" value="<?php echo (isset($recipient_address)) ? $recipient_address[0]["recipient_address"] : ""; ?>">
                  </div>
                    <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_dist">
                      <label class="control-label mb-10 text-left"> District <b style="color:red;">*</b><span class="help"></span></label>
                      <select id="district" required name="district" class="form-control select2 district-cls" >
                          <option value="">Select district</option>
                          <?php foreach ($district as $k => $v) { ?>
                          <option value="<?php echo $v['id']; ?>" <?php if(!empty($recipient_address) && $recipient_address[0]['district'] == $v['id']) { ?>selected <?php } ?>><?php echo $v['district_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                  <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_ps">
                    <label class="control-label mb-10 text-left"> Zip code <b style="color:red;">*</b><span class="help"></span></label>
                    <select id="police_station" required name="police_station" class="form-control select2" >
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
                    </div>
                    <div class="form-group col-md-4" style="display:none;">
                        <label class="control-label mb-10 text-left">Parcel Type<span class="help"></span></label>
                        <select id="parcel_type" name="parcel_type" class="form-control select2" >
                            <!-- <option value="">Select Type</option> -->
                            <option <?php if(!empty($row) && $row['parcel_type'] == 'parcel') { ?>selected <?php } else ?> selected <?php ?>  value="parcel">Parcel</option>
                            <!-- <option <?php if(!empty($row) && $row['parcel_type'] == 'document') { ?>selected <?php } ?> value="document">Document</option> -->

                        </select>
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
                    <div class="form-group col-md-4" style="display:none;">
                        <label class="control-label mb-10 text-left"> No of items <span class="help"></span></label>
                        <input type="text" id="no_of_items" required="" name="no_of_items" placeholder="Total no of items" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["no_of_items"] : "1"; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Weight (<b>Kg</b>)<span class="help"></span></label>
                        <input type="text" class="form-control productWeight" required=""  placeholder="Product weight" value="<?php echo (isset($row)) ? $row["product_weight"] : "1"; ?>" id="product_weight" name="product_weight" autocomplete="off">
                    </div>
                  </div>

                    <div class="form-group col-md-12">
                    <div class="form-group col-md-4" style="display:none;">
                        <label class="control-label mb-10 text-left">Package name<span class="help"></span></label>
                        <select id="package_name" name="package_name" class="form-control package-cls" >
                            <!-- <option value="">Select package name</option> -->
                            <?php foreach ($package as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['package_name'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?>(<?php echo $v['weight']; ?>)</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4" style="display:none;">
                        <label class="control-label mb-10 text-left">DC Payment method<span class="help"></span></label>
                        <select id="payment_method" name="payment_method" class="form-control select2" >
                            <!-- <option value="">Select payement method</option> -->
                            <!-- <option <?php if(!empty($row) && $row['payment_method'] == 'merch_will_pay') { ?>selected <?php } ?> value="merch_will_pay">Merchant Will Pay</option> -->
                            <!-- <option <?php if(!empty($row) && $row['payment_method'] == 'merch_paid') { ?>selected <?php }?> value="merch_paid">Merchant Paid</option> -->
                            <option <?php if(!empty($row) && $row['payment_method'] == 'cod') { ?>selected <?php } ?> value="cod">Cash on delivery</option>
                        </select>
                    </div>
                  <div class="form-group col-md-4">
                      <label class="control-label mb-10 text-left">Parcel price<span class="help"></span></label>
                      <input type="text" class="form-control" required=""  placeholder="Product Price" value="<?php echo (isset($row)) ? $row["product_price"] : "0"; ?>" id="product_price" name="product_price" autocomplete="off">
                      <!-- <label  style="font-size: 10px;color: red">Including service charge</label> -->
                  </div>
                  <div class="form-group col-md-4">
                      <label class="control-label mb-10 text-left">Delivery Charge<span class="help"></span></label>
                      <input type="text"  class="form-control" required=""  placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["total_price"] : ""; ?>" id="total_price" name="total_price" autocomplete="off">
                      <label  style="font-size: 10px;">Including service charge</label>
                  </div>
                  <div class="form-group col-md-4">
                      <label class="control-label mb-10 text-left">Total COD Charge<span class="help"></span></label>
                      <input type="text"  class="form-control" required=""  placeholder="Total COD Charge" value="<?php echo (isset($row)) ? $row["total_cod_charge"] : "0.00"; ?>" id="total_cod_charge" name="total_cod_charge" autocomplete="off">
                  </div>
                  </div>

                    <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> Promo code <span class="help"></span></label>
                        <!-- <input type="text" id="promo_code"  name="promo_code" value="<?php echo (isset($row)) ? $row["promo_code"] : ""; ?>" class="form-control" placeholder="Promo code" autocomplete="off"> -->
                        <select id="promo_code" name="promo_code" class="form-control select2 promo-cls" >
                          <option value="">Select promo</option>

                        </select>

                        <div id='responses_promo' style="color:yellow;"class='col-xs-12'></div>
                        <div id='responses_promo_error' style="color:red;" class='col-xs-12'></div>
                        <div id='responses_promo_final' style="color:green;" class='col-xs-12'></div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> Parcel Delivery date <span class="help"></span></label>
                        <input type="text" id="delivery_date" required="" name="delivery_date" value="<?php echo (isset($row))  ? $row["delivery_date"] = date( "d-m-Y", strtotime($row["delivery_date"])) : ""; ?>" class="form-control datepicker" placeholder="m/d/y">
                    </div>
                    <div class="form-group col-md-4">
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
                    </div>
                  </div>

                    <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                         <label class="control-label mb-10 text-left"> Notes <span class="help"></span></label>
                         <input type="text" id="instructions" name="instructions" placeholder="Instructions if any" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["instructions"] : ""; ?>">
                     </div>
                     <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Cash Collection Amount <span class="help"></span></label>
                          <input type="text" id="cash_collect" name="cash_collect" placeholder="Cash to be collected" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["cash_collection"] : ""; ?>">
                          <input type="hidden" id="extra_amount" name="extra_amount" value="">
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
                   </div>

                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total price (Product) <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_price_product" required="" name="total_price_product" class="form-control totalProductPrice" placeholder="Total price of product" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_price_product"] : "0"; ?>">
                   </div>
                   <!-- <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total price (Delivery) <span class="help"></span></label>
                       <input type="text" id="total_price" style="color:black;" readonly required="" name="total_price" class="form-control" placeholder="Total price of delivery" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_price"] : "0"; ?>">
                   </div> -->
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total Weight <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_weight" required="" name="total_weight" class="form-control" placeholder="Total weight of the product" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_weight"] : "0"; ?>">
                   </div>
                   <!-- <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total Cod Charge <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_cod_charge" required="" name="total_cod_charge" class="form-control" placeholder="Total % cod charge applicable" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_cod_charge"] : "0"; ?>">
                   </div> -->


                   <div class="form-group col-md-12">


                   <div class="form-group col-md-4" style="display:none;">
                         <label class="control-label mb-10 text-left"> Grand Total <span class="help"></span></label>
                         <input type="text" id="grand_total" style="color:black;" readonly required="" name="grand_total" class="form-control" placeholder="Grand total of Consignment" autocomplete="off" value="<?php echo (isset($row)) ? $row["grand_total"] : "0"; ?>">
                   </div>


             </div>

             <div class="form-group col-md-12">

             </div>

                </div>
            </div>
        </div>

        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group">

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
<div class="col-md-4">
								<div  class="panel-wrapper collapse in">
									<div  class="panel-body">
										<!-- sample modal content -->
										<div class="modal fade bs-example-modal-lg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h5 class="modal-title" id="myLargeModalLabel">Add New Merchant</h5>
													</div>
													<div class="modal-body">
                            <?php echo form_open_multipart('admin/customer/createsave', array("id" => "creatcustomer-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                            <div class="form-group">

                                <div class="col-sm-6">
                                  <label class="control-label mb-10 text-left"> NID No. <b style="color:red;">*</b><span class="help"></span></label>
                                  <input type="text" id="m_nid" name="m_nid" value="" class="form-control" placeholder="NID No." autocomplete="off" >
                                </div>
                                <div class="col-sm-6">
                                <label class="control-label mb-10 text-left"> Name <b style="color:red;">*</b><span class="help"></span></label>
                                <input type="text" class="form-control" required=""  placeholder="Full name" value="" id="name" name="name" autocomplete="off">
                              </div>

                            </div>
                            <!-- <div class="form-group">

                            </div> -->
                            <div class="form-group">
                              <div class="col-sm-6" style="margin-top: 5px;">
                                <label class="control-label mb-10 text-left"> Contact No <b style="color:red;">*</b><span class="help"></span></label>
                                <input type="text" id="phno" required="" name="phno" value="" class="form-control" placeholder="Contact Number" autocomplete="off">
                              </div>
                              <div class="col-sm-6" style="margin-top: 5px;">
                                <label class="control-label mb-10 text-left"> Email <b style="color:red;">*</b><span class="help"></span></label>
                                <input type="email" id="email" required="" name="email" value="" class="form-control" placeholder="Email" autocomplete="off">
                              </div>
                            </div>
                            <!-- <div class="form-group">
                          </div> -->
                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                                <label class="control-label mb-10 text-left"> Address <b style="color:red;">*</b><span class="help"></span></label>
                                <input type="text" id="address" required="" name="address" placeholder="street name/House no./road name etc." class="form-control" autocomplete="off" value="">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Landmark <span class="help"></span></label>
                              <input type="text" id="merchant_landmark" placeholder=" Landmark" name="merchant_landmark" class="form-control" autocomplete="off" value="">
                            </div>
                          </div>


                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> District <span class="help"></span></label>
                              <select id="district-merch" name="district" class="form-control select2 district-cls-merchant" required>
                                  <option value="">Select District</option>
                                  <?php foreach ($district as $k => $v) { ?>
                                  <option   value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Zip code <span class="help"></span></label>
                              <select id="police_station_merch" name="police_station" class="form-control select2" required>
                                <option value="">Select District First</option>

                              </select>
                            </div>

                          </div>

                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Postal Code <span class="help"></span></label>
                              <input type="text" id="pincode"  name="pincode" placeholder="Postalcode" class="form-control" autocomplete="off" value="">
                            </div>
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Company <b style="color:red;">*</b><span class="help"></span></label>
                              <input type="text" id="company"  name="company" class="form-control" autocomplete="off" placeholder="Company Name" value="" required>
                            </div>

                          </div>


                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Website <span class="help"></span></label>
                              <input type="text" id="web"  name="web" value="" class="form-control" placeholder="Website Name" autocomplete="off">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Bank Name <span class="help"></span></label>
                              <input type="text" id="bName" name="bName" value="" class="form-control" placeholder="Bank Name" autocomplete="off">
                            </div>
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Bank Branch <span class="help"></span></label>
                              <input type="text" id="bBranch" name="bBranch" class="form-control" autocomplete="off" placeholder="Bank Branch" value="">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Bank Acc No. <span class="help"></span></label>
                              <input type="text" id="bAccno" name="bAccno" value="" class="form-control" placeholder="Bank Account No." autocomplete="off">
                            </div>

                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Type Of Mobile Banking <span class="help"></span></label>
                              <select id="mobile_banking_type" name="mobile_banking_type" class="form-control select2" >
                                  <option value="">Select type</option>
                                  <option <?php if(!empty($row) && $row['mobile_banking_type'] == 'bkash') { ?>selected <?php } ?>  value="bkash">Bkash</option>
                                  <option <?php if(!empty($row) && $row['mobile_banking_type'] == 'nogod') { ?>selected <?php } ?> value="nogod">Nogod</option>
                                  <option <?php if(!empty($row) && $row['mobile_banking_type'] == 'rocket') { ?>selected <?php } ?> value="rocket">Rocket</option>
                              </select>
                            </div>

                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Mobile Banking Number <span class="help"></span></label>
                              <input type="text" id="mobile_banking_no" name="mobile_banking_no" class="form-control" autocomplete="off" placeholder="Mobile No." value="">
                            </div>


                            </div>

                            <div class="form-group">
                            <div class="col-sm-6" style="margin-top: 5px;">
                                <label class="control-label mb-10 text-left"> Office <b style="color:red;">*</b><span class="help"></span></label>
                                <select id="office_id" name="office_id" class="form-control select2" required>
                                    <option value="">Select Office</option>
                                    <?php foreach ($branch as $k => $v) { ?>
                                    <option   value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                              <div class="col-sm-6" style="margin-top: 5px;">
                                <label class="control-label mb-10 text-left"> Logo/Image <span class="help"></span></label>
                                <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                                <input type="file" id="logo" name="logo" value="" class="form-control logo" placeholder="" autocomplete="off">
                                <label type="text" class="files-selected" name="files-selected" id="files-selected"/>choose a file to upload</label><br>
                                <input type="hidden" class="logoValue" name="logoValue" id="uploaded_files"/>
                                <input type="hidden" class="oldlogoValue" name="oldlogoValue" value="<?php echo (isset($row)) ? $row["logo"] : ""; ?>"/>
                                <?php
                                 if(!empty($row["logo"])){
                                   ?>
                                last uploaded Logo:- <a target="_blank" href="<?php echo base_url('uploads/merchants/'.$row["logo"])?>">click here</a>
                                <?php
                              }
                              ?>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-sm-12" style="margin-top: 5px;">
                                <label class="control-label mb-10 text-left"> Password </label>
                                <input type="password" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="off" required>
                                <!-- <small style="color:red;">Leave the password field blank, if you dont want to change the password.</small> -->
                              </div>
                            </div>
                            <div class="form-group text-center">
                              <div class="col-sm-12" style="margin-top: 50px;">
                                <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
                                <button type="submit" class="btn btn-info btn-rounded">Create</button>
                                <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                              </div>
                            </div>
                            <?php echo form_close(); ?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
													</div>
												</div>
												<!-- /.modal-content -->
											</div>
											<!-- /.modal-dialog -->
										</div>
										<!-- /.modal -->
										<!-- Button trigger modal -->
										<!-- <img src="../img/modals/model2.png" alt="default" data-toggle="modal" data-target=".bs-example-modal-lg" class="model_img img-responsive"/> -->
									</div>
								</div>
							<!-- </div> -->
						</div>
<!-- <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script> -->
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>

<script type="text/javascript">
// Get the modal
// var modal = document.getElementById("responsive-modal");
// var addmerchmodal = document.getElementById("responsive-modal-merchant");
// Get the button that opens the modal
// var btn = document.getElementById("myBtn");
// var addmerchbtn = document.getElementById("addMerchantBtn");

// Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];
// var spanaddmerch = document.getElementsByClassName("closemerch")[0];

// When the user clicks the button, open the modal
// btn.onclick = function() {
  // modal.style.display = "block";
// }
// addmerchbtn.onclick = function() {
//   addmerchmodal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
// span.onclick = function() {
  // modal.style.display = "none";
// }
// spanaddmerch.onclick = function() {
//   addmerchmodal.style.display = "none";
// }

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
  // if (event.target == modal) {
    // modal.style.display = "none";
    // $('.modal-backdrop').css("display","none");
  // }
// }

// window.onclick = function(event) {
//   if (event.target == addmerchmodal) {
//     addmerchmodal.style.display = "none";
//   }
// }

document.addEventListener("DOMContentLoaded", function () {
$("#customer").select2().on('change', function(e) {
    var data = $(".customer-cls option:selected").val();
    // var btn = document.getElementById("myBtn");
    // var warn = document.getElementById("warning");
    var customerid=$('#customer_id');
    console.log(data);
    getAjaxShiping(data);
    // getAjaxRecipient(data);
    getAjaxcoupon(data);
    // getAddnewShipping(data);
    if(data != ""){
    // btn.style.display = "block";
    // warn.style.display = "block";
    customerid.val(data);
  }else{
    // btn.style.display = "none";
    // warn.style.display = "none";
  }
  });

  $("#district").select2().on('change', function(e) {
      var dist = $(".district-cls option:selected").val();
      console.log(dist);
      getAjaxPstation(dist);
    });

    $("#district-merch").select2().on('change', function(e) {
        var dist = $(".district-cls-merchant option:selected").val();
        console.log(dist);
        getAjaxPstation(dist);
      });

    $("#promo_code").select2().on('change', function(e) {
        // var data = $(".customer-cls option:selected").val();
        // console.log(data);
        getPromoPrice();
      });

});


$(document).ready(function(){
        getAjaxShiping();
        getAjaxRecipient();
        getAjaxPstation();
        // fetch_rcpnt_details();
        getAjaxcoupon();
        // fetch_rcpnt_details('#recipient_number');
});
    var policeStation = "<?php echo (isset($row))?$row['del_police_station']:0;  ?>"
    var deliveryType = "<?php echo (isset($row))?$row['delivery_type']:0;  ?>"
    var pickup = "<?php echo (isset($row))?$row['pickup_address']:0;  ?>"
    var recipientAddress = "<?php echo (isset($row))?$row['recipient_address']:0;  ?>"
    console.log("pickup "+pickup)
    $(document).on('change', '.customer-cls', function (e) {
       console.log("abc");
        var _this = $(this);
        e.preventDefault();
            getAjaxShiping();
            getAjaxRecipient();
        });


        $(document).on('keyup', '#cash_collect', function (e) {
          var actualparcelprice = $("#total_price_product").val();
          var parcelprice = $("#cash_collect").val();
          var extraamounttocollect = parseFloat(parcelprice)-parseFloat(actualparcelprice);
          console.log('extra amount'+extraamounttocollect);
          $("#extra_amount").val(extraamounttocollect);
        });

         function getAjaxShiping(customer){

           var customer = $("#customer").val();

           $.ajax({
                    url: '<?php echo base_url('admin/consignment/getshiping'); ?>',
                    type: "POST",
                    data: {customer: customer},
                    success: function (res)
                {
               console.log(pickup);
               if(res){
               pickup = res[0]['id'];
             }
                var jdata= res;
                  var shiping=$('#shiping');
                    shiping.empty();
                    shiping.append($("<option></option>").attr("value", '0').text('Select pickup address'));
                    Object.keys(jdata).forEach(function(k){
                        shiping.append($("<option></option>").attr("value", jdata[k].id).text("Name: "+jdata[k].name+", Phone :"+jdata[k].phone+", Address: "+jdata[k].address));
                        var pickup2 = jdata[0].id;
                    });
                    // if(pickup = ""){
                    //   shiping.val(defaultpickup);
                    // }else{
                    shiping.val(pickup);
                  // }
                }


                });

 }

 function getAjaxcoupon(customer){

   var customer = $("#customer").val();

   $.ajax({
            url: '<?php echo base_url('admin/consignment/getpromo'); ?>',
            type: "POST",
            data: {customer: customer},
            success: function (res)
        {
       // console.log(res);
        var jdata= res;
          var promo=$('#promo_code');
            promo.empty();
            // promo.append($("<option></option>").attr("value", '0').text('Select promo code'));
            Object.keys(jdata).forEach(function(k){
                promo.append($("<option></option>").attr("value", jdata[k].promo_code).text(jdata[k].promo_code));
            });
            promo.val();
        }


        });

}

 function getAjaxPstation(dist){
   var distshipping = $("#district").val();
   var distmerch = $("#district-merch").val();

   if(distshipping != ""){
     var dist = distshipping;
     var station=$('#police_station');
   }else{
   var dist = distmerch;
   var station=$('#police_station_merch');
 }
console.log(dist);
console.log(station);
   $.ajax({
            url: '<?php echo base_url('admin/branch/getPstation'); ?>',
            type: "POST",
            data: {dist: dist},
            success: function (res)
        {
       // console.log(res);
        var jdata= res;
          // var station=$('#police_station');
            station.empty();
            station.append($("<option></option>").attr("value", '0').text('Select Zip code'));
            Object.keys(jdata).forEach(function(k){
                station.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].station_name));
            });
            station.val(policeStation);
        }


        });

 }


 function getAjaxRecipient(customer){

   var customer = $("#recipient_address").val();

   $.ajax({
            url: '<?php echo base_url('admin/consignment/getshipingreceipient'); ?>',
            type: "POST",
            data: {customer: customer},
            success: function (res)
        {
       // console.log(res);
        var jdata= res;
          var recipient=$('#recipient_address');
            recipient.empty();
            recipient.append($("<option></option>").attr("value", '0').text('Select address'));
            Object.keys(jdata).forEach(function(k){
                recipient.append($("<option></option>").attr("value", jdata[k].id).text("Name: "+jdata[k].recipient_name+", Phone :"+jdata[k].recipient_number+", Address: "+jdata[k].recipient_address));
            });
            recipient.val(recipientAddress);
        }


        });

}


 $(document).on('change', '.delivery-cls', function (e) {
    // console.log("kjbjbji");
     var _this = $(this);
     e.preventDefault();
         getAjaxPackagePrice();
     });

      function getAjaxPackagePrice(){

        var package_name = $("#delivery_type").val();
         console.log("package_name "+package_name);
        $.ajax({
                 url: '<?php echo base_url('admin/consignment/getpackageprice'); ?>',
                 type: "POST",
                 data: {package_name: package_name},
                 success: function (res)
             {
            // console.log(res);
             var jdata= res;
                 Object.keys(jdata).forEach(function(k){
                     $("#package_price").val(jdata[k].total_price);

                 });
                 getTotalpackagePrice();
             }


             });

}

$(document).on('keyup', '#package_price', function (e) {
 getTotalpackagePrice();
});


function getTotalpackagePrice(){

  var price = parseInt($('[name="package_price"]').val());
  var items = parseInt($('[name="no_of_items"]').val());
  var promo_code = $("#promo_code").val();
  if(price >0 && items >0){
  var total_price = (price * items);

  $('[name="total_price"]').val(Math.floor(total_price));
  getGrandTotal();
  if(promo_code != ""){
  getPromoPrice();
}
 }
 else{
     $('[name="total_price"]').val('');
     $('#total_price').empty();
 }

}

function getGrandTotal(){
  var price = parseInt($('[name="total_price"]').val());
  var productPrice = parseInt($('[name="total_price_product"]').val());
  if(productPrice){
    pprice = productPrice;
  }else{
    pprice = 0;
  }
  if(price >0 || productPrice >0){
  var grand_total = (price + pprice);
  console.log(grand_total);

  $('[name="grand_total"]').val(Math.floor(grand_total));
 }
 else{
     $('[name="grand_total"]').val('');
     $('#grand_total').empty();
 }

}


  $(document).on('keyup', '.productWeight', function (e) {

  var product_weight = parseFloat($('[name="product_weight"]').val());
  var items = parseInt($('[name="no_of_items"]').val());
  if(product_weight >0 && items >0){
  var total_weight = (product_weight * items);

  $('[name="total_weight"]').val(total_weight+' kg');
 }
 else{
     $('[name="total_weight"]').val('');
     $('#total_weight').empty();
 }
  });


  function getPromoPrice(){
    // document.getElementById("responses_promo_final").style.display = "none";
    // document.getElementById("responses_promo_error").style.display = "none";
    // $('#responses_promo').html("checking.....");
    var promo_code = $("#promo_code").val();
    var customer = $("#customer").val();
    // var delivery = $("#total_price").val();

    var price = parseInt($('[name="package_price"]').val());
    var items = parseInt($('[name="no_of_items"]').val());
    if(price >0 && items >0){
    var total_price = (price * items);

    var delivery = Math.floor(total_price);
  }else{
    var delivery = 0;
  }
     // console.log("promo_code "+promo_code);
    $.ajax({
             url: '<?php echo base_url('admin/consignment/getDiscounredprice'); ?>',
             type: "POST",
             data: {promo_code: promo_code,customer: customer},
             success: function (res)
         {
        console.log(res);
        if(res.success == "true"){
          // document.getElementById("responses_promo_final").style.display = "block";
          // $('#responses_promo_final').html("Promo applied succesfully, you will get "+res.discount_percent+"Taka Discount");
          // document.getElementById("responses_promo_error").style.display = "none";
           // var discount_price = (res.discount_percent / 100) * delivery;
           // var final_amount = delivery - discount_price;
           var final_amount = delivery - res.discount_percent;
           $('[name="total_price"]').val(Math.floor(final_amount));
           getGrandTotal();
          // alert('promo applied successfully, you will get discount of '+res.discount_percent+' %');
      }else{
        // document.getElementById("responses_promo_final").style.display = "none";
        // document.getElementById("responses_promo").style.display = "none";
        // document.getElementById("responses_promo_error").style.display = "block";
      // $('#responses_promo_error').html(res.message);
      $('[name="total_price"]').val(Math.floor(delivery));
      getGrandTotal();

      }
         }


         });
  }


  $(document).on('keyup', '#product_price', function (e) {
   var product_price = parseInt($('[name="product_price"]').val());
   var items = parseInt($('[name="no_of_items"]').val());
   if(product_price >0 && items >0){
   var total_price_product = (product_price * items);

   $('[name="total_price_product"]').val(Math.floor(total_price_product));
   getGrandTotal();
  }
  else{
      $('[name="total_price_product"]').val('');
      $('#total_price_product').empty();
  }
  });


$(document).on('keyup', '#no_of_items', function (e) {
 var price = parseInt($('[name="package_price"]').val());
 var items = parseInt($('[name="no_of_items"]').val());
 if(price >0 && items >0){
 var total_price = (price * items);

 $('[name="total_price"]').val(Math.floor(total_price));
 getGrandTotal();
}
else{
    $('[name="total_price"]').val('');
    $('#total_price').empty();
}
getPromoPrice();
});


$(document).on('keyup', '#no_of_items', function (e) {
 var product_price = parseInt($('[name="product_price"]').val());
 var items = parseInt($('[name="no_of_items"]').val());
 if(product_price >0 && items >0){
 var total_price_product = (product_price * items);

 $('[name="total_price_product"]').val(Math.floor(total_price_product));
 getGrandTotal();
}
else{
    $('[name="total_price_product"]').val('');
    $('#total_price_product').empty();
}
});



$(document).on('keyup', '#no_of_items', function (e) {
 var product_weight = parseFloat($('[name="product_weight"]').val());
 var items = parseInt($('[name="no_of_items"]').val());
 if(product_weight >0 && items >0){
 var total_weight = (product_weight * items);

 $('[name="total_weight"]').val(total_weight+' kg');
}
else{
    $('[name="total_weight"]').val('');
    $('#total_weight').empty();
}
});

$('#customer').on('select2:select', function (e) {
  console.log(e)
});
</script>

<script>
$(document).on('change', '.package-cls', function (e) {
   console.log("def");
    var _this = $(this);
    e.preventDefault();
        getAjaxDelivery();
    });


    function getAjaxDelivery(){

      var ppackage = $("#package_name").val();
      console.log(ppackage);
      $.ajax({
               url: '<?php echo base_url('admin/consignment/getdelivery'); ?>',
               type: "POST",
               data: {ppackage: ppackage},
               success: function (res)
           {
          // console.log(res);
           var jdata= res;
             var delivery=$('#delivery_type');
               delivery.empty();
               delivery.append($("<option></option>").attr("value", '0').text('Select delivery type'));
               Object.keys(jdata).forEach(function(k){
                   delivery.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].delivery_type));
               });
               delivery.val();

           }


           });

}
</script>
<script>
$('#recipient_address').on('select2:select', function (e) {
    var data = e.params.data;
    console.log(data);
});

function fetch_rcpnt_details(){
        $( ".recipient_number" ).autocomplete({
         source: function( request, response ) {
           $this = $(this.element);
           // console.log($this);
           $.ajax({
             url: '<?php echo base_url('admin/consignment/get_merchant'); ?>',
             type: 'post',
             dataType: "json",
             data: {
               search: request.term
             },
             success: function( data ){
               console.log(data);
               response(data);
             }
           });
         },
         select: function (event, ui) {
           var tag = $(this).attr("data-tag");
           if(tag == 'rcpnt_num'){
             $('#recipient_number').val(ui.item.label);
             $('#recipient_name').val(ui.item.name);
             $('#recipient_address_shipping').val(ui.item.address);
             $('#recipient_landmark').val(ui.item.landmark);
             $('#recipient_city').val(ui.item.city);
             $('#district').val(ui.item.district);
             $('#police_station').val(ui.item.ps);
             $('#recipient_pincode').val(ui.item.zipcode);
             $('#recipient_address').val(ui.item.id);
             $('#recipient_data_id').val(ui.item.id);
             $('#recipient_address_detail').val(ui.item.name+","+ui.item.label+","+ui.item.address);
           }
           return false;
         }
        });
        }
</script>
