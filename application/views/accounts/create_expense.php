<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/accounts/createsave_explist', array("id" => "createuser-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Expense Type <span class="help"></span></label>
                        <input type="text" id="exp_type" required="" name="exp_type" value="<?php echo (isset($row)) ? $row["exp_type"] : ""; ?>" class="form-control" placeholder="Define Expense Type" autocomplete="off">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Group Head <span class="help"></span></label>
                        <select required id="grp_head" name="grp_head" class="form-control select2 paymentStatus">
                            <option value="">Select Type</option>
                            <option value="Asset" <?php if(isset($row) && $row['grp_head'] == 'Asset'){ echo "selected";}?>>Asset</option>
                            <option value="Liability" <?php if(isset($row) && $row['grp_head'] == 'Liability'){ echo "selected";}?>>Liability</option>
                            <option value="Capital" <?php if(isset($row) && $row['grp_head'] == 'Capital'){ echo "selected";}?>>Capital</option>
                            <option value="Expenses" <?php if(isset($row) && $row['grp_head'] == 'Expenses'){ echo "selected";}?>>Expenses</option>
                        </select>
                        </div>
                    </div>

                  </div>
                    <!-- <div class="form-group">

                    </div> -->

                        <!-- <div class="form-group"> -->

                        <!-- </div> -->

                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
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
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
