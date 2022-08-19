<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <?php if(isset($consignmentDetail)){ ?>
                  <div class="form-group col-md-6">
                          <label class="control-label mb-10 text-left">Consignment ID : <?php echo $consignment_id[0]['consignment_id']?><span class="help"></span></label>
                      </div>
                      <div class="form-group col-md-6">
                                  <label class="control-label mb-10 text-left">Customer Name : <?php echo $customer[0]['recipient_name']?><span class="help"></span></label>
                              </div>
                  <div class="form-group col-md-6">
                              <label class="control-label mb-10 text-left">Customer Address : <?php echo $customer[0]['recipient_address']?><span class="help"></span></label>
                          </div>
                          <div class="form-group col-md-6">
                                      <label class="control-label mb-10 text-left">Contact No : <?php echo $customer[0]['recipient_number']?><span class="help"></span></label>
                                  </div>
                                                  <div class="form-group col-md-6">
                                                              <label class="control-label mb-10 text-left">Parcel Weight : <?php echo $consignment_id[0]['total_weight']?><span class="help"></span></label>
                                                          </div>
                                                          <div class="form-group col-md-6">
                                                                      <label class="control-label mb-10 text-left">Parcel Price : Tk <?php echo $consignment_id[0]['total_price_product']?><span class="help"></span></label>
                                                                  </div>
                                                                  <div class="form-group col-md-6">
                                                                              <label class="control-label mb-10 text-left">Cash Collection Amount : Tk <?php echo $consignment_id[0]['cash_collection']?><span class="help"></span></label>
                                                                          </div>
                                                                  <div class="form-group col-md-6">
                                                                              <label class="control-label mb-10 text-left">Delivery Charge : Tk <?php echo $consignment_id[0]['total_price']?><span class="help"></span></label>
                                                                          </div>
                                                                          <div class="form-group col-md-6">
                                                                                      <label class="control-label mb-10 text-left">COD Charge: Tk <?php echo $consignment_id[0]['total_cod_charge']?><span class="help"></span></label>
                                                                                  </div>
<?php }else{ ?>
  <div class="form-group col-md-12">
    <center><h3>Invalid Consignment Number, No Data Found</h3></center>
                </div>
              <?php } ?>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
    </div>


                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Event</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($consignmentDetail)){
                                    foreach ($consignmentDetail as $k => $v) {
                                        ?>
                                        <tr>
                                            <td><?php echo $v['date'] ?></td>
                                            <td><?php echo $v['consignment_status'] ?></td>
                                            <td><?php echo $v['detail'] ?><?php if(!empty($v['branch'])){?><p style="color:red"><?php echo $v['branch']?></p><?php } ?></td>
                                            <!-- <td><?php echo $v['Status'] ?></td> -->

                                        </tr>


                                        <?php
                                    }
                                    }
                                    ?>


                                    </tbody>
                            </table>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    var userIS='<?php echo $_SESSION['user_type'];?>';
</script>
