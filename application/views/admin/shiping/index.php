<?php error_reporting(0);?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="pull-right">
                  <?php
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
     ?>
                    <!-- <a class="btn  btn-primary" href="<?php echo base_url('admin/customer'); ?>">Back</a> -->
                    <!-- <a class="btn  btn-primary" href="<?php echo base_url('admin/shiping/create/'.$customer_id); ?>">Add new Shipping </a> -->
                    <?php
                  }else{
                  ?>
                    <a class="btn  btn-primary" href="<?php echo base_url('merchant/shiping/create/'.$customer_id); ?>">Add new Shipping </a>
                    <?php
                  }
                  ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <input type="hidden" name="customer_id" id="customer_id" value="">
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Recipient Name</th>
                                        <th>Recipient Address</th>
                                        <th>Contact No</th>
                                        <th>District</th>
                                        <th>Zip code</th>
                                        <th>Parcel Category</th>
                                        <!-- <th>Type</th> -->
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
                                            <td><?php echo $v['recipient_name'] ?></td>
                                            <td><?php echo $v['recipient_address'] ?></td>
                                            <td><?php echo $v['recipient_number'] ?></td>
                                            <?php if(!empty($v['district'])){$dname = $this->shiping_model->get_where_all('district', ['id' => $v['district']]); $districtname = $dname[0]['district_name'];}else{$districtname = "N/A";}?>
                                            <td><?php echo $districtname; ?></td>
                                            <?php if(!empty($v['police_station'])){$pname = $this->shiping_model->get_where_all('police_station', ['id' => $v['police_station']]); $pstationname = $pname[0]['station_name'];}else{$pstationname = "N/A";}?>
                                            <td><?php echo $pstationname;?></td>
                                            <td>N/A</td>
                                            <!-- <?php
                                            if($v['type'] == "local"){
                                            ?>
                                            <td style="color:yellow;"><?php echo $v['type'] ?></td>
                                            <?php
                                          }else{
                                            ?>
                                              <td style="color:green;"><?php echo $v['type'] ?></td>
                                              <?php
                                            }
                                            ?> -->
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                               ?>
                                            <td><button class="btn btn-default btn-icon-anim btn-square action-button" data-tag="edit" title="edit" onclick="actionFunction()" data-url="<?php echo base_url("admin/shiping/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <button class="btn btn-info btn-icon-anim btn-square action-button" data-title="ADDRESS" data-tag="delete" title="delete" onclick="actionFunction()" data-url="<?php echo base_url("admin/shiping/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button>&nbsp;
                                              <!-- <button class="btn btn-success btn-icon-anim btn-square list-button" data-title="address" data-tag="edit" title="make default" data-url="<?php echo base_url("admin/shiping/default/".$v['customer']."/".$v['id']);?>"><i class="fa fa-superpowers"></i></button> -->
                                                </td>
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
$(".action-button").on("click", function (e) {
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
