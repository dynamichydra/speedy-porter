<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <?php if (!empty($row)) { ?>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Customer Name</th>
                                <td colspan="4"><?php echo $row['cus_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Tracking Id</th>
                                <td colspan="4"><?php echo $row['consignment_id']; ?></td>
                            </tr>
                            <tr>
                                <th>product Name</th>
                                <td colspan="4"><?php echo $row['pack_name']; ?></td>
                            </tr>

                                <tr>
                                    <th>Delivery Address</th>
                                    <td colspan="4"><?php echo $row['recipient_address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Product Price</th>
                                    <td colspan="4"><?php echo $row['product_price']; ?></td>
                                </tr>
                                <tr>
                                    <th>Product Price Total</th>
                                    <td colspan="4"><?php echo $row['total_price_product']; ?></td>
                                </tr>
                                  <tr>
                                    <th>No Of Items</th>
                                    <td colspan="4"><?php echo $row['no_of_items']; ?></td>
                                </tr>
                                <tr>
                                    <th>Total Price (delivery)</th>
                                    <td colspan="4"><?php echo $row['total_price']; ?></td>
                                </tr>
                                <tr>
                                <th>delivery_date</th>
                                <td colspan="4"><?php echo date( "m/d/Y", strtotime($row['delivery_date'])); ?></td>
                            </tr>

                        </tbody>
                    </table>

                <?php } ?>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
