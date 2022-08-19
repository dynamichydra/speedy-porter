<div class="row">
    <div class="col-sm-12">

      <?php echo form_open_multipart('admin/report/getBranchCount', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>

        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <!-- <?php print_r($q);?> -->
                  <?php
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
            ?>
                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                  <select id="branch" name="branch" class="form-control select2" >
                      <option value="">All Office</option>
                      <?php foreach ($branch as $k => $v) { ?>
                      <option   value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                      <?php } ?>
                  </select>
              </div>
            <?php } ?>

              <div class="form-group col-md-3">
                  <label class="control-label mb-10 text-left">From <span class="help"></span></label>
                  <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" value="<?php echo ((isset($src['from_date']))?$src['from_date']:'');?>">
              </div>
              <div class="form-group col-md-3">
                  <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                  <input type="text" id="to_date"  name="to_date" class="form-control datepicker" value="<?php echo ((isset($src['to_date']))?$src['to_date']:'');?>">

              </div>



                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" id="getsubmit" class="btn btn-info btn-rounded">Search</button>
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
                          <table id="example" class="table table-hover display  pb-30" style="width:100%;">
      <thead>
          <tr>
              <th>OFFICE</th>
              <th>STATUS</th>
              <!-- <th>DELIVERY DATE</th> -->
              <th>CONSIGNMENT ID</th>
              <th>MERCHANT DETAILS</th>
              <th>SHIPPING DETAILS</th>
              <th>PARCEL CATEGORY</th>
              <th>TRANSFER FROM</th>
              <th>TRANSPORTER</th>
              <th>ORDER DATE</th>
              <th>AMOUNT TO COLLECT</th>
              <th>LESS PAID</th>
              <th>COLLECTED AMOUNT</th>
              <th>PAYMENT STATUS</th>
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
