<div class="row">
    <div class="col-xs-12">
        <div class="box box-info">
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               Consignment Id:  <b style="color:red;"><?php echo $consignment_id[0]['consignment_id']; ?></b>
               <br>
                <?php if (!empty($consignment)) {
                  $j = 0;
                  foreach ($consignment as $row):?>
                    <table class="table table-bordered table-striped">
                        <tbody>
                          <tr>
                            <td colspan="4" style="width:50px"><?php echo $row['date']; ?></td>
                              <td colspan="4"><?php echo $row['detail']; ?></td>
                          </tr>

                        </tbody>
                    </table>
                    <?php
                                              $j++;
                                              endforeach;
                                              }else{
                                            $j = 0;
                                          ?>
                                          <table class="table table-bordered table-striped">
                                          <tbody>
                                              <tr>
                                                  <td colspan="4"><?php echo $consignment_id[0]['timestamp']; ?></td>
                                                  <td colspan="4">Order Placed</td>
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
