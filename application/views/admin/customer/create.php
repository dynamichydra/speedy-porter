<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB72OWY6_-HFF4AUqbzfAB6fVsOb8U6DwU&sensor=false&libraries=places&region=IN" async defer></script> -->
<div class="row">
    <div class="col-sm-12">
      <h5 class="modal-title">Personal Information:-</h5>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open_multipart('admin/customer/createsave', array("id" => "creatcustomer-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                    <div class="form-group">

                        <!-- <div class="col-sm-6">
                          <label class="control-label mb-10 text-left"> NID No. <span class="help"></span></label>
                          <input type="text" id="m_nid" name="m_nid" value="<?php echo (isset($row)) ? $row["m_nid"] : ""; ?>" class="form-control" placeholder="NID No." autocomplete="off" >
                        </div> -->
                        <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Name <b style="color:red;">*</b><span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Full name" value="<?php echo (isset($row)) ? $row["name"] : ""; ?>" id="name" name="name" autocomplete="off">
                      </div>

                    </div>
                    <!-- <div class="form-group">

                    </div> -->
                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Contact No <b style="color:red;">*</b><span class="help"></span></label>
                        <input type="text" id="phno" required="" name="phno" value="<?php echo (isset($row)) ? $row["phone"] : ""; ?>" class="form-control" placeholder="Contact Number" autocomplete="off">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Email <b style="color:red;">*</b><span class="help"></span></label>
                        <input type="email" id="email" required="" name="email" value="<?php echo (isset($row)) ? $row["email"] : ""; ?>" class="form-control" placeholder="Email" autocomplete="off">
                      </div>

                    </div>
                    <!-- <div class="form-group">

                  </div> -->
                  <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Address <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="text" id="address" required="" name="address" placeholder="street name/House no./road name etc." class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["address"] : ""; ?>">
                    </div>
                    <!-- <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Address 2 <span class="help"></span></label>
                      <input type="text" id="address_2" name="address_2" placeholder="Address 2" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["address_2"] : ""; ?>">
                    </div> -->
                  </div>
                  <!-- <div class="form-group"></div> -->

                  <!-- <div class="form-group">
                    <div class="col-sm-12" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Bank Accont Details <span class="help"></span></label>
                    </div>
                  </div> -->


                  <div class="form-group">
                    <!-- <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Address 3 <span class="help"></span></label>
                        <input type="text" id="address_3" placeholder="Address 3" name="address_3" placeholder="Address 3" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["address_3"] : ""; ?>">
                    </div> -->
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Landmark <span class="help"></span></label>
                      <input type="text" id="merchant_landmark" placeholder=" Landmark"  name="merchant_landmark" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["merchant_landmark"] : ""; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> District <span class="help"></span></label>
                      <select id="district" name="district" class="form-control select2 district-cls" required>
                          <option value="">Select District</option>
                          <?php foreach ($district as $k => $v) { ?>
                          <option <?php if(!empty($row) && $row['district'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Zip code <span class="help"></span></label>
                      <select id="police_station" name="police_station" class="form-control select2" required>
                        <option value="">Select District First</option>

                      </select>
                    </div>

                  </div>

                  <!-- <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Postal Code <span class="help"></span></label>
                      <input type="text" id="pincode" name="pincode" placeholder="Postalcode" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["pincode"] : ""; ?>">
                    </div>
                  </div> -->
                </div>
              </div>
            </div>

                  <!-- <h5 class="modal-title">Company Information:-</h5>
                    <div class="panel panel-default card-view">

                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                  <div class="form-group">
                  <div class="col-sm-6" style="margin-top: 5px;">
                    <label class="control-label mb-10 text-left"> Company <b style="color:red;">*</b><span class="help"></span></label>
                    <input type="text" id="company"  name="company" class="form-control" autocomplete="off" placeholder="Company Name" value="<?php echo (isset($row)) ? $row["company"] : ""; ?>" required>
                  </div> -->
                  <!-- </div> -->

                  <!-- <div class="form-group"> -->
                    <!-- <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Website <span class="help"></span></label>
                      <input type="text" id="web"  name="web" value="<?php echo (isset($row)) ? $row["website"] : ""; ?>" class="form-control" placeholder="Website Name" autocomplete="off">
                    </div> -->
                    <!-- <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Facebook Page <span class="help"></span></label>
                      <input type="text" id="fbPage"  name="fbPage" value="<?php echo (isset($row)) ? $row["facebook"] : ""; ?>" class="form-control" placeholder="Facebook Page" autocomplete="off">
                    </div> -->
                  <!-- </div>
                </div>
              </div>
            </div> -->

            <!-- <h5 class="modal-title">Payment Information:-</h5>
              <div class="panel panel-default card-view">

                  <div class="panel-wrapper collapse in">
                      <div class="panel-body">
                  <div class="form-group">

                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Bank A/C Name <span class="help"></span></label>
                      <input type="text" id="baccName" name="baccName" value="<?php echo (isset($row)) ? $row["bank_account_name"] : ""; ?>" class="form-control" placeholder="Bank A/C Name" autocomplete="off">
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Bank A/C Number <span class="help"></span></label>
                      <input type="text" id="bAccno" name="bAccno" value="<?php echo (isset($row)) ? $row["bank_account"] : ""; ?>" class="form-control" placeholder="Bank Account No." autocomplete="off">
                    </div>

                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Bank Name <span class="help"></span></label>
                      <input type="text" id="bName" name="bName" class="form-control" autocomplete="off" placeholder="Bank Name" value="<?php echo (isset($row)) ? $row["bank_name"] : ""; ?>">
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Bank Branch <span class="help"></span></label>
                      <input type="text" id="bBranch" name="bBranch" class="form-control" autocomplete="off" placeholder="Bank Branch" value="<?php echo (isset($row)) ? $row["bank_branch"] : ""; ?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Routing Number <span class="help"></span></label>
                      <input type="text" id="brouting" name="brouting" class="form-control" autocomplete="off" placeholder="Bank Routing no" value="<?php echo (isset($row)) ? $row["bank_routing"] : ""; ?>">
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Mobile Banking Type <span class="help"></span></label>
                      <select id="mobile_banking_type" name="mobile_banking_type" class="form-control select2" >
                          <option value="">Select type</option>
                          <option <?php if(!empty($row) && $row['mobile_banking_type'] == 'bkash') { ?>selected <?php } ?>  value="bkash">Bkash</option>
                          <option <?php if(!empty($row) && $row['mobile_banking_type'] == 'nogod') { ?>selected <?php } ?> value="nogod">Nogod</option>
                          <option <?php if(!empty($row) && $row['mobile_banking_type'] == 'rocket') { ?>selected <?php } ?> value="rocket">Rocket</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Mobile Banking Number <span class="help"></span></label>
                      <input type="text" id="mobile_banking_no" name="mobile_banking_no" class="form-control" autocomplete="off" placeholder="mobile no." value="<?php echo (isset($row)) ? $row["mobile_banking_no"] : ""; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div> -->

            <h5 class="modal-title">Other Information:-</h5>
              <div class="panel panel-default card-view">

                  <div class="panel-wrapper collapse in">
                      <div class="panel-body">
                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Referral Code <span class="help"></span></label>
                        <input type="text" id="ref_code" name="ref_code" class="form-control" autocomplete="off" placeholder="Referral code if any.." value="<?php echo (isset($row)) ? $row["ref_code"] : ""; ?>">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Profile Image <span class="help"></span></label>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                        <input type="file" id="logo" name="logo" value="" class="form-control logo" placeholder="" autocomplete="off">
                        <label type="text" class="files-selected" name="files-selected" id="files-selected"/>choose a file to upload</label><br>
                        <input type="hidden" class="logoValue" name="logoValue" id="uploaded_files"/>
                        <input type="hidden" class="oldlogoValue" name="oldlogoValue" value="<?php echo (isset($row)) ? $row["logo"] : ""; ?>"/>
                        <?php
                         if(!empty($row["logo"])){
                           ?>
                        last uploaded Logo:- <a target="_blank" href="<?php echo base_url('uploads/merchants/'.$row["logo"])?>">click here</a>
                        <?php
                      }
                      ?>
                      </div>
                    </div>

                      <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Package <b style="color:red;">*</b><span class="help"></span></label>
                        <select id="package" name="package" class="form-control select2 district-cls" required>
                            <option value="">Select Package</option>
                            <?php foreach ($package as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['package'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                      </div>

                      <?php
                      if (!isset($row)) {
                          ?>

                            <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left">Password </label>
                              <input type="password" required="" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="off">
                            </div>

                          <?php
                      }else{
                      ?>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left">Password </label>
                        <input type="password" class="form-control" id="password" name="password" value="" placeholder="password" autocomplete="off">
                        <small style="color:red;">Leave the password field blank, if you dont want to change the password.</small>
                      </div>
                      <?php
                    }
                    ?>
                    </div>
                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                        <input type="hidden" name="gmap_lat" id="gmap_lat" value="" />
                        <input type="hidden" name="gmap_lng" id="gmap_lng" value="" />
                        <input type="hidden" name="gmap_city" id="gmap_city" value="" />
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
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script> -->
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
<!-- <script type="text/javascript">
     var IsplaceChange = false;
    $(document).ready(function () {
        var input = document.getElementById('address');
        console.log(input);
        var autocomplete = new google.maps.places.Autocomplete((document.getElementById('address')), {types: ['geocode']});
        console.log(autocomplete);
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
           // console.log(place);
                setAddressOtherInfo(place,'div', '#address','addressdata');
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
</script> -->
<script>
document.addEventListener("DOMContentLoaded", function () {

var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"
var dist = "<?php echo (isset($row))?$row['district']:0;  ?>"
if(dist != 0){
  getAjaxPstation(dist);
}
  $("#district").select2().on('change', function(e) {
      var dist = $(".district-cls option:selected").val();
      console.log(dist);
      getAjaxPstation(dist);
    });

});

// $(document).ready(function(){
//         getAjaxPstation();
// });


$(".logo").change(function(){
  $('.files-selected').html('Uploading Files.....');
  var file_data =$("#logo").prop("files")[0];
  var form_data = new FormData();
   form_data.append("files[]", file_data);
   $.ajax({
     url: $("#base_url").val()+'admin/customer/logoUpload',
     type: 'post',
     data: form_data,
     dataType: 'json',
     contentType: false,
     processData: false,
     complete: function (response) {
       console.log(response.responseText);
       $('.logoValue').val(response.responseText);
       $('.files-selected').html('File/s Uploaded Succesfully!');
     }
   });
});


function getAjaxPstation(dist){

  var dist = $("#district").val();
  var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"

  $.ajax({
           url: '<?php echo base_url('admin/branch/getPstation'); ?>',
           type: "POST",
           data: {dist: dist},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         var station=$('#police_station');
           station.empty();
           station.append($("<option></option>").attr("value", '0').text('Select Zip code'));
           Object.keys(jdata).forEach(function(k){
               station.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].station_name));
           });
           station.val(policeStation);
       }


       });

}
</script>
