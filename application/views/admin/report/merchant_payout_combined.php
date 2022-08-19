
<style>
.dataTables_filter, .dataTables_info { display: none; }
</style>
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
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['customer_id']) && $v['id'] == $src['customer_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
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

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Payout By<span class="help"></span></label>
                        <select id="payout_by" name="payout_by" class="form-control select2" >
                            <option value="">select</option>
                            <option value="paybymerchant" <?php echo ((isset($src['payout_by']) && 'paybymerchant' == $src['payout_by'])?'selected':'');?>>Merchant</option>
                            <option value="paybyconsignment" <?php echo ((isset($src['payout_by']) && 'paybyconsignment' == $src['payout_by'])?'selected':'');?>>Consignment</option>
                        </select>
                    </div>
                    <!-- <div class="form-group col-md-12" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
                    </div> -->
                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" class="btn btn-info btn-rounded">Go</button>
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
                            <table id="datable_123" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Consignment Id</th>
                                        <th>Customer</th>
                                        <th class="Sum">Product Price</th>
                                        <!-- <th class="Total">Delivery Charge</th> -->
                                        <th>Delivery Date</th>
                                        <th>payment</th>
                                        <th class="Partial">Amount Collected</th>
                                        <th>Amount Paid</th>
                                        <th>Amount Due</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                           ?>
                                        <th>Update</th>
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
                                        <!-- <th></th> -->
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
                                          <td><?php echo $v['consignment_id'] ?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['product_price'] ?></td>
                                            <!-- <td><?php echo $v['delivery_charge'] ?></td> -->
                                            <td><?php echo $v['timestamp'] ?></td>
                                            <?php if($v['payment_status_merchant'] == "due") {?>
                                            <td style="color:red;"><?php echo ucfirst($v['payment_status_merchant']) ?></td>
                                          <?php }else if($v['payment_status_merchant'] == "paid"){ ?>
                                            <td style="color:green;"><?php echo ucfirst($v['payment_status_merchant']) ?></td>
                                            <?php
                                          }else{
                                          ?>
                                          <td style="color:yellow;"><?php echo ucfirst($v['payment_status_merchant']); ?></td>
                                          <?php
                                        }
                                        ?>
                                        <?php if($v['amount_paid'] > $v['delivery_charge']){?>
                                        <td><?php echo ($v['amount_paid'] - $v['delivery_charge']) ?></td>
                                        <?php
                                      }else{?>
                                        <td>0</td>
                                        <?php
                                      }?>
                                      <td><?php echo $v['merchant_payout']?></td>
                                        <td><?php echo ($v['product_price'] - $v['merchant_payout']) ?></td>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'staff'){
                           ?>
                                            <td>
                                              <!-- <a href="#myModal<?php echo $v["id"]; ?>" class="btn btn-default btn-md waves-effect waves-light" data-animation="fadein" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-message"></i></a> -->
                                              <button type="button" data-toggle="modal" data-target="#myModal<?php echo $v["id"]; ?>"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                            </td>
                                            <?php
                                          }
                                          ?>
                                            <!-- <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/delivery_person/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="DELIVERY_PERSON" data-tag="delete" data-url="<?php echo base_url("admin/delivery_person/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td> -->
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

                                                <?php echo form_open_multipart('admin/report/updatePaymentstausmerchantpayout', array("id" => "paymentUpdate-form".$v["id"], "method" => "post","enctype" => "multipart/form-data")); ?>
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
    $('#datable_123').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    } );
} );
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
