<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <div class="form-group">
                    <?php echo form_open_multipart('admin/shiping/createsave', array("id" => "creatshiping-form", "method" => "post","enctype" => "multipart/form-data")); ?>
                   <?php if(!empty($row["recipient_number"])){ ?>
                    <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Recipient Number<span class="help"></span></label>
                        <input type="text" style="color:black;" class="form-control" required=""  placeholder="Recipient Number" value="<?php echo (isset($row)) ? $row["recipient_number"] : ""; ?>" id="recipient_number"  name="recipient_number" autocomplete="off" disabled>
                    </div>
                <?php } ?>
                <?php if(empty($row["recipient_number"])){ ?>
                    <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Recipient Number<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Recipient Number" value="<?php echo (isset($row)) ? $row["recipient_number"] : ""; ?>" id="recipient_number"  name="recipient_number" autocomplete="off" >
                    </div>
                <?php } ?>
                    <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Recipient Name<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Recipient Name" value="<?php echo (isset($row)) ? $row["recipient_name"] : ""; ?>" id="recipient_name" name="recipient_name" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Recipient Address <span class="help"></span></label>
                        <input type="text" id="recipient_address" required="" name="recipient_address" placeholder="recipient Address" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["recipient_address"] : ""; ?>">
                    </div>
                    <!-- <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Recipient Address 2 <span class="help"></span></label>
                        <input type="text" id="recipient_address_2" required="" placeholder="street name/House no./road name etc." name="recipient_address_2" placeholder="recipient Address" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["recipient_address_2"] : ""; ?>">
                    </div> -->
                    <div class="col-sm-6" style="margin-top: 5px;">
                      <label class="control-label mb-10 text-left"> Recipient Landmark <span class="help"></span></label>
                      <input type="text" id="recipient_landmark" placeholder="Recipient Landmark" required="" name="recipient_landmark" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["recipient_landmark"] : ""; ?>">
                  </div>
                  </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                          <label class="control-label mb-10 text-left">Recipient City <span class="help"></span></label>
                          <input type="text" id="recipient_city" required="" name="recipient_city" class="form-control" autocomplete="off" placeholder="City" value="<?php echo (isset($row)) ? $row["recipient_city"] : ""; ?>">
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> District <span class="help"></span></label>
                        <select id="district" name="district" class="form-control select2 district-cls" >
                            <option value="">Select district</option>
                            <?php foreach ($district as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['district'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                            <?php } ?>
                        </select>
                      </div>


                  </div>

                    <div class="form-group">
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Zip code <span class="help"></span></label>
                        <select id="police_station" name="police_station" class="form-control select2" >
                          <option value="">Select district first</option>

                        </select>
                      </div>
                      <div class="col-sm-6" style="margin-top: 5px;">
                        <label class="control-label mb-10 text-left"> Recipient Postalcode <span class="help"></span></label>
                        <input type="text" id="recipient_pincode" placeholder="Recipient Postalcode" required="" name="recipient_pincode" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["recipient_postalcode"] : ""; ?>">
                    </div>
                      <!-- <div class="col-sm-6" style="margin-top: 5px;">
                          <label class="control-label mb-10 text-left">Recipient Area<span class="help"></span></label>
                          <input type="text" class="form-control" required=""  placeholder="Recipient Area" value="<?php echo (isset($row)) ? $row["recipient_area"] : ""; ?>" id="recipient_area" name="recipient_area" autocomplete="off">
                      </div> -->

                  </div>


                    <div class="form-group text-center">
                      <div class="col-sm-12" style="margin-top: 50px;">
                      <input type="hidden" name="gmap_lat" id="gmap_lat" value="<?php echo (isset($row))?$row["s_lat"]:"";?>" />
                      <input type="hidden" name="gmap_lng" id="gmap_lng" value="<?php echo (isset($row))?$row["s_lng"]:"";?>" />
                      <input type="hidden" name="gmap_city" id="gmap_city" value="<?php echo (isset($row))?$row["s_city"]:"";?>" />
                        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>">
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
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>
<script type="text/javascript">
     var IsplaceChange = false;
    $(document).ready(function () {
        // var input = document.getElementById('recipient_address');
        // console.log(input);
        // var autocomplete = new google.maps.places.Autocomplete((document.getElementById('recipient_address')), {types: ['geocode']});
        // console.log(autocomplete);
        // google.maps.event.addListener(autocomplete, 'place_changed', function () {
        //     var place = autocomplete.getPlace();
        //    // console.log(place);
        //         setAddressOtherInfo(place);
        //     IsplaceChange = true;
        // });

        // $("#recipient_address").keydown(function () {
        //     IsplaceChange = false;
        // });

        // $("#recipient_address").change(function () {
        //
        //     if (IsplaceChange == false) {
        //         $("#recipient_address").val('');
               // $("#autocomplete_msg").html('Please Select Location From List');
                //alert("");
            // }
            // else {
                // $("#autocomplete_msg").html('');
            // }

        // });
    });


    document.addEventListener("DOMContentLoaded", function () {

      $("#district").select2().on('change', function(e) {
          var dist = $(".district-cls option:selected").val();
          console.log(dist);
          getAjaxPstation(dist);
        });

    });
    var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"

    $(document).ready(function(){
            getAjaxPstation();
    });


    function getAjaxPstation(dist){

      var dist = $("#district").val();

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
