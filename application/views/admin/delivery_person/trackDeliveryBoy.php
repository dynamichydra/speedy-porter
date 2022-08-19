<!--
<style>
.dataTables_filter, .dataTables_info { display: none; }
</style>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/report/delivery_report', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Delivery Person<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2" >
                            <option value="">select delivery person</option>
                            <?php foreach ($row as $k => $v) { ?>
                            <option   value="<?php echo $v['nid']; ?>" <?php echo ((isset($src['customer_id']) && $v['nid'] == $src['customer_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button> -->
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                    <!-- </div>
                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
          <?php echo form_close(); ?>
    </div>
</div> -->

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
              <!-- <button onclick="showPositioning()">Try It</button> -->
              <center><h1>COMING SOON</h1></center>

<div id="mapholder"></div>
                <div class="clearfix"></div>
            </div>


        </div>
    </div>
</div>
<!-- <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script>

function showPositioning() {
  var latlon = "23.6101808,85.2799354";

  var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="+latlon+"&zoom=14&size=400x300&sensor=false&key=AIzaSyAh4FQcZCKoc-yxfzVjnZRZw268qcyp7xg";

  document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
}
</script> -->
