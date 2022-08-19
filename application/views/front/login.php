<center>
<div class="col-sm-12 text-center alert alert-danger" id="div_err" style="display:none;"></div>
<div class="col-sm-12 text-center alert alert-success" id="div_succ" style="display:none;"></div>

</center>
<section class="login_area">
    <div class="leftarea">
        <img src="<?php echo base_url('asset/new/images/login_left.jpg');?>" alt="">
    </div>
    <div class="rightarea">
        <div class="linkarea loginlink"><a href="<?php echo base_url('login')?>">LOGIN</a></div>
        <div class="linkarea registerlink"><a href="<?php echo base_url('register')?>">REGISTER</a></div>
        <div class="login-wrap">
            <div class="login-logo">
                <img style="max-height: 56px;" src="<?php echo base_url('asset/new/images/logo/logo.png'); ?>"></a>
            </div>
            <form action='<?php echo base_url('login/login_check'); ?>' method='post' id ='login-form'>
            <div class="login-txt">Signin into your account</div>
            <div class="login-input">
                <input type='email' name="email" placeholder='Email' id='email' required>
                <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' id='email' value="<?php echo base_url();?>">
            </div>
            <div class="login-input">
                <input type='password' name="password" placeholder='Password' id='password' required>
                <p ><a href="<?php echo base_url('login/forgot_password')?>">Forgot password</a></p>
            </div>
            <div class="login-button">
                <button type='submit' class='btn btn-dark btnSave'>LOGIN</button>
            </div>
          </form>
        </div>
    </div>
    <div class="clr"></div>
</section>


<?php
    echo $this->load->view('front/layout/subscribe', [], true);
?>

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
                  if (o.pass_updated == 1) {
                    swal({
                          title: "Success!",
                          text: "Successfully signed in!",
                          icon: "success",
                          // button: "Aww yiss!",
                        });
                    window.setTimeout(function() {
                        window.location.replace(site_url+"merchant/dashboard");
                        }, 1000);
                      }else{
                        swal({
                              title: "Success!",
                              text: "Successfully signed in! please Update your password",
                              icon: "success",
                              // button: "Aww yiss!",
                            });
                        window.setTimeout(function() {
                            window.location.replace(site_url+"admin/user/change_pass");
                            }, 1000);
                      }
                } else {
                    swal({
                          title: "Failure!",
                          text: "Email or Password didn't match!",
                          icon: "error",
                          button: "Try again",
                        });
                }

                $('button#btnSave').text('Save');
            }, 'json');
        });
    })
</script>
