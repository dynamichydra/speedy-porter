<?php error_reporting(0);?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
 ?>

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
                                        <th>Date</th>
                                        <th>Company Name</th>
                                        <th>Merchant Name</th>
                                        <th>Merchant address </th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <!-- <th>Pickup Office</th> -->
                                        <th>Bank Details</th>
                                        <!-- <th>Website</th> -->
                                        <th>Mobile Banking Details</th>
                                        <?php
                                        // if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                                        ?>
                                        <th>Action</th>
                                        <?php
                                      // }
                                      ?>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                      $dataorigional = $this->customer_model->get_where_all('customer', ["id" => $v['profile_id']]);
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td><?php $dt = new DateTime($v['update_date']);echo $dt->format('d, M Y'); ?></td>
                                            <td><?php echo $v['company_name'];?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <td>
                                              <?php echo $v['address']?>
                                        </td>
                                            <td><?php echo $v['phone'] ?></td>
                                            <td><?php echo $v['email'] ?></td>

                                            <td><?php echo $v['bank_account_name'] ?><br><?php echo $v['bank_name'] ?><br> <?php echo $v['bank_branch'] ?><br> <?php echo $v['bank_account'] ?><br>Routing no: <?php echo $v['bank_routing'] ?></td>

                                            <td ><?php echo ucfirst($v['mobile_banking_type']) ?><br><?php echo $v['mobile_banking_no'] ?></td>
                                            <td>
                                              <button class="btn btn-success btn-icon-anim btn-square list-button" onclick="actionFunction()" data-title="MERCHANT" data-tag="approve" data-url="<?php echo base_url("admin/customer/seen/".$v['id']);?>"><i class="fa fa-check"></i></button>

                                                </td>
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
          'pageLength'
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
            text: "You will not be able to review again !!",
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

    } else if (type === 'approve') {
        swal({
            title: "Are you sure?",
            text: "You want to approve this update !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#e91e63",
            confirmButtonText: "Yes, approve!",
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
