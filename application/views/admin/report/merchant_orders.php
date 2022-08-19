<div class="row">
    <div class="col-sm-12">
      <?php
if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'delivery'){
?>
        <?php echo form_open_multipart('admin/report/getdeliverylisted', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>
      <?php }else{?>
      <?php echo form_open_multipart('admin/report/getorderlist', array("id" => "creatdeliverystatus-form", "method" => "post","enctype" => "multipart/form-data")); ?>
      <?php
    }
    ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <?php
            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
            ?>
                  <div class="form-group col-md-3">
                      <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                      <select id="office_id" name="office_id" class="form-control select2" >
                          <option value="">All Office</option>
                          <?php foreach ($branch as $k => $v) { ?>
                          <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                          <?php } ?>
                      </select>
                  </div>
                  <?php
                }
                ?>
                    <?php
              if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'delivery'){
              ?>
              <div class="form-group col-md-3">
                  <label class="control-label mb-10 text-left">Merchant<span class="help"></span></label>
                  <select id="customer_id" name="customer_id" class="form-control select2" >
                      <option value="">Select Merchant</option>
                      <?php foreach ($merchant as $k => $v) { ?>
                      <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['customer_id']) && $v['id'] == $src['customer_id'])?'selected':'');?>><?php echo $v['name']; ?>, <?php echo $v['company']; ?></option>
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


                    <!-- <div class="form-group col-md-3">
                        <label class="control-label mb-10 text-left">Consignment Status<span class="help"></span></label>
                        <select id="con_status" name="con_status" class="form-control select2" >
                          <option value="">Select consignment status</option>
                          <?php foreach ($status as $k => $v) { ?>
                          <option   value="<?php echo $v['status']; ?>"><?php echo $v['status']; ?></option>
                          <?php } ?>
                        </select>
                    </div> -->



                    <div class="form-group col-md-3" style="margin-top: 30px;float:right;">
                    <button type="submit" id="getsubmit" class="btn btn-info btn-rounded">Search</button>
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
                          <table id="example" class="table table-hover display  pb-30" style="width:100%">
      <thead>
          <tr>
              <!-- <th>DELIVERY BOY</th> -->
              <th>PICKUP OFFICE</th>
              <th>ORDER DATE</th>
              <th>STATUS</th>

              <th>CONSIGNMENT ID</th>
              <th>MERCHANT DETAILS</th>
              <th>SHIPPING DETAILS</th>
              <th>NOTE</th>
              <th>PARCEL CATEGORY</th>
              <th>DELIVERY DATE</th>
              <th style="text-align: right;">PARCEL VALUE</th>
              <th style="text-align: right;">DELIVERY CHARGE</th>
              <th style="text-align: right;">COD CHARGE</th>
              <th style="text-align: right;">CASH COLLECTION</th>
              <th>ACTION</th>
              <!-- <th>UPDATE STATUS</th> -->
              <!-- <th>EDIT</th> -->
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
