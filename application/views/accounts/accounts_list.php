<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/accounts/accounts_list', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="form-group col-md-12">
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

                    </div>
                    <div class="form-group col-md-6" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                    </div>
                  </div>

                  <div class="form-group col-md-12">
                    <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
              ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office_id" name="office_id" class="form-control select2" >
                            <option value="">All Office</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option   value="<?php echo $v['name']; ?>" <?php echo ((isset($src['office_id']) && $v['name'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                  <?php } ?>

                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Voucher<span class="help"></span></label>
                      <select id="vouch" name="vouch" class="form-control select2" onchange="getParticulars(this.value)">
                          <option value="">Select Voucher</option>
                          <option value="invoice" <?php echo ((isset($src['vouch']) && "invoice" == $src['vouch'])?'selected':'');?>>Invoice</option>
                          <option value="transaction" <?php echo ((isset($src['vouch']) && "transaction" == $src['vouch'])?'selected':'');?>>Transaction</option>
                          <option value="voucher" <?php echo ((isset($src['vouch']) && "voucher" == $src['vouch'])?'selected':'');?>>Voucher</option>
                      </select>
                  </div>
                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Particular Name<span class="help"></span></label>
                      <select id="particular" name="particular" class="form-control select2" >
                          <option value="">Select Name</option>
                      </select>
                      <input type="hidden" name="sel_particular" id="sel_particular" value="<?php if(isset($src['particular'])){echo $src['particular'];} ?>">
                  </div>
                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Expense Type<span class="help"></span></label>
                      <select id="exptype" name="exptype" class="form-control select2" >
                          <option value="">Select Type</option>
                          <option value="N/A" <?php echo ((isset($src['exptype']) && "N/A" == $src['exptype'])?'selected':'');?>>N/A</option>
                          <?php foreach ($expense_list as $k => $v) { ?>
                          <option   value="<?php echo $v['exp_type']; ?>" <?php echo ((isset($src['exptype']) && $v['exp_type'] == $src['exptype'])?'selected':'');?>><?php echo $v['exp_type']; ?></option>
                          <?php } ?>
                      </select>
                      <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url();?>">
                  </div>
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
                            <table id="datable_165" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Date</th>

                                        <th>Voucher No.</th>

                                        <th>Name Of Particular</th>
                                        <th>Designation</th>
                                        <th>Office</th>
                                        <th>Group Head</th>
                                        <th>Expense Type</th>
                                        <th>Narration</th>
                                        <th class="dcsum" style="text-align: right;">Delivery Charge</th>
                                        <th class="sum_cashin" style="text-align: right;">Cash-IN</th>
                                        <th class="sum_cashout" style="text-align: right;">Cash-OUT</th>

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
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                        <th style="text-align: right;font-size: 15px;"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $x = 0;
                                    if(isset($result)){
                                    foreach ($result as $k => $v) {
                                       $x++;
                                        ?>
                                        <tr>
                                          <td><?php $dt = new DateTime($v->exp_date);echo $dt->format('d, M Y'); ?></td>
                                          <td><?php echo $v->voucher_no ?></td>
                                          <td><?php echo $v->name ?></td>
                                          <td><?php if($v->designation == 'motorist'){echo 'Rider';}else{ echo ucfirst($v->designation);} ?></td>
                                          <td><?php echo $v->office ?></td>
                                          <td><?php if($v->exp_head != ""){echo $v->exp_head;}else{echo 'N/A';} ?></td>
                                          <td><?php echo $v->exp_type ?></td>
                                          <td><?php echo $v->narration ?></td>
                                          <td style="text-align: right;"><?php echo $v->del_charge ?></td>
                                          <td style="text-align: right;"><?php echo $v->cash_in ?></td>
                                          <td style="text-align: right;"><?php echo $v->cash_out ?></td>
                                        </tr>
                                        <?php
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
var cashIn = "";
$(document).ready(function() {
    $('#datable_165').DataTable( {

        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
         {
         extend: 'pdfHtml5', footer: true ,
         orientation: 'portrait',
         pageSize: 'LEGAL',
         customize: function (doc) {
           var rowCount = $('#datable_165').DataTable().rows().count();
              for (i = 0; i < rowCount+1; i++) {
                doc.content[1].table.body[i][7].alignment = 'left';
                doc.content[1].table.body[i][8].alignment = 'right';
                doc.content[1].table.body[i][9].alignment = 'right';
                doc.content[1].table.body[i][10].alignment = 'right';
              };
           doc.styles.tableFooter.alignment = 'right';
           doc.styles.tableBodyEven.alignment = 'center';
           doc.styles.tableBodyOdd.alignment = 'center';
           doc.styles.tableHeader.fontSize = 9;
              doc.defaultStyle.fontSize = 9;
              doc.styles.tableFooter.fontSize = 9;
         },
       }
       ],
       "order": [] ,
       "columnDefs": [
           { "width": "25px", "targets": 6 }
         ],

       "initComplete": function (settings, json) {
           this.api().columns('.dcsum').every(function () {
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
               $(column.footer()).append("<br>        Balance");
           });
           this.api().columns('.sum_cashin').every(function () {
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
               cashIn= parseFloat(sum).toFixed(2);
               $(column.footer()).append("<br>  =     ");
           });
           this.api().columns('.sum_cashout').every(function () {
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
               var cashOut = parseFloat(sum).toFixed(2);
               var balance = cashIn - cashOut;
               console.log(cashIn);
               $(column.footer()).append("<br>      "+  balance);
           });
       },
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
<script>
$(document).ready(function() {
  var vouchType = $("#vouch").val();
  getParticulars(vouchType);
});
function getParticulars(vouchType){


  var selectedname = $("#sel_particular").val();

  $.ajax({
           // url: '<?php echo base_url('admin/consignment/getpromo'); ?>',
           url: $("#base_url").val()+"admin/accounts/getparticular",
           type: "POST",
           data: {vouchertype: vouchType},
           success: function (res)
       {
       var jdata= res;
         var prtclr=$('#particular');
           prtclr.empty();
            prtclr.append($("<option></option>").attr("value", '').text('Select Name'));
            if(vouchType == 'invoice'){
              Object.keys(jdata).forEach(function(k){
                  prtclr.append($("<option></option>").attr("value", jdata[k].name).text(jdata[k].company+', '+jdata[k].name));
              });
            }else{
           Object.keys(jdata).forEach(function(k){
               prtclr.append($("<option></option>").attr("value", jdata[k].name).text(jdata[k].name));
           });
         }
           prtclr.val(selectedname);
       }


       });

}
</script>
