<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
 ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/branch/create'); ?>">Add new branch</a>
                </div>
                <?php
              }
            }
              ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datablebranch_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>district</th>
                                        <th>Zip code</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                           ?>
                                        <th>Action</th>
                                        <?php
                                      }
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
                                            <td><?php echo $v['address'] ?></td>
                                            <td><?php echo $v['district_name'] ?></td>
                                            <td><?php echo $v['police_station'] ?></td>
                                            <td><?php echo $v['phone'] ?></td>
                                            <td><?php echo $v['email'] ?></td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                               ?>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/branch/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <?php if($v['id'] != 11){?>
                                              <button class="btn btn-info btn-icon-anim btn-square list-button" data-title="Branch" data-tag="delete" data-url="<?php echo base_url("admin/branch/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;
                                            <?php } ?>
                                              <a href="<?php echo base_url('admin/branch/print_detail')."/".$v['id']; ?>" class="btn btn-success btn-icon-anim btn-square list-button" title="Print" target="_blank"><i style="margin-top: 15px;" class="fa fa-print"></i></a></td>
                                            <?php
                                          }
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

<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#datablebranch_1').DataTable( {

        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
         {
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL'
         }
        ]
    } );
} );
</script>
