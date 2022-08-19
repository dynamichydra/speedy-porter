<!-- Breadcrumb -->
<section class="theme-breadcrumb pad-50">
                    <div class="theme-container container ">
                        <div class="row">
                            <div class="col-sm-8 pull-left">
                                <div class="title-wrap">
                                    <h2 class="section-title no-margin"> Register with us </h2>
                                    <p class="fs-16 no-margin"> It will take less than a minute </p>
                                </div>
                            </div>
                            <div class="col-sm-4 mob-none">
                                <ol class="breadcrumb-menubar list-inline">
                                    <li><a href="#" class="gray-clr">Home</a></li>
                                    <li class="active">Register</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Breadcrumb -->

                <!-- Contact Us -->
                <section class="contact-page pad-30" style="padding-top: 0;">
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-1">
                              <ul class="contact-detail title-2 pt-50">
                                  <li class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s"> <span>Location:</span> <p class="gray-clr"> S.P Mukherjee Road,<br> Kolkata-700059 </p> </li>
                                  <li class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".40s"> <span>Phone:</span> <p class="gray-clr"> +001-2463-957 <br> +001-4356-643 </p> </li>
                                  <li class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".50s"> <span>Email address:</span> <p class="gray-clr"> support@speedy.com <br> info@speedy.com </p> </li>
                              </ul>
                            </div>

                            <div class="col-md-5 col-sm-6 col-md-offset-1 contact-form">
                                <div class="calculate-form">
                                    <!-- <form class="row" id="contact-form"> -->
                                      <form action='<?php echo base_url('home/insert'); ?>' method='post' id ='reg-form'>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                            <div class="col-sm-3"> <label class="title-2"> Name: </label></div>
                                            <div class="col-sm-9">
                                              <input type="text" name="name" id="name" required="" placeholder="" class="form-control">
                                            <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' value="<?php echo base_url();?>"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                            <div class="col-sm-3"> <label class="title-2"> Email: </label></div>
                                            <div class="col-sm-9"> <input type="text" name="email" id="email" required="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="" class="form-control"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                            <div class="col-sm-3"> <label class="title-2"> Phone: </label></div>
                                            <div class="col-sm-9"> <input type="text" name="phone" id="phone" placeholder="" class="form-control"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s">
                                            <div class="col-sm-9 col-xs-12 pull-right">
                                                <!-- <button name="submit" id="submit_btn" class="btn-1"> send message </button> -->
                                                <button type='submit' id="submit_btn" class='btn-1 btn btn-dark btnSave'>SIGNUP</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Contact Us -->

                <!-- Contact Map -->
                <section class="map pt-80">
                    <div class="">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.364967147612!2d88.33367281479549!3d22.751833085090762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f89b27a9276299%3A0xb3a2cfb47ae05848!2sRendement%20Technologies%20Private%20Limited!5e0!3m2!1sen!2sin!4v1643691112959!5m2!1sen!2sin" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </section>
                <!-- /.Contact Map -->


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
                                            window.location.replace(site_url);
                                            // window.location.replace(site_url+"login");
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
