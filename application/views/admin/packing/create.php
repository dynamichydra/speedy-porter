<script>
var packPrice = "";
</script>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/packing/createsave', array("id" => "creatpacking-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left">Package Name<span class="help"></span></label>
                        <select id="package" name="package" class="form-control select2 package" >
                            <option value="">Select package</option>
                            <?php foreach ($status as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>"<?php if(isset($row["package_id"]) && $v['id'] == $row["package_id"]) echo "selected";?>>name: <?php echo $v['name']; ?>,  weight: <?php echo $v['weight']; ?>,   price: <?php echo $v['price']; ?>,   note: <?php echo $v['note']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left"> Allowed Delivery Type <span class="help"></span></label>
                        <select id="delivery_type" name="delivery_type" class="form-control select2" >
                            <option value="">Select type</option>
                            <?php
              for($i= 0;$i<11;$i++){
                ?>
                <option value= "standard(24-48hrs)+<?php echo $i ; ?>kg" <?php  if(isset($row["delivery_type"]) && $row["delivery_type"] == 'standard(24-48hrs)+'.$i.'kg')  echo 'selected'; ?>>Standard(24-48hrs)+<?php echo $i;?>kg</option>
                <?php
              }
              ?>
              <?php
              for($i= 0;$i<11;$i++){
                ?>
                <option value= "guaranteed(24hrs)+<?php echo $i ; ?>kg" <?php  if(isset($row["delivery_type"]) && $row["delivery_type"] == 'guaranteed(24hrs)+'.$i.'kg')  echo 'selected'; ?>>guaranteed(24hrs)+<?php echo $i;?>kg</option>
                <?php
              }
              ?>


                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left"> Price <span class="help"></span></label>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>">
                        <input type="text" id="price" required="" name="price" value="<?php echo (isset($row)) ? $row["price"] : ""; ?>" class="form-control price" placeholder="Packing Price" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label mb-10 text-left"> Total Price <span class="help"></span></label>
                        <input type="text" id="total_price" style="color:black;" required="" name="total_price" value="<?php echo (isset($row)) ? $row["total_price"] : ""; ?>" class="form-control total_price" placeholder="Total Price" autocomplete="off" readonly>
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
$("#package").select2().on('change', function(e) {
  var pack_id = $('.package option:selected').val();
  console.log(pack_id);
  var url = $("#base_url").val()+'admin/packing/get_packPrice/' + pack_id;
  $.post(url, function(o) {
        packPrice = o.price;
        // console.log(packPrice);
        if($(".price").val()){
          var price =$(".price").val();
          var totalPrice= parseInt(price) + parseInt(packPrice);
          $(".total_price").val(totalPrice);
        }else{
        $(".total_price").val("");
      }
    }, 'json');
  });

});

$(document).ready(function(){
        getPackage();
});
</script>
<script>
function getPackage(){
      var pack_id = $('.package').val();
      var url = $("#base_url").val()+'admin/packing/get_packPrice/' + pack_id;
      $.post(url, function(o) {
            packPrice = o.price;
            console.log(packPrice);
        }, 'json');
}
</script>
<script>
$(".price").keyup(function(){
  var price =$(".price").val();
  var totalPrice= parseInt(price) + parseInt(packPrice);
  // console.log(totalPrice);
  if(price){
    $(".total_price").val(totalPrice);
  }else{
    $(".total_price").val(packPrice);
  }

});
</script>
