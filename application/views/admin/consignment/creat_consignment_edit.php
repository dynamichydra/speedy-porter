<?php error_reporting(0);?>
<style>
.ui-corner-all {
  z-index: 9999999;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/consignment/createsave', array("id" => "creatconsignment-form", "method" => "post","enctype" => "multipart/form-data")); ?>
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
                        <label class="control-label mb-10 text-left">Shipping address</label>

                        <input type="text" id="recipient_address_detail" required="" name="recipient_address_detail" placeholder="Receipient Details" class="form-control" value="<?php if(isset($shipingd)) {echo $shipingd[0]["recipient_name"].','.$shipingd[0]["recipient_number"].','.$shipingd[0]["recipient_address"].','.$shipingd[0]["recipient_city"]; } ?>" readonly>
                        <input type="hidden" id="recipient_address" required="" name="recipient_address" value="<?php echo (isset($shipingd)) ? $shipingd[0]["id"] : " "; ?>">
                        <input type="hidden" id="customerdd" name="customer" value="<?php if(!empty($_SESSION) && $_SESSION['id'] != "") echo $_SESSION['id']?>">
                        <input type="hidden" name="shiping" id="shiping" value="<?php if(!empty($_SESSION) && $_SESSION['id'] != "") echo $_SESSION['id']?>">
                        <input type="hidden" name="service_area" id="service_area" value="">
                        <input type="hidden" name="service_ps" id="service_ps" value="<?php echo (isset($row)) ? $row["del_police_station"] : " "; ?>">
                    </div>

                </div>
            </div>
        </div>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="form-group col-md-12">
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Product ID / Merchant Order ID<span class="help"></span></label>
                        <input type="text" class="form-control"  placeholder="Have any particular product id ?" value="<?php echo (isset($row)) ? $row["product_id"] : ""; ?>" id="product_id" name="product_id" autocomplete="off">
                        <input type="hidden" name="parcel_type" value="parcel">
                    </div>

                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Category<span class="help"></span></label>
                        <select id="parcel_cat" name="parcel_cat" class="form-control select2" required>
                            <option value="">Select Category</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'accessories') { ?>selected <?php } ?> value="accessories">Accessories</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'cloths') { ?>selected <?php } ?> value="cloths">Cloths</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'cosmetics') { ?>selected <?php } ?> value="cosmetics">Cosmetics</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'electronics') { ?>selected <?php } ?> value="electronics">Electronics</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'fragile') { ?>selected <?php } ?> value="fragile">Fragile</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'grocery') { ?>selected <?php } ?> value="grocery">Grocery</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'liquid') { ?>selected <?php } ?> value="liquid">Liquid</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'shoe') { ?>selected <?php } ?> value="shoe">Shoe</option>
                            <option <?php if(!empty($row) && $row['parcel_category'] == 'others') { ?>selected <?php } ?> value="others">Others</option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                      <h3>Total Calculation:-</h3><br>
                      <!-- <h5>Parcel Price : -                  <span id = "tprice_product" style="float:right">0</span></h5> -->
                      <h5>Cash Collection : -                  <span id = "tcash_collect" style="float:right"><?php echo (isset($row)) ? $row["cash_collection"] : "0"; ?></span></h5>
                    </div>
                  </div>
                    <div class="form-group col-md-12">
                      <div class="form-group col-md-4" style="display:none;">
                          <label class="control-label mb-10 text-left" > No of items <span class="help"></span></label>
                          <input type="text" id="no_of_items" required="" name="no_of_items" placeholder="Total no of items" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["no_of_items"] : "1"; ?>">
                      </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Weight (<b>Kg</b>)<span class="help"></span></label>
                        <input type="number" min="1" max="5" class="form-control productWeight" required=""  placeholder="Product weight" value="<?php echo (isset($row)) ? $row["product_weight"] : "0"; ?>" id="product_weight" name="product_weight" autocomplete="off">
                        <input type="hidden" id="package_name" name="package_name" value="">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel price<span class="help"></span></label>
                        <input type="number" class="form-control" required=""  placeholder="Product Price" value="<?php echo (isset($row)) ? $row["product_price"] : "0"; ?>" id="product_price" name="product_price" autocomplete="off">
                        <input type="hidden" name="package_price" value="">
                        <!-- <label  style="font-size: 10px;color: red">Including service charge</label> -->
                    </div>

                    <div class="form-group col-md-4">
                      <h5>Delivery Charge : -                  <span id = "td_charge" style="float:right"><?php echo (isset($row)) ? '-'.$row["total_price"] : "0"; ?></span></h5><br>
                      <h5>COD Charge : -                  <span id = "tcod_charge" style="float:right"><?php echo (isset($row)) ? '-'.$row["total_cod_charge"] : "0"; ?></span></h5>
                    </div>
                  </div>
                    <div class="form-group col-md-12">
                      <div class="form-group col-md-4" style="display:none;">
                          <label class="control-label mb-10 text-left" >DC Payment method<span class="help"></span></label>
                          <select id="payment_method" name="payment_method" class="form-control select2" >
                              <!-- <option value="">Select payement method</option> -->
                              <!-- <option <?php if(!empty($row) && $row['payment_method'] == 'merch_will_pay') { ?>selected <?php } ?> value="merch_will_pay">I Will Pay</option> -->
                              <!-- <option <?php if(!empty($row) && $row['payment_method'] == 'merch_paid') { ?>selected <?php }?> value="merch_paid">I Paid</option> -->
                              <option <?php if(!empty($row) && $row['payment_method'] == 'cod') { ?>selected <?php } ?> value="cod">Customer Will Pay</option>
                          </select>
                      </div>

                    <!-- <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Delivery Charge<span class="help"></span></label>
                        <input type="text"  class="form-control" required=""  placeholder="Delivery Charge" value="<?php echo (isset($row)) ? $row["package_price"] : ""; ?>" id="package_price" name="package_price" autocomplete="off">
                        <label  style="font-size: 10px;">Including service charge</label>
                    </div> -->



                  </div>
                    <div class="form-group col-md-12">
                      <!-- <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Promo code <span class="help"></span></label>
                          <select id="promo_code" name="promo_code" class="form-control select2 promo-cls" >
                            <option value="">Select promo</option>

                          </select>

                          <div id='responses_promo' style="color:yellow;"class='col-xs-12'></div>
                          <div id='responses_promo_error' style="color:red;" class='col-xs-12'></div>
                          <div id='responses_promo_final' style="color:green;" class='col-xs-12'></div>
                      </div> -->
                      <!-- <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Parcel Delivery date <span class="help"></span></label>
                          <input type="text" id="delivery_date" required="" name="delivery_date" value="<?php echo (isset($row))  ? $row["delivery_date"] = date( "d-m-Y", strtotime($row["delivery_date"])) : ""; ?>" class="form-control datepicker" placeholder="m/d/y">
                      </div> -->
                    <!-- <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Delivery time<span class="help"></span></label>
                        <select id="delivery_time" name="delivery_time" class="form-control select2" >
                              <option  value="">Select time</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == 'any') { ?>selected <?php } ?> value="any">Any</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '08:00AM - 09:00AM') { ?>selected <?php } ?> value="08:00AM - 09:00AM">08:00AM - 09:00AM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '09:00AM - 10:00AM') { ?>selected <?php } ?> value="09:00AM - 10:00AM">09:00AM - 10:00AM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '10:00AM - 11:00AM') { ?>selected <?php } ?> value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '11:00AM - 12:00PM') { ?>selected <?php } ?> value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '12:00PM - 01:00PM') { ?>selected <?php } ?> value="12:00PM - 01:00PM">12:00PM - 01:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '01:00PM - 02:00PM') { ?>selected <?php } ?> value="01:00PM - 02:00PM">01:00PM - 02:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '02:00PM - 03:00PM') { ?>selected <?php } ?> value="02:00PM - 03:00PM">02:00PM - 03:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '03:00PM - 04:00PM') { ?>selected <?php } ?> value="03:00PM - 04:00PM">03:00PM - 04:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '04:00PM - 05:00PM') { ?>selected <?php } ?> value="04:00PM - 05:00PM">04:00PM - 05:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '05:00PM - 06:00PM') { ?>selected <?php } ?> value="05:00PM - 06:00PM">05:00PM - 06:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '06:00PM - 07:00PM') { ?>selected <?php } ?> value="06:00PM - 07:00PM">06:00PM - 07:00PM</option>
                              <option <?php if(!empty($row) && $row['delivery_time'] == '07:00PM - 08:00PM') { ?>selected <?php } ?> value="07:00PM - 08:00PM">07:00PM - 08:00PM</option>

                        </select>
                    </div> -->
                    <input type="hidden" name="delivery_date" value="<?php echo (isset($row)) ? $row["delivery_date"] : "0"; ?>">
                    <input type="hidden" name="delivery_time" value="any">
                    <input type="hidden" id="extra_amount" name="extra_amount" value="<?php echo (isset($row)) ? $row["extra_amount"] : "0"; ?>">


                   </div>

                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total price (Product) <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_price_product" required="" name="total_price_product" class="form-control totalProductPrice" placeholder="Total price of product" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_price_product"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total price (Delivery) <span class="help"></span></label>
                       <input type="text" id="total_price" style="color:black;" readonly required="" name="total_price" class="form-control" placeholder="Total price of delivery" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_price"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total Weight <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_weight" required="" name="total_weight" class="form-control" placeholder="Total weight of the product" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_weight"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Total Cod Charge <span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="total_cod_charge" required="" name="total_cod_charge" class="form-control" placeholder="Total % cod charge applicable" autocomplete="off" value="<?php echo (isset($row)) ? $row["total_cod_charge"] : "0"; ?>">
                   </div>
                   <div class="form-group col-md-4" style="display:none;">
                       <label class="control-label mb-10 text-left"> Grand Total<span class="help"></span></label>
                       <input type="text" style="color:black;" readonly id="grand_total" required="" name="grand_total" class="form-control" placeholder="Total % cod charge applicable" autocomplete="off" value="<?php echo (isset($row)) ? $row["grand_total"] : "0"; ?>">
                       <input type="hidden" id="dcccharge" name="dcccharge" value="">
                       <input type="hidden" id="excharge" name="excharge" value="">
                   </div>

                   <div class="form-group col-md-12">
                     <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Cash Collection Amount <span class="help"></span></label>
                          <input type="number" id="cash_collect" name="cash_collect" placeholder="Cash to be collected" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["cash_collection"] : ""; ?>">
                      </div>
                     <div class="form-group col-md-4">
                          <label class="control-label mb-10 text-left"> Notes <span class="help"></span></label>
                          <input type="text" id="instructions" name="instructions" placeholder="Instructions if any" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["instructions"] : ""; ?>">
                      </div>

                      <div class="form-group col-md-4">
                        <hr>
                        <h5>Total Payable Amount: -                  <span id = "tpayable_amount" style="float:right"><?php echo (isset($row)) ? $row["cash_collection"]-$row["total_cod_charge"]-$row["total_price"] : "0"; ?></span></h5>
                      </div>

                   <div class="form-group col-md-4">
                   </div>
                   <?php if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){ ?>
                   <div class="form-group col-md-4">
                       <label class="control-label mb-10 text-left"> Branch <span class="help"></span></label>
                       <select id="branch" name="branch" class="form-control select2" required>
                           <option value="">Select Office</option>
                           <?php foreach ($branch as $k => $v) { ?>
                           <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($row['branch']) && $v['id'] == $row['branch'])?'selected':'');?>><?php echo $v['name']; ?></option>
                           <?php } ?>
                       </select>
                   </div>
                 <!-- </div> -->
               <?php }
               ?>

               <div class="form-group text-center">
               <input type="hidden" value="<?php echo (isset($row))?$row["id"]:"";?>" id="id" name="id">
               <input type="hidden" value="<?php echo (isset($row))?$row["promo_code"]:"";?>" id="promo_code" name="promo_code">
               <input type="hidden" id="dcccharge" name="dcccharge" value="">
               <input type="hidden" id="excharge" name="excharge" value="">
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

<!-- <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&sensor=false&libraries=places&region=IN" ></script> -->
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url('asset/admin/'); ?>js/common.js"></script>

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function () {
$("#customer").select2().on('change', function(e) {
    var data = $(".customer-cls option:selected").val();
    var btn = document.getElementById("myBtn");
    var customerid=$('#customer_id');
    // console.log(data);
    getAjaxShiping(data);
    // getAjaxcoupon(data);
    if(data != ""){
    btn.style.display = "block";
    customerid.val(data);
  }else{
    btn.style.display = "none";
  }
  });

  $("#district").select2().on('change', function(e) {
      var dist = $(".district-cls option:selected").val();
      // console.log(dist);
      getAjaxPstation(dist);
    });

    // $("#promo_code").select2().on('change', function(e) {
    //     getPromoPrice();
    //   });

});


$(document).ready(function(){
        getAjaxShiping();
        getAjaxRecipient();
        getAjaxPstation();
        fetch_rcpnt_details();
        getAjaxServiceArea(policeStation);
});
    var policeStation = "<?php echo (isset($row))?$row['police_station']:0;  ?>"
    var deliveryType = "<?php echo (isset($row))?$row['delivery_type']:0;  ?>"
    var pickup = "<?php echo (isset($row))?$row['pickup_address']:0;  ?>"
    var recipientAddress = "<?php echo (isset($row))?$row['recipient_address']:0;  ?>"
    // console.log("pickup "+pickup)
    $(document).on('change', '.customer-cls', function (e) {
       // console.log("abc");
        var _this = $(this);
        e.preventDefault();
            getAjaxShiping();
            getAjaxRecipient();
        });

        $(document).on('change', '#cash_collect', function (e) {
          var cashtocollect = parseFloat($('[name="cash_collect"]').val());
          var parcelprice = $("#total_price_product").val();
          if(Math.sign(cashtocollect) == -1 ){
            alert("Cash collection should be greater than Parcel price");
            $("#cash_collect").val("");
          }else{
          var tweight = $("#total_weight").val();
          var total_weight = Math.ceil(parseFloat(tweight));
          // console.log('total weight:'+total_weight);
         getAjaxpackageprice(total_weight);
         // document.getElementById('tcash_collect').innerHTML = parseFloat(cashtocollect);
         if(isNaN(cashtocollect)){
           document.getElementById('tcash_collect').innerHTML = 0;
         }else{
         document.getElementById('tcash_collect').innerHTML = parseFloat(cashtocollect);
       }
     }
        });


        $(document).on('keyup', '#cash_collect', function (e) {
          var cashtocollect = parseFloat($('[name="cash_collect"]').val());
          var parcelprice = $("#total_price_product").val();
          if(Math.sign(cashtocollect) == -1 ){
            alert("Cash collection should be greater than Parcel price");
            $("#cash_collect").val("");
          }else{
          var tweight = $("#total_weight").val();
          var total_weight = Math.ceil(parseFloat(tweight));
          // console.log('total weight:'+total_weight);
         getAjaxpackageprice(total_weight);
         // document.getElementById('tcash_collect').innerHTML = parseFloat(cashtocollect);
         if(isNaN(cashtocollect)){
           document.getElementById('tcash_collect').innerHTML = 0;
         }else{
         document.getElementById('tcash_collect').innerHTML = parseFloat(cashtocollect);
       }
     }
        });

        function getAjaxpackageprice(total_weight){
          var package_id = $("#package_name").val();
          var chargearea = $("#service_area").val();
          var actualparcelprice = $("#total_price_product").val();
          var parcelprice = $("#cash_collect").val();
          // console.log(total_weight);
          $.ajax({
                   url: '<?php echo base_url('admin/consignment/getpackage'); ?>',
                   type: "POST",
                   data: {package_id: package_id},
                   success: function (res)
               {
               var pdata= res;
               var extraweight = (total_weight-1);
                 var totaldc=$('#total_price');
                 var totalcod=$('#total_cod_charge');
                 var dcchargee=$('#dcccharge');
                 var exchargee=$('#excharge');
                   totaldc.empty();
                   totalcod.empty();
                   if(chargearea == "urban"){
                     var extrchrg = (extraweight*pdata[0].urban_extra_chrg);
                     var totdc = parseInt(pdata[0].urban_dc);
                     var totaldchrg = parseInt(pdata[0].urban_dc) + parseInt(extrchrg);
                     if(pdata[0].cod == 1){
                       var totalcodchrg = ((pdata[0].urban_cod_chrg / 100) * parcelprice).toFixed(2)
                     }else{
                       var totalcodchrg = 0;
                     }

                   }else if(chargearea == "suburban"){
                     var extrchrg = (extraweight*pdata[0].sub_urban_extra_chrg);
                     var totdc = parseInt(pdata[0].sub_urban_dc);
                     var totaldchrg = parseInt(pdata[0].sub_urban_dc) + parseInt(extrchrg);
                     if(pdata[0].cod == 1){
                       var totalcodchrg = ((pdata[0].sub_urban_cod_chrg / 100) * parcelprice).toFixed(2)
                     }else{
                       var totalcodchrg = 0;
                     }
                   }else if(chargearea == "metro"){
                     var extrchrg = (extraweight*pdata[0].metro_extra_chrg);
                     var totdc = parseInt(pdata[0].metro_dc);
                     var totaldchrg = parseInt(pdata[0].metro_dc) + parseInt(extrchrg);
                     if(pdata[0].cod == 1){
                       var totalcodchrg = ((pdata[0].metro_cod_chrg / 100) * parcelprice).toFixed(2)
                     }else{
                       var totalcodchrg = 0;
                     }
                   }
                   var totaldeduction = parseFloat(totaldchrg)+parseFloat(totalcodchrg);
                   var totalpayamount = parcelprice - totaldeduction;
                   var extraamounttocollect = parseFloat(parcelprice)-parseFloat(actualparcelprice);
                   // console.log('total dc'+totaldeduction+'total payable'+totalpayamount);
                   // console.log(totaldchrg+'/'+totalcodchrg);
                   $("#extra_amount").val(extraamounttocollect);
                   totaldc.val(totaldchrg);
                   totalcod.val(totalcodchrg);
                   dcchargee.val(totdc);
                   exchargee.val(extrchrg);
                   document.getElementById('td_charge').innerHTML = '-'+parseFloat(totaldchrg);
                   document.getElementById('tcod_charge').innerHTML = '-'+parseFloat(totalcodchrg);
                   document.getElementById('tpayable_amount').innerHTML = parseFloat(totalpayamount).toFixed(2);
                   getPromoPrice();
                   // getGrandTotal();
               }


               });

}

         function getAjaxShiping(customer){

           var customer = $("#customerdd").val();
           $.ajax({
                    url: '<?php echo base_url('admin/consignment/getshiping'); ?>',
                    type: "POST",
                    data: {customer: customer},
                    success: function (res)
                {
               // console.log(pickup);
               if(res){
               pickup = res[0]['id'];
             }
                var jdata= res;
                // console.log(jdata[0].package);
                  var shiping=$('#shiping');
                  var packageid = $('#package_name')
                    shiping.empty();
                    shiping.append($("<option></option>").attr("value", '0').text('Select pickup address'));
                    Object.keys(jdata).forEach(function(k){
                        shiping.append($("<option></option>").attr("value", jdata[k].id).text("Name: "+jdata[k].name+", Phone :"+jdata[k].phone+", Address: "+jdata[k].address));
                        var pickup2 = jdata[0].id;
                    });
                    shiping.val(pickup);
                    packageid.val(jdata[0].package);
                }


                });

 }

//  function getAjaxcoupon(customer){
//
//    var customer = $("#customerdd").val();
//
//    $.ajax({
//             url: '<?php echo base_url('admin/consignment/getpromo'); ?>',
//             type: "POST",
//             data: {customer: customer},
//             success: function (res)
//         {
//         var jdata= res;
//           var promo=$('#promo_codee');
//             promo.empty();
//             Object.keys(jdata).forEach(function(k){
//                 promo.append($("<option></option>").attr("value", jdata[k].promo_code).text(jdata[k].promo_code));
//             });
//             promo.val();
//         }
//
//
//         });
//
// }

 function getAjaxPstation(dist){
   var distshipping = $("#district").val();
   // var distmerch = $("#district-merch").val();

   if(distshipping != ""){
     var dist = distshipping;
     var station=$('#police_station');
   }else{
   // var dist = distmerch;
   var station=$('#police_station_merch');
 }
// console.log(dist);
// console.log(station);
   $.ajax({
            url: '<?php echo base_url('admin/branch/getPstation'); ?>',
            type: "POST",
            data: {dist: dist},
            success: function (res)
        {
        var jdata= res;
            station.empty();
            station.append($("<option></option>").attr("value", '0').text('Select Zip code'));
            Object.keys(jdata).forEach(function(k){
                station.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].station_name));
            });
            station.val(policeStation);
        }


        });

 }


 function getAjaxRecipient(customer){

   var customer = $("#customer").val();

   $.ajax({
            url: '<?php echo base_url('admin/consignment/getshipingreceipient'); ?>',
            type: "POST",
            data: {customer: customer},
            success: function (res)
        {
        var jdata= res;
          var recipient=$('#recipient_address');
            recipient.empty();
            recipient.append($("<option></option>").attr("value", '0').text('Select address'));
            Object.keys(jdata).forEach(function(k){
                recipient.append($("<option></option>").attr("value", jdata[k].id).text("Name: "+jdata[k].recipient_name+", Phone :"+jdata[k].recipient_number+", Address: "+jdata[k].recipient_address));
            });
            recipient.val(recipientAddress);
        }


        });

}


 $(document).on('change', '.delivery-cls', function (e) {
     var _this = $(this);
     e.preventDefault();
         getAjaxPackagePrice();
     });

      function getAjaxPackagePrice(){

        var package_name = $("#delivery_type").val();
         // console.log("package_name "+package_name);
        $.ajax({
                 url: '<?php echo base_url('admin/consignment/getpackageprice'); ?>',
                 type: "POST",
                 data: {package_name: package_name},
                 success: function (res)
             {
             var jdata= res;
                 Object.keys(jdata).forEach(function(k){
                     $("#package_price").val(jdata[k].total_price);

                 });
                 getTotalpackagePrice();
             }


             });

}

$(document).on('keyup', '#package_price', function (e) {
 getTotalpackagePrice();
});


function getTotalpackagePrice(){

  var price = parseInt($('[name="package_price"]').val());
  var items = parseInt($('[name="no_of_items"]').val());
  var promo_code = $("#promo_code").val();
  if(price >0 && items >0){
  var total_price = (price * items);

  $('[name="total_price"]').val(Math.floor(total_price));
  getGrandTotal();
  if(promo_code != ""){
  getPromoPrice();
}
 }
 else{
     $('[name="total_price"]').val('');
     $('#total_price').empty();
 }

}

function getGrandTotal(){
  var price = parseInt($('[name="total_price"]').val());
  var productPrice = parseInt($('[name="total_price_product"]').val());
  if(productPrice){
    pprice = productPrice;
  }else{
    pprice = 0;
  }
  if(price >0 || productPrice >0){
  var grand_total = (price + pprice);
  // console.log(price+'/'+productPrice);
  // console.log(grand_total);

  $('[name="grand_total"]').val(Math.floor(grand_total));
 }
 else{
     $('[name="grand_total"]').val('');
     $('#grand_total').empty();
 }

}


  $(document).on('change', '.productWeight', function (e) {

  var product_weight = parseFloat($('[name="product_weight"]').val());
  var items = parseInt($('[name="no_of_items"]').val());
  if(product_weight >0 && items >0){
  var total_weight = (product_weight * items);

  $('[name="total_weight"]').val(total_weight+' kg');
  getAjaxpackageprice(Math.ceil(total_weight));
 }
 else{
     $('[name="total_weight"]').val('');
     $('#total_weight').empty();
 }
  });

  $(document).on('keyup', '.productWeight', function (e) {

  var product_weight = parseFloat($('[name="product_weight"]').val());
  var items = parseInt($('[name="no_of_items"]').val());
  if(product_weight >0 && items >0){
  var total_weight = (product_weight * items);

  $('[name="total_weight"]').val(total_weight+' kg');
  getAjaxpackageprice(Math.ceil(total_weight));
 }
 else{
     $('[name="total_weight"]').val('');
     $('#total_weight').empty();
 }
  });


  function getPromoPrice(){
    var promo_code = $("#promo_code").val();
    var customer = $("#customerdd").val();
    var sarea = $("#service_area").val();
    var dcchrg = $("#dcccharge").val();
    var extrchrg = $("#excharge").val();
    var totalcodchrg = $("#total_cod_charge").val();
    var parcelprice = $("#cash_collect").val();
    // console.log(dcchrg);

  //   var delprice = parseInt($('[name="total_price"]').val());
  //   var items = parseInt($('[name="no_of_items"]').val());
  //   if(price >0 && items >0){
  //   var total_price = (price * items);
  //
  //   var delivery = Math.floor(total_price);
  // }else{
  //   var delivery = 0;
  // }
    $.ajax({
             url: '<?php echo base_url('admin/consignment/getDiscounredprice'); ?>',
             type: "POST",
             data: {promo_code: promo_code,customer: customer},
             success: function (res)
         {
        // console.log(res);
        var totaldc=$('#total_price');
          totaldc.empty();
        if(res.success == "true"){
           if(sarea == "urban"){
             var finaldc = dcchrg - parseFloat(res.urban_dc_dis);
             if(extrchrg > 0){
             var finalexchrg = extrchrg - parseFloat(res.urban_extra_chrg_dis);
             var finalexchrg = Math.trunc(finalexchrg);
           // }
             var totaldchrg = parseFloat(finaldc)+parseFloat(finalexchrg);
           }else{
               var totaldchrg = parseFloat(finaldc);
             }
           }else if (sarea == "suburban") {
             var finaldc = dcchrg - parseFloat(res.sub_urban_dc_dis);
             if(extrchrg > 0){
             var finalexchrg = extrchrg - parseFloat(res.sub_urban_extra_chrg_dis);
             var finalexchrg = Math.trunc(finalexchrg);
           // }
             var totaldchrg = parseFloat(finaldc)+parseFloat(finalexchrg);
           }else{
               var totaldchrg = parseFloat(finaldc);
             }
           }else {
             var finaldc = dcchrg - parseFloat(res.metro_dc_dis);
             if(extrchrg > 0){
             var finalexchrg = extrchrg - parseFloat(res.metro_extra_chrg_dis);
             var finalexchrg = Math.trunc(finalexchrg);
             // console.log('finaldc'+res.metro_dc_dis+'finalexchrg'+res.metro_extra_chrg_dis);
           // }
             var totaldchrg = parseFloat(finaldc)+parseFloat(finalexchrg);
           }else{
               var totaldchrg = parseFloat(finaldc);
             }
           }
           var totaldeduction = parseFloat(totaldchrg)+parseFloat(totalcodchrg);
           var totalpayamount = parseFloat(parcelprice) - parseFloat(totaldeduction);
           totaldc.val(totaldchrg);
           // totalcod.val(totalcodchrg);
           // dcchargee.val(dccharge);
           // exchargee.val(extrchrg);
           document.getElementById('td_charge').innerHTML = '-'+parseFloat(totaldchrg);
           // document.getElementById('tcod_charge').innerHTML = '-'+parseFloat(totalcodchrg);
           if(isNaN(totalpayamount)){
           document.getElementById('tpayable_amount').innerHTML = '-'+parseFloat(totaldeduction);
         }else{
           document.getElementById('tpayable_amount').innerHTML = parseFloat(totalpayamount).toFixed(2);
         }
      }
      // else{
      // $('[name="total_price"]').val(Math.floor(delivery));
      // getGrandTotal();
      //
      // }
      getGrandTotal();
         }


         });
  }


  $(document).on('keyup', '#product_price', function (e) {
   var product_price = parseInt($('[name="product_price"]').val());
   var items = parseInt($('[name="no_of_items"]').val());
   if(product_price >0 && items >0){
   var total_price_product = (product_price * items);

   $('[name="total_price_product"]').val(Math.floor(total_price_product));
   // document.getElementById('tprice_product').innerHTML = Math.floor(total_price_product);
   getGrandTotal();
  }
  else{
      $('[name="total_price_product"]').val('');
      $('#total_price_product').empty();
      document.getElementById('tprice_product').innerHTML = 0;
  }
  });


$(document).on('keyup', '#no_of_items', function (e) {
 var price = parseInt($('[name="package_price"]').val());
 var items = parseInt($('[name="no_of_items"]').val());
 if(price >0 && items >0){
 var total_price = (price * items);

 $('[name="total_price"]').val(Math.floor(total_price));
 // getGrandTotal();
}
else{
    $('[name="total_price"]').val('');
    $('#total_price').empty();
}
getPromoPrice();
});


$(document).on('keyup', '#no_of_items', function (e) {
 var product_price = parseInt($('[name="product_price"]').val());
 var items = parseInt($('[name="no_of_items"]').val());
 if(product_price >0 && items >0){
 var total_price_product = (product_price * items);

 $('[name="total_price_product"]').val(Math.floor(total_price_product));
 // getGrandTotal();
}
else{
    $('[name="total_price_product"]').val('');
    $('#total_price_product').empty();
}
});



$(document).on('keyup', '#no_of_items', function (e) {
 var product_weight = parseFloat($('[name="product_weight"]').val());
 var items = parseInt($('[name="no_of_items"]').val());
 if(product_weight >0 && items >0){
 var total_weight = (product_weight * items);

 $('[name="total_weight"]').val(total_weight+' kg');
 getAjaxpackageprice(Math.ceil(total_weight));
}
else{
    $('[name="total_weight"]').val('');
    $('#total_weight').empty();
}
});

$('#customer').on('select2:select', function (e) {
  // console.log(e)
});
</script>

<script>
$(document).on('change', '.package-cls', function (e) {
   // console.log("def");
    var _this = $(this);
    e.preventDefault();
        getAjaxDelivery();
    });


    function getAjaxDelivery(){

      var ppackage = $("#package_name").val();
      // console.log(ppackage);
      $.ajax({
               url: '<?php echo base_url('admin/consignment/getdelivery'); ?>',
               type: "POST",
               data: {ppackage: ppackage},
               success: function (res)
           {
          // console.log(res);
           var jdata= res;
             var delivery=$('#delivery_type');
               delivery.empty();
               delivery.append($("<option></option>").attr("value", '0').text('Select delivery type'));
               Object.keys(jdata).forEach(function(k){
                   delivery.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].delivery_type));
               });
               delivery.val();

           }


           });

}
</script>
<script>
$('#recipient_address').on('select2:select', function (e) {
    var data = e.params.data;
    // console.log(data);
});

function fetch_rcpnt_details(){
        $( ".recipient_number" ).autocomplete({
         source: function( request, response ) {
           $this = $(this.element);
           // console.log($this);
           $.ajax({
             url: '<?php echo base_url('admin/consignment/get_merchant'); ?>',
             type: 'post',
             dataType: "json",
             data: {
               search: request.term
             },
             success: function( data ){
               // console.log(data);
               response(data);
             }
           });
         },
         select: function (event, ui) {
           var tag = $(this).attr("data-tag");
           if(tag == 'rcpnt_num'){
             $('#recipient_number').val(ui.item.label);
             $('#recipient_name').val(ui.item.name);
             $('#recipient_address_shipping').val(ui.item.address);
             $('#recipient_landmark').val(ui.item.landmark);
             $('#recipient_city').val(ui.item.city);
             $('#district').val(ui.item.district);
             $('#police_station').val(ui.item.ps);
             $('#recipient_pincode').val(ui.item.zipcode);
             $('#recipient_address').val(ui.item.id);
             $('#recipient_data_id').val(ui.item.id);
             $('#recipient_address_detail').val(ui.item.name+","+ui.item.label+","+ui.item.address);
             $('#product_weight').val(" ");
             $('#recipient_name_div').css('display','none');
             $('#addshipping_dist').css('display','none');
             $('#addshipping_ps').css('display','none');
             $('#myBtn').css('display','none');
             getAjaxServiceArea(ui.item.ps);
           }
           return false;
         }
        });
        }


        function getAjaxServiceArea(service_ps){

          var service_ps = $("#service_ps").val();
          // console.log(service_ps);
          $.ajax({
                   url: '<?php echo base_url('admin/consignment/getps_area'); ?>',
                   type: "POST",
                   data: {service_ps: service_ps},
                   success: function (res)
               {
               var sdata= res;
                 var servicearea=$('#service_area');
                   servicearea.empty();
                   servicearea.val(sdata[0].area);
               }


               });
               // getAjaxpackageprice();
        }
</script>
