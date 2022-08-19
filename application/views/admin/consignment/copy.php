<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/consignment/createsave', array("id" => "creatconsignent-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body">  
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Product Id<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Have any particular product id ?" value="<?php echo (isset($row)) ? $row["product_id"] : ""; ?>" id="product_id" name="product_id" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Parcel Type<span class="help"></span></label>
                        <select id="parcel_type" name="parcel_type" class="form-control select2" >
                            <option value="">select type</option>
                            <option  value="parcel">Parcel</option>
                            <option  value="document">Document</option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Payment Method<span class="help"></span></label>
                        <select id="payment_method" name="payment_method" class="form-control select2" >
                            <option></option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Delivery Type<span class="help"></span></label>
                        <select id="delivery_type" name="delivery_type" class="form-control select2" >
                            <option value="">select type</option>
                            <option value="standrad">Standard(24-48hrs)</option>
                            <option value="guaranteed">Guaranteed(24hrs)
                            </option>

                            
                        </select>
                        <label  style="font-size: 10px;color: red">Booking Time: 12 AM-5 PM </label>
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Package Name<span class="help"></span></label>
                        <select id="package_name" name="package_name" class="form-control select2" >
                            <option value="">select name</option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Product Price<span class="help"></span></label>
                        <input type="text" class="form-control" required=""  placeholder="Product Price" value="<?php echo (isset($row)) ? $row["product_price"] : ""; ?>" id="product_price" name="product_price" autocomplete="off">
                        <label  style="font-size: 10px;color: red">Including Service Charge</label>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> Promo code <span class="help"></span></label>
                        <input type="text" id="promo_code" required="" name="promo_code" value="<?php echo (isset($row)) ? $row["promo_code"] : ""; ?>" class="form-control" placeholder="Promo code" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> Delivery Date <span class="help"></span></label>
                        <input type="text" id="delivery_date" required="" name="delivery_date" value="<?php echo (isset($row)) ? $row["delivery_date"] : ""; ?>" class="form-control" >
                        
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left">Delivery Time<span class="help"></span></label>
                        <select id="delivery_time" name="delivery_time" class="form-control select2" >
                            <option value="">select time</option>
                            <option value="any">Any</option>
                            <option value="10:30AM-1PM">10:30AM-1PM</option>
                            <option value="1PM-4PM">1PM-4AM</option>
                            <option value="any">4PM-7pm</option>
                            
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> No Of Items <span class="help"></span></label>
                        <input type="text" id="no_of_items" required="" name="no_of_items" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["no_of_items"] : ""; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> Item Types <span class="help"></span></label>
                        <input type="text" id="item_types" required="" name="item_types" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["item_type"] : ""; ?>">
                    </div>
                   <div class="form-group col-md-4">
                        <label class="control-label mb-10 text-left"> Instructions <span class="help"></span></label>
                        <input type="text" id="instructions" required="" name="instructions" class="form-control" autocomplete="off" value="<?php echo (isset($row)) ? $row["instructions"] : ""; ?>">
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
        <?php echo form_close(); ?> 
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB72OWY6_-HFF4AUqbzfAB6fVsOb8U6DwU&sensor=false&libraries=places&region=IN" async defer></script>


