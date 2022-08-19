<!-- Section Start - Tracking App -->
    <section class='bg-lightgray' id='tracking-app-mobile'>
        <div class="container">
            <div class="row">
                <h1 class="heading">Tracking App</h1>
                <div class="headul"></div>
                <p class="subheading">Lorem ipsum dolor sit amet, consectetuer adipiscing elit enean commodo eget dolor aenean massa eget dolor aenean massa</p>
                <div class="features-wrap">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 tracking_leftside" id="tracking_leftside">
                      <div class="row">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="app-phones  app_phn">

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 tracking_rightside" id="tracking_rightside">
                      <div class="row">
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Tracking App -->
    <!-- Section Start - Track Your Order -->
    <section class='track_order parallax ' id='track_order'>
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="track-order">
                    <div class="track-logo transition">
                        <i class="icon icon-logo"></i>
                    </div>
                    <h1 class="heading">Track Your Order</h1>
                    <p class="subheading">ENTER YOUR TRACK ID FOR INSTANT SEARCH</p>
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                        <form method='post' action="<?php echo base_url('home/track_order')?>" class="track-form">
                            <input type="text" name='track-input' placeholder="Track ID" required>
                            <button style="display:contents;" type='submit' class='btnSave'><i class="icon icon-magnify"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section End - Track Your Order -->
    <script src="<?php echo base_url(); ?>/asset/frontend/tracking.js"></script>
