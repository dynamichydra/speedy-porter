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
        <div class="login-wrap">
            <div class="login-logo">
                <img style="max-height: 56px;" src="<?php echo base_url('asset/new/images/logo/logo.png'); ?>"></a>
            </div>
            <?php echo form_open('login/update_password', array("id" => "login-form", "method" => "post")); ?>
            <div class="login-txt">Update Password</div>
            <div class="login-input">
                <input type='password' name="pass" placeholder='Password' id='pass' required>
                <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' id='email' value="<?php echo base_url();?>">
            </div>
            <div class="login-input">
                <input type='password' name="confpass" placeholder='Confirm Password' id='confpass' required>
                <input type="hidden" class="form-control" style="color:black;" required="" id="user_id" name="user_id" value="<?php echo $user_id?>">
                <input type="hidden" class="form-control" style="color:black;" required="" id="user_type" name="user_type" value="<?php echo $user_type?>">
            </div>
            <div class="login-button">
                <button type='submit' class='btn btn-dark btnSave'>Update Password</button>
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
                          text: "Password updated successfully,please login again",
                          icon: "success",
                          // button: "Aww yiss!",
                        });
                    window.setTimeout(function() {
                        window.location.replace(site_url+"login");
                        }, 1000);
                      }else{
                        swal({
                              title: "Success!",
                              text: "Password updated successfully,please login again",
                              icon: "success",
                              // button: "Aww yiss!",
                            });
                        window.setTimeout(function() {
                            window.location.replace(site_url+"login");
                            }, 1000);
                      }
                } else {
                    swal({
                          title: "Failure!",
                          text: "Something went wrong pls try again.",
                          icon: "error",
                          button: "Try again",
                        });
                }

                $('button#btnSave').text('Save');
            }, 'json');
        });
    })
</script>
