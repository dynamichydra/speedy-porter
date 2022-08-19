<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/merchant_pay/cash_collection_branch', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office_id" name="office_id" class="form-control select2" >
                            <option value="">All Branch</option>
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
                        <input type="text" id="to_date" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

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
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">

                          <form action="<?php echo base_url('admin/merchant_pay/createsave_branch')?>" method="post">
                            <!-- <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left">Consignments <span class="help"></span></label>
                                <input type="text" id="all_merch"  name="all_merch"  class="form-control" value="">
                            </div> -->
                            <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left"> Total Amount <span class="help"></span></label>
                                <input type="text" style="color:black;" id="amounttopay" name="amounttopay" placeholder="0" class="form-control" value="" required readonly>
                                <input type="hidden" id="all_merch"  name="all_merch"  class="form-control" value="">
                                <input type="hidden" id="tspoter"  name="tspoter"  class="form-control" value="">

                            </div>
                            <div class="form-group col-md-3" style="margin-top: 30px;">
                              <button id="btnAll" type="button" class="btn btn-info btn-rounded">CALCULATE</button>
                            <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Received</button>
                                <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                            </div>
                            </form>

                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Payment Status</th>

                                        <th>Consignment ID</th>
                                        <!-- <th>Product/Order Id</th> -->
                                        <th>Office</th>

                                        <!-- <th>shipping address</th> -->

                                        <th>Order date</th>

                                        <th>Status</th>
                                        <th>Shipping Detail</th>
                                        <th>Transfer From</th>
                                        <th>Delivery date</th>
                                        <!-- <th>Cash Collection Amount</th> -->
                                        <th>CASH COLLECTION</th>
                                        <th>LESS PAID</th>
                                        <th>Collected Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($row )){
                                    foreach ($row as $k => $v) {
                                      if($v->delivery_status != "cancelled"){
                                        if($v->status != "inactive"){
                                        ?>
                                        <tr data-id="<?php echo $v->id ?>">
                                          <?php if($v->head_office_paid == 'received'){ ?>
                                            <td style="color:green;"><?php echo ucfirst($v->head_office_paid) ?></td>
                                          <?php }else{ ?>
                                            <td style="color:red;"><?php echo ucfirst($v->head_office_paid) ?></td>
                                          <?php
                                        }
                                        ?>
                                            <td data-id="<?php echo $v->consignment_id ?>" ><?php echo $v->consignment_id ?></td>
                                            <?php $branch_name = $this->Merchant_pay_model->get_where_all('branch', ['id' => $v->branch]);?>
                                            <td><?php echo $branch_name[0]['name'] ?></td>
                                            <td><?php $dt = new DateTime($v->timestamp);echo $dt->format('d, M Y'); ?></td>
                                            <td><?php echo ucfirst($v->delivery_status) ?></td>
                                            <td><?php echo $v->recipient_name ?><br><?php echo $v->recipient_address ?>,<?php echo $v->recipient_city ?>,<?php echo $v->recipient_postalcode ?><br>Contact: <?php echo $v->recipient_number ?></td>
                                            <td><?php if($v->transfer_from != ""){ echo $v->transfer_from;}else{echo "N/A";} ?></td>
                                            <td><?php $dt = new DateTime($v->delivery_date);echo $dt->format('d, M Y'); ?></td>
                                            <td><?php echo $v->cash_collection ?></td>
                                            <?php if($v->amount_paid != 0){ $lesspaid = $v->amounttocollect - $v->amount_paid; } else { $lesspaid = 0;}?>
                                            <td><?php echo $lesspaid ?> </td>
                                            <?php if($v->delivery_status == 'delivered'){ ?>
                                            <?php if($v->payment_status == 'due' && $v->deduction_amount>0){$paid= $v->deduction_amount;}else{ $paid= floatval($v->cash_collection) - floatval($v->less_paid_return);}?>
                                              <td><?php echo $paid ?></td>
                                            <?php }elseif($v->delivery_status == 'returned'){ ?>
                                              <!-- <td><?php echo $v->deduction_amount; ?></td> -->
                                              <td>0</td>
                                              <?php
                                            }else{
                                            ?>
                                            <td>0</td>
                                            <?php
                                          }
                                          ?>
                                            <!-- <td><?php echo $v->narration ?></td> -->
                                        </tr>


                                        <?php
                                      }
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
      "columnDefs": [
          { "width": "15px", "targets": 5 }
        ],
  } );

  var oTable = $('#datable_1').DataTable();

$('#datable_1 tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
    var pos = oTable.row(this).index();
    // var row = oTable.row(pos).data();
    var conid = oTable.cell( pos, 1 ).data();
    var amount = oTable.cell( pos, 10 ).data();
    var trname = oTable.cell( pos, 2 ).data();
    console.log(conid+amount);
} );


$("#btnAll").on("click",function(){
     var Allconid =[];
     var Allamountsum = 0;
     var Trname = '';
 $('#datable_1 tbody tr.selected').each(function(){
      var pos = oTable.row(this).index();
    // var row = oTable.row(pos).data();
    // var rowData = oTable.rows( { selected: true } ).data()[0];
    // var rowIdx = oTable.row( {selected: true } ).index();
var conid = oTable.cell( pos, 1 ).data();
var amount = oTable.cell( pos, 10 ).data();
var transporter = oTable.cell( pos, 2 ).data();
    // console.log(row);
    Trname = transporter;
    Allconid.push(conid);
    Allamountsum  = Allamountsum + parseInt(amount,10);
 });
    // console.log(oAll);
    // alert(oAll);
    $("#tspoter").val(Trname);
    $("#all_merch").val(Allconid);
    $("#amounttopay").val(Allamountsum);
});
    // $('#datable_1').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
    //       'excel',
    //      {
    //      extend: 'pdfHtml5',
    //      orientation: 'landscape',
    //      pageSize: 'LEGAL'
    //      }
    //     ]
    // } );

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
