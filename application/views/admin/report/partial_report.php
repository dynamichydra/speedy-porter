<div class="row">
    <div class="col-sm-12">

      <?php echo form_open_multipart('admin/report/getpartiallist', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>

        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <!-- <?php print_r($q);?> -->

                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2 customer-cls" >
                            <option value="">select merchant</option>
                            <?php foreach ($merchant as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>">Company: <?php echo $v['company']; ?><br>Name: <?php echo $v['name']; ?><br>Contact: <?php echo $v['phone']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Consignment<span class="help"></span></label>
                        <select id="consignment" name="consignment" class="form-control select2" >
                            <option value="">Select merchant first</option>

                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Shipping Contact<span class="help"></span></label>
                        <select id="s_contact" name="s_contact" class="form-control select2" >
                            <option value="">Select merchant first</option>

                        </select>
                    </div>


                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" class="btn btn-info btn-rounded">Search</button>
                        <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                        </div>
                </div>
            </div>
        </div>
        <div id="itemWrap">

                      </div>
          <?php echo form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
$( document ).ready(function() {
    getAjaxContactship();
});

document.addEventListener("DOMContentLoaded", function () {
$("#customer_id").select2().on('change', function(e) {
    var data = $(".customer-cls option:selected").val();
    console.log(data);
    getAjaxConsignment(data);

  });


});

function getAjaxConsignment(customer){

  var customer = $("#customer_id").val();

  $.ajax({
           url: '<?php echo base_url('admin/report/getConsignment'); ?>',
           type: "POST",
           data: {customer: customer},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         var cons=$('#consignment');
           cons.empty();
           cons.append($("<option></option>").attr("value", '').text('Select Consignment id'));
           Object.keys(jdata).forEach(function(k){
               cons.append($("<option></option>").attr("value", jdata[k].consignment_id).text(jdata[k].consignment_id));
           });
           cons.val();
       }


       });

}

function getAjaxContactship(){

  // var customer = $("#customer_id").val();

  $.ajax({
           url: '<?php echo base_url('admin/report/getshipcontact'); ?>',
           type: "POST",
           // data: {customer: customer},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         var cons=$('#s_contact');
           cons.empty();
           cons.append($("<option></option>").attr("value", '').text('Select shipping contact'));
           Object.keys(jdata).forEach(function(k){
               cons.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].recipient_number));
           });
           cons.val();
       }


       });

}

</script>
