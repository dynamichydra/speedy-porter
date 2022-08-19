<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/support/create'); ?>"> New support</a>
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
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Link</th>
                                        <th>File Attached</th>
                                        <th>Message</th>
                                        <th>Assesment</th>
                                        <th>Status</th>
                                        <!-- <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                           ?>
                                        <th>Action</th>
                                        <?php
                                      }
                                    }
                                      ?> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td><?php echo $v['date'] ?></td>
                                            <td><?php echo $v['user_type'] ?></td>
                                            <td><?php echo $v['link'] ?></td>
                                            <?php if($v['file'] != ""){?>
                                            <td><a target="_blank" href="<?php echo base_url('uploads/support/'.$v["file"])?>">click here</a></td>
                                            <?php
                                          }else{
                                            ?>
                                              <td>No file</td>
                                              <?php
                                            }
                                            ?>
                                            <td><?php echo $v['msg'] ?></td>
                                            <td><?php echo $v['assesment'] ?></td>
                                            <td><?php echo $v['status'] ?></td>
                                            <!-- <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                               ?>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/branch/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="Branch" data-tag="delete" data-url="<?php echo base_url("admin/branch/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td>
                                            <?php
                                          }
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
