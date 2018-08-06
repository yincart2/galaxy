<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/25/2015
 * Time: 6:44 PM
 */

use yii\widgets\LinkPager;
use yii\helpers\Url;

$link = $this->getAssetManager()->getPublishedUrl('@theme/star/home/assets');
?>
<!--content-->
<div class="page_content_offset">
<div class="container">
<div class="row clearfix">
<!--left content column-->
<section class="col-lg-9 col-md-9 col-sm-9">
<h2 class="tt_uppercase color_dark m_bottom_25">Blog</h2>
<!--blog post-->
<article class="m_bottom_25">
    <a href="#" class="d_block photoframe r_corners wrapper shadow m_bottom_25">
        <img src="<?= $link ?>/images/blog_img_4.jpg" class="tr_all_long_hover" alt="">
    </a>

    <div class="row clearfix m_bottom_10">
        <div class="col-lg-9 col-md-9 col-sm-9">
            <h4 class="m_bottom_5"><a href="#" class="color_dark fw_medium">Ut tellus dolor, dapibus eget, elementum
                    vel</a></h4>

            <p class="f_size_medium">25 January, 2013, <a href="#" class="color_dark">12 comments</a>, on <a href="#"
                                                                                                             class="color_dark">Fashion</a>
            </p>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 t_align_r t_sm_align_l">
            <p class="f_size_medium d_sm_inline_middle">Rate this item</p>
            <!--rating-->
            <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover">
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
            <a href="#" class="d_inline_middle f_size_medium default_t_color m_left_5">(1 Vote)</a>
        </div>
    </div>
    <!--post content-->
    <p class="m_bottom_10">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet,
        consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus
        eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.
        Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus
        eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. </p>
    <a href="#" class="tt_uppercase f_size_large">Read More</a>
</article>
<hr class="divider_type_3 m_bottom_30">
<article class="m_bottom_20 clearfix">
    <a href="#"
       class="photoframe d_block d_xs_inline_b f_xs_none wrapper shadow f_left m_right_20 m_bottom_10 r_corners">
        <img src="<?= $link ?>/images/blog_img_5.jpg" class="tr_all_long_hover" alt="">
    </a>

    <div class="mini_post_content">
        <h4 class="m_bottom_5"><a href="#" class="color_dark fw_medium">Aenean auctor wisi et urna</a></h4>

        <p class="f_size_medium m_bottom_10">20 January, 2013, <a href="#" class="color_dark">33 comments</a>, on <a
                href="#" class="color_dark">New Arrivals</a></p>
        <hr>
        <div class="rating_min_article">
            <p class="f_size_medium d_inline_middle d_sm_block d_xs_inline_middle">Rate this item</p>
            <!--rating-->
            <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover m_left_5 m_sm_left_0">
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
            <a href="#" class="d_inline_middle f_size_medium default_t_color m_left_5">(3 Votes)</a>
        </div>
        <hr class="m_bottom_15">
        <p class="m_bottom_10">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet,
            consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor,
            dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. </p>
        <a href="#" class="tt_uppercase f_size_large">Read More</a>
    </div>
</article>
<hr class="divider_type_3 m_bottom_30">
<article class="m_bottom_20 clearfix">
    <a href="#"
       class="photoframe d_block d_xs_inline_b f_xs_none wrapper shadow f_left m_right_20 m_bottom_10 r_corners">
        <img src="<?= $link ?>/images/blog_img_6.jpg" class="tr_all_long_hover" alt="">
    </a>

    <div class="mini_post_content">
        <h4 class="m_bottom_5"><a href="#" class="color_dark fw_medium">Vivamus eget nibh</a></h4>

        <p class="f_size_medium m_bottom_10">19 January, 2013, <a href="#" class="color_dark">add new comment</a>, on <a
                href="#" class="color_dark">Trends</a></p>
        <hr>
        <div class="rating_min_article">
            <p class="f_size_medium d_inline_middle d_sm_block d_xs_inline_middle">Rate this item</p>
            <!--rating-->
            <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover m_left_5 m_sm_left_0">
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
            <a href="#" class="d_inline_middle f_size_medium default_t_color m_left_5">(0 Vote)</a>
        </div>
        <hr class="m_bottom_15">
        <p class="m_bottom_10">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet,
            consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor,
            dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. </p>
        <a href="#" class="tt_uppercase f_size_large">Read More</a>
    </div>
</article>
<hr class="divider_type_3 m_bottom_30">
<article class="m_bottom_20 clearfix">
    <a href="#"
       class="photoframe d_block d_xs_inline_b f_xs_none wrapper shadow f_left m_right_20 r_corners m_bottom_10">
        <img src="<?= $link ?>/images/blog_img_7.jpg" class="tr_all_long_hover" alt="">
    </a>

    <div class="mini_post_content">
        <h4 class="m_bottom_5"><a href="#" class="color_dark fw_medium">Cursus eleifend, elit aenean</a></h4>

        <p class="f_size_medium m_bottom_10">15 January, 2013, <a href="#" class="color_dark">15 comments</a>, on <a
                href="#" class="color_dark">New Arrivals</a></p>
        <hr>
        <div class="rating_min_article">
            <p class="f_size_medium d_inline_middle d_sm_block d_xs_inline_middle">Rate this item</p>
            <!--rating-->
            <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover m_left_5 m_sm_left_0">
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
            <a href="#" class="d_inline_middle f_size_medium default_t_color m_left_5">(12 Votes)</a>
        </div>
        <hr class="m_bottom_15">
        <p class="m_bottom_10">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet,
            consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor,
            dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. </p>
        <a href="#" class="tt_uppercase f_size_large">Read More</a>
    </div>
</article>
<hr class="divider_type_3 m_bottom_30">
<article class="m_bottom_20 clearfix">
    <a href="#"
       class="photoframe d_block d_xs_inline_b f_xs_none wrapper shadow f_left m_right_20 r_corners m_bottom_10">
        <img src="<?= $link ?>/images/blog_img_8.jpg" class="tr_all_long_hover" alt="">
    </a>

    <div class="mini_post_content">
        <h4 class="m_bottom_5"><a href="#" class="color_dark fw_medium">In pede mi, aliquet sit </a></h4>

        <p class="f_size_medium m_bottom_10">11 January, 2013, <a href="#" class="color_dark">50 Comments</a>, on <a
                href="#" class="color_dark">Fashion</a></p>
        <hr>
        <div class="rating_min_article">
            <p class="f_size_medium d_inline_middle d_sm_block d_xs_inline_middle">Rate this item</p>
            <!--rating-->
            <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover m_left_5 m_sm_left_0">
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
            <a href="#" class="d_inline_middle f_size_medium default_t_color m_left_5">(7 Votes)</a>
        </div>
        <hr class="m_bottom_15">
        <p class="m_bottom_10">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet,
            consectetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor,
            dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. </p>
        <a href="#" class="tt_uppercase f_size_large">Read More</a>
    </div>
</article>
<hr class="divider_type_3 m_bottom_10">
<div class="row clearfix m_xs_bottom_30">
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-5">
        <p class="d_inline_middle f_size_medium">Results 1 - 5 of 45</p>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-7 t_align_r">
        <!--pagination-->
        <a role="button" href="#"
           class="f_size_large button_type_10 color_dark d_inline_middle bg_cs_hover bg_light_color_1 t_align_c tr_delay_hover r_corners box_s_none"><i
                class="fa fa-angle-left"></i></a>
        <ul class="horizontal_list clearfix d_inline_middle f_size_medium m_left_10">
            <li class="m_right_10"><a class="color_dark" href="#">1</a></li>
            <li class="m_right_10"><a class="scheme_color" href="#">2</a></li>
            <li class="m_right_10"><a class="color_dark" href="#">3</a></li>
        </ul>
        <a role="button" href="#"
           class="f_size_large button_type_10 color_dark d_inline_middle bg_cs_hover bg_light_color_1 t_align_c tr_delay_hover r_corners box_s_none"><i
                class="fa fa-angle-right"></i></a>
    </div>
</div>
</section>
<!--right column-->
<aside class="col-lg-3 col-md-3 col-sm-3">
    <!--widgets-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Blog Categories</h3>
        </figcaption>
        <div class="widget_content">
            <!--Categories list-->
            <ul class="categories_list">
                <li class="active">
                    <a href="#" class="f_size_large color_dark d_block">
                        <b>Fashion</b>
                    </a>
                </li>
                <li>
                    <a href="#" class="f_size_large color_dark d_block">
                        <b>Trends</b>
                    </a>
                </li>
                <li>
                    <a href="#" class="f_size_large color_dark d_block">
                        <b>New Arrivals</b>
                    </a>
                </li>
            </ul>
        </div>
    </figure>
    <!--Popular articles-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Popular Articles</h3>
        </figcaption>
        <div class="widget_content">
            <article class="clearfix m_bottom_15">
                <img src="<?= $link ?>/images/article_img_1.jpg" alt=""
                     class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
                <a href="#" class="color_dark d_block bt_link p_vr_0">Aliquam erat volutpat.</a>

                <p class="f_size_medium">50 comments</p>
            </article>
            <hr class="m_bottom_15">
            <article class="clearfix m_bottom_15">
                <img src="<?= $link ?>/images/article_img_2.jpg" alt=""
                     class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
                <a href="#" class="color_dark d_block p_vr_0 bt_link">Integer rutrum ante </a>

                <p class="f_size_medium">34 comments</p>
            </article>
            <hr class="m_bottom_15">
            <article class="clearfix m_bottom_5">
                <img src="<?= $link ?>/images/article_img_3.jpg" alt=""
                     class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
                <a href="#" class="color_dark d_block p_vr_0 bt_link">Vestibulum libero nisl, porta vel</a>

                <p class="f_size_medium">21 comments</p>
            </article>
        </div>
    </figure>
    <!--Bestsellers-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Bestsellers</h3>
        </figcaption>
        <div class="widget_content">
            <div class="clearfix m_bottom_15">
                <img src="<?= $link ?>/images/bestsellers_img_1.jpg" alt=""
                     class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
                <a href="#" class="color_dark d_block bt_link">Ut tellus dolor dapibus</a>
                <!--rating-->
                <ul class="horizontal_list clearfix d_inline_b rating_list type_2 tr_all_hover m_bottom_10">
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
                <p class="scheme_color">$61.00</p>
            </div>
            <hr class="m_bottom_15">
            <div class="clearfix m_bottom_15">
                <img src="<?= $link ?>/images/bestsellers_img_2.jpg" alt=""
                     class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
                <a href="#" class="color_dark d_block bt_link">Elementum vel</a>
                <!--rating-->
                <ul class="horizontal_list clearfix d_inline_b rating_list type_2 tr_all_hover m_bottom_10">
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
                <p class="scheme_color">$57.00</p>
            </div>
            <hr class="m_bottom_15">
            <div class="clearfix m_bottom_5">
                <img src="<?= $link ?>/images/bestsellers_img_3.jpg" alt=""
                     class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
                <a href="#" class="color_dark d_block bt_link">Crsus eleifend elit</a>
                <!--rating-->
                <ul class="horizontal_list clearfix d_inline_b rating_list type_2 tr_all_hover m_bottom_10">
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
                <p class="scheme_color">$24.00</p>
            </div>
        </div>
    </figure>
    <!--Specials-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption class="clearfix relative">
            <h3 class="color_light f_left f_sm_none m_sm_bottom_10 m_xs_bottom_0">Specials</h3>

            <div class="f_right nav_buttons_wrap_type_2 tf_sm_none f_sm_none clearfix">
                <button
                    class="button_type_7 bg_cs_hover box_s_none f_size_ex_large color_light t_align_c bg_tr f_left tr_delay_hover r_corners sc_prev">
                    <i class="fa fa-angle-left"></i></button>
                <button
                    class="button_type_7 bg_cs_hover box_s_none f_size_ex_large color_light t_align_c bg_tr f_left m_left_5 tr_delay_hover r_corners sc_next">
                    <i class="fa fa-angle-right"></i></button>
            </div>
        </figcaption>
        <div class="widget_content">
            <div class="specials_carousel">
                <!--carousel item-->
                <div class="specials_item">
                    <a href="#" class="d_block d_xs_inline_b wrapper m_bottom_20">
                        <img class="tr_all_long_hover" src="<?= $link ?>/images/product_img_6.jpg" alt="">
                    </a>
                    <h5 class="m_bottom_10"><a href="#" class="color_dark">Aliquam erat volutpat</a></h5>

                    <p class="f_size_large m_bottom_15"><s>$79.00</s> <span class="scheme_color">$36.00</span></p>
                    <button class="button_type_4 mw_sm_0 r_corners color_light bg_scheme_color tr_all_hover m_bottom_5">
                        Add to Cart
                    </button>
                </div>
                <!--carousel item-->
                <div class="specials_item">
                    <a href="#" class="d_block d_xs_inline_b wrapper m_bottom_20">
                        <img class="tr_all_long_hover" src="<?= $link ?>/images/product_img_7.jpg" alt="">
                    </a>
                    <h5 class="m_bottom_10"><a href="#" class="color_dark">Integer rutrum ante </a></h5>

                    <p class="f_size_large m_bottom_15"><s>$79.00</s> <span class="scheme_color">$36.00</span></p>
                    <button class="button_type_4 mw_sm_0 r_corners color_light bg_scheme_color tr_all_hover m_bottom_5">
                        Add to Cart
                    </button>
                </div>
                <!--carousel item-->
                <div class="specials_item">
                    <a href="#" class="d_block d_xs_inline_b wrapper m_bottom_20">
                        <img class="tr_all_long_hover" src="<?= $link ?>/images/product_img_5.jpg" alt="">
                    </a>
                    <h5 class="m_bottom_10"><a href="#" class="color_dark">Aliquam erat volutpat</a></h5>

                    <p class="f_size_large m_bottom_15"><s>$79.00</s> <span class="scheme_color">$36.00</span></p>
                    <button class="button_type_4 mw_sm_0 r_corners color_light bg_scheme_color tr_all_hover m_bottom_5">
                        Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </figure>
</aside>
</div>
</div>
</div>