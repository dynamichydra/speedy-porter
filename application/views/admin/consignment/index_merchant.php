<h5>Please input atleast one of your orders within 12.00 PM to confirm your parcel pick.</h5>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/consignment', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || $_SESSION['user_type'] == 'staff'){
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
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
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

                <div class="pull-right">
                  <?php
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'branch'|| isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff'){
     ?>
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/consignment/create'); ?>">Add new Consignment</a>
                  <?php }else if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){ ?>
                    <a class="btn  btn-primary" href="<?php echo base_url('merchant/consignment/create_delivery'); ?>">Add new Consignment</a>
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
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Consignment Id</th>
                                        <th>Pickup Office</th>
                                        <th>Order Date</th>
                                        <th>Product ID</th>
                                        <?php  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer'){ ?>
                                        <th>Merchant Company, Merchant Name, Product ID</th>
                                      <?php } ?>
                                        <!-- <th>Product/Order Id</th> -->
                                        <th>Shipping Details</th>
                                        <th>Note</th>
                                        <!-- <th>Parcel Category</th> -->

                                        <!-- <th>shipping Contact No</th> -->

                                        <th>Cash Collection</th>
                                        <!-- <th>Office</th> -->
                                        <th>Parcel Value</th>
                                        <th>Delivery Charge</th>
                                        <th>COD Charge</th>
                                        <th>Status</th>

                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <?php  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'customer'){ ?>
                                            <td><b><?php echo $v['consignment_id'] ?></b></td>
                                            <?php }else{ ?>
                                              <td><strong><a href="<?php echo base_url('admin/consignment/trackorder')."/".$v['consignment_id']; ?>"  title="Tracking" target="_blank"><?php echo $v['consignment_id'] ?></a></strong></td>
                                              <?php } ?>
                                              <td><?php echo $v['office'] ?></td>
                                              <td><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y h:i a'); ?></td>
                                              <td><?php echo $v['product_id'] ?></td>
                                            <td><?php echo $v['shipping_name'] ?><br><?php echo $v['recipient_address']; ?>,<?php echo $v['recipient_address_2']; ?>, <?php echo $v['recipient_area']; ?>, <?php echo $v['recipient_city']; ?><br><?php echo $v['recipient_number'];?></td>
                                            <td><?php echo $v['instructions'] ?></td>
                                            <td><?php echo $v['cash_collection'] ?></td>

                                          <?php if($v['total_price_product'] == ""){ ?>
                                            <td>0</td>
                                          <?php
                                         }else{
                                           ?>
                                            <td><?php echo $v['total_price_product'];  ?></td>
                                          <?php
                                        }
                                        ?>
                                        <td><?php echo $v['total_price'];  ?></td>
                                        <?php if($v['total_cod_charge'] == ""){ ?>
                                          <td>0</td>
                                        <?php
                                       }else{
                                         ?>
                                          <td><?php echo $v['total_cod_charge'];  ?></td>
                                        <?php
                                      }
                                      ?>
                                            <?php if($v['delivery_status'] == 'pending'){?>
                                              <td>New</td>
                                            <?php }else{?>
                                            <td><?php echo ucfirst($v['delivery_status']);  ?></td>
                                          <?php } ?>
                                            <td>
                                              <?php if($v['created_by'] == $_SESSION['id']){
                                                if($v['cons_status'] == 'pending'){?>
                                              <button class="btn btn-default btn-icon-anim btn-square list-button" onclick="actionFunction()" data-tag="edit" data-url="<?php echo base_url("admin/consignment/create_delivery/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;
                                              <?php }
                                            }
                                            ?>
                                            <?php $totalno = $this->consignment_model->gettotaltktopencount($v['id']);?>

                                              <?php if($totalno[0]['totalopen'] == 0){ ?>

                                            <a href="<?php echo base_url('merchant/ticket/raise_a_ticket')."/".$v['id']."/".$v['consignment_id']; ?>" class="btn btn-success btn-icon-anim btn-square list-button" title="Raise a ticket" target="_blank"><i style="margin-top: 15px;" class="fa fa-exclamation-triangle"></i></a>
                                          <?php } else{ ?>
                                            <a href="" onclick="checkoldtkt();" class="btn btn-success btn-icon-anim btn-square list-button" title="Raise a ticket"><i style="margin-top: 15px;" class="fa fa-exclamation-triangle"></i></a>
                                          <?php } ?>
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
<script>
$(document).ready(function() {
    $('#datable_1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
         {
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL'
         }
       ],
       "order": [[ 2, "desc" ]]
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

function checkoldtkt(){
  alert("A Ticket is already issued. Next ticket can be issued after resolving the ticket.");
}
</script>
