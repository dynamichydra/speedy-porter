<?php error_reporting(0);?>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/assign_deliveryperson/delivery', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Customer<span class="help"></span></label>
                      <select id="merch_id" name="merch_id" class="form-control select2" >
                          <option value="">Select Customer</option>
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
                <div class="pull-right">
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/assign_deliveryperson/assign_delivery'); ?>">Assign Transporter</a>
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
                                        <th>Consignment</th>
                                        <th>Order Date</th>
                                        <th>Recipient Zip code</th>
                                        <th>Office</th>
                                        <th>Transfer status</th>
                                        <th>Transfer Office</th>
                                        <th>Transporter</th>
                                        <!-- <th>Status</th> -->
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
                                      if($v['status'] != "inactive"){
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <?php $merch_info = $this->assign_deliveryperson_model->get_where_all('customer', ['id' => $v['customer']]); ?>
                                          <td>Consignment ID: <?php echo $v['consignment_id'] ?><br>Merchant Details: <?php echo $merch_info[0]['company'] ?>,<?php echo $merch_info[0]['name'] ?>,<?php echo $merch_info[0]['address'] ?>,<?php echo $merch_info[0]['phone'] ?><br>Shipping Details: <?php echo $v['recipient_name'] ?>,<?php echo $v['recipient_address'] ?>,<?php echo $v['recipient_number'] ?></td>
                                          <td><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y h:i a'); ?></td>
                                            <td><?php echo $v['station_name'] ?></td>
                                            <?php $merch_info = $this->assign_deliveryperson_model->get_where_all('branch', ['id' => $v['branch']]); ?>
                                            <?php if(!empty($merch_info)){?>
                                            <td><?php echo $merch_info[0]['name'] ?></td>
                                          <?php } else { ?>
                                            <td>Head Office</td>
                                            <?php
                                          } ?>
                                            <?php if($v['transfer_status'] != ''){
                                              if($v['transfer_to'] == $_SESSION['id']){ ?>
                                            <td>Transfer-In</td>
                                          <?php }else{?>
                                            <td>Transfer-Out</td>
                                            <?php
                                        }
                                      }else{
                                        ?>
                                        <td></td>
                                        <?php
                                      }
                                      ?>
                                        <?php if($v['transfer_to'] != ''){  $transfer_to_check = $this->assign_deliveryperson_model->get_where_all('branch', ['id' => $v['transfer_to']]); $transfer_to = $transfer_to_check[0]['name'];}else{$transfer_to = "";} ?>
                                            <td><?php echo $transfer_to; ?></td>
                                            <?php if($v['delivery_status'] == 'pending' || $v['delivery_status'] == 'reschedule'){ $trans = "In-House";}else{$trans_check = $this->assign_deliveryperson_model->get_transporter_delivery($v['id']); $trans = $trans_check[0]['transporter']; $edit_id = $trans_check[0]['editid'];} ?>
                                            <td> <?php echo $trans?></td>
                                            <?php
                              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                                if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer_care'){
                               ?>
                               <?php if($trans != "In-House"){?>
                                            <td>
                                              <?php if($v['status'] == 'assigned') {?>
                                              <button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" onclick="actionFunction()" data-url="<?php echo base_url("admin/assign_deliveryperson/edit/".$edit_id);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <?php
                                            }
                                            ?>
                                            <?php if($v['status'] != 'assigned') {?>
                                              <button class="btn btn-info btn-icon-anim btn-square list-button" data-title="DELIVERY_PERSON" onclick="actionFunction()" data-tag="delete" data-url="<?php echo base_url("admin/assign_deliveryperson/delete_assigned/".$edit_id);?>"><i class="fa fa-trash-o"></i></button>
                                              <?php
                                            }
                                            ?>
                                            </td>
                                          <?php }else{?>
                                            <td>N/A</td>
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
                                    }
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
