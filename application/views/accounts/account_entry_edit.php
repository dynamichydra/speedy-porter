<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open_multipart('admin/accounts/createsave_account_entry', array("id" => "account_entry-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                    <div class="form-group" style="">
                      <div class="col-sm-6">
                          <label class="control-label mb-10 text-left">Date <span class="help"></span></label>
                          <input required type="text" id="entrydate"  name="entrydate"  class="form-control datepicker" value="<?php echo ((isset($row['exp_date']))?$row['exp_date']:'');?>">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Transaction Type<span class="help"></span></label>
                        <select required id="t_type" name="t_type" class="form-control select2 paymentStatus">
                            <option value="">Select Type</option>
                            <option value="cash_in" <?php if(isset($row) && $row['trans_type'] == 'cash_in'){ echo "selected";}?>>Cash-IN</option>
                            <option value="cash_out" <?php if(isset($row) && $row['trans_type'] == 'cash_out'){ echo "selected";}?>>Cash-OUT</option>>
                        </select>
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Voucher No <span class="help"></span></label>
                        <input type="text" id="voucher_no" required="" name="voucher_no" value="<?php echo (isset($row)) ? $row["voucher_no"] : ""; ?>" class="form-control" placeholder="Voucher Number" autocomplete="off">

                      </div>


                    </div>
                    <!-- <div class="form-group">



                    </div> -->
                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                          <label class="control-label mb-10 text-left">List Type<span class="help"></span></label>
                          <select id="l_type" name="l_type" class="form-control select2 l_type_cls" required>
                              <option value="">Select Type</option>
                              <option value="t_list" <?php if(isset($row) && $row['list_type'] == 't_list'){ echo "selected";}?>>Transporter List</option>
                              <option value="l_ofentry" <?php if(isset($row) && $row['list_type'] == 'l_ofentry'){ echo "selected";}?>>List Of Entry</option>
                          </select>
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                        <select id="office" name="office" class="form-control select2 office_cls" required>
                          <option value="">Select</option>
                          <?php foreach ($branch as $k => $v) { ?>
                          <option <?php if(!empty($row) && $row['office'] == $v['name']) { ?>selected <?php } ?>  value="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="form-group">

                    </div> -->
                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Name<span class="help"></span></label>
                        <select id="list_name" required name="list_name" class="form-control select2 list_name_cls" >
                          <option value="">Select Office First</option>

                        </select>
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Expense Type<span class="help"></span></label>
                        <select required id="exp_type" name="exp_type" class="form-control select2 paymentStatus">
                            <option value="">Select Type</option>
                            <?php foreach ($exp_list as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['exp_type'] == $v['exp_type']) { ?>selected <?php } ?>  value="<?php echo $v['exp_type']; ?>"><?php echo $v['exp_type']; ?></option>
                            <?php } ?>
                        </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Narration <span class="help"></span></label>
                        <input type="text" id="narration" required="" name="narration" class="form-control" placeholder="Narration" autocomplete="off" value="<?php echo (isset($row)) ? $row["narration"] : ""; ?>">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Amount <span class="help"></span></label>
                        <?php if($row["trans_type"] == "cash_out"){ ?>
                        <input type="number" id="amount" required="" name="amount" class="form-control" placeholder="Amount" autocomplete="off" value="<?php echo (isset($row)) ? $row["cash_out"] : ""; ?>">
                      <?php }else{ ?>
                        <input type="number" id="amount" required="" name="amount" class="form-control" placeholder="Amount" autocomplete="off" value="<?php echo (isset($row)) ? $row["cash_in"] : ""; ?>">
                      <?php } ?>
                      </div>
                    </div>


                      <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
                        <input type="hidden" value="<?php echo base_url(); ?>" id="base_url" name="base_url">
                        <button type="submit" class="btn btn-info btn-rounded">Create</button>
                        <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>
                      </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
<script>
var rname = "<?php echo $row["name"] ?>";
var list_type = "<?php echo $row["list_type"] ?>";
var office = "<?php echo $row["office"] ?>";
</script>
