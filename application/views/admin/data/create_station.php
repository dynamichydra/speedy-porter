<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/add_data/createsave_station', array("id" => "createuser-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">District<span class="help"></span></label>
                        <select id="district" name="district" class="form-control select2 district-cls" >
                            <option value="">Select district</option>
                            <?php foreach ($district as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['district'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Zip code <span class="help"></span></label>
                        <input type="text" id="station_name" required="" name="station_name" value="<?php echo (isset($row)) ? $row["station_name"] : ""; ?>" class="form-control" placeholder="Zip code" autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Area<span class="help"></span></label>
                        <select id="area" name="area" class="form-control select2" required>
                            <option value="">Select Area</option>
                            <option <?php if(!empty($row) && $row['area'] == 'urban') { ?>selected <?php } ?> value="urban">Urban</option>
                            <option <?php if(!empty($row) && $row['area'] == 'suburban') { ?>selected <?php } ?> value="suburban">Sub-Urban</option>
                            <option <?php if(!empty($row) && $row['area'] == 'metro') { ?>selected <?php } ?> value="metro">Metropolitan</option>
                        </select>
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
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
