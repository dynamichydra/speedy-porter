<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/user/updatepassword', array("id" => "updatepassword-form", "method" => "post")); ?>
                          <div class="form-group">
                              <label>Current Password: </label>
                              <input type="password" name="password" value="" class="form-control" placeholder="Old Password">
                              <input type="hidden" name="id" value="<?php echo (isset($user_id)) ? $user_id : ""; ?>" class="form-control">
                          </div>
                          <div class="form-group">
                              <label>New Password: </label>
                              <!-- <input type="password" name="new-password" value="" class="form-control"> -->
                              <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="psw" id="psw" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password">
                              <div id="message">
                                <h3>Password must contain the following:</h3>
                                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                                <p id="number" class="invalid">A <b>number</b></p>
                                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label>Confirm Password: </label>
                              <input type="password" class="form-control" name="c_password" id="c_password" onkeyup="Validate()" placeholder="Password">
                              <div id="error-message" style="display:none;">
                                <p style="color:red;"><b>Passwords do not match, New Password and Confirm Password must be same.</b></p>
                              </div>
                          </div>

                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <button type="submit" class="btn btn-info btn-rounded" id="btn-changepassord">Update</button>
                        <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                      </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
