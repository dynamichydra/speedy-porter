
<style>
/* .dataTables_filter, .dataTables_info { display: none; } */
</style>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('merchant/report/financial_report', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Payment<span class="help"></span></label>
                        <select id="pstatus" name="pstatus" class="form-control select2" >
                            <option value="">Select payment status</option>
                            <?php foreach ($status as $k => $v) { ?>
                            <option   value="<?php echo $v['payment_status']; ?>" <?php echo ((isset($src['pstatus']) && $v['payment_status'] == $src['pstatus'])?'selected':'');?>><?php echo $v['payment_status']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
       ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2" >
                            <option value="">select merchant</option>
                            <?php foreach ($merchant as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                        <input type="hidden" name="merchantId" id="merchantId" value="<?php echo $_SESSION['id']?>">
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

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_21" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                      <th>payment Status</th>
                                      <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Consignment Id</th>
                                        <th>Shipping Details</th>
                                        <th>Cash Collection</th>
                                        <th class="Total">Delivery Charge</th>
                                        <th class="Sum">COD Charge</th>
                                        <th>Return Charge</th>
                                        <th>Less Paid</th>
                                        <th>Collected Amount</th>
                                        <th>Receivable Amount</th>
                                        <th>Invoice No</th>
                                        <th>Invoice Date/Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $x = 0;
                                    foreach ($result as $k => $v) {
                                       $x++;
                                        ?>
                                        <tr>
                                          <?php if($v['payment_status_merchant'] == "due") {?>
                                          <td style="color:red;"><?php echo ucfirst($v['payment_status_merchant']) ?></td>
                                        <?php }else if($v['payment_status_merchant'] == "paid"){ ?>
                                          <td style="color:green;"><?php echo ucfirst($v['payment_status_merchant']) ?></td>
                                          <?php
                                        }
                                        ?>
                                          <td><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y'); ?></td>
                                          <td><?php echo ucfirst($v['delivery_status']) ?></td>
                                          <td><?php echo $v['consignment_id'] ?></td>
                                            <td><?php echo $v['name'] ?><br><?php echo $v['recipient_address']; ?>,<?php echo $v['recipient_address_2']; ?>, <?php echo $v['recipient_area']; ?>, <?php echo $v['recipient_city']; ?><br><?php echo $v['contact'];?><br><?php echo $v['product_id'];?></td>
                                            <td><?php echo $v['cash_collection'] ?></td>
                                            <td><?php echo $v['delivery_charge'] ?></td>
                                            <td><?php if($v['total_cod_charge'] == ""){echo 0;} else{ echo $v['total_cod_charge'];} ?></td>
                                            <td><?php if($v['delivery_status'] == "returned"){ if($v['deduction_status'] == 1){ echo $v['deduction_amount'];}else{ echo $v['delivery_charge']+floatval($v['total_cod_charge'])+floatval($v['return_extra']);} }else{ echo 0;}?></td>
                                            <td><?php echo $v['less_paid_return'] ?></td>
                                            <td><?php echo $v['amount_paid'] ?></td>
                                        <td>
                                          <?php if($v['delivery_status'] == "delivered"){
                                           echo $v['paytomerch']-floatval($v['less_paid_return']);
                                         }elseif($v['delivery_status'] == "returned"){
                                           if($v['deduction_status'] == 1){
                                           echo $v['amount_paid']-floatval($v['deduction_amount']);
                                         }else{
                                           echo floatval($v['amount_paid'])-($v['delivery_charge']+floatval($v['total_cod_charge'])+floatval($v['return_extra']));
                                         }
                                         }?>
                                        </td>
                                        <?php $invoice = $this->consignment_model->get_invoice($v['consignment_id']);
                                        if(!empty($invoice)){ ?>
                                        <td><?php echo $invoice[0]['invoice_no'] ?></td>
                                        <td><?php $dt = new DateTime($invoice[0]['date']);echo $dt->format('d, M Y h:m:s a'); ?></td>
                                      <?php }else{?>
                                        <td>N/A</td>
                                        <td>N/A</td>
                                      <?php } ?>
                                        <td>
                                          <?php $totalno = $this->consignment_model->gettotaltktopencount($v['id']);?>

                                            <?php if($totalno[0]['totalopen'] == 0){ ?>

                                          <a href="<?php echo base_url('merchant/ticket/raise_a_ticket')."/".$v['id']."/".$v['consignment_id']; ?>" class="btn btn-success btn-icon-anim btn-square list-button" title="Raise a ticket" target="_blank"><i style="margin-top: 15px;" class="fa fa-exclamation-triangle"></i></a>
                                        <?php } else{ ?>
                                          <a href="" onclick="checkoldtkt();" class="btn btn-success btn-icon-anim btn-square list-button" title="Raise a ticket"><i style="margin-top: 15px;" class="fa fa-exclamation-triangle"></i></a>
                                        <?php } ?>
                                        </td>
                                        </tr>


                                        <div id="myModal<?php echo $v["id"]; ?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Payment Status</h4>
                                                <div class="row text-center alert alert-danger" id="div_err" style="display:none;"></div>
                                                <div class="row text-center alert alert-success" id="div_succ" style="display:none;"></div>
                                              </div>
                                              <div class="modal-body">

                                                <?php echo form_open_multipart('admin/report/updatePaymentstaus', array("id" => "paymentUpdate-form".$v["id"], "method" => "post","enctype" => "multipart/form-data")); ?>
                                                <div class="panel panel-default card-view">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body">
                                                          <div class="form-group">
                                                              <label class="control-label mb-10 text-left">Consignment Id: <?php echo $v['consignment_id'] ?> <span class="help"></span></label>
                                                              <input type="hidden" value="<?php echo $v['consignment_id'] ?>" name="conId" id="conId<?php echo $x ?>" >
                                                          </div>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">payment<span class="help"></span></label>
                                                                <select id="paymentStatus<?php echo $x ?>" name="paymentStatus" class="form-control paymentStatus" data-bind="<?php echo $x ?>" onChange="dropBoxChng(<?php echo $x ?>);">
                                                                    <option value="">select Status</option>

                                                                    <option value="due" <?php if($v['payment_status'] == 'due'){ echo "selected";}?>>Due</option>
                                                                    <option value="paid" <?php if($v['payment_status'] == 'paid'){ echo "selected";}?>>Paid</option>
                                                                    <option value="partial" <?php if($v['payment_status'] == 'partial'){ echo "selected";}?>>Partial</option>
                                                                </select>
                                                            </div>

                                                            <div id="txtBox<?php echo $x ?>" class="control-label mb-10 text-left txtBox" style="display:none;">
                                                                <label class="control-label mb-10 text-left">Amount <span class="help"></span></label>
                                                                <input type="text" id="partial_amount<?php echo $x ?>" name="partial_amount"  class="form-control" value="">
                                                            </div>
                                                            <!-- <div class="form-group" style="margin-top: 30px;">
                                                            <button type="submit" class="btn btn-info btn-rounded">update</button>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div id="itemWrap">

                                                              </div>
 -->

                                              </div>
                                              <div class="modal-footer">
                                                <button id="btnSave<?php echo $v["id"]; ?>" type="submit" class="btn btn-info btn-rounded" >update</button>
                                                <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                              </div>
                                              <?php echo form_close(); ?>
                                            </div>

                                          </div>
                                        </div>



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
    $('#datable_21').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel','pageLength', 'pdf',
        ]
    } );
} );
</script>

<script type="text/javascript">
function checkoldtkt(){
  alert("A Ticket is already issued. Next ticket can be issued after resolving the ticket.");
}
</script>


<!-- <script type="text/javascript">
        $(function () {
            // customer registration form submit
            $('#paymentUpdate-form').submit(function (e) {
                e.preventDefault();

                $('button#btnSave').text('updating...');

                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o) {
                    $("html, body").animate({scrollTop: 0}, 500);
                    if (o.msg_succ) {
                        $('#div_succ').show();
                        $('#div_succ').html(o.msg_succ);
                        setTimeout(function () {
                            $('#div_succ').hide();
                            window.location.reload();
                        }, 500);
                    } else {
                        $('#div_err').show();
                        $('#div_err').html(o.msg_err);
                        setTimeout(function () {
                            $('#div_err').hide();
                        }, 2000);
                    }

                    $('button#btnSave').text('update');
                }, 'json');
            });
        })
</script> -->
<!-- <script>
$(document).ready(function() {
    $('#modalbtn').click(function() {
        $('#myModal').modal('show');
    });
});
</script> -->
