<?php error_reporting(0);?>
<style>
.dataTables_filter, .dataTables_info { display: none; }
</style>

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
                            <h3>Under Maintenance, we will be back soon, sorry for the inconvinience caused!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<!-- <script>
$(document).ready(function() {
    $('#datable_21').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
    } );
} );
</script> -->


<!-- <script type="text/javascript">
        $(function () {
            // customer registration form submit
            $('#paymentUpdate-form').submit(function (e) {
                e.preventDefault();

                $('button#btnSave').text('updating...');

                var url = $(this).attr('action');
                var postData = $(this).serialize();
                $.post(url, postData, function (o) {
                    $("html, body").animate({scrollTop: 0}, 500);
                    if (o.msg_succ) {
                        $('#div_succ').show();
                        $('#div_succ').html(o.msg_succ);
                        setTimeout(function () {
                            $('#div_succ').hide();
                            window.location.reload();
                        }, 500);
                    } else {
                        $('#div_err').show();
                        $('#div_err').html(o.msg_err);
                        setTimeout(function () {
                            $('#div_err').hide();
                        }, 2000);
                    }

                    $('button#btnSave').text('update');
                }, 'json');
            });
        })
</script> -->
<!-- <script>
$(document).ready(function() {
    $('#modalbtn').click(function() {
        $('#myModal').modal('show');
    });
});
</script> -->
