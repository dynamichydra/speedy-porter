<?php error_reporting(0);?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
 ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/customer/create'); ?>">Add new Customer </a>
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
                            <table id="datable_2_cust" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                       <th>Registered On</th>
                                       <th>Referral Code</th>
                                        <th>Customer Name</th>
                                        <th>Customer address </th>
                                        <th>Customer Number</th>
                                        <th>Email</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td><?php $dt = new DateTime($v['registered_on']);echo $dt->format('d, M Y'); ?></td>
                                          <td><?php echo $v['ref_code'] ?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <?php
                                            $merchantadd = $this->customer_model->get_where_all('shiping',['customer'=>$v['id']]);
                                            ?>
                                            <td>
                                              <?php if($v['address'] != ""){ echo $v['address'];}else{echo "N/A";}?>
                                        </td>
                                            <td><?php echo $v['phone'] ?></td>
                                            <td><?php echo $v['email'] ?></td>
                                            <?php
                                            // if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
                               ?>
                                            <td><button id="editButton" class="btn btn-default btn-icon-anim btn-square list-button editButton" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/customer/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <button class="btn btn-info btn-icon-anim btn-square list-button" onclick="actionFunction()" data-title="MERCHANT" data-tag="delete" data-url="<?php echo base_url("admin/customer/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;
                                              <!-- <button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping/index/".$v['id']);?>"><i class="fa fa-plane"></i></button> -->
                                            </button>
                                            <!-- <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/customer/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="MERCHANT" data-tag="delete" data-url="<?php echo base_url("admin/customer/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;<button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping/index/".$v['id']);?>"><i class="fa fa-plane"></i></button>
                                            </button>&nbsp;<button class="btn btn-primary btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping_history/index/".$v['id']);?>"><i class="fa fa-thumbs-o-up"></i></button> -->

                                                </td>
                                                <?php
                                              }elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'branch'){
                                              ?>
                                              <td>
                                                <?php if($v['created_by'] != "admin"){?>
                                                <button id="editButton" class="btn btn-default btn-icon-anim btn-square list-button editButton" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/customer/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                                <button class="btn btn-info btn-icon-anim btn-square list-button" data-title="MERCHANT" onclick="actionFunction()" data-tag="delete" data-url="<?php echo base_url("admin/customer/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;
                                            <?php  } ?>
                                                <!-- <button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping/index/".$v['id']);?>"><i class="fa fa-plane"></i></button> -->
                                                  </td>
                                                  <?php
                                                }elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff'){
                                              ?>
                                              <td><button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping/index/".$v['id']);?>"><i class="fa fa-plane"></i></button>
                                                  </td>
                                                  <?php
                                                }elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer_care'){
                                                ?>
                                                <td><button class="btn btn-success btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/shiping/index/".$v['id']);?>"><i class="fa fa-plane"></i></button>
                                                    </td>
                                                    <?php
                                                  }?>
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

<!-- <script>
$(document).ready(function(){
    var table = $('#datable_1_cust').DataTable({
        "fnDrawCallback": function( oSettings ) {
            componentHandler.upgradeDOM();
        }
    });
});

function myFunction() {
  alert("danger");
}
</script> -->

<script>
$(document).ready(function() {
    $('#datable_2_cust').DataTable( {

        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
         {
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL'
         }
       ],
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
<script>
function actionFunction(){
$(".list-button").on("click", function (e) {
    var _this = this;
    var type = $(this).attr("data-tag");
    console.log(type);
    if (type === "edit") {
        window.location.href = $(this).attr("data-url");
    } else if (type === 'delete') {
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this " + $(this).attr("data-title") + "!!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e91e63",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.get($(_this).attr("data-url"), function (data) {
                    if (data.success == false) {
                        showToastMessage('Error', data.message, 'error');
                    } else {
                        showToastMessage('Success', data.message, 'success');
                        window.location.reload();
                    }
                });
            } else {

            }
        });

    }
});
}
</script>
