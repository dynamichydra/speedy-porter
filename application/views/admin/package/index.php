<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/package/create'); ?>">Add new Package</a>
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
                                        <th>Package Name</th>
                                        <th>Metropolitan </th>
                                        <th>Sub-Urban</th>
                                        <th>Urban</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                            <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['metro_dc']; ?>/<?php echo $v['metro_extra_chrg']; ?>/<?php echo $v['urban_dis_extra_chrg']; ?>/<?php echo $v['metro_cod_chrg']; ?>%</td>
                                            <td><?php echo $v['sub_urban_dc']; ?>/<?php echo $v['sub_urban_extra_chrg']; ?>/<?php echo $v['sub_dis_extra_chrg']; ?>/<?php echo $v['sub_urban_cod_chrg']; ?>%</td>
                                            <td><?php echo $v['urban_dc']; ?>/<?php echo $v['urban_extra_chrg']; ?>/<?php echo $v['metro_dis_extra_chrg']; ?>/<?php echo $v['urban_cod_chrg']; ?>%</td>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/package/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="PACKAGE" data-tag="delete" data-url="<?php echo base_url("admin/package/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td>
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
