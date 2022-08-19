
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="mb-30">
            <h3 class="text-center txt-dark mb-10">Reset Password</h3>
            <!-- <h6 class="text-center nonecase-font txt-grey">Enter your email to reset your password</h6> -->
        </div>

        <!-- <h2>Login</h2> -->
        <?php echo form_open('admin/home/update_password', array("id" => "login-form", "method" => "post")); ?>
        <div class="form-group">
            <!-- <label class="control-label mb-10" for="exampleInputem_2">Email address</label> -->
            <input type="email" class="form-control" style="color:black;" required="" id="email" name="email" placeholder="Enter email" value="<?php echo $email?>" readonly>
            <input type="hidden" class="form-control" style="color:black;" required="" id="user_id" name="user_id" value="<?php echo $user_id?>">
            <input type="hidden" class="form-control" style="color:black;" required="" id="user_type" name="user_type" value="<?php echo $user_type?>">
        </div>
        <div class="form-group">
            <!-- <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label> -->
            <!-- <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="<?php echo base_url('admin/home/forgot_password')?>">forgot password ?</a> -->
            <!-- <div class="clearfix"></div> -->
            <input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter new password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" required="" id="password" name="password" placeholder="Confirm password">
        </div>


        <div class="form-group text-center">
            <button type="submit" class="btn btn-info btn-rounded">Update Password</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>
