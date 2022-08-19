<?php error_reporting(0);?>
<style>
.ui-corner-all {
  z-index: 9999999;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/consignment/submitorder', array("id" => "creatconsignment-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <?php
                  if(isset($row) && $row['consignment_id'] != ""){
                  ?>
                  <div class="form-group col-md-6">
                          <label class="control-label mb-10 text-left">Consignment ID<span class="help"></span></label>
                          <input type="text" style="color:black" name="consignment_id" id="consignment_id" value="<?php echo (isset($row)) ? $row["consignment_id"] : ""; ?>" class="form-control" readonly>
                      </div>
                  <?php
                }else{
                ?>
                <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Consignment ID<span class="help"></span></label>
                        <input type="text" style="color:black" name="consignment_id" id="consignment_id" value="<?php echo (isset($autono)) ? $autono : ""; ?>" class="form-control" readonly>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Existing Customer</label></label>
                        <select id="customer" name="customer" class="form-control  customer-cls" >
                            <option value="">Select Customer</option>
                            <?php foreach ($customer as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['customer'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['company']; ?>,<?php echo $v['name']; ?>, phone:<?php echo $v['phone']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label mb-10 text-left">Order Type<span class="help"></span></label>
                        <select id="orderTYpe" name="orderTYpe" class="form-control select2" >
                          <option value="">Select Order Type</option>
                          <option value="SENDING" <?php if(!empty($row) && $row['order_type'] == "SENDING") { ?>selected <?php } ?>>Sending</option>
                          <option value="RECEIVING" <?php if(!empty($row) && $row['order_type'] == "RECEIVING") { ?>selected <?php } ?>>Receiving</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
<h5 class="modal-title">Pickup Address:-</h5>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <div class="col-sm-6" style="margin-top: 5px;" id="recipient_name_div">
                      <label class="control-label mb-10 text-left">Address <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="text" class="form-control" required=""  placeholder="Pickup Address" value="<?php echo (isset($row)) ? $row["pick_address_auto"] : ""; ?>" id="pick_address_auto" name="pick_address_auto" autocomplete="off">
                  </div>

                  <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left">Landmark <b style="color:red;">*</b><span class="help"></span></label>
                      <input type="text" class="form-control recipient_number" data-tag="rcpnt_num" required="" placeholder="Recipient Number" value="<?php echo (isset($row)) ? $row["pick_address_landmark"] : ""; ?>" id="pick_address_landmark"  name="pick_address_landmark" autocomplete="off">

                  </div>


                  <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Phone <b style="color:red;">*</b><span class="help"></span></label>
                      <input onfocusout="checkMobile();" type="number" minlength="10" maxlength="10" id="pick_number" required="" placeholder="street name/House no./road name etc." name="pick_number" placeholder="Mobile Number" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["pick_number"] : ""; ?>">
                  </div>
                    <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_dist">
                      <label class="control-label mb-10 text-left"> District <b style="color:red;">*</b><span class="help"></span></label>
                      <select onchange="getAjaxPstation(this.value)" id="distt" name="distt" class="select2 district-cls">

            </select>
                    </div>
                  <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_ps">
                    <label class="control-label mb-10 text-left"> Pincode <b style="color:red;">*</b><span class="help"></span></label>
                    <select onchange="getprice();" id="police_station" required name="police_station" class="form-control select2" >
                      <option value="">Select Pincode</option>

                    </select>
                  </div>

                </div>
            </div>
        </div>

        <h5 class="modal-title">Drop Address:-</h5>
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                          <div class="col-sm-6" style="margin-top: 5px;" id="recipient_name_div">
                              <label class="control-label mb-10 text-left">Address <b style="color:red;">*</b><span class="help"></span></label>
                              <input type="text" class="form-control" required=""  placeholder="Drop Address" value="<?php echo (isset($row)) ? $row["drop_address_auto"] : ""; ?>" id="drop_address_auto" name="drop_address_auto" autocomplete="off">
                          </div>

                          <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left">Landmark <b style="color:red;">*</b><span class="help"></span></label>
                              <input type="text" class="form-control recipient_number" data-tag="rcpnt_num" required="" placeholder="Recipient Number" value="<?php echo (isset($row)) ? $row["drop_address_landmark"] : ""; ?>" id="drop_address_landmark"  name="drop_address_landmark" autocomplete="off">

                          </div>


                          <div class="col-sm-6" style="margin-top: 5px;">
                              <label class="control-label mb-10 text-left"> Phone <b style="color:red;">*</b><span class="help"></span></label>
                              <input  onfocusout="checkMobileDrop();" type="number" minlength="10" maxlength="10" id="drop_number" required="" placeholder="street name/House no./road name etc." name="drop_number" placeholder="Mobile Number" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["drop_number"] : ""; ?>">
                          </div>
                            <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_dist">
                              <label class="control-label mb-10 text-left"> District <b style="color:red;">*</b><span class="help"></span></label>
                              <select  onchange="getAjaxPstation2(this.value)" id="distt2" name="distt2" class="select2 district-cls2">

            </select>
                            </div>
                          <div class="col-sm-6" style="margin-top: 5px;" id="addshipping_ps">
                            <label class="control-label mb-10 text-left"> Pincode <b style="color:red;">*</b><span class="help"></span></label>
                            <select onchange="getprice();" id="police_station2" required name="police_station2" class="form-control select2" >
                              <option value="">Select Pincode</option>

                            </select>
                          </div>

                        </div>
                    </div>
                </div>

<h5 class="modal-title">Consignment Detais:-</h5>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Category<span class="help"></span></label>
                        <select id="parcel_cat" name="parcel_cat" class="form-control select2" required>
                            <option value="">Select Category</option>
                            <option <?php if(!empty($row) && $row['category'] == 'accessories') { ?>selected <?php } ?> value="accessories">Accessories</option>
                            <option <?php if(!empty($row) && $row['category'] == 'cloths') { ?>selected <?php } ?> value="cloths">Cloths</option>
                            <option <?php if(!empty($row) && $row['category'] == 'cosmetics') { ?>selected <?php } ?> value="cosmetics">Cosmetics</option>
                            <option <?php if(!empty($row) && $row['category'] == 'electronics') { ?>selected <?php } ?> value="electronics">Electronics</option>
                            <option <?php if(!empty($row) && $row['category'] == 'fragile') { ?>selected <?php } ?> value="fragile">Fragile</option>
                            <option <?php if(!empty($row) && $row['category'] == 'grocery') { ?>selected <?php } ?> value="grocery">Grocery</option>
                            <option <?php if(!empty($row) && $row['category'] == 'liquid') { ?>selected <?php } ?> value="liquid">Liquid</option>
                            <option <?php if(!empty($row) && $row['category'] == 'shoe') { ?>selected <?php } ?> value="shoe">Shoe</option>
                            <option <?php if(!empty($row) && $row['category'] == 'others') { ?>selected <?php } ?> value="others">Others</option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Select Height<span class="help"></span></label>
                        <select id="height" name="height" class="select2 height-cls" onchange="getwidths(this.value)">

                </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Select Width<span class="help"></span></label>
                        <select onchange="getprice();" id="width" name="width" class="select2 width-cls">

                </select>
                    </div>
                  </div>

                    <div class="form-group col-md-12">


                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Weight (<b>Kg</b>)<span class="help"></span></label>
                        <input onkeyup="getprice();" type="text" class="form-control productWeight" required=""  placeholder="Product weight" value="<?php echo (isset($row)) ? $row["parcel_wt"] : "1"; ?>" id="product_weight" name="product_weight" autocomplete="off">
                    </div>
                  <div class="form-group col-md-4">
                      <label class="control-label mb-10 text-left">Delivery Charge<span class="help"></span></label>
                      <input type="text"  class="form-control" required=""  placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["delivery_charge"] : ""; ?>" id="total_price" name="total_price" autocomplete="off">
                      <label  style="font-size: 10px;">Including service charge</label>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="control-label mb-10 text-left"> Parcel Image <span class="help"></span></label>
                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                    <input type="file" id="parcel_image" name="parcel_image" value="" class="form-control logo" placeholder="" autocomplete="off">
                    <label type="text" class="files-selected" name="files-selected" id="files-selected"/>choose a file to upload</label><br>
                    <input type="hidden" class="imgValue" name="imgValue" id="uploaded_files"/>
                    <input type="hidden" class="oldimgValue" name="oldimgValue" value="<?php echo (isset($row)) ? $row["parcel_image"] : ""; ?>"/>
                    <?php
                     if(!empty($row["parcel_img"])){
                       ?>
                    last uploaded Logo:- <a target="_blank" href="<?php echo base_url('uploads/merchants/'.$row["parcel_img"])?>">click here</a>
                    <?php
                  }
                  ?>
                  </div>
                  </div>

             <div class="form-group col-md-12">

             </div>

                </div>
            </div>
        </div>

<h5 class="modal-title">Payment Detais:-</h5>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <div class="form-group col-md-12">
                  <input type="radio" id="cash" name="pmode" value="cash">
                <label for="cash">CASH</label><br>
                &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="p_pick_location" name="p_pick_location" value="patpick">
                <label for="p_pick_location">Payment at Pickup Location</label><br>
                &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="P_drop_location" name="p_pick_location" value="patdrop">
                <label for="P_drop_location">Payment at Drop Location</label><br>
                <input type="radio" id="online" name="pmode" value="online">
                <label for="online">ONLINE</label><br>
              </div>

            </div>
        </div>
    </div>

        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group">

                      <div class="form-group col-md-12">
                      <input type="checkbox" value="checked" name="tc" id="tc">     I have read and accept the <a class="modal-trigger"
                href="#demo-modal">
                Terms & Conditions.</a>
                         <div class="form-group text-center">
                        <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
                        <button type="submit" class="btn btn-info btn-rounded">Create</button>
                        <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>

                    </div>
                  </div>

         </div>
            </div>
        </div>
    </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>

<script>

var IsplaceChange = false;
$(document).ready(function () {
   var input = document.getElementById('pick_address_auto');
   console.log(input);
   var autocomplete = new google.maps.places.Autocomplete((document.getElementById('pick_address_auto')), {types: ['geocode']});
   console.log(autocomplete);
   google.maps.event.addListener(autocomplete, 'place_changed', function () {
       var place = autocomplete.getPlace();
      console.log(place);
      $('#pick_address_auto').val(place.formatted_address);
           setAddressOtherInfo(place);
       IsplaceChange = true;
   });

   $("#pick_address_auto").keydown(function () {
       // IsplaceChange = false;
   });

   $("#pick_address_auto").change(function () {

       if (IsplaceChange == false) {
           $("#pick_address_auto").val('');
          // $("#autocomplete_msg").html('Please Select Location From List');
           //alert("");
       }
       else {
           // $("#autocomplete_msg").html('');
       }

   });
});

function setAddressOtherInfo(place){
var city='';
if(typeof(place.address_components)!=="undefined"){
    Object.keys(place.address_components).forEach(function(k){
        if(place.address_components[k].types[0]=="administrative_area_level_2" && city=='')
            city =place.address_components[k].long_name;
        if(place.address_components[k].types[0]=="locality" && city=='')
            city =place.address_components[k].long_name;
    });
    $('#gmap_lat').val(place.geometry.location.lat());
    $('#gmap_lng').val(place.geometry.location.lng());
    $('#gmap_city').val(city);
}
}
</script>

<script>

var IsplaceChange2 = false;
$(document).ready(function () {
   var input = document.getElementById('drop_address_auto');
   console.log(input);
   var autocomplete = new google.maps.places.Autocomplete((document.getElementById('drop_address_auto')), {types: ['geocode']});
   console.log(autocomplete);
   google.maps.event.addListener(autocomplete, 'place_changed', function () {
       var place = autocomplete.getPlace();
      console.log(place);
      $('#drop_address_auto').val(place.formatted_address);
           setAddressOtherInfo2(place);
       IsplaceChange2 = true;
   });

   $("#drop_address_auto").keydown(function () {
       // IsplaceChange = false;
   });

   $("#drop_address_auto").change(function () {

       if (IsplaceChange2 == false) {
           $("#drop_address_auto").val('');
          // $("#autocomplete_msg").html('Please Select Location From List');
           //alert("");
       }
       else {
           // $("#autocomplete_msg").html('');
       }

   });
});

function setAddressOtherInfo2(place){
var city='';
if(typeof(place.address_components)!=="undefined"){
    Object.keys(place.address_components).forEach(function(k){
        if(place.address_components[k].types[0]=="administrative_area_level_2" && city=='')
            city =place.address_components[k].long_name;
        if(place.address_components[k].types[0]=="locality" && city=='')
            city =place.address_components[k].long_name;
    });
    $('#gmap_lat').val(place.geometry.location.lat());
    $('#gmap_lng').val(place.geometry.location.lng());
    $('#gmap_city').val(city);
}
}
</script>

<script type="text/javascript">
$(document).ready(function(){
  var seldistrict ='<?php echo $row['distt'] ;?>';
  if(seldistrict != ""){
    getdisctricts(seldistrict);
  }
  console.log(seldistrict);
  getdisctricts();
    getheights()
});

function checkMobile() {
  if(!$('#pick_number').val().match('[0-9]{10}'))  {
              document.getElementById('pick_number').value = '';
               alert("Please put 10 digit mobile number");
               return;
           }
}

function checkMobileDrop() {
  if(!$('#drop_number').val().match('[0-9]{10}'))  {
              document.getElementById('drop_number').value = '';
               alert("Please put 10 digit mobile number");
               return;
           }
}

function getdisctricts(seldistrict=null){
  $.ajax({
           url: '<?php echo base_url('admin/consignment/districts'); ?>',
           type: "POST",
           success: function (res)
       {
      console.log(res);
      var htm = "<option value = '' disabled selected>Select District</option>";
      var alldist = res.distdata;
      for(var i =0;i<alldist.length;i++){
        htm +=`<option value = "${alldist[i].id}">${alldist[i].district_name}</option>`;
      }
      $("#distt").html(htm);
      $("#distt2").html(htm);
    }
  });
}

  function getheights(){
    $.ajax({
             url: '<?php echo base_url('admin/consignment/volumetric'); ?>',
             type: "POST",
             success: function (res)
         {
      console.log(res);
      var htm = "<option value = '' disabled selected>Select Height</option>";
      var alldist = res.distdata;
      for(var i =0;i<alldist.length;i++){
        htm +=`<option value = "${alldist[i].height}">${alldist[i].height}</option>`;
      }
      $("#height").html(htm);
    }
    })
  }


  function getwidths(height){

    $.ajax({
             url: '<?php echo base_url('admin/consignment/volumetric_width'); ?>',
             type: "POST",
             data: {height: height},
             success: function (res)
         {
      console.log(res);
      var htm = "<option value = '' disabled selected>Select Width</option>";
      var alldist = res.widthdata;
      for(var i =0;i<alldist.length;i++){
        htm +=`<option value = "${alldist[i].width}">${alldist[i].width}</option>`;
      }
      $("#width").html(htm);
    }
    })
  }

  function getAjaxPstation(dist){
    console.log(dist);
    $.ajax({
             url: '<?php echo base_url('admin/consignment/stationlist'); ?>',
             type: "POST",
             data: {district: dist},
             success: function (res)
         {
        console.log(res);

        var htm = "<option value = '' disabled selected>Select Pincode</option>";
        var allps = res.pstdata;
        for(var i =0;i<allps.length;i++){
          htm +=`<option value = "${allps[i].id}">${allps[i].station_name}</option>`;
        }
        $("#police_station").html(htm);
      }
      })
    }

    function getAjaxPstation2(dist){
      console.log(dist);
      $.ajax({
               url: '<?php echo base_url('admin/consignment/stationlist'); ?>',
               type: "POST",
               data: {district: dist},
               success: function (res)
           {
          console.log(res);

          var htm = "<option value = '' disabled selected>Select Pincode</option>";
          var allps = res.pstdata;
          for(var i =0;i<allps.length;i++){
            htm +=`<option value = "${allps[i].id}">${allps[i].station_name}</option>`;
          }
          $("#police_station2").html(htm);
        }
        })
      }

      function getprice(){
      var dimension_price= $('#width').val();
      var wt= $('#parcel_wt').val();
      var from_zip= $('#police_station').val();
      var to_zip= $('#police_station2').val();

      var bs_distance = 5;
      var bs_weight = 2;
      var got_dis = 0;
      var extraChargeforWeight = 0;
      var extraChargefordistance = 0;
      var got_dis = 0;

            if(from_zip != " " && to_zip!= ""){
             got_dis = 50
          }
        console.log(got_dis);
        $.ajax({
                 url: '<?php echo base_url('admin/consignment/getpackagepricing'); ?>',
                 type: "POST",
                 success: function (res)
             {
                console.log(res.pckg);
              if(wt>0 && parseFloat(wt) > parseFloat(bs_weight)){
                var extra_wt = parseFloat(wt)-parseFloat(bs_weight);
                extraChargeforWeight = extra_wt*res.pckg[0].metro_extra_chrg;
              }
              console.log(extraChargeforWeight);
              if(got_dis>0 && parseFloat(got_dis) > parseFloat(bs_distance)){
                var extra_dis = parseFloat(got_dis)-parseFloat(bs_distance);
                extraChargefordistance = extra_dis*res.pckg[0].metro_dis_extra_chrg;
              }

              var totalCharge = parseFloat(res.pckg[0].metro_dc)+parseFloat(0)+parseFloat(extraChargeforWeight)+parseFloat(extraChargefordistance)+parseFloat(dimension_price);
              console.log('T_charge = '+totalCharge);
              document.getElementById("total_price").value = totalCharge;

            }
             });

    }

    $(".logo").change(function(){
      $('.files-selected').html('Uploading Files.....');
      var file_data =$("#parcel_image").prop("files")[0];
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
           $('.imgValue').val(response.responseText);
           $('.files-selected').html('File/s Uploaded Succesfully!');
         }
       });
    });
</script>
