<?php error_reporting(0); ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/delivery_charge', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <!-- <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Transporter<span class="help"></span></label>
                        <select id="transprtr" name="transprtr" class="form-control select2" >
                            <option value="">All Transporter</option>
                            <?php foreach ($transporter as $k => $v) {
                              if($v['name'] != ''){?>
                            <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['transprtr']) && $v['id'] == $src['transprtr'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php }
                          }
                           ?>
                        </select>
                    </div> -->
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
                      <label class="control-label mb-10 text-left">Collection Status<span class="help"></span></label>
                      <select id="c_status" name="c_status" class="form-control select2" >
                          <option value="">All</option>
                          <?php foreach ($conss as $k => $v) { ?>
                          <option   value="<?php echo $v['payment_status_merchant']; ?>" <?php echo ((isset($src['c_status']) && $v['payment_status_merchant'] == $src['c_status'])?'selected':'');?>><?php echo ucfirst($v['payment_status_merchant']); ?></option>
                          <?php } ?>
                      </select>
                  </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date"  name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

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
                            <table id="datable_2_cust" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Office</th>
                                        <th style="text-align: center;">Order Date</th>
                                        <th style="text-align: center;">Comsignment ID</th>
                                        <th style="text-align: center;">Merchant Details</th>
                                        <th style="text-align: center;">Shipping Details</th>
                                        <th style="text-align: center;">Delivery Date</th>
                                        <th style="text-align: center;">Status</th>
                                        <th class="dc_chrg" style="text-align: right;">Delivery Charge</th>
                                        <th class="cd_chrg" style="text-align: right;">COD Charge</th>
                                        <th class="rn_chrg" style="text-align: right;">Return Charge</th>
                                        <th class="t_chrg" style="text-align: right;">Total Charge</th>
                                        <th style="text-align: center;">Collection Status</th>
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
                                        ?>
                                        <tr data-id="<?php echo $v->id;?>">
                                            <td style="text-align: center;"><?php echo $v->branchname ?></td>
                                            <td style="text-align: center;"><?php $dt = new DateTime($v->timestamp);echo $dt->format('d, M Y h:i a'); ?></td>
                                            <td style="text-align: center;"><?php echo $v->consignment_id ?></td>
                                            <td style="text-align: left;">Company : <?php echo $v->company ?><br>Merchant Name: <?php echo $v->name ?><br>Contact: <?php echo $v->phone ?><br>Product ID: <?php echo $v->product_id ?></td>
                                            <td style="text-align: left;">Receipient Name: <?php echo $v->recipient_name ?><br>Address : <?php echo $v->recipient_address ?><br>Contact: <?php echo $v->recipient_number ?><br></td>
                                            <td style="text-align: center;"><?php $dt = new DateTime($v->delivery_date);echo $dt->format('d, M Y'); ?></td>
                                            <td style="text-align: center;"><?php echo ucfirst($v->delivery_status) ?></td>
                                            <td style="text-align: right;"><?php echo $v->total_price ?></td>
                                            <?php if($v->total_cod_charge == ""){$cdcharge = 0;}else{$cdcharge = $v->total_cod_charge;}?>
                                            <td style="text-align: right;"><?php echo $cdcharge ?></td>
                                            <td style="text-align: right;"><?php echo $v->deduction_amount ?></td>
                                            <?php if($v->delivery_status == 'returned'){$tamount = $v->deduction_amount;}else{$tamount = $v->total_price+$cdcharge;}?>
                                            <td style="text-align: right;"><?php echo $tamount ?></td>
                                            <?php if($v->payment_status_merchant == "due"){$cstatus = "Due";$color='red';}else{$cstatus = "Paid";$color='green';}?>
                                            <td style='color:<?php echo $color ?>;text-align: center;' ><?php echo $cstatus ?></td>
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

<!-- <script>
$(document).ready(function(){
    var table = $('#datable_1_cust').DataTable({
        "fnDrawCallback": function( oSettings ) {
            componentHandler.upgradeDOM();
        }
    });
});

function myFunction() {
  alert("danger");
}
</script> -->

<script>
$(document).ready(function() {
    $('#datable_2_cust').DataTable( {

        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
     //      {
     //   extend: "pdfHtml5", footer: true ,
     //   orientation: 'landscape',
     //   pageSize: 'LEGAL',
     //   customize: function(doc) {
     //     doc.styles.tableBodyEven.alignment = 'right';
     //     doc.styles.tableBodyOdd.alignment = 'right';
     //   },
     //   exportOptions: {
     //     orthogonal: "myExport"
     //   }
     // }
     {
    extend: "pdfHtml5", footer: true ,
    orientation: 'landscape',
    pageSize: 'LEGAL',
    customize: function (doc) {
      var rowCount = $('#datable_2_cust').DataTable().rows().count();
         for (i = 0; i < rowCount+1; i++) {
           doc.content[1].table.body[i][3].alignment = 'left';
           doc.content[1].table.body[i][4].alignment = 'left';
           doc.content[1].table.body[i][7].alignment = 'right';
           doc.content[1].table.body[i][8].alignment = 'right';
           doc.content[1].table.body[i][9].alignment = 'right';
           doc.content[1].table.body[i][10].alignment = 'right';
         };
      doc.styles.tableFooter.alignment = 'right';
      doc.styles.tableBodyEven.alignment = 'center';
      doc.styles.tableBodyOdd.alignment = 'center';
      // doc.styles.tableHeader.fontSize = 9;
         // doc.defaultStyle.fontSize = 9;
    },
  },
       ],

       "initComplete": function (settings, json) {
           this.api().columns('.dc_chrg').every(function () {
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
           this.api().columns('.cd_chrg').every(function () {
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
           this.api().columns('.rn_chrg').every(function () {
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
           this.api().columns('.t_chrg').every(function () {
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
