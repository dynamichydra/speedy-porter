

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

                          <form id="creatassignDPerson-form" action="<?php echo base_url('admin/assign_deliveryperson/createsave_multiple'); ?>" method="post">
                            <div class="form-group col-md-3">
                                <label class="control-label mb-10 text-left">Consignment ID's <span class="help"></span></label>
                                <input type="text" id="consignment_id" required name="consignment_id"  class="form-control" value="">
                            </div>
                            <?php
                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] != 'branch'){
                            ?>
                            <div class="form-group col-md-3" style="display:none;">
                              <label class="control-label mb-10 text-left">Office<span class="help"></span></label>
                              <select id="selected_branch" name="selected_branch" required class="form-control select2 office_class" >
                                  <option value="11">Select Office</option>
                                  <?php foreach ($branch as $k => $v) { ?>
                                  <option   value="<?php echo $v['id']; ?>" <?php echo ((isset($src['office_id']) && $v['id'] == $src['office_id'])?'selected':'');?>><?php echo $v['name']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                            <?php
                          }else{
                            ?>
                            <input type="hidden" value="<?php if(isset($_SESSION['branch']) && $_SESSION['branch'] != '') echo $_SESSION['branch']; ?>">
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
                                        <th>Customer Details</th>
                                        <th>Office</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($row as $k => $v) {
                                      if($v->status != "inactive"){
                                        ?>
                                        <tr data-id="<?php echo $v->id ?>">
                                          <td><?php echo $v->consignment_id ?></td>
                                          <td><?php $dt = new DateTime($v->timestamp);echo $dt->format('d, M Y h:i a'); ?></td>
                                            <td><?php echo $v->cus_company ?><br><?php echo $v->cus_address ?></td>
                                            <td><?php echo $v->office ?></td>
                                        </tr>


                                        <?php
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
$(document).ready(function() {

    var ofyc = $('#sel_branch').val();
    console.log(ofyc);
    if(ofyc != ""){
      getAjaxtransporter(ofyc);
    }

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
  console.log(ofc);
  if(ofc == ""){
  var ofc = $("#selected_branch").val();
}
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
