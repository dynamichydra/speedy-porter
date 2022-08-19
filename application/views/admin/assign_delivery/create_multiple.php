<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/assign_deliveryperson/createsave_multiple', array("id" => "creatassignDPerson-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="form-group col-md-6">
                    <label class="control-label mb-10 text-left" style="margin-top: 5px;">District</label>
                    <select id="district" name="district" class="form-control select2 district-cls" >
                        <option value="">Select district</option>
                        <?php foreach ($district as $k => $v) { ?>
                        <option <?php if(!empty($row) && $row['district'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label mb-10 text-left" style="margin-top: 5px;"> Zip code <span class="help"></span></label>
                    <select id="police_station" name="police_station" class="form-control select2 station-cls" >
                      <option value="">Select district first</option>

                    </select>
                  </div>
                    <div class="form-group col-md-12" style="height:100%">
                        <label class="control-label mb-10 text-left">Consignment Id<span class="help"></span></label>
                        <select id="consignment_id" name="consignment_id[]" required multiple class="form-control select2 cons-cls" >
                            <!-- <option value="">Select consignment</option> -->

                        </select>
                        <br>
<input type="checkbox" id="checkbox"> Select All
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Delivery Person<span class="help"></span></label>
                        <select id="delivery_person" name="delivery_person" required class="form-control select2" >
                            <option value="">Select delivery person</option>
                            <?php foreach ($d_person as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['delivery_person'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Branch<span class="help"></span></label>
                        <select id="selected_branch" name="selected_branch" required class="form-control select2" >
                            <option value="">Select branch</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['branch'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group">

                         <div class="form-group text-center">
                        <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
                        <button type="submit" class="btn btn-info btn-rounded">Create</button>
                        <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button>

                    </div>

         </div>
            </div>
        </div>
    </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>

<script>

document.addEventListener("DOMContentLoaded", function () {
$("#district").select2().on('change', function(e) {
    var dist = $(".district-cls option:selected").val();
    // console.log(dist);
    getAjaxPstation(dist);
    getAjaxConsignment(dist);
  });

  $("#police_station").select2().on('change', function(e) {
      var station = $(".station-cls option:selected").val();
      console.log(station);
      getAjaxConsignment(station);
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


function getAjaxConsignment(dist){

  var dist = $("#district").val();
  var station = $("#police_station").val();

  $.ajax({
           url: '<?php echo base_url('admin/assign_deliveryperson/getConsignment'); ?>',
           type: "POST",
           data: {dist: dist,station: station},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         var consignments=$('#consignment_id');
           consignments.empty();
           // consignments.append($("<option></option>").attr("value", '0').text('Select all'));
           Object.keys(jdata).forEach(function(k){
               consignments.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].consignment_id+" customer: "+jdata[k].recipient_name+" delivery: "+jdata[k].recipient_address+","+jdata[k].recipient_postalcode));
           });
           consignments.val();
           // document.getElementById("checkbox").style.display = "block";
       }


       });

}

$("#checkbox").click(function(){
    if($("#checkbox").is(':checked') ){
        $(".cons-cls > option").prop("selected","selected");
        $(".cons-cls").trigger("change");
    }else{
         $(".cons-cls").val(null).trigger('change');
     }
});

// $('#checkbox').prop('checked', true).trigger('change');

// $("#checkbox").click(function(){
//     if($("#checkbox").is(':checked') ){
//         $("#consignment_id > option").prop("selected","selected");
//         <!-- $("#consignment_id").trigger("change"); -->
//         $("#consignment_id").select2('destroy');
//         $("#consignment_id").hide();
//         $("#valueall").val($("#consignment_id").val())
//     }else{
//         $("#consignment_id > option").removeAttr("selected");
//          <!-- $("#consignment_id").trigger("change"); -->
//          $("#consignment_id").select2();
//         $("#consignment_id").show();
//          $("#valueall").val($("#consignment_id").val())
//      }
// });
</script>
