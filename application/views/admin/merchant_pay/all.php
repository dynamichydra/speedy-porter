<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/merchant_pay/all', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Company<span class="help"></span></label>
                        <select id="company" name="company" class="form-control select2" >
                            <option value="">All Company</option>
                            <?php foreach ($merch as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['company']) && $v['id'] == $src['company'])?'selected':'');?>><?php echo $v['company']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
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

                          <form action="<?php echo base_url('admin/merchant_pay/createsave')?>" method="post">
                            <!-- <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left">Consignments <span class="help"></span></label>
                                <input type="text" id="all_merch"  name="all_merch"  class="form-control" value="">
                            </div> -->
                            <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left"> Total Amount <span class="help"></span></label>
                                <input type="text" id="amounttopay" name="amounttopay" class="form-control" value="">
                                <input type="hidden" id="all_merch"  name="all_merch"  class="form-control" value="">

                            </div>
                            <div class="form-group col-md-3" style="margin-top: 30px;">
                              <button id="btnAll" type="button" class="btn btn-info btn-rounded">CALCULATE</button>
                            <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Paid</button>
                                <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                            </div>
                            </form>

                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Payment Status</th>
                                        <th style="text-align: center;">Order Date</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Consignment ID</th>
                                        <!-- <th>Product/Order Id</th> -->
                                        <th style="text-align: center;">Merchant Details</th>

                                        <!-- <th>shipping address</th> -->

                                        <th style="text-align: center;">Shipping  Details</th>

                                        <!-- <th>Status</th> -->
                                        <!-- <th>Delivery Date</th> -->
                                        <!-- <th>Cash Collection</th> -->
                                        <th class="clamnt" style="text-align: right;">Collected Amount</th>


                                        <th class="lpaid" style="text-align: right;">Less Paid</th>
                                        <th class="dlchrg" style="text-align: right;">Delivery Charge</th>
                                        <th class="cdchrg" style="text-align: right;">COD Charge</th>
                                        <th class="rnchrg" style="text-align: right;">Return Charge</th>
                                        <th class="mpymnt" style="text-align: right;">Merchant Payment</th>
                                        <th style="text-align: center;">Delivery Note</th>
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
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                      // if($v->delivery_status != "cancelled"){
                                      //   if($v->status != "inactive"){
                                          if($v->payment_status_merchant != 'paid'){
                                        ?>
                                        <tr data-id="<?php echo $v->id ?>">
                                          <?php if($v->payment_status_merchant == 'paid'){ ?>
                                            <td style="color:green;text-align: center;"><?php echo ucfirst($v->payment_status_merchant) ?></td>
                                          <?php }else{ ?>
                                            <td style="color:red;text-align: center;"><?php echo ucfirst($v->payment_status_merchant) ?></td>
                                          <?php
                                        }
                                        ?>
                                            <td style="text-align: center;"><?php $dt = new DateTime($v->timestamp);echo $dt->format('d, M Y h:i a'); ?></td>
                                            <td style="text-align: center;"><?php echo ucfirst($v->delivery_status) ?></td>
                                            <td data-id="<?php echo $v->consignment_id ?>" style="text-align: center;"><?php echo $v->consignment_id ?></td>
                                            <td style="text-align: left;">Company: <?php echo $v->company_name ?><br>Product ID: <?php echo $v->product_id ?></td>
                                            <td style="text-align: left;"><?php echo $v->recipient_name ?><br><?php echo $v->recipient_address ?>,<?php echo $v->recipient_city ?>,<?php echo $v->recipient_postalcode ?><br>Contact: <?php echo $v->recipient_number ?></td>

                                            <!-- <td><?php echo $v->delivery_date ?></td> -->
                                            <td style="text-align: right;"><?php echo $v->amount_paid ?></td>

                                            <?php if($v->amount_paid != 0){ $lesspaid = $v->amounttocollect - $v->amount_paid; } else { $lesspaid = $v->less_paid_return;}?>
                                            <td style="text-align: right;"><?php if($lesspaid > 0){ echo $lesspaid;}else{echo 0;} ?> </td>
                                            <td style="text-align: right;"><?php echo $v->total_price ?></td>
                                            <td style="text-align: right;"><?php if($v->total_cod_charge != ""){ echo $v->total_cod_charge;}else{ echo 0;} ?></td>
                                            <td style="text-align: right;"><?php echo $v->deduction_amount ?></td>
                                            <?php if($v->delivery_status == 'delivered'){ ?>
                                            <?php if($v->payment_status == 'due' && $v->deduction_amount>0){$paid= "-".$v->deduction_amount;}else{ $paid= $v->paytomerch - $v->less_paid_return;}?>
                                              <td style="text-align: right;"><?php echo $paid; ?></td>
                                            <?php }elseif($v->delivery_status == 'returned'){
                                              if($v->deduction_status == '1'){ ?>
                                              <td style="text-align: right;"><?php echo '-'.$v->deduction_amount; ?></td>
                                            <?php }elseif ($v->amount_paid == 0) { ?>
                                              <td style="text-align: right;"> 0 </td>
                                            <?php }else{?>
                                              <td style="text-align: right;"><?php echo $v->amount_paid - ($v->total_price+$v->return_extra); ?></td>
                                              <?php
                                            }
                                            }else{
                                            ?>
                                            <td style="text-align: right;">0</td>
                                            <?php
                                          }
                                          ?>
                                            <td style="text-align: center;"><?php if($v->note != "") {echo $v->note;}else{echo "N/A";} ?></td>
                                        </tr>


                                        <?php
                                      }
                                    //   }
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

  $('#datable_1').DataTable( {
      dom: 'Bfrtip',
      buttons: [
        'excel','pageLength',
       // {
       // extend: 'pdfHtml5',
       // orientation: 'landscape',
       // pageSize: 'LEGAL'
       // }
       {
      extend: "pdfHtml5", footer: true ,
      orientation: 'landscape',
      pageSize: 'LEGAL',
      customize: function (doc) {
        var rowCount = $('#datable_1').DataTable().rows().count();
           for (i = 0; i < rowCount+1; i++) {
             doc.content[1].table.body[i][4].alignment = 'left';
             doc.content[1].table.body[i][5].alignment = 'left';
             doc.content[1].table.body[i][6].alignment = 'right';
             doc.content[1].table.body[i][7].alignment = 'right';
             doc.content[1].table.body[i][8].alignment = 'right';
             doc.content[1].table.body[i][9].alignment = 'right';
             doc.content[1].table.body[i][10].alignment = 'right';
             doc.content[1].table.body[i][11].alignment = 'right';
            };
        doc.styles.tableFooter.alignment = 'right';
        doc.styles.tableBodyEven.alignment = 'center';
        doc.styles.tableBodyOdd.alignment = 'center';
        // doc.styles.tableHeader.fontSize = 9;
           // doc.defaultStyle.fontSize = 9;
      },
    },
      ],
       "order": [[ 1, "desc" ]],
       "initComplete": function (settings, json) {
         this.api().columns('.clamnt').every(function () {
             var column = this;

             var sum = column
                .data()
                .reduce(function (a, b) {
                    a = parseFloat(a, 10);
                    if(isNaN(a)){ a = 0; }

                    b = parseFloat(b, 10);
                    if(isNaN(b)){ b = 0; }

                    return a + b;
                });

             $(column.footer()).html(parseFloat(sum).toFixed(2));
         });
         this.api().columns('.lpaid').every(function () {
             var column = this;

             var sum = column
                .data()
                .reduce(function (a, b) {
                    a = parseFloat(a, 10);
                    if(isNaN(a)){ a = 0; }

                    b = parseFloat(b, 10);
                    if(isNaN(b)){ b = 0; }

                    return a + b;
                });

             $(column.footer()).html(parseFloat(sum).toFixed(2));
         });
         this.api().columns('.dlchrg').every(function () {
             var column = this;

             var sum = column
                .data()
                .reduce(function (a, b) {
                    a = parseFloat(a, 10);
                    if(isNaN(a)){ a = 0; }

                    b = parseFloat(b, 10);
                    if(isNaN(b)){ b = 0; }

                    return a + b;
                });

             $(column.footer()).html(parseFloat(sum).toFixed(2));
         });
         this.api().columns('.cdchrg').every(function () {
             var column = this;

             var sum = column
                .data()
                .reduce(function (a, b) {
                    a = parseFloat(a, 10);
                    if(isNaN(a)){ a = 0; }

                    b = parseFloat(b, 10);
                    if(isNaN(b)){ b = 0; }

                    return a + b;
                });

             $(column.footer()).html(parseFloat(sum).toFixed(2));
         });
         this.api().columns('.rnchrg').every(function () {
             var column = this;

             var sum = column
                .data()
                .reduce(function (a, b) {
                    a = parseFloat(a, 10);
                    if(isNaN(a)){ a = 0; }

                    b = parseFloat(b, 10);
                    if(isNaN(b)){ b = 0; }

                    return a + b;
                });

             $(column.footer()).html(parseFloat(sum).toFixed(2));
         });
         this.api().columns('.mpymnt').every(function () {
             var column = this;

             var sum = column
                .data()
                .reduce(function (a, b) {
                    a = parseFloat(a, 10);
                    if(isNaN(a)){ a = 0; }

                    b = parseFloat(b, 10);
                    if(isNaN(b)){ b = 0; }

                    return a + b;
                });

             $(column.footer()).html(parseFloat(sum).toFixed(2));
         });
       }
  } );

  var oTable = $('#datable_1').DataTable();

$('#datable_1 tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
    var pos = oTable.row(this).index();
    // var row = oTable.row(pos).data();
    var conid = oTable.cell( pos, 3 ).data();
    var amount = oTable.cell( pos, 11 ).data();
    console.log(conid+amount);
} );


$("#btnAll").on("click",function(){
     var Allconid =[];
     var Allamountsum = 0;
 $('#datable_1 tbody tr.selected').each(function(){
      var pos = oTable.row(this).index();
    // var row = oTable.row(pos).data();
    // var rowData = oTable.rows( { selected: true } ).data()[0];
    // var rowIdx = oTable.row( {selected: true } ).index();
var conid = oTable.cell( pos, 3 ).data();
var amount = oTable.cell( pos, 11 ).data();
    // console.log(row);
    Allconid.push(conid);
    Allamountsum  = Allamountsum + parseInt(amount,10);
 });
    // console.log(oAll);
    // alert(oAll);
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
