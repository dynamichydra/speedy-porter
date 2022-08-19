
<style>
/* .dataTables_filter, .dataTables_info { display: none; } */
</style>

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
                                      <th style="text-align: center;">Order Date</th>
                                      <th style="text-align: center;">Consignment ID</th>
                                        <th style="text-align: center;">Shipping Details</th>
                                        <th class="cascol" style="text-align: right;">Cash Collection</th>
                                        <th class="delchrg" style="text-align: right;">Delivery Charge</th>
                                        <th class="cdchrg" style="text-align: right;">COD Charge</th>
                                        <th class="rnchrg" style="text-align: right;">Return Charge</th>
                                        <th class="clctdamnt" style="text-align: right;">Collected Amount</th>
                                        <th class="amntp" style="text-align: right;">Amount Paid</th>
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
                                    $x = 0;
                                    foreach ($tran_history as $k => $v) {
                                        ?>
                                        <tr>
                                          <td style="text-align: center;"><?php $dt = new DateTime($v['timestamp']);echo $dt->format('d, M Y'); ?></td>
                                          <td style="text-align: center;"><?php echo $v['consignment_id'];?></td>
                                          <?php $customer = $this->consignment_model->get_where_all('shiping', ['id' => $v['recipient_address']]); ?>
                                          <td style="text-align: left;"><?php echo $customer[0]['recipient_name']?><br>
                                          <?php echo $customer[0]['recipient_address']?>,<?php echo $customer[0]['recipient_address_2']?>,<?php echo $customer[0]['recipient_city']?>,<?php echo $customer[0]['recipient_area']?><br>
                                          <?php echo $customer[0]['recipient_number']?><br>
                                          <?php echo $v['product_id']?></td>
                                          <td style="text-align: right;"><?php echo $v['cash_collection'];?></td>
                                          <td style="text-align: right;"><?php echo $v['total_price'];?></td>
                                          <td style="text-align: right;"><?php if($v['total_cod_charge'] == ""){echo 0;}else{ echo $v['total_cod_charge'];}?></td>
                                          <td style="text-align: right;"><?php if($v['delivery_status'] == "returned"){ if($v['deduction_status'] == 1){ echo $v['deduction_amount'];}else{ echo $v['total_price']+floatval($v['total_cod_charge'])+floatval($v['return_extra']);} }else{ echo 0;}?></td>
                                          <!-- <td><?php echo $v['paytomerch']?></td> -->
                                          <td style="text-align: right;"><?php echo $v['amount_paid'];?></td>
                                          <td style="text-align: right;">
                                            <?php if($v['delivery_status'] == "delivered"){
                                             echo $v['paytomerch']-floatval($v['less_paid_return']);
                                           }elseif($v['delivery_status'] == "returned"){
                                             if($v['deduction_status'] == 1){
                                             echo $v['amount_paid']-floatval($v['deduction_amount']);
                                           }else{
                                             echo floatval($v['amount_paid'])-($v['total_price']+floatval($v['total_cod_charge'])+floatval($v['return_extra']));
                                           }
                                           }?>
                                         </td>

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
$(document).ready(function() {
    $('#datable_21').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel','pageLength',
       //      {
       //   extend: "pdfHtml5", footer: true ,
       //   customize: function(doc) {
       //     doc.styles.tableBodyEven.alignment = 'right';
       //     doc.styles.tableBodyOdd.alignment = 'right';
       //     doc.styles.tableFooter.alignment = 'right';
       //   },
       //   exportOptions: {
       //     orthogonal: "myExport"
       //   }
       // }
       {
      extend: "pdfHtml5", footer: true ,
      // orientation: 'landscape',
      customize: function (doc) {
        var rowCount = $('#datable_21').DataTable().rows().count();
           for (i = 0; i < rowCount+1; i++) {
             doc.content[1].table.body[i][2].alignment = 'left';
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
      },
    },
        ],
        "initComplete": function (settings, json) {
            this.api().columns('.cascol').every(function () {
                var column = this;

                var sum = column
                   .data()
                   .reduce(function (a, b) {
                       a = parseInt(a, 10);
                       if(isNaN(a)){ a = 0; }

                       b = parseInt(b, 10);
                       if(isNaN(b)){ b = 0; }

                       return a + b;
                   });

                $(column.footer()).html(sum);
            });
            this.api().columns('.delchrg').every(function () {
                var column = this;

                var sum = column
                   .data()
                   .reduce(function (a, b) {
                       a = parseInt(a, 10);
                       if(isNaN(a)){ a = 0; }

                       b = parseInt(b, 10);
                       if(isNaN(b)){ b = 0; }

                       return a + b;
                   });

                $(column.footer()).html(sum);
            });
            this.api().columns('.cdchrg').every(function () {
                var column = this;

                var sum = column
                   .data()
                   .reduce(function (a, b) {
                       a = parseInt(a, 10);
                       if(isNaN(a)){ a = 0; }

                       b = parseInt(b, 10);
                       if(isNaN(b)){ b = 0; }

                       return a + b;
                   });

                $(column.footer()).html(sum);
            });
            this.api().columns('.rnchrg').every(function () {
                var column = this;

                var sum = column
                   .data()
                   .reduce(function (a, b) {
                       a = parseInt(a, 10);
                       if(isNaN(a)){ a = 0; }

                       b = parseInt(b, 10);
                       if(isNaN(b)){ b = 0; }

                       return a + b;
                   });

                $(column.footer()).html(sum);
            });
            this.api().columns('.clctdamnt').every(function () {
                var column = this;

                var sum = column
                   .data()
                   .reduce(function (a, b) {
                       a = parseInt(a, 10);
                       if(isNaN(a)){ a = 0; }

                       b = parseInt(b, 10);
                       if(isNaN(b)){ b = 0; }

                       return a + b;
                   });

                $(column.footer()).html(sum);
            });
            this.api().columns('.amntp').every(function () {
                var column = this;

                var sum = column
                   .data()
                   .reduce(function (a, b) {
                       a = parseInt(a, 10);
                       if(isNaN(a)){ a = 0; }

                       b = parseInt(b, 10);
                       if(isNaN(b)){ b = 0; }

                       return a + b;
                   });

                $(column.footer()).html(sum);
            });
        }
    } );
} );
</script>
