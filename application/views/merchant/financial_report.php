
<style>
.dataTables_filter, .dataTables_info { display: none; }
</style>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/financial', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2" >
                            <option value="">select merchant</option>
                            <?php foreach ($merchant as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date" required="" name="to_date" class="form-control datepicker" >
                    </div>
                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button type="submit" class="btn btn-info btn-rounded">Search</button>
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
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Consignment Id</th>
                                        <th>Customer</th>
                                        <th>Product Price</th>
                                        <th>Delivery Charge</th>
                                        <th>Delivery Date</th>
                                        <th>payment status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($result as $k => $v) {
                                        ?>
                                        <tr data-id="">
                                          <td><?php echo $v['consignment_id'] ?></td>
                                            <td><?php echo $v['name'] ?></td>
                                            <td><?php echo $v['product_price'] ?></td>
                                            <td><?php echo $v['delivery_charge'] ?></td>
                                            <td><?php echo $v['timestamp'] ?></td>
                                            <!-- <td><?php echo ucfirst($v['payment_status']) ?></td> -->
                                            <td>
                                              <select id="payment" name="payment" style="background-color: #d1d1d1;">
                                                  <option   value="due" <?php if($v['payment_status'] == 'due'){ echo "selected";}?>>due</option>
                                                  <option   value="paid" <?php if($v['payment_status'] == 'paid'){ echo "selected";}?>>paid</option>
                                              </select>
                                            </td>
                                            <!-- <td><button class="btn btn-default btn-icon-anim btn-square list-button" data-tag="edit" data-url="<?php echo base_url("admin/delivery_person/create/".$v['id']);?>"><i class="fa fa-pencil"></i></button>&nbsp;<button class="btn btn-info btn-icon-anim btn-square list-button" data-title="DELIVERY_PERSON" data-tag="delete" data-url="<?php echo base_url("admin/delivery_person/delete/".$v['id']);?>"><i class="fa fa-trash-o"></i></button></td> -->
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

<!-- <script>
$(".select2").select2();

    $('#from_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });
</script> -->
