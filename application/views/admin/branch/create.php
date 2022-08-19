<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <?php echo form_open('admin/branch/createsave', array("id" => "createuser-form", "method" => "post")); ?>
                    <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left">Name<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Branch name" value="<?php echo (isset($row)) ? $row["name"] : ""; ?>" id="name" name="name" autocomplete="off">
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label mb-10 text-left"> Email <span class="help"></span></label>
                        <input type="email" id="email" required="" name="email" value="<?php echo (isset($row)) ? $row["email"] : ""; ?>" class="form-control" placeholder="Email" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;">address</label>
                      <input type="text" required="" class="form-control" id="address" name="address" value="<?php echo (isset($row)) ? $row["address"] : ""; ?>" placeholder="Address" autocomplete="off">
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;"> Phone <span class="help"></span></label>
                      <input type="text" id="phone" required="" name="phone" value="<?php echo (isset($row)) ? $row["phone"] : ""; ?>" class="form-control" placeholder="Phone" autocomplete="off">
                    </div>

                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;">District</label>
                      <select id="district" name="district" class="form-control select2 district-cls" >
                          <option value="">Select district</option>
                          <?php foreach ($district as $k => $v) { ?>
                          <option <?php if(!empty($row) && $row['district'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;"> Zip code <span class="help"></span></label>
                      <select id="police_station" name="police_station" class="form-control select2" >
                        <option value="">Select district first</option>

                      </select>
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;">Zonal Area</label>
                      <select id="cp_station" name="cp_station[]" class="form-control select2" multiple>
                          <option value="">Select Zip code's</option>
                          <?php
                          $covering_station = explode(" ",$row["cp_station"]);
                           foreach ($p_station as $k => $v) { ?>
                          <option <?php if(!empty($row) && strpos($row["cp_station"], $v['id'])) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['station_name']; ?></option>
                          <?php } ?>
                      </select>
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

document.addEventListener("DOMContentLoaded", function () {
$("#district").select2().on('change', function(e) {
    var dist = $(".district-cls option:selected").val();
    console.log(dist);
    getAjaxPstation(dist);
  });
});

$(document).ready(function(){
        getAjaxPstation();
});

var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"


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
