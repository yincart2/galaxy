<?php
/**
 * Created by Yinhe ark network technology co. LTD.
 * User: He.Yin
 * Date: 2019/4/20
 * Time: 21:45
 */
use cms\assets\AppAsset;

AppAsset::register($this);
list($path, $link) = $this->getAssetManager()->publish('@theme/cms/assets');
?>


<div class="c-layout-page">
    <!-- BEGIN: PAGE CONTENT -->
    <div id="home"></div>
    <!-- BEGIN: LAYOUT/SLIDERS/REVO-SLIDER-13-1 -->
    <section class="c-layout-revo-slider c-layout-revo-slider-13" dir="ltr">
        <div class="tp-banner-container tp-fullscreen tp-fullscreen-mobile c-arrow-darken" data-bullets-pos="center">
            <div class="tp-banner rev_slider" data-version="5.0">
                <ul>
                    <!--BEGIN: SLIDE #1 -->
                    <li data-index="rs-16" data-transition="zoomout" data-slotamount="default"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="<?= $link ?>/base/img/content/backgrounds/bg-18.jpg"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Let's use Yincart" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="<?= $link ?>/base/img/content/backgrounds/bg-18.jpg"  alt="" data-bgposition="center center" data-kenburns="on" data-duration="15000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="-500 500" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-0 c-font-white c-font-bold"
                             id="slide-16-layer-1"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                             data-fontsize="['70','70','70','45']"
                             data-lineheight="['70','70','70','50']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="1000"
                             data-splitin="chars"
                             data-splitout="none"
                             data-responsive_offset="on"

                             data-elementdelay="0.05"

                             style="z-index: 5; white-space: nowrap;">LET'S Use Yincart
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-0 c-font-white"
                             id="slide-16-layer-4"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="1500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"


                             style="z-index: 6; white-space: nowrap;">HIGHLY FLEXIBLE DEMO COMPONENTS
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption NotGeneric-Icon   tp-resizeme rs-parallaxlevel-0"
                             id="slide-16-layer-8"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['-68','-68','-68','-68']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"
                             data-style_hover="cursor:default;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="2000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"


                             style="z-index: 7; white-space: nowrap;"><i class="pe-7s-refresh"></i>
                        </div>
                    </li>
                    <!--END -->
                    <!-- BEGIN: SLIDE #2 -->
                    <li data-index="rs-17" data-transition="fadetotopfadefrombottom" data-slotamount="default"  data-easein="Power3.easeInOut" data-easeout="Power3.easeInOut" data-masterspeed="1500"  data-thumb="<?= $link ?>/base/img/content/shop4/25.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="No Hassle" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="<?= $link ?>/base/img/content/shop4/25.jpg"  alt=""  data-bgposition="center center" data-kenburns="on" data-duration="15000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 500" data-offsetend="0 -500" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-3 c-font-white c-font-bold"
                             id="slide-17-layer-1"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                             data-fontsize="['70','70','70','45']"
                             data-lineheight="['70','70','70','50']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rZ:-35deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:0px;"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="1000"
                             data-splitin="chars"
                             data-splitout="none"
                             data-responsive_offset="on"

                             data-elementdelay="0.05"

                             style="z-index: 5; white-space: nowrap;">NO HASSLE
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-2 c-font-white"
                             id="slide-17-layer-4"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];"
                             data-mask_out="x:inherit;y:inherit;"
                             data-start="1500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"


                             style="z-index: 6; white-space: nowrap;">ALL COMPONENTS WILL WORK WITH ALL DEMOS
                        </div>
                    </li>
                    <!-- END -->
                    <!-- SLIDE #3  -->
                    <li data-index="rs-20" data-transition="zoomin" data-slotamount="7"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="<?= $link ?>/base/img/content/shop4/27.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Love it?" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="<?= $link ?>/base/img/content/shop4/27.jpg"  alt=""  data-bgposition="center center" data-kenburns="on" data-duration="15000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 -500" data-offsetend="0 500" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-0 c-font-white c-font-bold"
                             id="slide-20-layer-1"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                             data-fontsize="['70','70','70','45']"
                             data-lineheight="['70','70','70','50']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="x:[-105%];z:0;rX:0deg;rY:0deg;rZ:-90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:0px;s:inherit;e:inherit;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="1000"
                             data-splitin="chars"
                             data-splitout="none"
                             data-responsive_offset="on"

                             data-elementdelay="0.1"

                             style="z-index: 5; white-space: nowrap;">LOVE IT?
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-0 c-font-white"
                             id="slide-20-layer-4"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['52','52','52','51']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="1500"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"


                             style="z-index: 6; white-space: nowrap;">GET Yincart TODAY
                        </div>

                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption tp-resizeme rs-parallaxlevel-0"
                             id="slide-20-layer-8"
                             data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                             data-y="['middle','middle','middle','middle']" data-voffset="['105','105','105','105']"
                             data-width="none"
                             data-height="none"
                             data-whitespace="nowrap"
                             data-transform_idle="o:1;"
                             data-style_hover="cursor:default;"

                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;"
                             data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                             data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                             data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                             data-start="2000"
                             data-splitin="none"
                             data-splitout="none"
                             data-responsive_offset="on"


                             style="z-index: 7; white-space: nowrap;">
                            <a href="https://themeforest.net/item/jango-highly-flexible-component-based-html5-template/11987314?ref=themehats" class="c-action-btn btn btn-lg c-btn-circle c-theme-btn c-btn-uppercase">Purchase Now</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section><!-- END: LAYOUT/SLIDERS/REVO-SLIDER-13-1 -->

    <!-- BEGIN: CONTENT/SLIDERS/CLIENT-LOGOS-3 -->
    <div class="c-content-box c-size-md c-bg-white">
        <div class="container">
            <!-- Begin: Testimonals 1 component -->
            <div class="c-content-client-logos-slider-3 wow fadeIn" data-slider="owl">

                <!-- Begin: Owlcarousel -->

                <div class="owl-carousel owl-theme c-theme owl-bordered1 c-owl-nav-center" data-items="6" data-desktop-items="5" data-desktop-small-items="4" data-tablet-items="4" data-mobile-items="2" data-slide-speed="5000" data-rtl="false">
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client1.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client2.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client3.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client4.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client5.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client6.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client5.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client6.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client5.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client6.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client5.jpg" alt=""/></a>
                    </div>
                    <div class="item">
                        <a href="#"><img src="<?= $link ?>/base/img/content/client-logos/client6.jpg" alt=""/></a>
                    </div>
                </div>
                <!-- End-->
            </div>
            <!-- End-->
        </div>
    </div><!-- END: CONTENT/SLIDERS/CLIENT-LOGOS-3 -->

    <div id="about-us"></div>
    <!-- BEGIN: CONTENT/TABS/TAB-4-1 -->
    <div class="c-content-box c-size-md c-bg-img-center c-bg-parallax" style="background-image: url(<?= $link ?>/base/img/content/backgrounds/bg-101.jpg)">
        <div class="container">
            <div class="c-content-title-1 c-opt-1 wow fadeInDown">
                <h3 class="c-font-34 c-font-center c-font-bold c-margin-b-30 c-font-white">
                    Our Awesome Customers
                </h3>
                <p class="c-font-center c-font-grey">We first goal is to make our customers happy. Yes, this is the way we work</p>
                <div class="c-line-center c-theme-bg"></div>
            </div>
            <div class="c-content-tab-6 c-opt-1" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav" role="tablist">
                            <li role="presentation" class="active wow fadeInLeft" data-wow-delay="0s">
                                <a href="#tab-1" role="tab" data-toggle="tab">Amazing Features</a>
                            </li>
                            <li role="presentation" class="wow fadeInLeft" data-wow-delay="0.2s">
                                <a href="#tab-2" role="tab" data-toggle="tab">Exceptional Apps</a>
                            </li>
                            <li role="presentation" class="wow fadeInLeft" data-wow-delay="0.4s">
                                <a href="#tab-3" role="tab" data-toggle="tab">Reponsive Design</a>
                            </li>
                            <li role="presentation" class="wow fadeInLeft" data-wow-delay="0.6s">
                                <a href="#tab-4" role="tab" data-toggle="tab">Great Support</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content c-bg-white wow fadeInRight">
                            <div role="tabpanel" class="tab-pane fade in active" id="tab-1">
                                <ul class="c-tab-items">
                                    <li class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <img class="img-responsive" width="350" height="230"
                                                 src="<?= $link ?>/base/img/content/stock/97.jpg"  alt=""/>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <h4>Amazing Features</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetuer
                                                adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                                                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud
                                                exerci tation ullamcorper suscipit lobortis nisl.</p>
                                            <a href="#">Learn More</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-2">
                                <ul class="c-tab-items">
                                    <li class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <img class="img-responsive" width="350" height="230"
                                                 src="<?= $link ?>/base/img/content/stock/95.jpg"  alt=""/>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <h4>Exceptional Apps</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetuer
                                                adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                                                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud
                                                exerci tation ullamcorper suscipit lobortis nisl.</p>
                                            <a href="#">Learn More</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-3">
                                <ul class="c-tab-items">
                                    <li class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <img class="img-responsive" width="350" height="230"
                                                 src="<?= $link ?>/base/img/content/stock/87.jpg"  alt=""/>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <h4>Responsive Design</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetuer
                                                adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                                                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud
                                                exerci tation ullamcorper suscipit lobortis nisl.</p>
                                            <a href="#">Learn More</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab-4">
                                <ul class="c-tab-items">
                                    <li class="row">
                                        <div class="col-sm-4 col-xs-12">
                                            <img class="img-responsive" width="350" height="230"
                                                 src="<?= $link ?>/base/img/content/stock/84.jpg"  alt=""/>
                                        </div>
                                        <div class="col-sm-8 col-xs-12">
                                            <h4>Great Support</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetuer
                                                adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                                                magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud
                                                exerci tation ullamcorper suscipit lobortis nisl.</p>
                                            <a href="#">Learn More</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- END: CONTENT/TABS/TAB-4-1 -->

    <div id="services"></div>
    <!-- BEGIN: CONTENT/MISC/SERVICES-6 -->
    <div class="c-content-box c-size-md c-bg-white">
        <div class="container">
            <div class="c-content-services-6">
                <div class="c-content-title-1 c-opt-1 wow fadeInUp">
                    <h3 class="c-center c-font-bold">Amazing Services</h3>
                    <p class="c-font-center">Getting it right the first time.</p>
                    <div class="c-line-center c-theme-bg"></div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="c-content-services-6-item wow fadeInUp" data-wow-delay="0s">
                            <div class="c-content-services-6-item-icon c-content-business-line-icon c-theme c-business-icon-13"></div>
                            <h3 class="c-content-services-6-item-title">Feature Loaded</h3>
                            <p class="c-content-services-6-item-desc">Lorem ipsum sit dolor eamet dolore adipiscing</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="c-content-services-6-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="c-content-services-6-item-icon c-content-business-line-icon c-theme c-business-icon-12"></div>
                            <h3 class="c-content-services-6-item-title">Future Proof</h3>
                            <p class="c-content-services-6-item-desc">Lorem ipsum sit dolor eamet dolore adipiscing</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="c-content-services-6-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="c-content-services-6-item-icon c-content-business-line-icon c-theme c-business-icon-29"></div>
                            <h3 class="c-content-services-6-item-title">Countless Components</h3>
                            <p class="c-content-services-6-item-desc">Lorem ipsum sit dolor eamet dolore adipiscing</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="c-content-services-6-item wow fadeInUp" data-wow-delay="0.6s">
                            <div class="c-content-services-6-item-icon c-content-business-line-icon c-theme c-business-icon-18"></div>
                            <h3 class="c-content-services-6-item-title">Endless Extension</h3>
                            <p class="c-content-services-6-item-desc">Lorem ipsum sit dolor eamet dolore adipiscing</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="c-content-services-6-item wow fadeInUp" data-wow-delay="0.8s">
                            <div class="c-content-services-6-item-icon c-content-business-line-icon c-theme c-business-icon-24"></div>
                            <h3 class="c-content-services-6-item-title">Flexibility Freedom</h3>
                            <p class="c-content-services-6-item-desc">Lorem ipsum sit dolor eamet dolore adipiscing</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="c-content-services-6-item wow fadeInUp" data-wow-delay="1s">
                            <div class="c-content-services-6-item-icon c-content-business-line-icon c-theme c-business-icon-27"></div>
                            <h3 class="c-content-services-6-item-title">Ease of Use</h3>
                            <p class="c-content-services-6-item-desc">Lorem ipsum sit dolor eamet dolore adipiscing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- END: CONTENT/MISC/SERVICES-6 -->

    <!-- BEGIN: CONTENT/FEATURES/FEATURES-15-6 -->
    <div id="feature-15-6" class="c-content-feature-15 c-content-feature-15-5 c-bg-img-center c-bg-parallax" style="background-image: url(<?= $link ?>/base/img/content/shop4/63.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12">
                    <div class="c-feature-15-container c-bg-white wow fadeIn">
                        <h2 class="c-feature-15-title wow fadeInLeft" data-wow-delay="0.5s">A Great Theme is Always Ready</h2>
                        <p class="c-feature-15-desc wow fadeInLeft" data-wow-delay="0.7s">
                            Lorem ipsum dolor sit amet, consectetuer
                            adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore
                            magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud
                            exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                            consequat. Lorem ipsum dolor sit amet, consectetuer
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: CONTENT/FEATURES/FEATURES-15-6 -->

    <div id="client"></div>
    <!-- BEGIN: CONTENT/TESTIMONIALS/TESTIMONIALS-12 -->
    <div class="c-content-box c-size-md c-bg-grey-1">
        <div class="container">
            <!-- Begin: testimonials 1 component -->
            <div class="c-content-testimonials-12" data-slider="owl">
                <!-- Begin: Title 1 component -->
                <div class="c-content-title-1 c-opt-1">
                    <h3 class="c-center c-font-bold">Customers that Love Yincart</h3>
                    <p class="c-font-center">Top notch customer service is always a priority.</p>
                    <div class="c-line-center c-theme-bg"></div>
                </div>
                <!-- End-->
                <!-- Begin: Owlcarousel -->
                <div class="owl-carousel owl-theme c-theme c-owl-nav-center" data-single-item="true" data-navigation-dots="false" data-navigation-label="true" data-auto-play-hover-pause="true" data-slide-speed="5000" data-rtl="false">
                    <div class="item">
                        <div class="c-testimonial">
                            <div class="c-testimonial-container c-bg-white">
                                <img class="c-testimonial-12-quote-icon" src="<?= $link ?>/base/img/content/misc/quote-marks.png"/>
                                <p class="c-testimonial-12-desc">TOP Quality Theme. Very well written and great customer support from Themehats, I'm really glad for the theme. </p>
                                <h3 class="c-testimonial-12-author">Soundream, Yincart Customer</h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="c-testimonial">
                            <div class="c-testimonial-container c-bg-white">
                                <img class="c-testimonial-12-quote-icon" src="<?= $link ?>/base/img/content/misc/quote-marks.png"/>
                                <p class="c-testimonial-12-desc">Yincart is the best support I've experienced, and truly is flexible. This is quickly becoming my go to theme for custom projects.</p>
                                <h3 class="c-testimonial-12-author">Smauel76, Yincart Customer</h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="c-testimonial">
                            <div class="c-testimonial-container c-bg-white">
                                <img class="c-testimonial-12-quote-icon" src="<?= $link ?>/base/img/content/misc/quote-marks.png"/>
                                <p class="c-testimonial-12-desc">Simply the best theme I've purchase in years. Thanks for including so much options and elements. Great job.</p>
                                <h3 class="c-testimonial-12-author">Xerracol, Yincart Customer</h3>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="c-testimonial">
                            <div class="c-testimonial-container c-bg-white">
                                <img class="c-testimonial-12-quote-icon" src="<?= $link ?>/base/img/content/misc/quote-marks.png"/>
                                <p class="c-testimonial-12-desc">As a full stack developer myself, it is extremely rare that I rate anything 5 stars.</p>
                                <h3 class="c-testimonial-12-author">Degrama, Yincart Customer</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End-->
            </div>
            <!-- End-->
        </div>
    </div><!-- END: CONTENT/TESTIMONIALS/TESTIMONIALS-12 -->

    <!-- BEGIN: CONTENT/EVENTS/EVENTS-1 -->
    <div class="c-content-box c-size-md c-bg-white">
        <div class="container">
            <div class="c-content-title-1 c-opt-1 wow fadeInDown">
                <h3 class="c-center c-font-bold">Company Events</h3>
                <p class="c-font-center">Journey to Greatness requires dedication and persistance.</p>
                <div class="c-line-center c-theme-bg"></div>
            </div>
            <div class="c-content-events-1">
                <div class="row">
                    <div class="col-md-4">
                        <div class="c-content-events-1-item wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="c-content-events-1-img-container">
                                <img class="c-content-events-1-img" src="<?= $link ?>/base/img/content/stock3/44.jpg"/>
                            </div>
                            <div class="c-content-events-1-content-container">
                                <div class="c-content-events-1-cat">News</div>
                                <h3 class="c-content-events-1-title">We are growing!</h3>
                                <p class="c-content-events-1-desc">Lorem ipsum dolor amet adipicing et noummy eit seat dias estudiat elit dolore et isum siady et dolor amet adipicing noummy set dias set estudat eliat dolore noummy</p>
                                <a href="https://themeforest.net/item/jango-highly-flexible-component-based-html5-template/11987314?ref=themehats" class="c-content-events-1-link">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="c-content-events-1-item wow fadeInLeft">
                            <div class="c-content-events-1-img-container">
                                <img class="c-content-events-1-img" src="<?= $link ?>/base/img/content/stock3/36.jpg"/>
                            </div>
                            <div class="c-content-events-1-content-container">
                                <div class="c-content-events-1-cat">Announcements</div>
                                <h3 class="c-content-events-1-title">Yincart v2.0 is here!</h3>
                                <p class="c-content-events-1-desc">Lorem ipsum dolor amet adipicing et noummy eit seat dias estudiat elit dolore et isum siady et dolor amet adipicing noummy set dias set estudat eliat dolore noummy</p>
                                <a href="https://themeforest.net/item/jango-highly-flexible-component-based-html5-template/11987314?ref=themehats" class="c-content-events-1-link">Purchase Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="c-content-events-1-item c-events-1-featured wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1s">
                            <div class="c-content-events-1-content-container">
                                <div class="c-content-events-1-cat">Featured Event</div>
                                <h3 class="c-content-events-1-title">Awesome New Features!</h3>
                                <p class="c-content-events-1-desc">Lorem ipsum dolor amet adipicing et noummy eit seat dias estudiat elit dolore et isum siady et dolor amet adipicing noummy set dias set estudat eliat dolore noummy</p>
                                <ul class="c-content-events-1-list">
                                    <li class="c-content-events-1-list-item">
                                        <span>Ever Expanding Demos Themes</span>
                                    </li>
                                    <li class="c-content-events-1-list-item">
                                        <span>New Demos to be released consistently</span>
                                    </li>
                                    <li class="c-content-events-1-list-item">
                                        <span>Same Great Code Quality</span>
                                    </li>
                                    <li class="c-content-events-1-list-item">
                                        <span>Neverending Support</span>
                                    </li>
                                </ul>
                                <a href="https://themeforest.net/item/jango-highly-flexible-component-based-html5-template/11987314?ref=themehats" class="c-content-events-1-link btn c-btn c-theme-btn c-btn-circle c-font-uppercase">Purchase Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- END: CONTENT/EVENTS/EVENTS-1 -->

    <div id="contact"></div>
    <!-- BEGIN: CONTENT/MISC/SUBSCRIBE-FORM-3 -->
    <div class="c-content-box c-size-md c-theme-bg">
        <div class="container">
            <div>
                <form action="//themehats.us11.list-manage.com/subscribe/post?u=d2e2cd5a03bb51e84c3313d79&amp;id=9207486a10" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate c-content-subscribe-form-3" target="_blank" novalidate>
                    <input id="mce-EMAIL" type="email" name="EMAIL" class="form-control input-lg c-content-subscribe-form-3-input c-theme-bg c-font-white" placeholder="Enter your Email to Subscribe" required>
                    <span class="input-group-btn c-content-subscribe-form-3-btn">
					<button type="submit" value="" name="subscribe" id="mc-embedded-subscribe" class="btn c-theme-btn"><img src="<?= $link ?>/base/img/content/misc/subscribe-button.png"/></button>
				</span>
                </form>
            </div>
        </div>
    </div><!-- END: CONTENT/MISC/SUBSCRIBE-FORM-3 -->

    <!-- END: PAGE CONTENT -->


</div>
