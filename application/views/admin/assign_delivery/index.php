<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/assign_deliveryperson/create'); ?>">Assign New Delivery</a>
                </div>
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
                                        <th>Branch</th>
                                        <th>Delivery Person </th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                            <td>Tracking Id: <b><?php echo $v['consignment_id'] ?></b><br/>
                                                Package Name: <b><?php echo $v['pack_name'] ?></b><br/>
                                                 Pickup Address: <b><?php echo $v['recipient_address'] ?></b><br/></td>
                                                 <td>Name: <b><?php echo $v['branch_name'] ?></b><br/>
                                                     Phone: <b><?php echo $v['branch_phone'] ?></b><br/>
                                                      Address: <b><?php echo $v['branch_address'] ?></b><br/></td>
                                            <td><?php echo $v['delivery_person_name']; ?></td>
                                            <td><?php if($v['status'] == 'active'){  ?>
                                            <span class="text-green" style="color: green">Active<span><?php } ?>
                                            <?php if($v['status'] == 'inactive'){ ?>
                                        <span class="text-red" style="color: red">Deactive<span>
                                            <?php } ?></td>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/assign_deliveryperson/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="ASSIGN" data-tag="delete" data-url="<?php echo base_url("admin/assign_deliveryperson/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td>
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
