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
                      <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                      <select id="office_id" name="office_id" class="form-control select2" >
                          <option value="">All Office</option>
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
                        <input type="text" id="to_date"  name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="button" onclick="sortdata();" class="btn btn-info btn-rounded">Search</button>
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
                                      <th>Office</th>
                                      <!-- <th>Date</th> -->
                                      <th>Transporter ID</th>
                                      <th>Transporter</th>
                                      <th class="total_rcv">Total Receive</th>
                                      <th class="total_del">Total Delivery</th>
                                      <th class="total_ress">Rescheduled</th>
                                      <th class="total_deduct">Deducted Return</th>
                                      <th class="total_ndec">Non-Deducted Return</th>

                                      <th class="total_return">Total Return</th>
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
                                        <tr data-id="<?php echo $v['id'];?>">
                                          <?php $branchname = $this->report_model->get_where_all('branch', ['id' => $v['office']]);?>
                                            <td><?php if(!empty($branchname[0]['name'])){ echo $branchname[0]['name'];} else{echo 'N/A';} ?></td>
                                            <!-- <td></td> -->
                                            <td><?php echo $v['transporter_id'] ?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <?php $total_received = $this->report_model->get_totalreceive($v['id']);?>
                                            <td><?php echo $total_received[0]['totalreceive'];?></td>
                                            <?php $total_delivered = $this->report_model->get_alldeliveries($v['id']);?>
                                            <td><?php echo $total_delivered[0]['totaldeliveries']; ?></td>
                                            <?php $total_rescheduled = $this->report_model->get_all_res($v['id']);?>
                                            <td><?php echo $total_rescheduled[0]['total_res']; ?></td>
                                            <?php $total_deducted_returned = $this->report_model->get_all_deducted_returns($v['id']);?>
                                            <td><?php echo $total_deducted_returned[0]['total_deductreturns']; ?></td>
                                            <?php $total_nondeducted_returned = $this->report_model->get_all_nondeducted_returns($v['id']);?>
                                            <td><?php echo $total_nondeducted_returned[0]['total_nondeductreturns']; ?></td>
                                            <?php $total_returned = $this->report_model->get_allreturns($v['id']);?>
                                            <td><?php echo $total_returned[0]['totalreturns']; ?></td>
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
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL',
         customize: function (doc) {
           var rowCount = $('#datable_2_cust').DataTable().rows().count();
              for (i = 0; i < rowCount+1; i++) {
                doc.content[1].table.body[i][4].alignment = 'right';
                doc.content[1].table.body[i][5].alignment = 'right';
                doc.content[1].table.body[i][6].alignment = 'right';
                doc.content[1].table.body[i][7].alignment = 'right';
                doc.content[1].table.body[i][8].alignment = 'right';
                doc.content[1].table.body[i][9].alignment = 'right';
              };
           doc.styles.tableFooter.alignment = 'right';
           doc.styles.tableBodyEven.alignment = 'center';
           doc.styles.tableBodyOdd.alignment = 'center';
           doc.styles.tableHeader.fontSize = 9;
              doc.defaultStyle.fontSize = 9;
         },
         }
        ]
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
