<div class="row">
    <div class="col-sm-12">
      <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery'){
?>
        <?php echo form_open_multipart('admin/report/getdeliverylisted', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>
      <?php }else{?>
      <?php echo form_open_multipart('admin/report/getdeliverylist', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>
      <?php
    }
    ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <!-- <?php print_r($q);?> -->
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Status<span class="help"></span></label>
                        <select id="status" name="status" class="form-control select2" >
                            <option value="">Select status</option>
                            <?php foreach ($status as $k => $v) { ?>
                            <option   value="<?php echo $v['delivery_status']; ?>"><?php echo $v['delivery_status']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'delivery'){
              ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Delivery Boy<span class="help"></span></label>
                        <select id="customer_id" name="customer_id" class="form-control select2" >
                            <option value="">Select person</option>
                            <?php foreach ($delivery_boy as $k => $v) { ?>
                            <option   value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                  }
                  ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> From <span class="help"></span></label>
                        <input type="text" id="from_date"  name="from_date"  class="form-control datepicker" >
                        <input type="hidden" value="<?php echo base_url();?>" name="base_url" id="base_url">
                        <input type="hidden" value="<?php echo $_SESSION['user_type']?>" name="userType" id="userType">
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left"> To <span class="help"></span></label>
                        <input type="text" id="to_date"  name="to_date" class="form-control datepicker" >
                    </div>

                    <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'delivery'){
              ?>
                    <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Delivery Boy Type<span class="help"></span></label>
                        <select id="user_type" name="user_type" class="form-control select2" >
                          <option value="">Select user type</option>
                          <option value="delivery" >delivery</option>
                          <option value="receiver" >receiver</option>
                        </select>
                    </div>
                    <?php
                  }
                  ?>

                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" class="btn btn-info btn-rounded">Go</button>
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

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                          <table id="example" class="display" style="width:100%; display:none">
      <thead>
          <tr>
              <th>DELIVERY BOY</th>
              <th>CONSIGNMENT ID</th>
              <th>PRODUCT ID</th>
              <th>PRODUCT NAME</th>
              <th>PRODUCT TYPE</th>
              <th>PRODUCT PRICE</th>
              <th>NO OF ITEMS</th>
              <th>DELIVERY DATE</th>
              <th>MERCHANT NAME</th>
              <th>SHIPING ADDRESS</th>
              <th>TOTAL VALUE</th>
              <th>UPDATE STATUS</th>
          </tr>
      </thead>
      <!-- <tfoot>
          <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Extn.</th>
              <th>Start date</th>
              <th>Salary</th>
          </tr>
      </tfoot> -->
  </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script>

$(document).ready(function(){
    var datatable = $('#datable_352').DataTable({
        "ajax": {
            "url": '<?php echo base_url('admin/report/getdeliverylist'); ?>',
            "type": "POST",
            "dataSrc": ''
        },
        "columns": [
            { "data": "" },
            { "data": "column1" },
            { "data": "column2" },
            { "data": "column3" }
        ],
        "iDisplayLength": 25,
        "order": [[ 6, "desc" ]]
    });

    $('#creatdeliverystatus-form').submit(function (e) {
       var _this = $(this);
       var base_url = $('#base_url').val();
       var userType = $('#userType').val();
       _this.find("[type='submit']").prop('disabled', true);
       e.preventDefault();
        var status = $('#status').val();
        var customer_id = $('#customer_id').val();
        // var searchtli = $('#searchtli').val();

        if(status == "" && customer_id == ""){
            // $('.message').text('You did not enter any search criteria.');
            return false; // making sure they enter something
        } else {
            $.post(
                _this.attr('action'),
                $('#creatdeliverystatus-form').serialize(),
                function(data) {
                    var newData = data;
                    datatable.clear().draw();
                    datatable.rows.add(newData); // Add new data
                    datatable.columns.adjust().draw(); // Redraw the DataTable
                });
            }
        });
 });
</script> -->
