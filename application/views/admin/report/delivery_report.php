<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/delivery_report', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
              ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office_id" name="office_id" class="form-control select2" >
                            <option value="">All Office</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                  <?php } ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>
                    <div class="form-group col-md-12" style="margin-top: 30px;">
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
                            <table id="datable_126" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Pick Office</th>

                                        <th>Order Date</th>

                                        <th>Consignment ID</th>
                                        <th>Status</th>
                                        <th>Merchant Details</th>
                                        <th>Shipping Details</th>
                                        <th>Transfer Office</th>
                                        <th>Receiver</th>
                                        <th>Transporter</th>
                                        <th>Assign Date</th>
                                        <!-- <th>Parcel Value</th> -->
                                        <!-- <th>DELIVERY CHARGE</th> -->
                                        <th>Cash Collection</th>
                                        <th>Less Paid</th>
                                        <!-- <th>Pay to Merchant</th> -->
                                        <!-- <th>Narration</th> -->
                                        <th style="text-align: right;">Collected Amount</th>
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
                                        <!-- <th></th> -->
                                        <!-- <th></th> -->
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $x = 0;
                                    foreach ($result as $k => $v) {
                                       $x++;
                                        ?>
                                        <tr>
                                          <td><?php echo $v['brname'] ?></td>

                                            <td><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y h:i a'); ?></td>

                                            <td><?php echo $v['consignment_id'] ?></td>
                                            <td><?php echo ucfirst($v['delivery_status']) ?></td>
                                            <td>Company: <?php echo $v['customer_company'] ?><br> Product ID: <?php echo $v['product_id'] ?></td>
                                            <td>Receiver Name: <?php echo $v['recipient_name'] ?><br> Address: <?php echo $v['shiping_address'] ?><br>Contact: <?php echo $v['recipient_number'] ?></td>
                                            <td><?php if($v['transfer_from'] != ""){ echo $v['transfer_from'];}else{echo "N/A";} ?></td>
                                            <?php $rec = $this->report_model->get_where_all('assign_receive', ['consignment' => $v['id']]);
                                            if(!empty($rec)){
                                                   $recname = $this->report_model->get_where_all('delivery_person', ['id' => $rec[0]['delivery_person']]);
                                                 }
                                                   ?>
                                            <td><?php if(isset($recname) && !empty($recname)){echo $recname[0]['name'];}else{echo "N/A";} ?></td>
                                            <td><?php echo $v['dp_name'] ?></td>
                                            <td><?php $dt = new DateTime($v['assigned_date']);echo $dt->format('d, M Y'); ?></td>
                                            <!-- <td><?php echo $v['product_price'] ?></td> -->
                                            <!-- <td><?php echo $v['delivery_charge'] ?></td> -->
                                            <td style="text-align: right;"><?php echo $v['cash_collection'] ?></td>
                                            <td style="text-align: right;"><?php echo $v['less_paid_return'] ?></td>
                                            <!-- <td><?php echo $v['paytomerch'] ?></td> -->
                                            <!-- <td><?php echo $v['narration'] ?></td> -->
                                            <td style="text-align: right;"><?php echo $v['amount_paid'] ?></td>
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
    $('#datable_126').DataTable( {

        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
         {
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL'
         }
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
