<?php error_reporting(0);?>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/cancel_parcel', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office_id" name="office_id" class="form-control select2" >
                            <option value="">Select Office</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                  }
                  ?>
                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                      <select id="merch_id" name="merch_id" class="form-control select2" >
                          <option value="">Select Merchant</option>
                          <?php foreach ($merchant as $k => $v) { ?>
                          <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['merch_id']) && $v['id'] == $src['merch_id'])?'selected':'');?>><?php echo $v['name']; ?>,<?php echo $v['company']; ?></option>
                          <?php } ?>
                      </select>
                  </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:left;" type="submit" class="btn btn-info btn-rounded">Search</button>
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                    </div>
                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
          <?php echo form_close(); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
 ?>
                <!-- <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/assign_deliveryperson/assign_transporter'); ?>">Assign Transporter</a>
                </div> -->
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
                                        <th>Consignment ID</th>
                                        <!-- <th>Consignment</th> -->
                                        <th>Order Date</th>
                                        <th>Merchant Details</th>
                                        <th>Shipping Details</th>
                                        <th>Office</th>
                                        <th>Transporter</th>
                                        <th>Status</th>
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
                                    if(isset($row)){
                                    foreach ($row as $k => $v) {
                                      // if($v->delivery_status == "in-transit" || $v->delivery_status == "pending" ){
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <td><?php echo $v['consignment_id'] ?></td>
                                          <td><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y h:i a'); ?></td>
                                          <?php $merch_info = $this->report_model->get_where_all('customer', ['id' => $v['customer']]); ?>
                                            <td><?php echo $merch_info[0]['company'] ?><br><?php echo $merch_info[0]['address'] ?><br><?php echo $merch_info[0]['phone'] ?></td>
                                            <td><?php echo $v['s_name'] ?><br><?php echo $v['s_address'] ?><br><?php echo $v['s_number'] ?></td>
                                            <?php $merch_info = $this->report_model->get_where_all('branch', ['id' => $v['branch']]); ?>
                                            <td><?php echo $merch_info[0]['name'] ?></td>
                                            <?php if($v['receive_status'] == 'not_assigned'){ $trans = "Not Assigned";}else{$trans_check = $this->report_model->get_transporter($v['id']); $trans = $trans_check[0]['transporter']; $edit_id = $trans_check[0]['editid'];} ?>
                                            <td><?php print_r($trans); ?></td>
                                            <?php if($v['cons_status'] == 'pending'){$col = "yellow";}elseif ($v['cons_status'] == 'cancelled'){$col = "red";}else{$col = "green";}?>
                                            <td style="color:<?php echo $col; ?>;"><?php echo ucfirst($v['cons_status']) ?></td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                               ?>
                                            <td>
                                              <?php if($v['receive_status'] == 'assigned' && $v['cons_status'] == 'pending') {
                                                if($v['transfer_from'] == '') {?>
                                              <button class="btn btn-default btn-icon-anim btn-square list-button" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/assign_deliveryperson/edit_receive/".$edit_id);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <?php
                                            }
                                          }
                                            ?>
                                            <?php if($v['receive_status'] == 'assigned' && $v['cons_status'] == 'pending') {?>
                                              <a href="<?php echo base_url('admin/assign_deliveryperson/receive_cons')."/".$v['id']; ?>" class="btn btn-success btn-icon-anim btn-square list-button" title="Receive" onclick="return confirm('Are you sure you would like to receive this order?');"><i style="margin-top: 13px;" class="fa fa-check"></i></a>&nbsp;
                                              <?php
                                            }
                                            ?>
                                            <?php if($v['cons_status'] == 'pending') {?>
                                            <a href="<?php echo base_url('admin/assign_deliveryperson/cancel_cons')."/".$v['id']; ?>" class="btn btn-info btn-icon-anim btn-square list-button" title="Cancel" onclick="return confirm('Are you sure you would like to cancel this order?');"><i style="margin-top: 13px;" class="fa fa-window-close"></i></a>
                                            <?php
                                          }
                                          ?>
                                          <?php if($v['cons_status'] == 'cancelled') {?>
                                          <a href="<?php echo base_url('admin/report/retrieve_cons')."/".$v['id']; ?>" class="btn btn-default btn-icon-anim btn-square list-button" title="Cancel" onclick="return confirm('Are you sure you would like to retrieve this order?');"><i style="margin-top: 13px;" class="fa fa-undo"></i></a>
                                          <?php
                                        }
                                        ?>
                                            <?php
                                          }
                                        }
                                          ?>
                                        </tr>


                                        <?php
                                      }
                                    // }
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
        ],
         "order": [[ 1, "desc" ]]
    } );



    $(".select2").select2();

    $('#from_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });
    $('#to_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });


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
