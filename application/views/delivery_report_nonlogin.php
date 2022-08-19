<!-- Section Start - Request A Quote -->
    <section class='estimate' id='estimate'>
        <div class="container">
            <div class="row">
              <?php if (!empty($consignment_id[0]['consignment_id'])) {?>
                <h1 class="heading">Tracking Status</h1>
                <div class="headul"></div>
                <p class="subheading">Consignment ID: <b><?php echo $consignment_id[0]['consignment_id'] ?></b></p>
                <!-- <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 quote-form "> -->
                    <!-- Estimate Form - Start -->
                    <div class='wrapper'>
                        <table  class="table datatable" style="width: 100%;" cellspacing='0'>
                <thead>
                    <tr>
                        <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;">Sl. No. </th>
                        <!-- <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;">Consignment Id </th> -->
                        <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;"> Date</th>
                        <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;"> Status</th>
                        <th style="text-align: right;border-bottom: 1px solid #354650;padding: .75rem;">Event</th>
                        <!-- <th style="text-align: center;border-bottom: 1px solid #354650;padding: .75rem;"> UOM </th> -->


                    </tr>
                </thead>

                <tbody>
                    <?php
                    if(!empty($consignment)){
                                              $j = 0;
                                              foreach ($consignment as $row):
                                          ?>
                    <tr>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $j+1; ?></td>
                        <!-- <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><a href="<?php echo base_url('delivery/status/'.$row['consignment_id']);?>"><?php echo $row['consignment_id']?></a></td> -->
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $row['date']?></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $row['consignment_status']?></td>
                        <td style="text-align: right; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $row['detail']?></td>
                        <!-- <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].unit%></td> -->

                    </tr>
                    <?php
                                              $j++;
                                              endforeach;
                                          }else{
                                            $j = 0;
                                          ?>
                                            <tr>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $j+1; ?></td>
                        <!-- <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><a href="<?php echo base_url('delivery/status/'.$row['consignment_id']);?>"><?php echo $row['consignment_id']?></a></td> -->
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $consignment_id[0]['timestamp']?></td>
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;">Order Placed</td>
                        <!-- <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><%-row[k].unit%></td> -->

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
                    </div>
                    <!-- Estimate Form - End -->
                <!-- </div> -->
                <?php
              }else{
              ?>
              <div id="noData">
                <center>
                <p>please provide a valid consignment no.</p><br>
                Return <a href="<?php echo base_url();?>">Home</a>
              </center>
              </div>
              <?php
            }
            ?>
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
