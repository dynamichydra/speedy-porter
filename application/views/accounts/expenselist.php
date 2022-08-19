<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/accounts/create_expense'); ?>">Add New List</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1010" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                      <th>Sl no.</th>
                                        <th>Expense Type</th>
                                        <th>Group Head</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $x = 1;
                                  foreach ($row as $k => $v) {
                                      ?>
                                        <tr data-id="">
                                          <td><?php echo $x ?></td>
                                          <td><?php echo $v['exp_type'] ?></td>
                                            <td><?php echo $v['grp_head'] ?></td>
                                            <td>
                                              <button class="btn btn-default btn-icon-anim btn-square list-button" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/accounts/create_expense/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                            <button class="btn btn-info btn-icon-anim btn-square list-button" onclick="actionFunction()" data-title="Delete Entry" data-tag="delete" data-url="<?php echo base_url("admin/accounts/delete_expense/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;
                                          </td>
                                        </tr>

                                        <?php
                                        $x++;
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
    $('#datable_1010').DataTable( {

        dom: 'Bfrtip',
        buttons: [
          'pageLength'
       ],
        // "order": [[ 0, "desc" ]]
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
