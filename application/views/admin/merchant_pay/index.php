<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
  ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/merchant_pay/create'); ?>">Pay Merchant</a>
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
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Merchant</th>
                                        <th>Amount</th>
                                        <th>Date-time </th>
                                        <!-- <th>Status</th>
                                        <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                            <td><b><?php echo $v['merchant_name'] ?></b></td>
                                            <td><?php echo $v['amount_paid']; ?></td>
                                            <td><?php echo $v['date']; ?></td>
                                            <!-- <td><?php if($v['status'] == 'active'){  ?>
                                            <span class="text-green" style="color: green">Active<span><?php } ?>
                                            <?php if($v['status'] == 'inactive'){ ?>
                                        <span class="text-red" style="color: red">Deactive<span>
                                            <?php } ?></td>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/assign_deliveryperson/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="ASSIGN" data-tag="delete" data-url="<?php echo base_url("admin/assign_deliveryperson/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td> -->
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
