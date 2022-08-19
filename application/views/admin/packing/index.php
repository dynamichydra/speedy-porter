<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

              <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
              ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/packing/create'); ?>">Add new packing</a>
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
                                        <th>Package Name</th>
                                        <th>Allowed Delivery Type </th>
                                        <th>Packing Price</th>
                                        <th>total Price</th>
                                        <!-- <th>Packing Width</th> -->
                                        <?php
                                        if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                                        ?>
                                        <th>Action</th>
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
                                            <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['delivery_type']; ?></td>
                                            <td><?php echo $v['price']; ?></td>
                                            <td><?php echo $v['total_price']; ?></td>
                                            <!-- <td><?php echo $v['width']; ?></td> -->
                                            <?php
                                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                                            ?>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/packing/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="PACKING" data-tag="delete" data-url="<?php echo base_url("admin/packing/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td>
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
