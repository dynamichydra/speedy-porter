<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB72OWY6_-HFF4AUqbzfAB6fVsOb8U6DwU&sensor=false&libraries=places&region=IN" async defer></script> -->
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open_multipart('merchant/ticket/createsave', array("id" => "ticket-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                    <div class="form-group">

                        <div class="col-sm-6">
                          <label class="control-label mb-10 text-left"> consignment No. <span class="help"></span></label>
                          <input type="text" style="color:black;" class="form-control" id="consignment_id" name="consignment_id" value="<?php echo (isset($consignno)) ? $consignno : ""; ?>" readonly>
                          <input type="hidden" id="consignment_no" name="consignment_no" value="<?php echo (isset($consignid)) ? $consignid : ""; ?>">
                          <!-- <select id="consignment_no" name="consignment_no" class="form-control select2" >
                              <option value="">Select consignment</option>
                              <?php foreach ($consignment_id as $k => $v) { ?>
                              <option <?php if(!empty($row) && $row['consignment_no'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['consignment_id']; ?></option>
                              <?php } ?>
                          </select> -->
                        </div>
                        <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Subject<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="subject" value="<?php echo (isset($row)) ? $row["subject"] : ""; ?>" id="subject" name="subject" autocomplete="off">
                      </div>

                    </div>
                    <!-- <div class="form-group">

                    </div> -->
                    <div class="form-group">
                      <div class="col-sm-12" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Description <span class="help"></span></label>
                        <textarea id="description" name="description" class="form-control" rows="5" placeholder="Describe your issue"></textarea>
                      </div>
                    </div>

                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> File <span class="help"></span></label>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                        <input type="file" id="file" name="file" value="" class="form-control file" placeholder="" autocomplete="off">
                        <label type="text" class="files-selected" name="files-selected" id="files-selected"/>choose a file to upload</label><br>
                        <input type="hidden" class="fileValue" name="fileValue" id="uploaded_files"/>
                        <input type="hidden" class="oldfileValue" name="oldfileValue" value="<?php echo (isset($row)) ? $row["file"] : ""; ?>"/>
                        <!-- <?php
                         if(!empty($row["logo"])){
                           ?>
                        last uploaded file:- <a target="_blank" href="<?php echo base_url('uploads/merchants/'.$row["logo"])?>">click here</a>
                        <?php
                      }
                      ?> -->
                      </div>
                    </div>
                   <!-- <div class="form-group">
                        <label class="control-label mb-10 text-left"> Image <span class="help"></span></label>
                        <input type="file" id="image"  name="image" value="" class="form-control">
                    </div> -->
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
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
<script>
$(".file").change(function(){
  $('.files-selected').html('Uploading Files.....');
  var file_data =$("#file").prop("files")[0];
  var form_data = new FormData();
   form_data.append("files[]", file_data);
   $.ajax({
     url: $("#base_url").val()+'merchant/ticket/fileUpload',
     type: 'post',
     data: form_data,
     dataType: 'json',
     contentType: false,
     processData: false,
     complete: function (response) {
       console.log(response.responseText);
       $('.fileValue').val(response.responseText);
       $('.files-selected').html('File/s Uploaded Succesfully!');
     }
   });
});
</script>
