<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Consignment</th>
                                        <th>Transferred From</th>
                                        <!-- <th>Discount(%)</th> -->
                                        <!-- <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                           ?> -->
                                        <th>Action</th>
                                        <!-- <?php
                                      }
                                      ?> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td>Consignment ID:<?php echo $v['consignment_id'] ?><br>Merchant Details: <?php echo $v['merchant_company'] ?>,<?php echo $v['merchant_name'] ?>,<?php echo $v['merchant_address'] ?>,<?php echo $v['merchant_number'] ?><br>Shipping Details:<?php echo $v['shipping_name'] ?>,<?php echo $v['recipient_address']; ?>,<?php echo $v['recipient_landmark']; ?>, <?php echo $v['recipient_area']; ?>, <?php echo $v['recipient_city']; ?>,<?php echo $v['recipient_number'] ?></td>
                                          <!-- <?php $bran = $this->Transfer_model->get_where_all('branch', ['id' => $v['transfer_to']]); ?> -->
                                            <td><?php echo $v['office'];  ?></td>
                                            <!-- <td><?php echo $v['discount_percent'] ?></td> -->
                                            <!-- <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                               ?> -->
                                            <td>
                                              <!-- <button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("#".$v['id']);?>"><i class="fa fa-check-circle"></i></button> -->
                                              <a href="<?php echo base_url('admin/transfer/accept')."/".$v['id']; ?>" class="btn btn-default btn-icon-anim btn-square list-button" title="Receive" onclick="return confirm('Are you sure to receive this order?');"><i class="fa fa-check-circle"></i></a>
                                            </td>
                                            <!-- <?php
                                          }
                                          ?> -->
                                        </tr>


                                        <?php
                                    }
                                    ?>


                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
