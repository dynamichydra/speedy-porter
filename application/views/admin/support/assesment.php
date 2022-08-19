<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/support/assesmentupdate', array("id" => "assesment-form", "method" => "post")); ?>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Date:- <?php echo (isset($row)) ? $row[0]["date"] : ""; ?><span class="help"></span></label>
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Created By:- <?php echo (isset($userid)) ? $userid[0]["name"] : ""; ?><span class="help"></span></label>
                      </div>
                    </div>

					<div class="col-sm-12">
                        <label class="control-label mb-10 text-left">link:- <span class="help"></span></label>
						<?php echo (isset($row)) ? $row[0]["link"] : ""; ?>
                      </div>

                      <div class="col-sm-12">
                                    <label class="control-label mb-10 text-left">File Attached:- <span class="help"></span></label>
            						<?php if(isset($row)) {?> <a target="_blank" href="<?php echo base_url('uploads/support/'.$row[0]["file"])?>">click here</a> <?php } ?>
                                  </div>

                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Subject<span class="help"></span></label>
                        <input type="text" class="form-control" placeholder="Subject" value="<?php echo (isset($row)) ? $row[0]["subject"] : ""; ?>" id="subject" name="subject" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Status<span class="help"></span></label>
                        <select id="status" name="status" class="form-control">
                            <option value="">select Status</option>
                            <option value="pending" <?php if($row[0]['status'] == 'pending'){ echo "selected";}?>>pending</option>
                            <option value="in-review" <?php if($row[0]['status'] == 'in-review'){ echo "selected";}?>>in-review</option>
                            <option value="closed" <?php if($row[0]['status'] == 'closed'){ echo "selected";}?>>closed</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Message <span class="help"></span></label>

              <textarea id="msg" name="msg" class="form-control" rows="5"><?php echo (isset($row)) ? $row[0]["msg"] : ""; ?></textarea>
                      </div>

                      <div class="col-sm-12" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Assesment <span class="help"></span></label>

              <textarea id="assesment" name="assesment" class="form-control" rows="5"><?php echo (isset($row)) ? $row[0]["assesment"] : ""; ?></textarea>
                      </div>

                    </div>
                  </div>
                    <!-- <div class="form-group">

                    </div> -->

                        <!-- <div class="form-group"> -->

                        <!-- </div> -->

                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <input type="hidden" value="<?php echo (isset($row))?$row[0]["id"]:"";?>" id="id" name="id">
                        <button type="submit" class="btn btn-info btn-rounded">Submit Assesment</button>

                      </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Init JavaScript -->
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/init.js"></script>
	<script src="<?php echo base_url('asset/admin/'); ?>dist/js/dashboard-data.js"></script>
