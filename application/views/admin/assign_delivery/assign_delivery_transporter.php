<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart('admin/assign_deliveryperson/assign_delivery', array("id" => "financialreport-form", "method" => "post","enctype" => "multipart/form-data")); ?>
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                  <div class="form-group col-md-3">
                    <label class="control-label mb-10 text-left" style="margin-top: 5px;">District</label>
                    <select id="district" name="district" class="form-control select2 district-cls" required>
                        <option value="">Select district</option>
                        <?php foreach ($district as $k => $v) { ?>
                        <option <?php if(!empty($showe) && $show['district'] == $v['id']) { ?>selected <?php } ?>  value="<?php echo $v['id']; ?>"><?php echo $v['district_name']; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="control-label mb-10 text-left" style="margin-top: 5px;"> Zip code <span class="help"></span></label>
                    <!-- <input type="text" id="police_station" required="" name="police_station" value="<?php echo (isset($row)) ? $row["police_station"] : ""; ?>" class="form-control" placeholder="Zip code" autocomplete="off"> -->
                    <select id="police_station" name="police_station[]" class="form-control select2 station-cls" multiple required>
                      <option value="">Select district first</option>

                    </select>
                  </div>

                    <div class="form-group col-md-3" style="margin-top: 30px;">
                    <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Search</button>
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

                <div class="pull-right">
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">

                          <form id="creatassignDPerson-form" action="<?php echo base_url('admin/assign_deliveryperson/createsave_multiple_delivery'); ?>" method="post">
                            <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left">Consignment ID's <span class="help"></span></label>
                                <input type="text" id="consignment_id"  name="consignment_id"  class="form-control" value="" required>
                            </div>
                            <?php
                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
                            ?>
                            <div class="form-group col-md-3">
                              <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                              <select id="selected_branch" required name="selected_branch" class="form-control select2 office_class" >
                                  <option value="">Select Office</option>
                                  <?php foreach ($branch as $k => $v) { ?>
                                  <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                            <?php
                          }else{
                            ?>
                            <input type="hidden" id="selected_branch" name="selected_branch" value="<?php if(isset($_SESSION['branch']) && $_SESSION['branch'] != '') echo $_SESSION['branch']; ?>">
                            <?php
                          }
                          ?>
                            <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left"> Transporter<span class="help"></span></label>
                                <select id="delivery_person" required name="delivery_person" class="form-control select2" >
                                  <option value="">Select Office First</option>

                                </select>

                            </div>
                            <div class="form-group col-md-3" style="margin-top: 30px;">
                              <!-- <button id="btnAll" type="button" class="btn btn-info btn-rounded">CALCULATE</button> -->
                            <button style="float:right;" type="submit" class="btn btn-info btn-rounded">Assign</button>
                                <!-- <button type="button" class="btn btn-default  btn-rounded button-back">Cancel</button> -->
                            </div>
                            </form>

                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Consignment ID</th>
                                        <th>Order Date</th>
                                        <th>Details</th>
                                        <th>Zip code</th>
                                        <th>Office</th>
                                        <th>Transporter</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(isset($row)){
                                    foreach ($row as $k => $v) {
                                      if($v->status != "inactive"){
                                        ?>
                                        <tr data-id="<?php echo $v->id ?>">
                                          <td><?php echo $v->consignment_id ?></td>
                                          <td><?php $dt = new DateTime($v->timestamp);echo $dt->format('d, M Y h:i a'); ?></td>
                                            <td>Merchant Details: <?php echo $v->cus_company ?>,<?php echo $v->cus_name ?>,<?php echo $v->cus_contact ?>,<?php echo $v->product_id ?><br>
                                            Shipping Details: <?php echo $v->recipient_name ?>,<?php echo $v->recipient_address ?>,<?php echo $v->recipient_number ?></td>
                                            <?php $ps_info = $this->assign_deliveryperson_model->get_where_all('police_station', ['id' => $v->del_police_station]); ?>
                                            <?php if(!empty($ps_info)){?>
                                            <td><?php echo $ps_info[0]['station_name'] ?></td>
                                            <?php }else{ ?>
                                              <td>N/A</td>
                                              <?php
                                            }
                                            ?>
                                            <?php $merch_info = $this->assign_deliveryperson_model->get_where_all('branch', ['id' => $v->created_by]); ?>
                                            <?php if(!empty($merch_info)){?>
                                            <td><?php echo $merch_info[0]['name'] ?></td>
                                          <?php } else { ?>
                                            <td>Head Office</td>
                                            <?php
                                          } ?>
                                            <?php if($v->delivery_status == 'pending' || $v->delivery_status == 'reschedule'){ $trans = "In-House";}else{$trans_check = $this->assign_deliveryperson_model->get_transporter($v->id); $trans = $trans_check[0]['transporter'];} ?>
                                            <td> <?php echo $trans?></td>
                                        </tr>


                                        <?php
                                    }
                                  }
                                }
                                    ?>


                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="sel_branch" name="sel_branch" value="<?php if(isset($_SESSION['branch']) && $_SESSION['branch'] != '') echo $_SESSION['branch']; ?>">
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script>
var ofyc = $('#sel_branch').val();
if(ofyc != ""){
  getAjaxtransporter(ofyc);
}

document.addEventListener("DOMContentLoaded", function () {
$("#district").select2().on('change', function(e) {
    var dist = $(".district-cls option:selected").val();
    // console.log(dist);
    getAjaxPstation(dist);
    // getAjaxConsignment(dist);
  });

});

function getAjaxPstation(dist){

  var dist = $("#district").val();

  $.ajax({
           url: '<?php echo base_url('admin/transfer/getPstation'); ?>',
           type: "POST",
           data: {dist: dist},
           success: function (res)
       {
      // console.log(res);
       var jdata= res;
         var station=$('#police_station');
           station.empty();
           Object.keys(jdata).forEach(function(k){
               station.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].station_name));
           });
           station.val(policeStation);
       }


       });

}

$(document).ready(function() {

  $('#datable_1').DataTable( {
      dom: 'Bfrtip',
      buttons: [
        'pageLength'
      ],
      "order": [[ 1, "desc" ]]
  } );

  var oTable = $('#datable_1').DataTable();

$('#datable_1 tbody').on( 'click', 'tr', function () {
    $(this).toggleClass('selected');
    var pos = oTable.row(this).index();
    // var row = oTable.row(pos).data();
    var conid = oTable.cell( pos, 0 ).data();
    // var amount = oTable.cell( pos, 9 ).data();
    console.log(conid);
    get_cons();
} );


function get_cons(){
     var Allconid =[];
     // var Allamountsum = 0;
 $('#datable_1 tbody tr.selected').each(function(){
      var pos = oTable.row(this).index();
    // var row = oTable.row(pos).data();
    // var rowData = oTable.rows( { selected: true } ).data()[0];
    // var rowIdx = oTable.row( {selected: true } ).index();
var conid = oTable.cell( pos, 0 ).data();
// var amount = oTable.cell( pos, 9 ).data();
    // console.log(row);
    Allconid.push(conid);
    // Allamountsum  = Allamountsum + parseInt(amount,10);
 });
    // console.log(oAll);
    // alert(oAll);
    $("#consignment_id").val(Allconid);
    // $("#amounttopay").val(Allamountsum);
};
    // $('#datable_1').DataTable( {
    //     dom: 'Bfrtip',
    //     buttons: [
    //       'excel',
    //      {
    //      extend: 'pdfHtml5',
    //      orientation: 'landscape',
    //      pageSize: 'LEGAL'
    //      }
    //     ]
    // } );

    $(".select2").select2();

    $('#from_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });
    $('#to_date').datetimepicker({
        format: 'd-m-Y',
        mask: '39-19-9999',
        timepicker: false
    });

    $("#selected_branch").select2().on('change', function(e) {
        var ofc = $(".office_class option:selected").val();
        console.log(ofc);
        getAjaxtransporter(ofc);
      });
} );


function getAjaxtransporter(ofc){
  var ofc = $("#selected_branch").val();
  var transporters=$('#delivery_person');
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
           transporters.append($("<option></option>").attr("value", '').text('Select Transporter'));
           Object.keys(jdata).forEach(function(k){
               transporters.append($("<option></option>").attr("value", jdata[k].id).text(jdata[k].name));
           });
           transporters.val();
       }


       });

}
</script>
