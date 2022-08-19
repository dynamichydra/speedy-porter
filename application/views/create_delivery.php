<style type="text/css">
	.error{
		color: red;
	}
</style>
<section>
<div class="container">
<div class="row">
	<?php echo form_open_multipart('delivery/createsave', array("id" => "creatdelivery-form", "method" => "post","enctype" => "multipart/form-data")); ?>
		<div id="part1">
    <div class="col-sm-12">
	<div class="col-md-5" id="div1">
	<div class="create-delivery-form-holder">

<div class="create-delivery-form">
	<h3>From</h3>

	<div class="create-delivery-form-wrap">
		<div class="create-delivery-form-wrap">
			<!-- <h4> Name <sup>*</sup></h4> -->
			<input type="text" name="recipient_name" id="recipient_name" placeholder="Name" value="<?php echo $customer[0]['name'];?>" readonly>
			<input type='hidden' name="base_url" id="base_url" placeholder='Email' class='transition' value="<?php echo base_url();?>">
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> Contact No <sup>*</sup></h4> -->
			<input type="text" name="recipient_phno" id="recipient_name" placeholder="Contact No" value="<?php echo $customer[0]['phone'];?>" readonly>
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> City <sup>*</sup></h4> -->
			<input type="text" name="recipient_city" id="recipient_city" placeholder="City" >
		</div>

		<div class="create-delivery-form-wrap">
			<!-- <h4>  Postal Code <sup>*</sup></h4> -->
			<input type="text" name="recipient_postalcode" id="recipient_postalcode" placeholder="Postal Code" >
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> Address <sup>*</sup></h4> -->
			<input type="text"  id="recipient_address" name="recipient_address" placeholder="Address" value="<?php echo $customer[0]['address'];?>">
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> Landmark </h4> -->
			<input type="text"  name="recipient_landmark" name="recipient_landmark" placeholder="Landmark" >
		</div>
		<!-- <div class="create-delivery-form-wrap">
			<h4> Zone </h4>
			<select name="recipient_zone" id="recipient_zone" >
				<option value="">select zone</option>
			</select>
		</div> -->
		<div class="create-delivery-form-wrap">
			<!-- <h4> Landmark </h4> -->
			<input type="text"  name="recipient_zone" name="recipient_zone" placeholder="Area" >
		</div>
	</div>

</div>





</div>
</div>
<div class="col-md-2">
	<!-- <input type ='button' class="btn btn-danger btn-icon-anim btn-square list-button" value ='Switch' id="interchange" style="margin-top: 30px;margin-left: 0px;color: white;font-size: 20px" > -->

</div>
<div class="col-md-5" id="div2">

	<div class="create-delivery-form-holder">

<div class="create-delivery-form">
	<h3>To</h3>

	<div class="create-delivery-form-wrap">
		<div class="create-delivery-form-wrap">
			<!-- <h4> Name <sup>*</sup></h4> -->
			<input type="text" name="name" id="name"  placeholder="Name">
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> Contact No <sup>*</sup></h4> -->
			<input type="text" name="phno" id="phno"  placeholder="Contact No">
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> City <sup>*</sup></h4> -->
			<input type="text" name="city" id="city"  placeholder="City">
		</div>

		<div class="create-delivery-form-wrap">
			<!-- <h4>  Postal Code <sup>*</sup></h4> -->
			<input type="text" name="postalcode" id="postalcode"  placeholder="Postal Code">
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> Address <sup>*</sup></h4> -->
			<input type="text"  name="address" id="address"  placeholder="Address">
		</div>
		<div class="create-delivery-form-wrap">
			<!-- <h4> Landmark </h4> -->
			<input type="text"  name="landmark" id="landmark"  placeholder="Landmark">
		</div>
		<!-- <div class="create-delivery-form-wrap">
			<h4> Zone </h4>
			<select id="zone" name="zone">
				<option value="">select zone</option>
			</select>
		</div> -->
		<div class="create-delivery-form-wrap">
			<!-- <h4> Landmark </h4> -->
			<input type="text"  name="zone" name="zone" placeholder="Area" >
		</div>
	</div>

</div>


</div>
</div>
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 40%;margin-bottom:2%"><input type="button" class="btn btn-primary enabled transition btnSave" value="Next" id="next_step1" style="color: white;font-size: 20px" onclick="show_step1()"></div>
 </div>
</div>
<div id="part2" style="display: none">
     <div class="col-sm-12">
	<div class="col-md-7" style="margin-left: 20%;">
	<div class="create-delivery-form">
	<h3>Shipment Details</h3>

	<div class="create-delivery-form-wrap">
		<div class="create-delivery-form-wrap prod_types">
			<h4>Item Types<sup>*</sup></h4>
			<select id="product_types" name="product_types" class="product_types_cls " >
				<option value="">select Product</option>
				<option  value="document">Document</option>
				<option value="packages">Packages</option>
			</select>
		</div>

	<div class="doc-cls" style="display: none">
	<div class="create-delivery-form-wrap">
			<h4>Describe The document<sup>*</sup></h4>
			<input type="text" id="doc_type" name="doc_type" placeholder="Such as legal,financial or business paperwork etc" >
		</div>
		<div class="create-delivery-form-wrap">
			<h4>Shipment references<sup>*</sup></h4>
			<input type="text" id="doc_reference" name="doc_reference" placeholder="Reference appears on shiping label and waybill" >
		</div>
	</div>

	<div class="package-cls" style="display: none">
	<div class="create-delivery-form-wrap">
			<h4>Summarize the contents of your shipment<sup>*</sup></h4>
			<input type="text" id="package_type" name="package_type" placeholder="Such as office supplies,auto parts,clothing etc" >
		</div>
		<div class="create-delivery-form-wrap">
			<h4>Shipment references<sup>*</sup></h4>
			<input type="text" id="package_reference" name="package_reference" placeholder="Reference appears on shiping label and waybill" >
		</div>
	</div>

	</div>

</div>
</div>
</div>
<div class="col-sm-12">
	<div class="col-md-3"  style="margin-left: 20%;">
<div class="btn btn-default btn-icon-anim btn-square list-button"  style="margin-left: 48%;margin-bottom:2%"><input type="button" class="btn btn-danger enabled transition btnSave" value="Back" id="back_step" onclick="show_step2()" style="color: white;font-size: 20px"></div>
</div>
<div class="col-md-3">
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 48%;margin-bottom:2%"><input type="button" class="btn btn-primary enabled transition btnSave" value="Next" id="next_step2" style="color: white;font-size: 20px" onclick="show_step3()"></div>

</div>
</div>
</div>

<div id="part3" style="display: none">
     <div class="col-sm-12">
	<div class="col-md-9" style="margin-left: 15%;">
	<div class="create-delivery-form">
	<h3>Select Package</h3>
	<!-- <h3>Select Packing</h3> -->

	<div class="create-delivery-form-wrap">
		                           <div class="form-group col-md-2">
                                        <label class="col-form-label" style="width: 100%">Package<span style="float: right;"></label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">Quantity<sup>*</sup></label>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="col-form-label">Weight (Kg) <sup>*</sup></label>
                                    </div>
                                    <div class="form-group col-md-5" >
                                        <label class="col-form-label" style="margin-left: 30%;">Dimension (CM)<sup>*</sup></label>
                                    </div>


	</div>
	<div class="create-delivery-form-wrap data-row-wrap" style="float: right;">
		<div class=" col-md-2">
			<!-- <input type="text" name="packing" id="packing" class="packing-cls" placeholder="Name" > -->
			<select id="packing" name="packing" class="packing-cls" >
				<option value="">select packing</option>
                 <?php foreach ($packing as $k => $v) { ?>
	                <option value="<?php echo $v['id']; ?>" ><?php echo $v['name']; ?><br/>
	                         <?php echo $v['weight']; ?></option>
													 <!-- <?php echo $v['width']; ?>*<?php echo $v['height']; ?>*<?php echo $v['length']; ?></option> -->
	                <?php } ?>

			</select>
		</div>

		<div class=" col-md-2" >
			<input type="text" name="qnty" id="qnty" class="qnty-cls" placeholder="Quantity" >
		</div>
		<div class=" col-md-2" >
			<input type="text" name="weight" id="weight" class="wght-cls" placeholder="weight">
		</div>
		<div class=" col-md-2" >
			<input type="text" name="length" id="length" placeholder="length">
		</div>
		<div class=" col-md-2" >
			<input type="text" name="height" id="height" placeholder="height">
		</div>
		<div class=" col-md-2" >
			<input type="text" name="width" id="width" placeholder="width">
		</div>

	</div>
	<div class="create-delivery-form-wrap">
		<div class=" col-md-2">
			<h4>Total</h4>
		</div>
		<div class=" col-md-2" id="tot_qnty">
			0
		</div>
		<div class=" col-md-2" id="tot_wght">
			kg
		</div>


	</div>


</div>
</div>
</div>
<div class="col-sm-12">
	<div class="col-md-3"  style="margin-left: 20%;">
<div class="btn btn-default btn-icon-anim btn-square list-button"  style="margin-left: 48%;margin-bottom:2%"><input type="button" class="btn btn-danger btn-icon-anim btn-square list-button" value="Back" id="back_step" onclick="show_step4()" style="color: white;font-size: 20px"></div>
</div>
<div class="col-md-3">
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 48%;margin-bottom:2%"><input type="button" class="btn btn-primary enabled transition btnSave" value="Next" id="next_step3" style="color: white;font-size: 20px" onclick="show_step5()"></div>

</div>
</div>
</div>
<div id="part4" style="display: none">
     <div class="col-sm-12">
	<div class="col-md-7" style="margin-left: 20%;">
	<div class="create-delivery-form">
	<h3>How will you pay?</h3>

	     <div class="create-delivery-form">
		  <div class="create-delivery-form">
		  	<h4>Payment Option<sup>*</sup></h4>
		  	<select id="payment_method" name="payment_method" >
		  		<option value="">select payment option</option>
		  		<option value="online">Online Payment</option>
		  		<option value="cash">Cash</option>
		  	</select>
		  </div>
		</div>

</div>
</div>
</div>
<div class="col-sm-12">
	<div class="col-md-3"  style="margin-left: 20%;">
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 48%;margin-bottom:2%"><input type="button" value="Back" class="btn btn-danger btn-icon-anim btn-square list-button" id="back_step" onclick="show_step6()" style="color: white;font-size: 20px"></div>
</div>
<div class="col-md-3">
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 48%;margin-bottom:2%"><input type="button" class="btn btn-primary enabled transition btnSave" value="Next" id="next_step4" onclick="show_step7()" style="color: white;font-size: 20px"></div>

</div>
</div>
</div>
<div id="part5" style="display: none">
     <div class="col-sm-12">
	<div class="col-md-7" style="margin-left: 20%;">
	<div class="create-delivery-form">
	<h3>Create Delivery Date</h3>

        <div class="create-delivery-form">
		  <div class="create-delivery-form">
		  	<h4>Delivery Date<sup>*</sup></h4>
		  	<input type="text" id="delivery_date" name="delivery_date">
		  </div>
		  </div>

</div>
</div>
</div>
<div class="col-sm-12">
	<div class="col-md-3"  style="margin-left: 20%;">
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 48%;margin-bottom:2%"><input type="button" value="Back" class="btn btn-danger btn-icon-anim btn-square list-button" id="back_step" onclick="show_step8()" style="color: white;font-size: 20px"></div>
</div>
<div class="col-md-3">
<div class="btn btn-default btn-icon-anim btn-square list-button" style="margin-left: 48%;margin-bottom:2%"><input type="submit" class="btn btn-primary enabled transition btnSave" value="submit" id="next_step5" style="color: white;font-size: 20px"></div>

</div>
</div>
</div>
 <!-- </form>  -->
 <?php echo form_close(); ?>
</div>
        </div>
    </section>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
    $(function(){
        // member registration form submit
        $('#creatdelivery-form').submit(function(e) {
            e.preventDefault();

            $('button#next_step5').text('Loading...');

            var site_url = $('#base_url').val();
            var url = $(this).attr('action');
            var postData = $(this).serialize();
            console.log(postData);
            $.post(url, postData, function (o) {
                // $("html, body").animate({ scrollTop: 0 }, 500);
                console.log(o.success);
                if (o.success == true) {
                    swal({
                          title: "Success!",
                          text: o.message,
                          icon: "success",
                          // button: "Aww yiss!",
                        });
                    window.setTimeout(function() {
                        window.location.replace(site_url+"dashboard");
                        }, 1000);
                } else {
                    swal({
                          title: "Failure!",
                          text: o.message,
                          icon: "warning",
                          button: "OK",
                        });
                }

                $('button#next_step5').text('submit');
            }, 'json');
        });
    })
</script>
<script>
$('#interchange').click(function(){

	console.log("click");
  var div1cont = $("#div1").html();
  var div2cont = $("#div2").html();

  $("#div1").html(div2cont);
  $("#div2").html(div1cont);
});

function show_step1() {
            $('#part1').hide();
            $('#part2').fadeIn();

        }
function show_step2() {
            $('#part2').hide();
            $('#part1').fadeIn();

        }
function show_step3() {
            $('#part2').hide();
            $('#part3').fadeIn();

        }
function show_step4() {
            $('#part3').hide();
            $('#part2').fadeIn();

        }
function show_step5() {
            $('#part3').hide();
            $('#part4').fadeIn();

        }
function show_step6() {
            $('#part4').hide();
            $('#part3').fadeIn();

        }
function show_step7() {
            $('#part4').hide();
            $('#part5').fadeIn();

        }
function show_step8() {
            $('#part5').hide();
            $('#part4').fadeIn();

        }
 $(".product_types_cls").on("change", function () {
 	$('.package-cls').hide();
 	$('.doc-cls').hide();
 	if($(this).val() == 'document'){
 		$('.package-cls').hide();
 	    $('.doc-cls').show();
 	}
 	else if($(this).val() == 'packages'){
         $('.package-cls').show();
 	     $('.doc-cls').hide();
 	}
 });

 $(document).on('change', '.packing-cls', function (e) {
        console.log("abc");
        var _this = $(this);
        e.preventDefault();


            getAjaxPacking();
        });

         function getAjaxPacking(){

           var packing_name = $("#packing").val();
             console.log("packing_name "+packing_name);
           $.ajax({
                    url: '<?php echo base_url('frontend/delivery/getpacking'); ?>',
                    type: "POST",
                    data: {packing_name: packing_name},
                    success: function (res)
                {
                console.log(res);
                var jdata= res;
                    Object.keys(jdata).forEach(function(k){
                        $("#weight").val(jdata[k].weight);
                        $("#length").val(jdata[k].length);
                        $("#height").val(jdata[k].height);
                        $("#width").val(jdata[k].width);
                    });
                }


                });
           var rw = event.target.closest(".data-row-wrap");
           initRowElement();
           claculateqnty(rw);

 }

 function initRowElement(){
 	$(".wght-cls").on("change paste keyup", function(){
            var rw = event.target.closest(".data-row-wrap");
            claculateqnty(rw);
        });
        $(".qnty-cls").on("change paste keyup", function(){
            var rw = event.target.closest(".data-row-wrap");
            claculateqnty(rw);
        });
 }
 function claculateqnty(rw){
 	var arr={q:0,w:0};
 	var qnty = parseFloat($("#qnty").val()),wght = parseFloat($("#weight").val());

 arr.q += qnty;
 arr.w += wght;

$("#tot_qnty").html(arr.q);
$("#tot_wght").html(arr.w);
 }
$('#next_step1').on('click', function (e) {
                var recipient_name = $('[name="recipient_name"]'), recipient_name_val = $.trim(recipient_name.val());
                var recipient_phno = $('[name="recipient_phno"]'), recipient_phno_val = $.trim(recipient_phno.val());
                var recipient_city = $('[name="recipient_city"]'), recipient_city_val = $.trim(recipient_city.val());
                var recipient_postalcode = $('[name="recipient_postalcode"]'), recipient_postalcode_val = $.trim(recipient_postalcode.val());
                var recipient_address = $('[name="recipient_address"]'), recipient_address_val = $.trim(recipient_address.val());
                var name = $('[name="name"]'), name_val = $.trim(name.val());
                var phno = $('[name="phno"]'), phno_val = $.trim(phno.val());
                var city = $('[name="city"]'), city_val = $.trim(city.val());
                var postalcode = $('[name="postalcode"]'), postalcode_val = $.trim(postalcode.val());
                var address = $('[name="address"]'), address_val = $.trim(address.val());
                $('#creatdelivery-form .error').remove();
                var error = false;
                if (recipient_name_val == '') {
                    recipient_name.after('<label class="error">This field is required.</label>');
                    error = true;
                }
                if (recipient_phno.length > 0) {
                    if (recipient_phno_val == '') {
                        recipient_phno.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (recipient_city.length > 0) {
                    if (recipient_city_val == '') {
                        recipient_city.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (recipient_postalcode.length > 0) {
                    if (recipient_postalcode_val == '') {
                        recipient_postalcode.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (recipient_address.length > 0) {
                    if (recipient_address_val == '') {
                        recipient_address.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (name_val == '') {
                    name.after('<label class="error">This field is required.</label>');
                    error = true;
                }
                if (phno.length > 0) {
                    if (phno_val == '') {
                        phno.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (city.length > 0) {
                    if (city_val == '') {
                        city.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (postalcode.length > 0) {
                    if (postalcode_val == '') {
                        postalcode.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (address.length > 0) {
                    if (address_val == '') {
                        address.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }


                 if (error === true) {

                            show_step2();
                }

            });
$('#next_step2').on('click', function (e) {
                var product_types = $('[name="product_types"]'), product_types_val = $.trim(product_types.val());
                var doc_type = $('[name="doc_type"]'), doc_type_val = $.trim(doc_type.val());
                var doc_reference = $('[name="doc_reference"]'), doc_reference_val = $.trim(doc_reference.val());
                var package_type = $('[name="package_type"]'), package_type_val = $.trim(package_type.val());
                var package_reference = $('[name="package_reference"]'), package_reference_val = $.trim(package_reference.val());
                $('#creatdelivery-form .error').remove();
                var error = false;
                if (product_types_val == '') {
                    product_types.after('<label class="error">This field is required.</label>');
                    error = true;
                }
                if(product_types_val == 'document'){
                if (doc_type.length > 0) {
                    if (doc_type_val == '') {
                        doc_type.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (doc_reference.length > 0) {
                    if (doc_reference_val == '') {
                        doc_reference.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
            }
            else if(product_types_val == 'packages'){
                if (package_type.length > 0) {
                    if (package_type_val == '') {
                        package_type.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
                if (package_reference.length > 0) {
                    if (package_reference_val == '') {
                        package_reference.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }
            }



                 if (error === true) {

                            show_step4();
                }

            });
    $('#next_step3').on('click', function (e) {
                var packing = $('[name="packing"]'), packing_val = $.trim(packing.val());
                var qnty = $('[name="qnty"]'), qnty_val = $.trim(qnty.val());
                $('#creatdelivery-form .error').remove();
                var error = false;
                 if (packing.length > 0) {
                     if (packing_val == '') {
                    packing.after('<label class="error">This field is required.</label>');
                    error = true;
                   }
                }

                if (qnty.length > 0) {
                    if (qnty_val == '') {
                        qnty.after('<label class="error">This field is required.</label>');
                        error = true;
                    }
                }




                 if (error === true) {

                            show_step6();
                }

            });
    $('#next_step4').on('click', function (e) {
                var payment_method = $('[name="payment_method"]'), payment_method_val = $.trim(payment_method.val());
                $('#creatdelivery-form.error').remove();
                var error = false;
                if (payment_method.length > 0) {
                     if (payment_method_val == '') {
                    payment_method.after('<label class="error">This field is required.</label>');
                    error = true;
                   }
               }
                 if (error === true) {

                         show_step8();
                }

            });
    $('#next_step5').on('click', function (e) {
                var delivery_date = $('[name="delivery_date"]'), delivery_date_val = $.trim(delivery_date.val());
                $('#creatdelivery-form.error').remove();
                var error = false;

                 if (delivery_date.length > 0) {
                     if (delivery_date_val == '') {
                    delivery_date.after('<label class="error">This field is required.</label>');
                    error = true;
                   }
               }

                 if (error === false) {

                         $('#creatdelivery-form').submit();
                }

            });


</script>
