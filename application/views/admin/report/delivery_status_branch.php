<div class="row">
    <div class="col-sm-12">

      <?php echo form_open_multipart('admin/report/getdeliverylistByUser', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>

        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <!-- <?php print_r($q);?> -->
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Status<span class="help"></span></label>
                        <select id="status" name="status" class="form-control select2" >
                            <option value="">Select status</option>
                            <?php foreach ($status as $k => $v) { ?>
                            <option   value="<?php echo $v['delivery_status']; ?>"><?php echo $v['delivery_status']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                        <select id="merchant_id" name="merchant_id" class="form-control select2" >
                            <option value="">Select merchant</option>
                            <?php foreach ($merchant as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" >
                        <input type="hidden" value="<?php echo base_url();?>" name="base_url" id="base_url">
                        <input type="hidden" value="<?php echo $_SESSION['user_type']?>" name="userType" id="userType">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date"  name="to_date" class="form-control datepicker" >
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">User Type<span class="help"></span></label>
                        <select id="user_type" name="user_type" class="form-control select2 user_type-cls" >
                            <option value="">Select user type</option>
                            <?php foreach ($user as $k => $v) { ?>
                            <option   value="<?php echo $v['user_type']; ?>"><?php echo $v['user_type']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">User<span class="help"></span></label>
                        <select id="userName" name="userName" class="form-control select2" >
                            <option value="">Select user type first</option>
                        </select>
                    </div>


                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" class="btn btn-info btn-rounded">Go</button>
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
                          <table id="example" class="display" style="width:100%; display:none">
      <thead>
          <tr>
              <th>DELIVERY BOY</th>
              <th>CONSIGNMENT ID</th>
              <th>PRODUCT ID</th>
              <th>PRODUCT NAME</th>
              <th>PRODUCT TYPE</th>
              <th>PRODUCT PRICE</th>
              <th>NO OF ITEMS</th>
              <th>DELIVERY DATE</th>
              <th>MERCHANT NAME</th>
              <th>SHIPING ADDRESS</th>
              <th>TOTAL VALUE</th>
              <!-- <th>UPDATE STATUS</th> -->
          </tr>
      </thead>

  </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
