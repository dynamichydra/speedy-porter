<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/merchant_pay/createsave', array("id" => "creatassignDPerson-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="form-group col-md-6">
                    <label class="control-label mb-10 text-left" style="margin-top: 5px;">Merchant</label>
                    <select id="merchant" name="merchant" class="form-control select2 merchant-cls" >
                      <option value="">select merchant</option>
                      <?php foreach ($merchant as $k => $v) { ?>
                      <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['customer_id']) && $v['id'] == $src['customer_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                      <label class="control-label mb-10 text-left" style="margin-top: 5px;">Amount<span class="help"></span></label>
                      <input type="text" class="form-control" style="color:black;" required=""  placeholder="total amount" value="0" id="t_amount" name="t_amount" autocomplete="off" readonly>

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


                </div>
            </div>
        </div>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group">

                         <div class="form-group text-center">
                        <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
                        <button type="submit" class="btn btn-info btn-rounded">Paid</button>
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
$("#merchant").select2().on('change', function(e) {
    var merchant = $(".merchant-cls option:selected").val();
    // console.log(merchant);
    // getAjaxPstation(dist);
    getAjaxConsignment(merchant);
  });

  $("#consignment_id").select2().on('change', function(e) {
      var cons = $(".cons-cls option:selected").val();
      // console.log(cons);
      var amount_field=$('#t_amount');
      amount_field.val();
      getAjaxConsignmentprice(cons);
    });

});

// $(document).ready(function(){
//         getAjaxPstation();
// });
//
// var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"


function getAjaxConsignmentprice(cons){
  var cons = $("#consignment_id").val();
  var amount = $("#t_amount").val();
  var amount_field=$('#t_amount');
console.log(cons);
// if(con > 0){
  $.ajax({
           url: '<?php echo base_url('admin/merchant_pay/getconsprice'); ?>',
           type: "POST",
           data: {cons: cons},
           success: function (res)
       {
      console.log(res);
           amount_field.val(Math.floor(res));
       }
       });
}


function getAjaxConsignment(merchant){

  var merchant = $("#merchant").val();

  $.ajax({
           url: '<?php echo base_url('admin/merchant_pay/getConsignment'); ?>',
           type: "POST",
           data: {merchant: merchant},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         var consignments=$('#consignment_id');
           consignments.empty();
           // consignments.append($("<option></option>").attr("value", '0').text('Select all'));
           Object.keys(jdata).forEach(function(k){
               consignments.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].consignment_id));
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
