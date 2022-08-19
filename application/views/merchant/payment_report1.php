<?php error_reporting(0);?>
<!-- <style>
.dataTables_filter, .dataTables_info { display: none; }
</style> -->

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
                                      <th>Invoice No.</th>
                                      <th>Invoice Date</th>
                                        <th>Cash Collection</th>
                                        <th>Delivery Charge</th>
                                        <th>COD Charge</th>
                                        <th>Return Charge</th>
                                        <th>Collected Amount</th>
                                        <th>Amount Paid</th>
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
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $x = 0;
                                    foreach ($transaction as $k => $v) {
                                        ?>
                                        <tr>
                                          <td>
                                          <form action="<?php echo base_url('merchant/report/payment_history'); ?>" method="post">
                                            <input type="hidden" name="consignments" value="<?php echo $v['consignments'];?>">
                                            <input type="submit" name="submit" value="View">  <?php echo $v['invoice_no'];?>
                                          </form>
                                        </td>
                                          <!-- <td><a href="<?php echo base_url('merchant/report/payment_history')."/".$v['consignments']; ?>"  title="Invoice Details" target="_blank"><?php echo $v['invoice_no'];?></a></td> -->
                                          <td><?php $dt = new DateTime($v['date']);echo $dt->format('d, M Y'); ?></td>
                                          <td><?php echo $v['cash_collection'];?></td>
                                          <td><?php echo $v['del_charge'];?></td>
                                          <td><?php echo $v['cod_charge'];?></td>
                                          <td><?php echo $v['return_charge'];?></td>
                                          <td><?php echo $v['collected'];?></td>
                                          <td><?php echo $v['amount_paid'];?></td>
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
         {
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL'
         }
       ],
       "order": [[ 1, "desc" ]]
    } );
} );
</script>
