
<!-- <style>
.dataTables_filter, .dataTables_info { display: none; }
</style> -->
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/merchant_payout', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
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
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2" >
                            <option value="">select merchant</option>
                            <?php foreach ($merchant as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['customer_id']) && $v['id'] == $src['customer_id'])?'selected':'');?>><?php echo $v['company']; ?>,<?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <!-- <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office_id" name="office_id" class="form-control select2" >
                            <option value="">All Office</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div> -->
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <!-- <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Payout By<span class="help"></span></label>
                        <select id="payout_by" name="payout_by" class="form-control select2" >
                            <option value="">select</option>
                            <option value="paybymerchant" <?php echo ((isset($src['payout_by']) && 'paybymerchant' == $src['payout_by'])?'selected':'');?>>Merchant</option>
                            <option value="paybyconsignment" <?php echo ((isset($src['payout_by']) && 'paybyconsignment' == $src['payout_by'])?'selected':'');?>>Consignment</option>
                        </select>
                    </div> -->
                    <!-- <div class="form-group col-md-12" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
                    </div> -->
                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" class="btn btn-info btn-rounded">Search</button>
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
                            <table id="datable_123" class="table table-hover display  pb-30" style="width:100%;">
                                <thead>
                                    <tr>
                                      <th>Order Date</th>
                                      <th>Status</th>
                                        <th>Consignment Id</th>
                                        <th>MERCHANT DETAILS</th>
                                        <th>Shipping Details</th>
                                        <th class="ccollect">Cash Collection</th>
                                        <th class="lpaid">Less Paid</th>
                                        <th class="dc_chrg">Delivery Charge</th>
                                        <th class="cd_chrg">COD Charge</th>
                                        <!-- <th class="Sum">Product Price</th> -->
                                        <th class="camnt">Collected Amount</th>
                                        <th class="rn_chrg">Return Charge</th>
                                        <th class="mpymnt">Merchant Payment</th>
                                        <!-- <th class="Total">Delivery Charge</th> -->


                                        <!-- <th class="Partial">Amount Collected</th> -->
                                        <!-- <th>Delivery Charge</th> -->

                                        <th>Payment Status</th>
                                        <th>Invoice No</th>
                                        <th>Invoice Date/Time</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                           ?>
                                        <!-- <th>Update</th> -->
                                        <?php
                                      }
                                      ?>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $x = 0;
                                    foreach ($result as $k => $v) {
                                      // if($v['delivery_status'] != 'pending'){
                                       $x++;
                                        ?>
                                        <tr>
                                          <td><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y h:i a'); ?></td>
                                          <td><?php echo ucfirst($v['delivery_status']) ?></td>
                                          <td><?php echo $v['consignment_id'] ?></td>
                                          <td>Company:<?php echo $v['cus_company']; ?><br>Merchant Name:<?php echo $v['customer_name']; ?><br>Contact:<?php echo $v['cust_contact']; ?><br>Product ID:<?php echo $v['product_id']; ?></td>
                                          <td>Receipient Name: <?php echo $v['recipient_name'] ?><br>Address : <?php echo $v['recipient_address'] ?><br>Contact: <?php echo $v['recipient_number'] ?></td>
                                          <td style="text-align: right;"><?php echo $v['cash_collection'] ?></td>
                                          <td style="text-align: right;"><?php echo $v['less_paid_return'] ?></td>
                                          <td style="text-align: right;"><?php echo $v['delivery_charge'] ?></td>
                                          <?php if($v['total_cod_charge'] == ""){$cdcharge = "0.00";}else{$cdcharge = $v['total_cod_charge'];}?>
                                          <td style="text-align: right;"><?php echo $cdcharge ?></td>
                                          <td style="text-align: right;"><?php echo $v['amount_paid'] ?></td>
                                          <?php if($v['delivery_status'] == "returned"){ ?>
                                            <td style="text-align: right;"><?php if($v['deduction_status'] == 1){ echo $v['deduction_amount'];}else{ echo $v['delivery_charge']+floatval($v['total_cod_charge'])+floatval($v['return_extra']);} ?></td>
                                          <?php }else{?>
                                            <td style="text-align: right;">0</td>
                                          <?php }?>
                                            <!-- <td><?php echo $v['paytomerch']-$v['less_paid_return'] ?></td> -->
                                            <td style="text-align: right;">
                                              <?php if($v['delivery_status'] == "delivered"){
                                               echo $v['paytomerch']-floatval($v['less_paid_return']);
                                             }elseif($v['delivery_status'] == "returned"){
                                               if($v['deduction_status'] == 1){
                                               echo $v['amount_paid']-floatval($v['deduction_amount']);
                                             }elseif ($v['amount_paid'] == 0) {
                                               echo 0;
                                             }else{
                                               echo floatval($v['amount_paid'])-($v['delivery_charge']+floatval($v['total_cod_charge'])+floatval($v['return_extra']));
                                             }
                                             }?>
                                           </td>




                                            <?php if($v['payment_status_merchant'] == "paid"){?>
                                            <td style="color:green;text-align: center;"><?php echo ucfirst($v['payment_status_merchant']) ?></td>
                                            <?php
                                          }else{
                                            ?>
                                              <td style="color:red;text-align: center;"><?php echo ucfirst($v['payment_status_merchant']) ?></td>
                                              <?php
                                            }
                                            ?>
                                            <?php $invoice = $this->consignment_model->get_invoice($v['consignment_id']);
                                            if(!empty($invoice)){ ?>
                                            <td style="text-align: center;"><?php echo $invoice[0]['invoice_no'] ?></td>
                                            <td style="text-align: center;"><?php $dt = new DateTime($invoice[0]['date']);echo $dt->format('d, M Y h:m:s a'); ?></td>
                                          <?php }else{?>
                                            <td style="text-align: center;">N/A</td>
                                            <td style="text-align: center;">N/A</td>
                                          <?php } ?>
                                        </tr>



                                        <?php
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
// $(document).ready(function() {
//
// } );
// </script>



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
