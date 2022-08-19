<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
 ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/discount/create'); ?>">Add new promo</a>
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
                                        <th>Customer</th>
                                        <th>Promo Code</th>
                                        <!-- <th>DC Discount (Taka)</th> -->
                                        <th>Metropolitan </th>
                                        <th>Sub-Urban</th>
                                        <th>Urban</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
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
                                          <td><?php echo $v['cus_company'] ?></td>
                                            <td><?php echo $v['promo_code'] ?></td>
                                            <!-- <td><?php echo $v['discount_percent'] ?></td> -->
                                            <td><?php echo $v['metro_dc_dis'] ?>/<?php echo $v['metro_extra_chrg_dis'] ?>/<?php echo $v['metro_cod_chrg_dis'] ?>%/<?php echo $v['metro_return_chrg_dis'] ?>%</td>
                                            <td><?php echo $v['sub_urban_dc_dis'] ?>/<?php echo $v['sub_urban_extra_chrg_dis'] ?>/<?php echo $v['sub_urban_cod_chrg_dis'] ?>%/<?php echo $v['sub_urban_return_chrg_dis'] ?>%</td>
                                            <td><?php echo $v['urban_dc_dis'] ?>/<?php echo $v['urban_extra_chrg_dis'] ?>/<?php echo $v['urban_cod_chrg_dis'] ?>%/<?php echo $v['urban_return_chrg_dis'] ?>%</td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                               ?>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/discount/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="Promo" onclick="actionFunction()" data-tag="delete" data-url="<?php echo base_url("admin/discount/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td>
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

<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
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
