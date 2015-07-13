<?php
/**
 * if this view can't show , you should install imagick for php,The EasyThumbnailImage depend on it
 */
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
$link = $this->getAssetManager()->getPublishedUrl('@theme/home/default/assets');
$this->registerJsFile($link . '/js/wishlist.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($link . '/js/compare.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="boxed_layout relative w_xs_auto">
    <!--slider-->
    <div class="camera_wrap m_bottom_0">
        <div data-src="<?= $link ?>/images/slide_02.jpg" data-custom-thumb="<?= $link ?>/images/slide_02.jpg">
<!--            <div class="camera_caption_1 fadeFromTop t_align_c d_xs_none">-->
<!--                <div class="f_size_large color_light tt_uppercase slider_title_3 m_bottom_5">Meet New Theme</div>-->
<!--                <hr class="slider_divider d_inline_b m_bottom_5">-->
<!--                <div class="color_light slider_title tt_uppercase t_align_c m_bottom_45 m_sm_bottom_20"><b>Attractive-->
<!--                        &amp; Elegant<br>HTML Theme</b></div>-->
<!--                <div class="color_light slider_title_2 m_bottom_45">$<b>15.00</b></div>-->
<!--                <a href="#" role="button"-->
<!--                   class="tr_all_hover button_type_4 bg_scheme_color color_light r_corners tt_uppercase">Buy Now</a>-->
<!--            </div>-->
        </div>
        <div data-src="<?= $link ?>/images/slide_01.jpg" data-custom-thumb="<?= $link ?>/images/slide_01.jpg">
<!--            <div class="camera_caption_2 fadeIn t_align_c d_xs_none">-->
<!--                <div class="f_size_large tt_uppercase slider_title_3 scheme_color">New arrivals</div>-->
<!--                <hr class="slider_divider type_2 m_bottom_5 d_inline_b">-->
<!--                <div class="color_light slider_title tt_uppercase t_align_c m_bottom_65 m_sm_bottom_20"><b><span-->
<!--                            class="scheme_color">Spring/Summer 2014</span><br><span-->
<!--                            class="color_dark">Ready-To-Wear</span></b></div>-->
<!--                <a href="#" role="button"-->
<!--                   class="d_sm_inline_b button_type_4 bg_scheme_color color_light r_corners tt_uppercase tr_all_hover">View-->
<!--                    Collection</a>-->
<!--            </div>-->
        </div>
        <div data-src="<?= $link ?>/images/slide_03.jpg" data-custom-thumb="<?= $link ?>/images/slide_03.jpg">
<!--            <div class="camera_caption_3 fadeFromTop t_align_c d_xs_none">-->
<!--                <img src="--><?//= $link ?><!--/images/slider_layer_img.png" alt="" class="m_bottom_5">-->
<!---->
<!--                <div class="color_light slider_title tt_uppercase t_align_c m_bottom_60 m_sm_bottom_20"><b-->
<!--                        class="color_dark">up to 70% off</b></div>-->
<!--                <a href="#" role="button"-->
<!--                   class="d_sm_inline_b button_type_4 bg_scheme_color color_light r_corners tt_uppercase tr_all_hover">Shop-->
<!--                    Now</a>-->
<!--            </div>-->
        </div>
    </div>

    <!--products-->
    <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">
        <!--product item-->
        <?php
        $items = \star\catalog\models\Item::find()->limit(12)->all();
        if ($items) {
            /** @var \star\catalog\models\Item $item */
            foreach ($items as $key => $item) {
                ?>
                <div class="product_item featured">
                    <figure class="r_corners photoframe shadow relative animate_ftb long">
                        <!--product preview-->
                        <a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>" class="d_block relative pp_wrap">
                            <?= EasyThumbnailImage::thumbnailImg(
                                '@image/'.$item->getMainImage(),
                                242,
                                242,
                                EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                ['class'=>"tr_all_hover"]
                            )?>
                            <span data-popup="#quick_view_product"
                                  class="box_s_none button_type_5 color_light r_corners tr_all_hover d_xs_none">预览</span>
                        </a>
                        <!--description and price of product-->
                        <figcaption>
                            <h5 class="m_bottom_10">
                                <div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap;width:242px;">
                                    <a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>" class="color_dark" title="<?= $item->title ?>">
                                        <?= $item->title ?>
                                    </a>
                                </div>
                            </h5>
                            <div class="clearfix m_bottom_15">
                                <p class="scheme_color f_size_large f_left"><?= $item->price ?></p>
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
                                <button
                                    class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light f_left mw_0">
                                    加入购物车
                                </button>
                                <button
                                    class="compare button_type_4 bg_light_color_2 tr_all_hover f_right r_corners color_dark mw_0 m_left_5 p_hr_0"
                                    data-compare_id="<?= $key?>"
                                    data-item_id="<?= $item->item_id?>"
                                    data-category_id="<?= $item->category_id?>"
                                    data-selected= 0>
                                    <i class="fa fa-files-o"></i></button>
<!--                                <button-->
<!--                                    class="wishlist button_type_4 bg_light_color_2 tr_all_hover f_right r_corners color_dark mw_0 p_hr_0"-->
<!--                                    data-url="--><?//= Url::to(['/member/wishlist/add-wishlist'])?><!--"-->
<!--                                    data-csrf="--><?//= Yii::$app->request->csrfToken?><!--"-->
<!--                                    data-item_id="--><?//= $item->item_id?><!--">-->
<!--                                    <i class="fa fa-heart-o"></i></button>-->
                            </div>
                        </figcaption>
                    </figure>
                </div>
            <?php }
        } ?>
    </section>
</div>

<div class="popup_wrap d_none" id="quick_view_product">
    <section class="popup r_corners shadow">
        <button class="bg_tr color_dark tr_all_hover text_cs_hover close f_size_large"><i class="fa fa-times"></i>
        </button>
        <div class="clearfix">
            <div class="custom_scrollbar">
                <!--left popup column-->
                <div class="f_left half_column">
                    <div class="relative d_inline_b m_bottom_10 qv_preview">
                        <span class="hot_stripe"><img src="<?= $link ?>/images/sale_product.png" alt=""></span>
                        <img src="<?= $link ?>/images/quick_view_img_1.jpg" class="tr_all_hover" alt="">
                    </div>
                    <!--carousel-->
                    <div class="relative qv_carousel_wrap m_bottom_20">
                        <button
                            class="button_type_11 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_prev">
                            <i class="fa fa-angle-left "></i>
                        </button>
                        <ul class="qv_carousel d_inline_middle">
                            <li data-src="<?= $link ?>/images/quick_view_img_1.jpg"><img
                                    src="<?= $link ?>/images/quick_view_img_4.jpg" alt=""></li>
                            <li data-src="<?= $link ?>/images/quick_view_img_2.jpg"><img
                                    src="<?= $link ?>/images/quick_view_img_5.jpg" alt=""></li>
                            <li data-src="<?= $link ?>/images/quick_view_img_3.jpg"><img
                                    src="<?= $link ?>/images/quick_view_img_6.jpg" alt=""></li>
                            <li data-src="<?= $link ?>/images/quick_view_img_1.jpg"><img
                                    src="<?= $link ?>/images/quick_view_img_4.jpg" alt=""></li>
                            <li data-src="<?= $link ?>/images/quick_view_img_2.jpg"><img
                                    src="<?= $link ?>/images/quick_view_img_5.jpg" alt=""></li>
                            <li data-src="<?= $link ?>/images/quick_view_img_3.jpg"><img
                                    src="<?= $link ?>/images/quick_view_img_6.jpg" alt=""></li>
                        </ul>
                        <button
                            class="button_type_11 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_next">
                            <i class="fa fa-angle-right "></i>
                        </button>
                    </div>
                    <div class="d_inline_middle">Share this:</div>
                    <div class="d_inline_middle m_left_5">
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                            <a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>
                        </div>
                        <!-- AddThis Button END -->
                    </div>
                </div>
                <!--right popup column-->
                <div class="f_right half_column">
                    <!--description-->
                    <h2 class="m_bottom_10"><a href="#" class="color_dark fw_medium">Eget elementum vel</a></h2>

                    <div class="m_bottom_10">
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
                        <a href="#" class="d_inline_middle default_t_color f_size_small m_left_5">1 Review(s) </a>
                    </div>
                    <hr class="m_bottom_10 divider_type_3">
                    <table class="description_table m_bottom_10">
                        <tr>
                            <td>Manufacturer:</td>
                            <td><a href="#" class="color_dark">Chanel</a></td>
                        </tr>
                        <tr>
                            <td>Availability:</td>
                            <td><span class="color_green">in stock</span> 20 item(s)</td>
                        </tr>
                        <tr>
                            <td>Product Code:</td>
                            <td>PS06</td>
                        </tr>
                    </table>
                    <h5 class="fw_medium m_bottom_10">Product Dimensions and Weight</h5>
                    <table class="description_table m_bottom_5">
                        <tr>
                            <td>Product Length:</td>
                            <td><span class="color_dark">10.0000M</span></td>
                        </tr>
                        <tr>
                            <td>Product Weight:</td>
                            <td>10.0000KG</td>
                        </tr>
                    </table>
                    <hr class="divider_type_3 m_bottom_10">
                    <p class="m_bottom_10">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean
                        auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum
                        dolor sit amet, consecvtetuer adipiscing elit. </p>
                    <hr class="divider_type_3 m_bottom_15">
                    <div class="m_bottom_15">
                        <s class="v_align_b f_size_ex_large">$152.00</s><span
                            class="v_align_b f_size_big m_left_5 scheme_color fw_medium">$102.00</span>
                    </div>
                    <table class="description_table type_2 m_bottom_15">
                        <tr>
                            <td class="v_align_m">Size:</td>
                            <td class="v_align_m">
                                <div class="custom_select f_size_medium relative d_inline_middle">
                                    <div class="select_title r_corners relative color_dark">s</div>
                                    <ul class="select_list d_none"></ul>
                                    <select name="product_name">
                                        <option value="s">s</option>
                                        <option value="m">m</option>
                                        <option value="l">l</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="v_align_m">Quantity:</td>
                            <td class="v_align_m">
                                <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                                    <button class="bg_tr d_block f_left" data-direction="down">-</button>
                                    <input type="text" name="" readonly value="1" class="f_left">
                                    <button class="bg_tr d_block f_left" data-direction="up">+</button>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="clearfix m_bottom_15">
                        <button
                            class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover f_left f_size_large">
                            Add to Cart
                        </button>
                        <button
                            class="button_type_12 bg_light_color_2 tr_delay_hover f_left r_corners color_dark m_left_5 p_hr_0">
                            <i class="fa fa-heart-o f_size_big"></i><span
                                class="tooltip tr_all_hover r_corners color_dark f_size_small">Wishlist</span></button>
                        <button
                            class="button_type_12 bg_light_color_2 tr_delay_hover f_left r_corners color_dark m_left_5 p_hr_0">
                            <i class="fa fa-files-o f_size_big"></i><span
                                class="tooltip tr_all_hover r_corners color_dark f_size_small">Compare</span></button>
                        <button
                            class="button_type_12 bg_light_color_2 tr_delay_hover f_left r_corners color_dark m_left_5 p_hr_0 relative">
                            <i class="fa fa-question-circle f_size_big"></i><span
                                class="tooltip tr_all_hover r_corners color_dark f_size_small">Ask a Question</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>