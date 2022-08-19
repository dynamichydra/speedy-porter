<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/user/createsave', array("id" => "createuser-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Name<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Full name" value="<?php echo (isset($row)) ? $row["name"] : ""; ?>" id="name" name="name" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Email <span class="help"></span></label>
                        <input type="email" id="email" required="" name="email" value="<?php echo (isset($row)) ? $row["email"] : ""; ?>" class="form-control" placeholder="Email" autocomplete="off">
                      </div>
                    </div>
                    <!-- <div class="form-group">

                    </div> -->
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Phone <span class="help"></span></label>
                      <input type="text" id="email" required="" name="phone" value="<?php echo (isset($row)) ? $row["phone"] : ""; ?>" class="form-control" placeholder="phone No." autocomplete="off">
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> User Type <span class="help"></span></label>
                        <select id="user_type" name="user_type" class="form-control select2" onChange="branchBoxChng();">
                            <option value="">Select user type</option>
                            <option value="admin" <?php if(isset($row) && $row['user_type'] == 'admin'){ echo "selected";}?>>admin</option>
                            <option value="staff" <?php if(isset($row) && $row['user_type'] == 'staff'){ echo "selected";}?>>staff(support service)</option>
                            <option value="branch" <?php if(isset($row) && $row['user_type'] == 'branch'){ echo "selected";}?>>branch</option>
                            <option value="customer_care" <?php if(isset($row) && $row['user_type'] == 'customer_care'){ echo "selected";}?>>Customer Care</option>
                        </select>
                      </div>

                      <?php
                      if (isset($row)) {
                          ?>
                          <div class="col-sm-6" style="margin-top: 5px;">
                            <label class="control-label mb-10 text-left">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="off">
                                <small style="color:red;">Leave the password field blank, if you dont want to change the password.</small>
                          </div>
                          <?php
                      }else{
                      ?>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Password</label>
                        <input type="password" required="" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="off">
                            <small style="color:red;">Leave the password field blank, if you dont want to change the password.</small>
                      </div>
                      <?php
                    }
                    ?>

                    </div>

                    <div id="branchBox" class="col-sm-6" style="margin-top: 5px; display:none;">
                      <label class="control-label mb-10 text-left"> Branch <span class="help"></span></label>
                      <select id="selected_branch" name="selected_branch" class="form-control select2" >
                          <option value="">Select branch</option>
                          <?php foreach ($branch as $k => $v) { ?>
                          <option <?php if(!empty($row) && $row['branch'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                          <?php } ?>

                      </select>
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
            </div>
        </div>
    </div>
</div>
