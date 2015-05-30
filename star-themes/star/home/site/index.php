<?php
$link = $this->getAssetManager()->getPublishedUrl('@theme/star/home/assets');
?>
<div class="boxed_layout relative w_xs_auto">
    <!--slider-->
    <div class="camera_wrap m_bottom_0">
        <div data-src="<?= $link ?>/images/slide_02.jpg" data-custom-thumb="<?= $link ?>/images/slide_02.jpg">
            <div class="camera_caption_1 fadeFromTop t_align_c d_xs_none">
                <div class="f_size_large color_light tt_uppercase slider_title_3 m_bottom_5">Meet New Theme</div>
                <hr class="slider_divider d_inline_b m_bottom_5">
                <div class="color_light slider_title tt_uppercase t_align_c m_bottom_45 m_sm_bottom_20"><b>Attractive
                        &amp; Elegant<br>HTML Theme</b></div>
                <div class="color_light slider_title_2 m_bottom_45">$<b>15.00</b></div>
                <a href="#" role="button"
                   class="tr_all_hover button_type_4 bg_scheme_color color_light r_corners tt_uppercase">Buy Now</a>
            </div>
        </div>
        <div data-src="<?= $link ?>/images/slide_01.jpg" data-custom-thumb="<?= $link ?>/images/slide_01.jpg">
            <div class="camera_caption_2 fadeIn t_align_c d_xs_none">
                <div class="f_size_large tt_uppercase slider_title_3 scheme_color">New arrivals</div>
                <hr class="slider_divider type_2 m_bottom_5 d_inline_b">
                <div class="color_light slider_title tt_uppercase t_align_c m_bottom_65 m_sm_bottom_20"><b><span
                            class="scheme_color">Spring/Summer 2014</span><br><span
                            class="color_dark">Ready-To-Wear</span></b></div>
                <a href="#" role="button"
                   class="d_sm_inline_b button_type_4 bg_scheme_color color_light r_corners tt_uppercase tr_all_hover">View
                    Collection</a>
            </div>
        </div>
        <div data-src="<?= $link ?>/images/slide_03.jpg" data-custom-thumb="<?= $link ?>/images/slide_03.jpg">
            <div class="camera_caption_3 fadeFromTop t_align_c d_xs_none">
                <img src="<?= $link ?>/images/slider_layer_img.png" alt="" class="m_bottom_5">

                <div class="color_light slider_title tt_uppercase t_align_c m_bottom_60 m_sm_bottom_20"><b
                        class="color_dark">up to 70% off</b></div>
                <a href="#" role="button"
                   class="d_sm_inline_b button_type_4 bg_scheme_color color_light r_corners tt_uppercase tr_all_hover">Shop
                    Now</a>
            </div>
        </div>
    </div>

    <!--products-->
    <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
    <!--product item-->
    <div class="product_item">
        <figure class="r_corners photoframe shadow relative hit animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap">
                <!--hot product-->
                <span class="hot_stripe"><img src="<?= $link ?>/images/hot_product.png" alt=""></span>
                <img src="<?= $link ?>/images/product_img_1.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Eget elementum vel</a></h5>
                <div class="clearfix">
                    <p class="scheme_color f_left f_size_large m_bottom_15">$102.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item featured">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative wrapper pp_wrap">
                <img src="<?= $link ?>/images/product_img_2.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Ut tellus dolor dapibus</a></h5>
                <div class="clearfix m_bottom_15">
                    <p class="scheme_color f_size_large f_left">$57.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <div class="clearfix">
                    <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light f_left mw_0">Add to Cart</button>
                    <button class="button_type_4 bg_light_color_2 tr_all_hover f_right r_corners color_dark mw_0 m_left_5 p_hr_0"><i class="fa fa-files-o"></i></button>
                    <button class="button_type_4 bg_light_color_2 tr_all_hover f_right r_corners color_dark mw_0 p_hr_0"><i class="fa fa-heart-o"></i></button>
                </div>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item new">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative wrapper pp_wrap">
                <img src="<?= $link ?>/images/product_img_3.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Cursus eleifend elit aenean aucto.</a></h5>
                <div class="clearfix">
                    <p class="scheme_color f_left f_size_large m_bottom_15">$99.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item specials">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap">
                <!--sale product-->
                <span class="hot_stripe"><img src="<?= $link ?>/images/sale_product.png" alt=""></span>
                <img src="<?= $link ?>/images/product_img_4.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Aliquam erat volutpat</a></h5>
                <div class="clearfix">
                    <p class="scheme_color f_left f_size_large m_bottom_15"><s>$79.00</s> $36.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item hit">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap">
                <!--hot product-->
                <span class="hot_stripe type_2"><img src="<?= $link ?>/images/hot_product_type_2.png" alt=""></span>
                <img src="<?= $link ?>/images/product_img_5.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Eget elementum vel</a></h5>
                <div class="clearfix">
                    <p class="scheme_color f_left f_size_large m_bottom_15">$102.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item featured">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative wrapper pp_wrap">
                <img src="<?= $link ?>/images/product_img_6.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
									<span class="clearfix p_buttons d_block tr_all_hover">
										<span class="box_s_none button_type_5 tr_delay_hover f_left r_corners color_light p_hr_0"><i class="fa fa-heart-o"></i></span>
										<span class="box_s_none button_type_5 tr_delay_hover f_left r_corners color_light m_left_5 p_hr_0"><i class="fa fa-files-o"></i></span>
									</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Ut tellus dolor dapibus</a></h5>
                <div class="clearfix m_bottom_15">
                    <p class="scheme_color f_size_large f_left">$57.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item specials">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative wrapper pp_wrap">
                <img src="<?= $link ?>/images/product_img_7.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Cursus eleifend elit aenean aucto.</a></h5>
                <div class="clearfix">
                    <p class="scheme_color f_left f_size_large m_bottom_15">$99.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    <!--product item-->
    <div class="product_item rated">
        <figure class="r_corners photoframe shadow relative animate_ftb long">
            <!--product preview-->
            <a href="#" class="d_block relative pp_wrap">
                <!--sale product-->
                <span class="hot_stripe type_2"><img src="<?= $link ?>/images/sale_product_type_2.png" alt=""></span>
                <img src="<?= $link ?>/images/product_img_8.jpg" class="tr_all_hover" alt="">
                <span data-popup="#quick_view_product" class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="#" class="color_dark">Aliquam erat volutpat</a></h5>
                <div class="clearfix">
                    <p class="scheme_color f_left f_size_large m_bottom_15"><s>$79.00</s> $36.00</p>
                    <!--rating-->
                    <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li class="active">
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                        <li>
                            <i class="fa fa-star-o empty tr_all_hover"></i>
                            <i class="fa fa-star active tr_all_hover"></i>
                        </li>
                    </ul>
                </div>
                <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>
            </figcaption>
        </figure>
    </div>
    </section>
</div>