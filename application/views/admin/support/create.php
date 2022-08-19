<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/support/createsave', array("id" => "support-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Subject<span class="help"></span></label>
                        <input type="text" class="form-control"  placeholder="Subject" value="" id="subject" name="subject" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Link <span class="help"></span></label>
                        <input type="text" id="link" name="link" value="" class="form-control" placeholder="Link if any" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Message <span class="help"></span></label>

              <textarea id="msg" name="msg" class="form-control" rows="5"></textarea>
                      </div>

                    </div>

                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Upload File <span class="help"></span></label>
                      <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                      <input type="file" id="docs" name="docs" value="" class="form-control docs" placeholder="upload a file" autocomplete="off">
                      <input type="hidden" class="docsValue" name="docsValue" id="uploaded_files"/>
                      <label type="text" class="files-selected" name="files-selected" id="files-selected"/>choose a file to upload</label><br>
                      <small style="color:red;" >Note:-  Only gif,png,jpg,jpeg files are allowed</small>
                      <?php
                      if(!empty($row["doc"])){
                        ?>
                      last uploaded document:- <a target="_blank" href="<?php echo base_url('uploads/support/'.$row["file"])?>">click here</a>
                      <?php
                    }
                    ?>
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
<script>
$(".docs").change(function(){
  $('.files-selected').html('Uploading Files.....');
  var file_data =$("#docs").prop("files")[0];
  var form_data = new FormData();
   form_data.append("files[]", file_data);
   $.ajax({
     url: $("#base_url").val()+'admin/support/fileUpload',
     type: 'post',
     data: form_data,
     dataType: 'json',
     contentType: false,
     processData: false,
     complete: function (response) {
       console.log(response.responseText);
       $('.docsValue').val(response.responseText);
       $('.files-selected').html('File/s Uploaded Succesfully!');
     }
   });
});
</script>
