<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/package/createsave', array("id" => "creatpackage-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left"> Package Name <span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Package Name" value="<?php echo (isset($row)) ? $row["name"] : ""; ?>" id="package_name" name="package_name" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6" style="display:none;">
                        <label class="control-label mb-10 text-left"> Package weight (in kg)<span class="help"></span></label>
                        <input type="text" id="package_weight" required="" name="package_weight" value="<?php echo (isset($row)) ? $row["weight"] : ""; ?>" class="form-control" placeholder="Package weight" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6" style="display:none;">
                        <label class="control-label mb-10 text-left"> Package Price <span class="help"></span></label>
                        <input type="number" class="form-control" required=""  placeholder="Package Price" value="<?php echo (isset($row)) ? $row["price"] : ""; ?>" id="package_price" name="package_price" autocomplete="off">
                    </div>

                    <div class="form-group col-md-6" style="display:none;">
                        <label class="control-label mb-10 text-left"> Special Note <span class="help"></span></label>
                        <input type="text" class="form-control"  placeholder="Note if any.." value="<?php echo (isset($row)) ? $row["note"] : ""; ?>" id="note" name="note" autocomplete="off">
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Area<span class="help"></span></label>
                        <select id="p_area" name="p_area" class="form-control select2" onchange="getinputbox()" required>
                            <option value="">Select Area</option>
                            <option <?php if(!empty($row) && $row['p_area'] == 'urban') { ?>selected <?php } ?> value="urban">Urban</option>
                            <option <?php if(!empty($row) && $row['p_area'] == 'suburban') { ?>selected <?php } ?> value="suburban">Sub-Urban</option>
                            <option <?php if(!empty($row) && $row['p_area'] == 'metro') { ?>selected <?php } ?> value="metro">Metropolitan</option>
                            <option <?php if(!empty($row) && $row['p_area'] == 'urban&suburban') { ?>selected <?php } ?> value="urban&suburban">Urban + Sub-Urban</option>
                            <option <?php if(!empty($row) && $row['p_area'] == 'all') { ?>selected <?php } ?> value="all">All</option>
                        </select>
                      </div>
                      <div id="cod_applicable" class="col-sm-6" style="display:none;">
                        <label class="control-label mb-10 text-left">COD Applicable<span class="help"></span></label>
                        <select id="cod" name="cod" class="form-control select2" onchange="enablecod_charge()" required>
                            <!-- <option value="">Select Area</option> -->
                            <option <?php if(!empty($row) && $row['cod'] == '0') { ?>selected <?php } ?> value="0">No</option>
                            <option <?php if(!empty($row) && $row['cod'] == '1') { ?>selected <?php } ?> value="1">Yes</option>
                        </select>
                      </div>
                    </div>

                    <div id='urban_box' style="display:none;">
                      <label style="margin-left: 15px;margin-top: 5px;" class="control-label mb-10 text-left">Urban Details :-<span class="help"></span></label>
                    <div class="form-group">
                      <div class="col-sm-3">
                        <label class="control-label mb-10 text-left">DC<span class="help"></span></label>
                        <input type="number" class="form-control" name="urban_dc" id="urban_dc" placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["urban_dc"] : "0"; ?>">
                      </div>
                      <div class="col-sm-3">
                        <label class="control-label mb-10 text-left">Extra Charge/Kg<span class="help"></span></label>
                        <input type="number" class="form-control" name="urban_extra_chrg" id="urban_extra_chrg" placeholder="Extra Charge Per Kg" value="<?php echo (isset($row)) ? $row["urban_extra_chrg"] : "0"; ?>">
                      </div>

                      <div class="col-sm-3">
                        <label class="control-label mb-10 text-left">Extra Charge/distance<span class="help"></span></label>
                        <input type="number" class="form-control" name="urban_dis_extra_chrg" id="urban_dis_extra_chrg" placeholder="Extra Charge Per km" value="<?php echo (isset($row)) ? $row["urban_dis_extra_chrg"] : "0"; ?>">
                      </div>

                      <div class="col-sm-3">
                        <label class="control-label mb-10 text-left">COD Charge(%)<span class="help"></span></label>
                        <input type="number" class="form-control" name="urban_cod_chrg" id="urban_cod_chrg" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["urban_cod_chrg"] : "0"; ?>" disabled>
                      </div>
                    </div>
                  </div>

                  <div id='sub_urban_box' style="display:none;">
                    <label style="margin-left: 15px;margin-top: 5px;" class="control-label mb-10 text-left">Sub-Urban Details :-<span class="help"></span></label>
                  <div class="form-group">
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">DC<span class="help"></span></label>
                      <input type="number" class="form-control" name="sub_urban_dc" id="sub_urban_dc" placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["sub_urban_dc"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">Extra Charge/Kg<span class="help"></span></label>
                      <input type="number" class="form-control" name="sub_urban_extra_chrg" id="sub_urban_extra_chrg" placeholder="Extra Charge Per Kg" value="<?php echo (isset($row)) ? $row["sub_urban_extra_chrg"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">Extra Charge/distance<span class="help"></span></label>
                      <input type="number" class="form-control" name="sub_dis_extra_chrg" id="sub_dis_extra_chrg" placeholder="Extra Charge Per km" value="<?php echo (isset($row)) ? $row["sub_dis_extra_chrg"] : "0"; ?>">
                    </div>
                    <div class="col-sm-3">
                      <label class="control-label mb-10 text-left">COD Charge(%)<span class="help"></span></label>
                      <input type="number" class="form-control" name="sub_urban_cod_chrg" id="sub_urban_cod_chrg" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["sub_urban_cod_chrg"] : "0"; ?>" disabled>
                    </div>
                  </div>
                </div>


                <div id='metro_box' style="display:none;">
                  <label style="margin-left: 15px;margin-top: 5px;" class="control-label mb-10 text-left">Metropolitan Details :-<span class="help"></span></label>
                <div class="form-group">
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">DC<span class="help"></span></label>
                    <input type="number" class="form-control" name="metro_dc" id="metro_dc" placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["metro_dc"] : "0"; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">Extra Charge/Kg<span class="help"></span></label>
                    <input type="number" class="form-control" name="metro_extra_chrg" id="metro_extra_chrg" placeholder="Extra Charge Per Kg" value="<?php echo (isset($row)) ? $row["metro_extra_chrg"] : "0"; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">Extra Charge/distance<span class="help"></span></label>
                    <input type="number" class="form-control" name="metro_dis_extra_chrg" id="metro_dis_extra_chrg" placeholder="Extra Charge Per km" value="<?php echo (isset($row)) ? $row["metro_dis_extra_chrg"] : "0"; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label class="control-label mb-10 text-left">COD Charge(%)<span class="help"></span></label>
                    <input type="number" class="form-control" name="metro_cod_chrg" id="metro_cod_chrg" placeholder="COD Charge in %" value="<?php echo (isset($row)) ? $row["metro_cod_chrg"] : "0"; ?>" disabled>
                  </div>
                </div>
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
