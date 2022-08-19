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
                            <!-- <li><i class="icon icon-arrow-right"></i><a href="<?php echo base_url('dashboard/report');?>">Report</a></li> -->
                        </ul>
                    </div>
                    
                    
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <h1 class="heading left-align">TRACKING STATUS</h1>
                    Consignment ID: <h3 class="heading left-align"><?php echo $consignment_id[0]['consignment_id'] ?></h3>
                    <div class="headul left-align"></div>
                    <table  class="table datatable" style="width: 100%;" cellspacing='0'>
                <thead>
                    <tr>
                        <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;">Sl. No. </th>
                        <!-- <th style="text-align: left;border-bottom: 1px solid #354650;padding: .75rem;">Consignment Id </th> -->
                        <th style="text-align: center;border-bottom: 1px solid #354650;padding: .75rem;"> Date</th>
                        <th style="text-align: center;border-bottom: 1px solid #354650;padding: .75rem;">Event</th>
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
                        <td style="text-align: left; border-bottom: 1px solid #354650;padding: .75rem;"><?php echo $row['detail']?></td>
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





