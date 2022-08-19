<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">

                <div class="pull-right">
                  <!-- <?php
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin'){
     ?>
                    <a class="btn  btn-primary" href="<?php echo base_url('admin/consignment/create'); ?>">Add new Consignment</a>
                  <?php }else if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){ ?> -->
                    <!-- <a class="btn  btn-primary" href="<?php echo base_url('merchant/ticket/raise_a_ticket'); ?>">Raise new Ticket</a> -->
                    <!-- <?php
                  }
                  ?> -->



                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30" >
                                <thead>
                                    <tr>
                                        <th>Ticket No</th>
                                        <?php
                          if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer_care'){
                           ?>
                                        <th>Company</th>
                           <?php
                         }
                         ?>
                                        <th>Consignment No</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $x = 0;
                                    foreach ($row as $k => $v) {
                                      $x++;
                                        ?>
                                        <tr data-id="<?php echo $v['id'];?>">
                                            <td><?php echo $v['ticket_no'] ?></td>
                                            <?php
                                            if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'staff' || isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer_care'){
                                             ?>
                                                          <td><?php echo $v['company'] ?></td>
                                             <?php
                                           }
                                           ?>
                                            <td><?php echo $v['consignment']; ?></td>
                                            <td><?php echo $v['subject'];  ?></td>
                                            <td><?php echo date( "d, M Y", strtotime($v['date_open']));  ?> </td>
                                            <!-- <td><?php echo $v['status'];  ?></td> -->
                                            <?php if($v['status'] == "open") {?>
                                            <td style="color:red;"><?php echo ucfirst($v['status']) ?></td>
                                          <?php }else if($v['status'] == "declined"){ ?>
                                            <td style="color:orange;"><?php echo ucfirst($v['status']) ?></td>
                                          <?php }else if($v['status'] == "on review"){ ?>
                                            <td style="color:yellow;"><?php echo ucfirst($v['status']) ?></td>
                                            <?php
                                          }else{
                                          ?>
                                          <td><p style="color:green;"><?php echo ucfirst($v['status']); ?></p> Date : <?php echo date( "d/m/Y", strtotime($v['date_close']));  ?> </td>
                                          <?php
                                        }
                                        ?>
                                        <td><?php if(!empty($v['comment'])){ echo ucfirst($v['comment']); ?> <?php }else{ echo "N/A";} ?></td>

                                        </tr>

                                        <div id="myModal<?php echo $v["id"]; ?>" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Update Ticket Status</h4>
                                                <div class="row text-center alert alert-danger" id="div_err" style="display:none;"></div>
                                                <div class="row text-center alert alert-success" id="div_succ" style="display:none;"></div>
                                              </div>
                                              <div class="modal-body">

                                                <?php echo form_open_multipart('admin/tickets/updateStatus', array("id" => "statusUpdate-form".$v["id"], "method" => "post","enctype" => "multipart/form-data")); ?>
                                                <div class="panel panel-default card-view">
                                                    <div class="panel-wrapper collapse in">
                                                        <div class="panel-body">
                                                          <div class="form-group">
                                                              <label class="control-label mb-10 text-left">Message: <?php echo $v['description'] ?> <span class="help"></span></label>
                                                              <input type="hidden" value="<?php echo $v['id'] ?>" name="id" id="id<?php echo $x ?>" >
                                                          </div>
                                                            <div class="form-group">
                                                                <label class="control-label mb-10 text-left">status<span class="help"></span></label>
                                                                <select id="status<?php echo $x ?>" name="status" class="form-control status" data-bind="<?php echo $x ?>" onChange="dropBoxChng(<?php echo $x ?>);">
                                                                    <option value="">select Status</option>

                                                                    <option value="open" <?php if($v['status'] == 'open'){ echo "selected";}?>>open</option>
                                                                    <option value="on review" <?php if($v['status'] == 'on review'){ echo "selected";}?>>on review</option>
                                                                    <option value="close" <?php if($v['status'] == 'close'){ echo "selected";}?>>close</option>
                                                                    <option value="declined" <?php if($v['status'] == 'declined'){ echo "selected";}?>>Declined</option>
                                                                </select>
                                                            </div>

                                                            <div id="txtBox<?php echo $x ?>" class="control-label mb-10 text-left txtBox" style="display:none;">
                                                                <label class="control-label mb-10 text-left">Comment <span class="help"></span></label>
                                                                <input type="text" id="comment<?php echo $x ?>" name="comment"  class="form-control" value="">
                                                            </div>
                                                            <!-- <div class="form-group" style="margin-top: 30px;">
                                                            <button type="submit" class="btn btn-info btn-rounded">update</button>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div id="itemWrap">

                                                              </div>
 -->

                                              </div>
                                              <div class="modal-footer">
                                                <button id="btnSave<?php echo $v["id"]; ?>" type="submit" class="btn btn-info btn-rounded" >update</button>
                                                <button type="button" class="btn btn-default btn-rounded" data-dismiss="modal">Close</button>
                                              </div>
                                              <?php echo form_close(); ?>
                                            </div>

                                          </div>
                                        </div>


                                        <?php
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
<script src="<?php echo base_url('asset/admin/'); ?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#datable_1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          'excel','pageLength',
         {
         extend: 'pdfHtml5',
         orientation: 'landscape',
         pageSize: 'LEGAL'
         }
       ],
       "order": []
    } );
} );
</script>
