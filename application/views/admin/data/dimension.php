<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
 ?>
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/add_data/create_dimension'); ?>">Add new dimension</a>
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
                                        <th>sl no.</th>
                                        <th>Height</th>
                                        <th>Width</th>
                                        <th>Price</th>
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
                                    $i = 1;
                                    foreach ($row as $k => $v) {
                                      // $i++
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td><?php echo $i++ ?></td>
                                            <td><?php echo $v['height'] ?></td>
                                            <td><?php echo $v['width'] ?></td>
                                            <td><?php echo $v['price'] ?></td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                               ?>
                                            <td><button class="btn btn-default btn-icon-anim btn-square list-button" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/add_data/create_dimension/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="Dimension" data-tag="delete" onclick="actionFunction()" data-url="<?php echo base_url("admin/add_data/delete_dimension/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td>
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
