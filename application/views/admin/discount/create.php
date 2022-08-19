<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/discount/createsave', array("id" => "createuser-form", "method" => "post")); ?>

                    <div class="col-sm-12">
                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left">Customer</label>
                      <select id="merchant" name="merchant" class="form-control select2 district-cls" required>
                          <option value="">Select Customer</option>
                          <?php foreach ($merchant as $k => $v) { ?>
                          <option <?php if(!empty($row) && $row['merchant'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?>,<?php echo $v['company']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left"> Promo Code <span class="help"></span></label>
                      <input type="text" id="promo_code" required="" name="promo_code" value="<?php echo (isset($row)) ? $row["promo_code"] : ""; ?>" class="form-control" placeholder="promo Code" autocomplete="off">
                    </div>
                  </div>

                    <!-- <div class="col-sm-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;"> Discount (taka) <span class="help"></span></label>
                      <input type="number" id="discount_percent" required="" name="discount_percent" value="<?php echo (isset($row)) ? $row["discount_percent"] : ""; ?>" class="form-control" placeholder="Discount in Taka" autocomplete="off">
                    </div> -->
                    <div class="col-sm-12">
                    <div id="cod_applicable" class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">COD Applicable<span class="help"></span></label>
                      <select id="cod_apl" name="cod_apl" class="form-control select2" onchange="enablecod_charge()" required>
                          <!-- <option value="">Select Area</option> -->
                          <option <?php if(!empty($row) && $row['cod_apl'] == '0') { ?>selected <?php } ?> value="0">No</option>
                          <option <?php if(!empty($row) && $row['cod_apl'] == '1') { ?>selected <?php } ?> value="1">Yes</option>
                      </select>
                    </div>

                    <div id="cod_applicable" class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Return Charge Applicable<span class="help"></span></label>
                      <select id="return_apl" name="return_apl" class="form-control select2" onchange="enable_return_charge()"required>
                          <!-- <option value="">Select Area</option> -->
                          <option <?php if(!empty($row) && $row['return_apl'] == '0') { ?>selected <?php } ?> value="0">No</option>
                          <option <?php if(!empty($row) && $row['return_apl'] == '1') { ?>selected <?php } ?> value="1">Yes</option>
                      </select>
                    </div>
                  </div>



                  <div id='urban_box' class="col-sm-12">
                    <label style="margin-left: 15px;margin-top: 5px;" class="control-label mb-10 text-left">Urban Discount Details :-<span class="help"></span></label>
                  <div class="form-group">
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">DC Discount<span class="help"></span></label>
                      <input type="number" class="form-control" name="urban_dc_dis" id="urban_dc_dis" placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["urban_dc_dis"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">Extra Charge/Kg<span class="help"></span></label>
                      <input type="number" class="form-control" name="urban_extra_chrg_dis" id="urban_extra_chrg_dis" placeholder="Extra Charge Per Kg" value="<?php echo (isset($row)) ? $row["urban_extra_chrg_dis"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">COD Charge(%)<span class="help"></span></label>
                      <input type="number" class="form-control" name="urban_cod_chrg_dis" id="urban_cod_chrg_dis" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["urban_cod_chrg_dis"] : "0"; ?>" disabled>
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">Return Charge(%)<span class="help"></span></label>
                      <input type="number" class="form-control" name="urban_return_chrg_dis" id="urban_return_chrg_dis" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["urban_return_chrg_dis"] : "0"; ?>" disabled>
                    </div>
                  </div>
                </div>

                <div id='sub_urban_box' class="col-sm-12">
                  <label style="margin-left: 15px;margin-top: 5px;" class="control-label mb-10 text-left">Sub-Urban Discount Details :-<span class="help"></span></label>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">DC Discount<span class="help"></span></label>
                    <input type="number" class="form-control" name="sub_urban_dc_dis" id="sub_urban_dc_dis" placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["sub_urban_dc_dis"] : "0"; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">Extra Charge/Kg<span class="help"></span></label>
                    <input type="number" class="form-control" name="sub_urban_extra_chrg_dis" id="sub_urban_extra_chrg_dis" placeholder="Extra Charge Per Kg" value="<?php echo (isset($row)) ? $row["sub_urban_extra_chrg_dis"] : "0"; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">COD Charge(%)<span class="help"></span></label>
                    <input type="number" class="form-control" name="sub_urban_cod_chrg_dis" id="sub_urban_cod_chrg_dis" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["sub_urban_cod_chrg_dis"] : "0"; ?>" disabled>
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">Return Charge(%)<span class="help"></span></label>
                    <input type="number" class="form-control" name="sub_urban_return_chrg_dis" id="sub_urban_return_chrg_dis" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["sub_urban_return_chrg_dis"] : "0"; ?>" disabled>
                  </div>
                </div>
              </div>

                  <div id='metro_box' class="col-sm-12">
                    <label style="margin-left: 15px;margin-top: 5px;" class="control-label mb-10 text-left">Metropolitan Discount Details :-<span class="help"></span></label>
                  <div class="form-group">
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">DC Discount<span class="help"></span></label>
                      <input type="number" class="form-control" name="metro_dc_dis" id="metro_dc_dis" placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["metro_dc_dis"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">Extra Charge/Kg<span class="help"></span></label>
                      <input type="number" class="form-control" name="metro_extra_chrg_dis" id="metro_extra_chrg_dis" placeholder="Extra Charge Per Kg" value="<?php echo (isset($row)) ? $row["metro_extra_chrg_dis"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">COD Charge(%)<span class="help"></span></label>
                      <input type="number" class="form-control" name="metro_cod_chrg_dis" id="metro_cod_chrg_dis" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["metro_cod_chrg_dis"] : "0"; ?>" disabled>
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">Return Charge(%)<span class="help"></span></label>
                      <input type="number" class="form-control" name="metro_return_chrg_dis" id="metro_return_chrg_dis" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["metro_return_chrg_dis"] : "0"; ?>" disabled>
                    </div>
                  </div>
                </div>

                </div>
                    <!-- <div class="form-group">

                    </div> -->

                        <!-- <div class="form-group"> -->

                        <!-- </div> -->

                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
                        <button type="submit" class="btn btn-info btn-rounded">Create</button>
                        <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                      </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
