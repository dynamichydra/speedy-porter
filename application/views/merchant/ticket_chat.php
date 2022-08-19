<div class="container">
    <div class="row">
        <!-- <div class="col-md-6 col-md-offset-3"> -->
            <br><br><br>
                <?= $this->session->flashdata('done'); ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                      Ticket No :- <?php echo $ticket_no;?>
                    </div>

                    <div class="panel-body" style="height: 400px; overflow-y: scroll; background-color: black;">
                    <?php foreach ($chat as $c){ ?>
                        <?php if($c['sender'] == $this->session->userdata('name')){ ?>
                            <div class="col-md-12">
                                <div class="panel panel-success panel-comment pull-right">
                                    <div class="panel-heading" >
                                        <strong style="opacity: .6; font-size: 12px; color: #ff3300">ME : &nbsp;&nbsp;&nbsp;</strong>
                                        <small><?php echo date("d-M-Y H:i:s", strtotime($c['time'])); ?></small><br/>
                                        <?= $c['text'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="col-md-12">
                                <div class="panel panel-warning panel-comment pull-left">
                                    <div class="panel-heading" >
                                        <strong style="opacity: .6; font-size: 12px; color: #ff3300"><?= $c['sender'] ?>:</strong>
                                        <small><?php echo date("d-M-Y H:i:s", strtotime($c['time'])); ?></small><br/>
                                        <?= $c['text'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    </div>

                </div>
                    <div class="row">
                        <div class="col-md-12 ">
                            <form method="post" action="<?php echo base_url('admin/tickets/send')?>">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input type="text" name="message" class="form-control" placeholder="Send Message">
                                        <input type="hidden" name="ticketid" class="form-control" placeholder="Send Message" value="<?php echo $ticket_id;?>">
                                        <input type="hidden" name="ticketno" class="form-control" placeholder="Send Message" value="<?php echo $ticket_no;?>">
                                        <span class="input-group-btn">
                                            <input class="btn btn-success" type="submit" value="Send">
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
        <!-- </div> -->
    </div>
</div>
