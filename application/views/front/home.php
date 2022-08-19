<!-- Banner -->
<section class="banner mask-overlay pad-120 white-clr">
                    <div class="container theme-container rel-div">
                        <img class="pt-10 effect animated fadeInLeft" alt="" src="<?php echo base_url(); ?>asset/new/img/icons/icon-1.png" />
                        <ul class="list-items fw-600 effect animated wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                            <li><a href="#">fastest</a></li>
                            <li><a href="#">secured</a></li>
                            <li><a href="#">worldwide</a></li>
                        </ul>
                        <h2 class="section-title fs-48 effect animated wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> Partner with <span class="theme-clr"> Speedy </span> <span style="color: #eb5c58;">Porter</span> </h2>
                    </div>
                    <div class="pad-50 visible-lg"></div>
                </section>
                <!-- /.Banner -->


                <!-- Track Product -->
                <section>
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 track-prod clrbg-before wow slideInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <h2 class="title-1"> track your product </h2> <span class="font2-light fs-12">Now you can track your product easily</span>
                                <div class="row">
                                    <form class="">
                                        <div class="col-md-7 col-sm-7">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter your product ID" required="" class="form-control box-shadow">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <button class="btn-1">track your product</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Track Product -->


                 <!-- About Us -->
                 <section class="pad-80 about-wrap clrbg-before" style="padding-bottom: 0;">
                    <span class="bg-text wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> About </span>
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="about-us">
                                    <h2 class="section-title pb-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> About Us </h2>
                                    <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                                        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci
                                        tation ullamcorper suscipit lobortis nisl ut aliquip.</p>
                                    <ul class="feature">
                                        <li>
                                            <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/icon-2.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                            <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s">
                                                <h2 class="title-1">Fast delivery</h2>
                                                <p>Duis autem vel eum iriure dolor</p>
                                            </div>
                                        </li>
                                        <li>
                                            <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/icon-3.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                            <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s">
                                                <h2 class="title-1">secured service</h2>
                                                <p>Duis autem vel eum iriure dolor in hendrerit</p>
                                            </div>
                                        </li>
                                        <li>
                                            <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/icon-4.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" />
                                            <div class="feature-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s">
                                                <h2 class="title-1">worldwide shipping</h2>
                                                <p>Eum iriure dolor in hendrerit in vulputa</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="pb-80 visible-lg"></div>
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/block/about.png" class="wow slideInRight abt-img" data-wow-offset="50" data-wow-delay=".20s" />
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.About Us -->

                <!-- Calculate Your Cost -->
                <section class="calculate pt-100">
                    <div class="theme-container container">
                        <span class="bg-text right wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> calculate </span>
                        <div class="row">
                            <div class="col-md-6 col-md-push-6">
                                <div class="pad-10"></div>
                                <h2 class="section-title pb-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" > calculate your cost </h2>
                                <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">Lorem ipsum dolor sit amet, consectetuer adipiscing elit nonummy nibh
                                    euismod tincidunt ut laoreet.</p>
                                <div class="calculate-form">
                                    <form class="row">
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                            <div class="col-lg-3 col-md-4"> <label class="title-2"> height (cm): </label></div>
                                            <div class="col-lg-9 col-md-8">
                                              <!-- <input onkeyup="getprice();" id="height" data-bind="in:value, f: float" data-name="height" type="number" placeholder="" class="form-control">  -->
                                            <select onchange="getwidth(this.value);" id="height" name="height" class="form-control select2 district-cls" required>
                                                <option value="">Select Height</option>
                                                <?php foreach ($height as $k => $v) { ?>
                                                <option <?php if(!empty($row) && $row['height'] == $v['height']) { ?>selected <?php } ?>  value="<?php echo $v['height']; ?>"><?php echo $v['height']; ?></option>
                                                <?php } ?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                            <div class="col-lg-3 col-md-4"> <label class="title-2"> width (cm): </label></div>
                                            <div class="col-lg-9 col-md-8">
                                              <!-- <input onkeydown="getprice();" id="width" data-bind="in:value, f: float" data-name="width" type="number" placeholder="" class="form-control"> -->
                                              <select onchange="getprice();" id="width" name="width" class="form-control select2" required>
                                              <option value="">Select Height First</option>

                                            </select>
                                             </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                            <div class="col-lg-3 col-md-4"> <label class="title-2"> weight (kg): </label></div>
                                            <div class="col-lg-9 col-md-8"> <input onkeyup="getprice();" id="weight" data-bind="in:value, f: float" data-name="weight" type="number" placeholder="" class="form-control"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                            <div class="col-lg-3 col-md-4"> <label class="title-2"> location: </label></div>
                                            <div class="col-lg-9 col-md-8">
                                                <div class="col-sm-6 no-pad">
                                                    <!-- <input onchange="getprice();" id="from" type="number" data-bind="in:value" data-name="locations[from]" placeholder="From Pincode" class="form-control from fw-600"> -->
                                                    <select onchange="getprice();" id="from" name="from" class="form-control select2 district-cls" required>
                                                        <option value="">From Pincode</option>
                                                        <?php foreach ($pincodes as $k => $v) { ?>
                                                        <option <?php if(!empty($row) && $row['station_name'] == $v['station_name']) { ?>selected <?php } ?>  value="<?php echo $v['station_name']; ?>"><?php echo $v['station_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6 no-pad">
                                                    <!-- <input onchange="getprice();" id="to" type="number" data-bind="in:value" data-name="locations[to]" placeholder="To Pincode" class="form-control to fw-600"> -->
                                                    <select onchange="getprice();" id="to" name="to" class="form-control select2 district-cls" required>
                                                        <option value="">To Pincode</option>
                                                        <?php foreach ($pincodes as $k => $v) { ?>
                                                        <option <?php if(!empty($row) && $row['station_name'] == $v['station_name']) { ?>selected <?php } ?>  value="<?php echo $v['station_name']; ?>"><?php echo $v['station_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                            <div class="col-sm-9 col-xs-12 pull-right">
                                                <div class="btn-1"> <span> Total Cost: </span>
                                                    <span data-bind="out:price, f:currency" data-name="cost" class="btn-1 dark">
                                                        <span class="pr-sign">&nbsp;</span> ₹ <span class="pr-wrap" style="display: none;"><span class="pr" id="pr">0</span></span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <div class="col-md-6 col-md-pull-6 text-center">
                                <img src="<?php echo base_url(); ?>asset/new/img/block/Courier-Man.png" alt="" class="wow slideInLeft cost-img" data-wow-offset="50" data-wow-delay=".20s" />
                            </div>
                        </div>
                    </div>
                </section>


                <section class="steps-wrap pad-80" style="padding-bottom: 0">
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-lg-7 col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="section-title wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;"> Get more with <span class="theme-clr"> Our Application </span></h2>
                                        <p class="fs-16 wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s" style="visibility: visible;color: #7d7d7d; animation-delay: 0.25s; animation-name: fadeInUp;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam
                                        nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci
                                        </p>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="font-2 fs-40 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> 1. </div>
                                        <div class="steps-content wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">
                                            <h2 class="title-3">Order</h2>
                                            <p class="gray-clr" style="margin-bottom: 0;">Duis autem vel eum iriur <br> hendrerit in vulputate</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="font-2 fs-40 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> 2. </div>
                                        <div class="steps-content wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">
                                            <h2 class="title-3">Wait</h2>
                                            <p class="gray-clr" style="margin-bottom: 0;">Duis autem vel eum iriur <br> hendrerit in vulputate</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="font-2 fs-40 wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> 3. </div>
                                        <div class="steps-content wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">
                                            <h2 class="title-3">Deliver</h2>
                                            <p class="gray-clr" style="margin-bottom: 0;">Duis autem vel eum iriur <br> hendrerit in vulputate</p>
                                        </div>
                                    </div>
                                    <img src="<?php echo base_url(); ?>asset/new/img/block/play-store.png" style="width: 200px;margin-top: 15px;">
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-6">
                            <img src="<?php echo base_url(); ?>asset/new/img/block/app.png" style="max-width: 90%;">
                        </div>
                        </div>
                    </div>

                </section>
                <!-- /.Steps -->


                <!-- Provides -->
                <section class="prod-delivery pad-120">
                    <div class="theme-container container">
                        <span class="bg-text center wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible;top: 13%; animation-delay: 0.2s; animation-name: fadeInUp;"> Services </span>
                                    <div class="title-wrap text-center  pb-50">
                                        <h2 class="section-title wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;"><span class="theme-clr">Speedy </span> <span style="color: #eb5c58">Porter</span> Provides </h2>
                                        <p class="wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInLeft;">Services we provide our customer</p>
                                    </div>
                        <div class="row service">
                            <div class="col-sm-4 mb-30">
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/delivery.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="service-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: rotateInDownRight;">
                                    <h2 class="title-1">Reverse Delivery</h2>
                                    <p>Duis autem vel eum iriure dolor in hendrerit. Duis autem vel eum iriure dolor in hendrerit</p>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-30">
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/various.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="service-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: rotateInDownRight;">
                                    <h2 class="title-1">Delivery Option</h2>
                                    <p>Duis autem vel eum iriure dolor in hendrerit. Duis autem vel eum iriure dolor in hendrerit</p>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-30">
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/cod.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="service-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: rotateInDownRight;">
                                    <h2 class="title-1">Best COD Rates</h2>
                                    <p>Duis autem vel eum iriure dolor in hendrerit. Duis autem vel eum iriure dolor in hendrerit</p>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-30">
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/track.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="service-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".40s" style="visibility: visible; animation-delay: 0.3s; animation-name: rotateInDownRight;">
                                    <h2 class="title-1">Live Tracking</h2>
                                    <p>Eum iriure dolor in hendrerit in vulputa. Eum iriure dolor in hendrerit in vulputa</p>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-30">
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/pickup.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="service-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".50s" style="visibility: visible; animation-delay: 0.3s; animation-name: rotateInDownRight;">
                                    <h2 class="title-1">Flexible Pickup</h2>
                                    <p>Eum iriure dolor in hendrerit in vulputa. Eum iriure dolor in hendrerit in vulputa</p>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-30">
                                <img alt="" src="<?php echo base_url(); ?>asset/new/img/icons/pay.png" class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <div class="service-content wow rotateInDownRight" data-wow-offset="50" data-wow-delay=".60s" style="visibility: visible; animation-delay: 0.3s; animation-name: rotateInDownRight;">
                                    <h2 class="title-1">Easy Payment</h2>
                                    <p>Eum iriure dolor in hendrerit in vulputa. Eum iriure dolor in hendrerit in vulputa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Product Delivery -->



                <!-- Testimonial -->
                <section class="testimonial mask-overlay">
                    <div class="theme-container container">
                        <div class="testimonial-slider no-pagination pad-120">
                            <div class="item">
                                <div class="testimonial-img darkclr-border theme-clr font-2 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">
                                    <img alt="" src="<?php echo base_url(); ?>asset/new/img/block/testimonial-1.png" />
                                    <span>,,</span>
                                </div>
                                <div class="testimonial-content">
                                    <p class="wow fadeInUp" data-wow-offset="50" data-wow-delay=".25s">  <i class="gray-clr fs-16">
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                            <br> facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                                            <br> augue duis dolore te feugait nulla facilisi.
                                        </i> </p>
                                    <h2 class="title-2 pt-10 wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> <a href="#" class="white-clr fw-900"> Bushra Ahsani </a> </h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-img darkclr-border theme-clr font-2">
                                    <img alt="" src="<?php echo base_url(); ?>asset/new/img/block/testimonial-1.png" />
                                    <span>,,</span>
                                </div>
                                <div class="testimonial-content">
                                    <p>  <i class="gray-clr fs-16">
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                            <br> facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                                            <br> augue duis dolore te feugait nulla facilisi.
                                        </i> </p>
                                    <h2 class="title-2 pt-10"> <a href="#" class="white-clr fw-900"> Bushra Ahsani </a> </h2>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimonial-img darkclr-border theme-clr font-2">
                                    <img alt="" src="<?php echo base_url(); ?>asset/new/img/block/testimonial-1.png" />
                                    <span>,,</span>
                                </div>
                                <div class="testimonial-content">
                                    <p>  <i class="gray-clr fs-16">
                                            Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                            <br> facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit
                                            <br> augue duis dolore te feugait nulla facilisi.
                                        </i> </p>
                                    <h2 class="title-2 pt-10"> <a href="#" class="white-clr fw-900"> Bushra Ahsani </a> </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Testimonial -->


                <!-- Pricing & Plans -->
                <section class="pricing-wrap pt-120">
                    <div class="theme-container container">
                        <span class="bg-text center wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s"> Pricing </span>
                        <div class="title-wrap text-center  pb-50">
                            <h2 class="section-title wow fadeInUp" data-wow-offset="50" data-wow-delay=".20s">Pricing & plans</h2>
                            <p class="wow fadeInLeft" data-wow-offset="50" data-wow-delay=".25s">See our pricing & plans to get best service</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50" data-wow-delay=".20s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <h2 class="section-title fs-36">$50</h2>
                                        <p>for single product</p>
                                        <div class="btn-1">basic</div>
                                    </div>
                                    <div class="price-content">
                                        <ul class="title-2">
                                            <li> Product Weight: <span class="gray-clr"> &LT; 3kg</span> </li>
                                            <li> Country: <span class="gray-clr">  all</span> </li>
                                            <li> duration: <span class="gray-clr">7-14 days</span> </li>
                                            <li> support: <span class="gray-clr">yes</span> </li>
                                        </ul>
                                    </div>
                                    <div class="order">
                                        <a href="#" class="title-1 theme-clr"> <span class="transition"> order now </span> <i class="arrow_right fs-26"></i> </a>
                                    </div>
                                    <div class="pricing-hover clrbg-before clrbg-after transition"></div>
                                </div>
                            </div>
                            <div class="col-md-4 active white-clr wow slideInUp" data-wow-offset="50" data-wow-delay=".25s">
                                <div class="pricing-box theme-clr-bg">
                                    <div class="title-wrap text-center">
                                        <h2 class="section-title fs-36">$250</h2>
                                        <p>for package product</p>
                                        <div class="btn-1 dark">Premium</div>
                                    </div>
                                    <div class="price-content">
                                        <ul class="title-2">
                                            <li> Product Weight: <span class="white-clr">&LT; 3kg</span> </li>
                                            <li> Country: <span class="white-clr">  all</span> </li>
                                            <li> duration: <span class="white-clr">7-14 days</span> </li>
                                            <li> support: <span class="white-clr">yes</span> </li>
                                        </ul>
                                    </div>
                                    <div class="order">
                                        <a href="#" class="title-1 white-clr"> <span class="transition"> order now </span> <i class="arrow_right fs-26"></i> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 wow slideInUp" data-wow-offset="50" data-wow-delay=".30s">
                                <div class="pricing-box clrbg-before clrbg-after transition">
                                    <div class="title-wrap text-center">
                                        <h2 class="section-title fs-36">$150</h2>
                                        <p>for multiple product</p>
                                        <div class="btn-1">standard</div>
                                    </div>
                                    <div class="price-content">
                                        <ul class="title-2">
                                            <li> Product Weight: <span class="gray-clr">&LT; 3kg</span> </li>
                                            <li> Country: <span class="gray-clr">  all</span> </li>
                                            <li> duration: <span class="gray-clr">7-14 days</span> </li>
                                            <li> support: <span class="gray-clr">yes</span> </li>
                                        </ul>
                                    </div>
                                    <div class="order">
                                        <a href="#" class="title-1 theme-clr"> <span class="transition"> order now </span> <i class="arrow_right fs-26"></i> </a>
                                    </div>
                                    <div class="pricing-hover clrbg-before clrbg-after transition"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Pricing & Plans -->

                 <!-- Contact us -->
                 <section class="contact-wrap pad-120">
                    <span class="bg-text wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s"> Contact </span>
                    <div class="theme-container container">
                        <div class="row">
                            <div class="col-md-6 col-sm-8">
                                <div class="title-wrap">
                                    <h2 class="section-title wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s">contact us</h2>
                                    <p class="wow fadeInLeft" data-wow-offset="50" data-wow-delay=".20s" >Get in touch with us easiky</p>
                                </div>
                                <ul class="contact-detail title-2">
                                    <li class="wow slideInUp" data-wow-offset="50" data-wow-delay=".20s"> <span>uk numbers:</span> <p class="gray-clr"> +001-2463-957 <br> +001-4356-643 </p> </li>
                                    <li class="wow slideInUp" data-wow-offset="50" data-wow-delay=".25s"> <span>usa numbers:</span> <p class="gray-clr"> +001-2463-957 <br> +001-4356-643 </p> </li>
                                    <li class="wow slideInUp" data-wow-offset="50" data-wow-delay=".30s"> <span>Email address:</span> <p class="gray-clr"> support@go.com <br> info@go.com </p> </li>
                                </ul>
                            </div>
                            <div class="col-md-5 col-sm-6 col-md-offset-1 contact-form">
                                <div class="calculate-form">
                                    <form class="row" id="contact-form">
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                            <div class="col-sm-3"> <label class="title-2"> Name: </label></div>
                                            <div class="col-sm-9"> <input type="text" name="Name" id="Name" required="" placeholder="" class="form-control bg-light"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                            <div class="col-sm-3"> <label class="title-2"> Email: </label></div>
                                            <div class="col-sm-9"> <input type="email" name="Email" id="Email" required="" pattern="" placeholder="" class="form-control bg-light"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                            <div class="col-sm-3"> <label class="title-2"> Phone: </label></div>
                                            <div class="col-sm-9"> <input type="text" name="Phone" id="Phone" placeholder="" class="form-control bg-light"> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                            <div class="col-sm-3"> <label class="title-2"> Message: </label></div>
                                            <div class="col-sm-9"> <textarea class="form-control bg-light" name="Message" id="Message" required="" cols="25" rows="3"></textarea> </div>
                                        </div>
                                        <div class="form-group wow fadeInUp" data-wow-offset="50" data-wow-delay=".30s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                                            <div class="col-sm-9 col-xs-12 pull-right">
                                                <button name="submit" id="submit_btn" class="btn-1"> send message </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /.Contact us -->s

  <script>
  function getwidth(height){
    // console.log(height);
  $.ajax({
           url: '<?php echo base_url('home/getwidth'); ?>',
           type: "POST",
           data: {height: height},
           success: function (res)
       {
      console.log(res);
       var jdata= res;
         var width=$('#width');
           width.empty();
           width.append($("<option></option>").attr("value", '0').text('Select width'));
           Object.keys(jdata).forEach(function(k){
               width.append($("<option></option>").attr("value", jdata[k].price).text(jdata[k].width));
           });
           width.val();
       }


       });
  }
  </script>
  <script>
  function getprice(){
    var dimension_price= $('#width').val();
    var wt= $('#weight').val();
    var from_zip= $('#from').val();
    var to_zip= $('#to').val();

    var bs_distance = 5;
    var bs_weight = 2;
    var got_dis = 0;
    var extraChargeforWeight = 0;
    var extraChargefordistance = 0;
    var got_dis = 0;

      //Find the distance
      // $.getJSON("https://maps.googleapis.com/maps/api/distancematrix/xml?origins=828109&destinations=700102&key=AIzaSyAm1_xprk0gyEsK7yJAZEqQEeQdKCxM0gc&callback=?", function(data) {
          // data = JSON.parse(data);
          // console.log(data);
          if(from_zip != " " && to_zip!= ""){
           got_dis = 50
        }
      // });
      console.log(got_dis);
      $.ajax({
               url: '<?php echo base_url('home/getpackage'); ?>',
               // type: "POST",
               // data: {height: height},
               success: function (res)
           {

            if(wt>0 && parseFloat(wt) > parseFloat(bs_weight)){
              var extra_wt = parseFloat(wt)-parseFloat(bs_weight);
              extraChargeforWeight = extra_wt*res[0].metro_extra_chrg;
            }
            console.log(extraChargeforWeight);
            if(got_dis>0 && parseFloat(got_dis) > parseFloat(bs_distance)){
              var extra_dis = parseFloat(got_dis)-parseFloat(bs_distance);
              extraChargefordistance = extra_dis*res[0].metro_dis_extra_chrg;
            }

            var totalCharge = parseFloat(res[0].metro_dc)+parseFloat(0)+parseFloat(extraChargeforWeight)+parseFloat(extraChargefordistance)+parseFloat(dimension_price);
            console.log('T_charge = '+totalCharge);
            document.getElementById("pr").innerHTML = totalCharge;
           }


           });

  }
  </script>
