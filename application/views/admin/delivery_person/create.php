<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open_multipart('admin/delivery_person/createsave', array("id" => "creatdelivery_person-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                    <div class="form-group" style="">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Transporter ID<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Transporter ID" value="<?php echo (isset($row)) ? $row["transporter_id"] : ""; ?>" id="transporter_id" name="transporter_id" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Transporter Name<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Full name" value="<?php echo (isset($row)) ? $row["name"] : ""; ?>" id="name" name="name" autocomplete="off">
                      </div>
                      <div class="col-sm-6"  style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Contact No <span class="help"></span></label>
                        <input type="number" id="phno" required="" name="phno" value="<?php echo (isset($row)) ? $row["phone"] : ""; ?>" class="form-control" placeholder="Contact Number" autocomplete="off">

                      </div>


                    </div>
                    <!-- <div class="form-group">



                    </div> -->
                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                          <label class="control-label mb-10 text-left">ID Type<span class="help"></span></label>
                          <select id="id_type" name="id_type" class="form-control paymentStatus" onChange="dropBoxChng();">
                              <option value="">Select type</option>
                              <option value="nid" <?php if(isset($row) && $row['id_type'] == 'nid'){ echo "selected";}?>>NID</option>
                              <option value="birth" <?php if(isset($row) && $row['id_type'] == 'birth'){ echo "selected";}?>>Birth Certificate</option>
                              <option value="passport" <?php if(isset($row) && $row['id_type'] == 'passport'){ echo "selected";}?>>Passport</option>
                              <option value="dl" <?php if(isset($row) && $row['id_type'] == 'dl'){ echo "selected";}?>>Driving License</option>
                          </select>
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">ID no.<span class="help"></span></label>
                        <input type="text" class="form-control"  placeholder="ID no." value="<?php echo (isset($row)) ? $row["nid"] : ""; ?>" id="nid" name="nid" autocomplete="off">
                      </div>
                    </div>
                    <!-- <div class="form-group">

                    </div> -->
                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Address <span class="help"></span></label>
                        <input type="text" id="addresss" required="" name="address" class="form-control" placeholder="Address" autocomplete="off" value="<?php echo (isset($row)) ? $row["address"] : ""; ?>">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Email <span class="help"></span></label>
                        <input type="email" id="email" name="email" value="<?php echo (isset($row)) ? $row["email"] : ""; ?>" class="form-control" placeholder="Email" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Service Type<span class="help"></span></label>
                      <select id="user_type" name="user_type" class="form-control paymentStatus" onChange="dropBoxChng();">
                          <option value="">Select type</option>
                          <option value="delivery" <?php if(isset($row) && $row['user_type'] == 'delivery'){ echo "selected";}?>>Delivery</option>
                          <option value="receiver" <?php if(isset($row) && $row['user_type'] == 'receiver'){ echo "selected";}?>>Receiver</option>
                          <option value="Delivery & Receiver" <?php if(isset($row) && $row['user_type'] == 'Delivery & Receiver'){ echo "selected";}?>>Delivery & Receiver</option>
                      </select>
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Transporter Type<span class="help"></span></label>
                        <select id="transporter_type" name="transporter_type" class="form-control paymentStatus" onChange="dropBoxChng();">
                            <option value="">Select type</option>
                            <option value="cyclist" <?php if(isset($row) && $row['transporter_type'] == 'cyclist'){ echo "selected";}?>>Cyclist</option>
                            <option value="motorist" <?php if(isset($row) && $row['transporter_type'] == 'motorist'){ echo "selected";}?>>Rider</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Monthly Salary <span class="help"></span></label>
                        <input type="number" id="month_salary" required="" name="month_salary" class="form-control" placeholder="Monthly Salary" autocomplete="off" value="<?php echo (isset($row)) ? $row["month_salary"] : ""; ?>">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Delivery Commission <span class="help"></span></label>
                        <input type="number" id="del_comission" name="del_comission" value="<?php echo (isset($row)) ? $row["del_comission"] : ""; ?>" class="form-control" placeholder="Delivery Commission" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Pickup Commission <span class="help"></span></label>
                        <input type="number" id="pick_comission" required="" name="pick_comission" class="form-control" placeholder="Pickup Commission" autocomplete="off" value="<?php echo (isset($row)) ? $row["pick_comission"] : ""; ?>">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Oil Bill <span class="help"></span></label>
                        <input type="number" id="oil_bill" name="oil_bill" value="<?php echo (isset($row)) ? $row["oil_bill"] : ""; ?>" class="form-control" placeholder="Motor Oil Bill" autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group">
                      <?php
                      if (!isset($row)) {
                          ?>

                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left">Password</label>
                              <input type="password" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="off">
                            </div>


                          <?php
                      }else{
                      ?>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="Leave the password field blank, if you dont want to change the password." autocomplete="off">
                        <!-- <small style="color:red;">Leave the password field blank, if you dont want to change the password.</small> -->
                      </div>
                      <?php
                    }
                    ?>
                    <!-- <div class="col-sm-6" style="margin-top: 5px;">
                    <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                    <select id="office" name="office" class="form-control">
                      <option value="">Select</option>
                      <?php foreach ($branch as $k => $v) { ?>
                      <option <?php if(!empty($row) && $row['office'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                      <?php } ?>
                    </select>
                    </div> -->

                    </div>



                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Upload Image <span class="help"></span></label>
                        <input type="file" id="pic" name="pic" value="" class="form-control pic" placeholder="Contact Number" autocomplete="off">
                        <input type="hidden" class="picValue" name="picValue" id="uploaded_files"/>
                        <label type="text" class="files-selected-pic" name="files-selected-pic" id="files-selected-pic"/>choose a file to upload</label><br>
                        <?php
                         if(!empty($row["photo"])){
                           ?>
                        last uploaded picture:- <a target="_blank" href="<?php echo base_url('uploads/delivery_person/'.$row["photo"])?>">click here</a>
                        <?php
                      }
                      ?>
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Upload Documents (Pdf)<span class="help"></span></label>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                        <input type="file" id="docs" name="docs" value="" class="form-control docs" placeholder="Email" autocomplete="off">
                        <input type="hidden" class="docsValue" name="docsValue" id="uploaded_files"/>
                        <label type="text" class="files-selected" name="files-selected" id="files-selected"/>choose a PDF file to upload</label><br>
                        <?php
                        if(!empty($row["doc"])){
                          ?>
                        last uploaded document:- <a target="_blank" href="<?php echo base_url('uploads/delivery_person/'.$row["doc"])?>">click here</a>
                        <?php
                      }
                      ?>
                        </div>
                      </div>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
<script type="text/javascript">
     var IsplaceChange = false;
    $(document).ready(function () {
        var input = document.getElementById('address');
        console.log(input);
        var autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {types: ['geocode']});
        console.log(autocomplete);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
           // console.log(place);
                setAddressOtherInfo(place,'div', '#address','dpaddressdata');
            IsplaceChange = true;
        });

        $("#address").keydown(function () {
            IsplaceChange = false;
        });

        $("#address").change(function () {

            if (IsplaceChange == false) {
                $("#address").val('');
               // $("#autocomplete_msg").html('Please Select Location From List');
                //alert("");
            }
            else {
                // $("#autocomplete_msg").html('');
            }

        });
    });
</script>
<script>
$(".docs").change(function(){
  $('.files-selected').html('Uploading Files.....');
  var file_data =$("#docs").prop("files")[0];
  var form_data = new FormData();
   form_data.append("files[]", file_data);
   $.ajax({
     url: $("#base_url").val()+'admin/delivery_person/docsUpload',
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
<script>
$(".pic").change(function(){
  $('.files-selected-pic').html('Uploading Files.....');
  var file_data =$("#pic").prop("files")[0];
  var form_data = new FormData();
   form_data.append("files[]", file_data);
   $.ajax({
     url: $("#base_url").val()+'admin/delivery_person/picUpload',
     type: 'post',
     data: form_data,
     dataType: 'json',
     contentType: false,
     processData: false,
     complete: function (response) {
       console.log(response.responseText);
       $('.picValue').val(response.responseText);
       $('.files-selected-pic').html('File/s Uploaded Succesfully!');
     }
   });
});
</script>
