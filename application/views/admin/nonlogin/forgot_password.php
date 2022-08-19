
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="mb-30">
            <h3 class="text-center txt-dark mb-10">Forgot Password</h3>
            <h6 class="text-center nonecase-font txt-grey">Enter your email to reset your password</h6>
        </div>

        <!-- <h2>Login</h2> -->
        <?php echo form_open('admin/home/reset_mail', array("id" => "login-form", "method" => "post")); ?>
        <div class="form-group">
            <!-- <label class="control-label mb-10" for="exampleInputem_2">Email address</label> -->
            <input type="email" class="form-control" required="" id="email" name="email" placeholder="Enter email">
            <div class="clearfix"></div>
            <!-- <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="<?php echo base_url('admin')?>">Sign in</a> -->
            <!-- <div class="clearfix"></div> -->
            <br>
            <select id="user_type" name="user_type" class="form-control select2">
                <option value="">Select your role</option>
                <option value="admin" <?php if(isset($row) && $row['user_type'] == 'admin'){ echo "selected";}?>>admin</option>
                <option value="staff" <?php if(isset($row) && $row['user_type'] == 'staff'){ echo "selected";}?>>staff(support service)</option>
                <option value="branch" <?php if(isset($row) && $row['user_type'] == 'branch'){ echo "selected";}?>>branch</option>
                <option value="customer_care" <?php if(isset($row) && $row['user_type'] == 'customer_care'){ echo "selected";}?>>Customer Care</option>
                <option value="delivery" <?php if(isset($row) && $row['user_type'] == 'delivery'){ echo "selected";}?>>delivery</option>
                <option value="receiver" <?php if(isset($row) && $row['user_type'] == 'receiver'){ echo "selected";}?>>receiver</option>
            </select>
        </div>
        <div class="form-group">
            <a class="capitalize-font txt-primary block mb-10 pull-left font-12" href="<?php echo base_url('admin')?>">Sign in</a>

        </div>


        <div class="form-group text-center">
            <button type="submit" class="btn btn-info btn-rounded">Send Email</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>
