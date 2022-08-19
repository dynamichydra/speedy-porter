<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/transporter_report', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
            ?>
                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Transporter<span class="help"></span></label>
                      <select id="transprtr" name="transprtr" class="form-control select2" >
                          <option value="">All Transporter</option>
                          <?php foreach ($alltransporter as $k => $v) { ?>
                          <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['transprtr']) && $v['id'] == $src['transprtr'])?'selected':'');?>><?php echo $v['name']; ?></option>
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
                        <input type="text" id="to_date"  name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" onclick="sortdata();" class="btn btn-info btn-rounded">Search</button>
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
                                      <!-- <th>Date</th> -->
                                      <th style="text-align: center;">Transporter ID</th>
                                      <th style="text-align: center;">Transporter</th>
                                      <th class="total_rcv" style="text-align: right;">Total Receive</th>
                                      <th class="total_del" style="text-align: right;">Total Delivery</th>
                                      <th class="total_ress" style="text-align: right;">Rescheduled</th>
                                      <th class="total_deduct" style="text-align: right;">Deducted Return</th>
                                      <th class="total_ndec" style="text-align: right;">Non-Deducted Return</th>

                                      <th class="total_return" style="text-align: right;">Total Return</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                        ?>
                                        <tr data-id="">
                                            <td style="text-align: center;"><?php echo $v['branch_name'] ?></td>
                                            <td style="text-align: center;"><?php echo $v['transporter_id'] ?></td>
                                            <td style="text-align: center;"><?php echo $v['dp_name'] ?></td>
                                            <td style="text-align: right;"><?php echo $v['totalreceive'] ?></td>
                                            <td style="text-align: right;"><?php echo $v['totaldeliveries']; ?></td>
                                            <td style="text-align: right;"><?php echo $v['total_res'] ?></td>
                                            <td style="text-align: right;"><?php echo $v['total_deductreturns'] ?></td>
                                            <td style="text-align: right;"><?php echo $v['total_nondeductreturns'] ?></td>
                                            <td style="text-align: right;"><?php echo $v['totalreturns'] ?></td>
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
function sortdata(){
var startdate = $('#from_date').val();
var enddate = $('#to_date').val();
console.log(startdate);
}
</script>
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
          {
         extend: "pdfHtml5", footer: true ,
         orientation: 'portrait',
         pageSize: 'LEGAL',
         customize: function (doc) {
           var rowCount = $('#datable_2_cust').DataTable().rows().count();
              for (i = 0; i < rowCount+1; i++) {
                doc.content[1].table.body[i][3].alignment = 'right';
                doc.content[1].table.body[i][4].alignment = 'right';
                doc.content[1].table.body[i][5].alignment = 'right';
                doc.content[1].table.body[i][6].alignment = 'right';
                doc.content[1].table.body[i][7].alignment = 'right';
                doc.content[1].table.body[i][8].alignment = 'right';
              };
           doc.styles.tableFooter.alignment = 'right';
           doc.styles.tableBodyEven.alignment = 'center';
           doc.styles.tableBodyOdd.alignment = 'center';
           doc.styles.tableHeader.fontSize = 9;
              doc.defaultStyle.fontSize = 9;
         },
       },
        ],

        "initComplete": function (settings, json) {
            this.api().columns('.total_rcv').every(function () {
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
            this.api().columns('.total_del').every(function () {
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
            this.api().columns('.total_ress').every(function () {
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
            this.api().columns('.total_deduct').every(function () {
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
            this.api().columns('.total_ndec').every(function () {
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
            this.api().columns('.total_return').every(function () {
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
