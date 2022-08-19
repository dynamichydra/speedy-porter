<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/add_data/createsave_dimension', array("id" => "createuser-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Height (cm)<span class="help"></span></label>
                        <input type="text" id="height" required="" name="height" value="<?php echo (isset($row)) ? $row["height"] : ""; ?>" class="form-control" placeholder="Height" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Width (cm)<span class="help"></span></label>
                        <input type="text" id="width" required="" name="width" value="<?php echo (isset($row)) ? $row["width"] : ""; ?>" class="form-control" placeholder="Width" autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Price <span class="help"></span></label>
                        <input type="number" id="price" required="" name="price" value="<?php echo (isset($row)) ? $row["price"] : ""; ?>" class="form-control" placeholder="Price" autocomplete="off">
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
