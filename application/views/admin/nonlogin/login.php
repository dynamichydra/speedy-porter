
<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="mb-30">
            <h3 class="text-center txt-dark mb-10">Sign in to SPEEDY PORTER</h3>
            <h6 class="text-center nonecase-font txt-grey">Enter your details below</h6>
        </div>

        <!-- <h2>Login</h2> -->
        <?php echo form_open('admin/home/login', array("id" => "login-form", "method" => "post")); ?>
        <div class="form-group">
            <!-- <label class="control-label mb-10" for="exampleInputem_2">Email address</label> -->
            <input type="email" class="form-control" required="" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <!-- <label class="pull-left control-label mb-10" for="exampleInputpwd_2">Password</label> -->
            <div class="clearfix"></div>
            <input type="password" class="form-control" required="" id="password" name="password" placeholder="Enter password">
            <input type="checkbox" onclick="myFunction()">  Show Password
            <a class="capitalize-font txt-primary block mb-10 pull-right font-12" href="<?php echo base_url('admin/home/forgot_password')?>">forgot password ?</a>

        </div>


        <div class="form-group text-center">
            <button type="submit" class="btn btn-info btn-rounded">sign in</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
