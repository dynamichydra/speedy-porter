   <style type="text/css">
       form input {
    background-color: #f5f5f5;
    color: #757575;
    border: 0px solid rgba(255, 255, 255, 0.5);
    height: 50px;
    padding: 10px 15px;
    margin-bottom: 40px;
    vertical-align: top;
}
   </style>
    <!-- Section Start - Our Mission -->
    <center>
<div class="col-sm-12 text-center alert alert-danger" id="div_err" style="display:none;"></div>
<div class="col-sm-12 text-center alert alert-success" id="div_succ" style="display:none;"></div>

</center>
    <section class='mission bg-lightgray' id='mission'>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 text-area">
                    <h1 class="heading left-align">Sign In</h1>
                    <div class="headul left-align"></div>
                    <p>Don't have an account with us? <a href="<?php echo base_url('home/register'); ?>">Register here</a> to create new account at SPEEDYPORTER.com</p>
                    <!-- <a href="#" class="btn btn-primary">Register here</a> -->
                </div><br><br>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-0 contact-full-info">
                    <div class='row'>
                        <h3 class="heading left-align"></h3>
                        <form action='<?php echo base_url('login/login_check'); ?>' method='post' id ='login-form'>
                            <div class='col-xs-12'>
                                <input type='email' name="email" placeholder='Email' class='transition' id='email' required>
                                <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' id='email' value="<?php echo base_url();?>">
                            </div>
                            <div class='col-xs-12'>
                                <input type='password' name="password" placeholder='Password' class='transition' id='password' required>
                                <p style="float:right">Forgot password? <a href="#">Reset</a></p>
                                <!-- <p style="float:right">Forgot password? <a href="<?php echo base_url('home/forgot_password'); ?>">Reset</a></p> -->
                            </div>

                            <!-- <div id='response_email' class='col-xs-12'></div> -->
                            <div style="float: right" class='col-xs-4'>
                                <button type='submit' class='btn btn-primary transition btnSave'>Login</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Section End - Our Mission -->
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
    $(function(){
        // member registration form submit
        $('#login-form').submit(function(e) {
            e.preventDefault();

            $('button#btnSave').text('Loading...');

            var site_url = $('#base_url').val();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            console.log(postData);
            $.post(url, postData, function (o) {
                // $("html, body").animate({ scrollTop: 0 }, 500);
                console.log(o.success);
                if (o.success == true) {
                    swal({
                          title: "Success!",
                          text: "Successfully signed in!",
                          icon: "success",
                          // button: "Aww yiss!",
                        });
                    window.setTimeout(function() {
                        window.location.replace(site_url+"merchant/dashboar");
                        }, 1000);
                } else {
                    swal({
                          title: "Failure!",
                          text: "Email or Password didn't match or Account inactive!",
                          icon: "error",
                          button: "Try again",
                        });
                }

                $('button#btnSave').text('Save');
            }, 'json');
        });
    })
</script>
