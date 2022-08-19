<!-- Section Start - Request A Quote -->
    <section class='estimate' id='estimate'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Register with us</h1>
                <div class="headul"></div>
                <p class="subheading">Please fill in this form to create an account.</p>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 quote-form ">
                    <!-- Estimate Form - Start -->
                    <div class='row'>
                        <form action='<?php echo base_url('home/insert'); ?>' method='post' id ='reg-form'>
                            <h4 class="col-md-12">User Information</h4>
                            <div class='col-xs-6'>
                                <label>Name</label>
                                <input type='text' name="name" placeholder='' class='transition' id='est_fn'>
                                <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' value="<?php echo base_url();?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Email</label>
                                <input type='email' name="email" placeholder='' class='transition' id='est_email'>
                            </div>
                            <div class='col-xs-6'>
                                <label>Address</label>
                                <input type='text' name="address" placeholder='' class='transition' id='est_add'>
                            </div>
                            <div class='col-xs-6'>
                                <label>Phone</label>
                                <input type='text' name="phone" placeholder='' class='transition' id='est_phone'>
                            </div>
                            <div class='col-xs-6'>
                                <label>Password</label>
                                <input type='password' name="password" placeholder='' class='transition' id='est_state'>
                            </div>
                            <div class='col-xs-6'>
                                <label>Confirm Password</label>
                                <input type='password' placeholder='' class='transition' id='est_country'>
                            </div>
                            
                            <div class='col-xs-12'>
                                <button type='submit' class='btn btn-primary enabled transition btnSave' id='est_submit'>Sign Up</button>
                            </div>
                        </form>
                    </div>
                    <!-- Estimate Form - End -->
                </div>
            </div>
        </div>
    </section>
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
                    swal({
                          title: "Success!",
                          text: o.message,
                          icon: "success",
                          // button: "Aww yiss!",
                        });
                    window.setTimeout(function() {
                        window.location.replace(site_url+"login");
                        }, 1000);
                } else {
                    swal({
                          title: "Failure!",
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