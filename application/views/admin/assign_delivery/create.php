<?php error_reporting(0);?>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/assign_deliveryperson/createsave', array("id" => "creatassignDPerson-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Consignment Id<span class="help"></span></label>
                        <select id="consignment_id" name="consignment_id" class="form-control select2" readonly>
                            <option value="">Select consignment</option>
                            <?php foreach ($consignment_id as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['consignment'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>">ID:<?php echo $v['consignment_id']; ?>, shiping_address:<?php echo $v['recipient_address']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Branch<span class="help"></span></label>
                        <select id="selected_branch" name="selected_branch" class="form-control select2" >
                            <option value="">Select branch</option>
                            <?php foreach ($branch as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['branch'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Delivery Person<span class="help"></span></label>
                        <select id="delivery_person" name="delivery_person" class="form-control select2" >
                            <option value="">Select delivery person</option>
                            <!-- <?php foreach ($d_person as $k => $v) { ?>
                            <option <?php if(!empty($row) && $row['delivery_person'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?> -->

                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="hidden" name="edit_receive" value="<?php if(isset($edit_receive)){echo $edit_receive;}?>">
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
                        <input type="hidden" value="<?php echo (isset($row))?$row["delivery_person"]:"";?>" id="dp_id" name="dp_id">
                        <button type="submit" class="btn btn-info btn-rounded">Update</button>
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

$(document).ready(function() {

  var ofc = "<?php echo $row['branch'] ;?>";
  console.log(ofc);
  getAjaxtransporter(ofc);
$("#selected_branch").select2().on('change', function(e) {
    var ofc = $(".office_class option:selected").val();
    console.log(ofc);
    getAjaxtransporter(ofc);
  });
} );

function getAjaxtransporter(ofc){
  var ofc = $("#selected_branch").val();
  var transporters=$('#delivery_person');
  var dp = $("#dp_id").val();
  $.ajax({
           url: '<?php echo base_url('admin/assign_deliveryperson/gettransporters'); ?>',
           type: "POST",
           data: {ofc: ofc},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         // var station=$('#police_station');
           transporters.empty();
           transporters.append($("<option></option>").attr("value", '0').text('Select Transporter'));
           Object.keys(jdata).forEach(function(k){
               transporters.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].name));
           });
           transporters.val(dp);
       }


       });

}
</script>
