    <!-- Section Start - Page Sidebar -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="sidebar-widget search-widget">
                        <form action="#" method="post">
                            <i class="icon icon-magnify"></i>
                            <input type="text" placeholder="Search...">
                            <input type="submit" value="">
                        </form>
                    </div>
                    <div class="sidebar-widget">
                        <h4>Dashboard</h4>
                        <div class="headul"></div>
                        <ul>
                            <!-- <li><i class="icon icon-arrow-right"></i><a href="#">Profile</a></li> -->
                            <li><i class="icon icon-arrow-right"></i><a href="<?php echo base_url('delivery');?>">Create Delievry</a></li>
                            <li><i class="icon icon-arrow-right"></i><a href="<?php echo base_url('dashboard/report');?>">Report</a></li>
                        </ul>
                    </div>


                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <h1 class="heading left-align">Profile</h1>
                    <div class="headul left-align"></div>
                    <form action='<?php echo base_url('home/saveProfile'); ?>' method='post' id ='reg-form'>
                            <!-- <h4 class="col-md-12">User Information</h4> -->
                            <div class='col-xs-6'>
                                <label>Name</label>
                                <input type='text' name="name" placeholder='' class='transition' id='est_fn' value="<?php echo $customer[0]['name']?>">
                                <input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' id='email' value="<?php echo base_url();?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Email</label>
                                <input type='email' name="email" placeholder='' class='transition' id='est_email' value="<?php echo $customer[0]['email']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Address</label>
                                <input type='text' name="address" placeholder='' class='transition' id='est_add' value="<?php echo $customer[0]['address']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Phone</label>
                                <input type='text' name="phone" placeholder='' class='transition' id='est_phone' value="<?php echo $customer[0]['phone']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Website</label>
                                <input type='text' name="web" placeholder='' class='transition' id='web' value="<?php echo $customer[0]['website']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Company</label>
                                <input type='text' name="company" placeholder='' class='transition' id='company' value="<?php echo $customer[0]['company']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Bank Name</label>
                                <input type='text' name="bank_name" placeholder='' class='transition' id='bank_name' value="<?php echo $customer[0]['bank_name']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Bank Branch</label>
                                <input type='text' name="bank_branch" placeholder='' class='transition' id='bank_branch' value="<?php echo $customer[0]['bank_branch']?>">
                            </div>
                            <div class='col-xs-6'>
                                <label>Bank Acc No.</label>
                                <input type='text' name="bank_account" placeholder='' class='transition' id='bank_account' value="<?php echo $customer[0]['bank_account']?>">
                            </div>

                            <div class='col-xs-6'>
                                <label>Other Info</label>
                                <input type='text' name="others" placeholder='' class='transition' id='others' value="<?php echo $customer[0]['others']?>">
                            </div>

                            <div class='col-xs-6'>
                                <label>Facebook</label>
                                <input type='text' name="facebook" placeholder='' class='transition' id='facebook' value="<?php echo $customer[0]['facebook']?>">
                            </div>
                            <!-- <div class='col-xs-6'>
                                <label>Phone</label>
                                <input type='text' name="phone" placeholder='' class='transition' id='est_phone' value="<?php echo $customer[0]['phone']?>">
                            </div> -->


                            <div class='col-xs-12'>
                                <button type='submit' class='btn btn-primary enabled transition btnSave' id='est_submit'>save</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Page Sidebar -->

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
                        window.location.reload();
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
