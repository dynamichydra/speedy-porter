<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
 ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/customer'); ?>">Back</a>
                </div>
                <?php
              }
              ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>">
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Tracking Id</th>
                                        <th>Product Name</th>
                                        <th>weight</th>
                                        <th>price</th>
                                        <th>Delivery Date</th>
                                        <th>Delivery Status</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
                           ?>
                                        <th>Action</th>
                                      <?php }else{ ?>
                                        <th>Details</th>
                                        <?php
                                      }
                                      ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                            <td><?php echo $v['consignment_id']; ?></td>
                                            <td><?php echo $v['pack_name']; ?></td>
                                            <td><?php echo $v['pack_weight']; ?></td>
                                            <td><?php echo $v['total_price']; ?></td>
                                            <td><?php echo date( "m/d/Y", strtotime($v['delivery_date'])); ?></td>
                                            <td><?php if($v['delivery_status'] == 'pending'){  ?>
                                            <span class="text-red" style="color: red">Pending<span><?php } ?>
                                            <?php if($v['delivery_status'] == 'in-transist'){ ?>
                                        <span class="text-yellow" style="color: yellow">in-transist<span>
                                            <?php } ?>
                                            <?php if($v['delivery_status'] == 'delivered'){ ?>
                                        <span class="text-green" style="color: green">Delivered<span>
                                            <?php } ?></td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
                               ?>
                                            <td>
                                                <?php if($v['delivery_status'] == 'in-transist'){ ?>
                                                <button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping_history/view/".$v['customer']."/".$v['id']);?>"><i class="fa fa-keyboard-o"></i></button>&nbsp;<button class="btn btn-danger btn-icon-anim btn-square list-button" data-title="CUSTOMER" data-tag="delete" data-url="<?php echo base_url("admin/shiping_history/track/".$v['customer']."/".$v['id']);?>"><i class="fa fa-plane"></i></button>
                                            <?php }else{ ?>
                                                <button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping_history/view/".$v['customer']."/".$v['id']);?>"><i class="fa fa-keyboard-o"></i></button>
                                            <?php } ?>
                                                </td>
                                                <?php }else{ ?>
                                                  <td>
                                                      <button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="details"> <a href="<?php echo base_url('merchant/shiping_history/details/'.$v['consignment_id']);?>"><i class="fa fa-keyboard-o"></i></a></button>
                                                  </td>
                                                  <?php
                                                }
                                                ?>
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
