<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark"><strong><?php echo $title; ?></strong></h5>
    </div>
    <!-- Breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <?php
            foreach ($nav as $k => $v) {
                if ($k == 'blank') {
                    ?>
                    <li class="active"><span><?php echo $v; ?></span></li>

                    <?php
                } else {
                    ?>
                    <?php
      if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'customer'){
       ?>
                    <li><a href="<?php echo base_url('merchant/'.$k); ?>"><?php echo $v; ?></a></li>
                    <?php
                  }else{?>
                    <li><a href="<?php echo base_url('admin/'.$k); ?>"><?php echo $v; ?></a></li>
                    <?php
                  }
                  ?>
                    <?php
                }
            }
            ?>
        </ol>
    </div>
    <!-- /Breadcrumb -->
</div>
