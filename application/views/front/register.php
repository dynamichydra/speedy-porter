
<section class="login_area">
    <div class="leftarea">
        <img src="<?php echo base_url('asset/new/images/login_left.jpg');?>" alt="">
    </div>
    <div class="rightarea">
        <div class="linkarea loginlink"><a href="<?php echo base_url('login')?>">LOGIN</a></div>
        <div class="linkarea registerlink"><a href="<?php echo base_url('register')?>">REGISTER</a></div>
        <div class="login-wrap" style="margin: 10% auto;">
            <div class="login-logo">
                <img style="max-height: 56px;" src="<?php echo base_url('asset/new/images/logo/logo.png'); ?>"></a>
            </div>
            <div class="login-txt">Signup to SPEEDY PORTER</div>
            <form action='<?php echo base_url('home/insert'); ?>' method='post' id ='reg-form'>
            <div class="login-input">
                <input type='text' name="name" placeholder='Name'  id='name' required>
                <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' value="<?php echo base_url();?>">
            </div>
            <div class="login-input">
                <input type='email' name="email" placeholder='Email'id='email' required>
            </div>
            <div class="login-input">
                <input type='text' name="phone" placeholder='Phone Number'  id='phone' required>
            </div>
            <!-- <div class="login-input">
                <input type='password' name="password" placeholder='Password'  id='password' required>
            </div> -->
            <!-- <div class="login-input">
                <input type='password' name="cpassword" placeholder='Confirm Password'  id='cpassword' required>
            </div> -->
            <div class="login-button">
                <button type='submit' class='btn btn-dark btnSave'>SIGNUP</button>
            </div>
            </form>
        </div>
    </div>
    <div class="clr"></div>
</section>


<?php
    echo $this->load->view('front/layout/subscribe', [], true);
?>

<!-- Section End - Request A Quote -->
    <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
    $(function(){
        // member registration form submit
        $('#reg-form').submit(function(e) {
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
                        swal(o.message, {
                    buttons: {
                      cancel: "Okay got it",
                    },
                  })
                  .then((value) => {
                    switch (value) {
                      default:
                        swal("Password Sent to EMAIL");
                        window.setTimeout(function() {
                            window.location.replace(site_url+"login");
                          }, 4000);
                    }
                  });
                } else {
                    swal({
                          title: "Failure!",
                          // text: o.message,
                          html: true,
                          text: o.message,
                          icon: "warning",
                          button: "OK",
                        });
                }

                $('button#btnSave').text('Save');
            }, 'json');
        });
    })
</script>
