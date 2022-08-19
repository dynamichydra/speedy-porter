<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/general_setting/updatetheme', array("id" => "updatetheme-form", "method" => "post")); ?>
                          <div class="form-group">
                            <label class="control-label mb-10 text-left">Choose Theme<span class="help"></span></label>
                            <select id="theme" name="theme" class="form-control select2" >
                                <option value="">Select Theme</option>
                                  <option value="light" <?php if(isset($theme) && $theme[0]['theme'] == 'light'){ echo "selected";}?>>Light</option>
                                  <option value="dark" <?php if(isset($theme) && $theme[0]['theme'] == 'dark'){ echo "selected";}?>>Dark</option>
                            </select>
                          </div>

                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <input type="hidden" value="<?php echo (isset($userid))?$userid:"";?>" id="id" name="id">
                        <button type="submit" class="btn btn-info btn-rounded" id="btn-updatetheme">Update</button>
                        <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                      </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
