<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/accounts/createsave_entrylist', array("id" => "createuser-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Name <span class="help"></span></label>
                        <input type="text" id="name" required="" name="name" value="<?php echo (isset($row)) ? $row["name"] : ""; ?>" class="form-control" placeholder="Name" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Designation <span class="help"></span></label>
                        <input type="text" id="designation" required="" name="designation" value="<?php echo (isset($row)) ? $row["designation"] : ""; ?>" class="form-control" placeholder="Designation" autocomplete="off">
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office" name="office" class="form-control">
                          <option value="">Select</option>
                          <?php foreach ($branch as $k => $v) { ?>
                          <option <?php if(!empty($row) && $row['office'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                          <?php } ?>
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
