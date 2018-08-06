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

    <div class="page_content_offset">
    <div class="container">
    <h2 class="tt_uppercase m_bottom_20 color_dark heading1 animate_ftr">商品展示</h2>
    <!--filter navigation of products-->
    <ul class="horizontal_list clearfix tt_uppercase isotope_menu f_size_ex_large">
        <li class="active m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter="*">所有</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".hot">热卖</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".new">新品</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".best">精品</button></li>
        <li class="m_right_5 m_bottom_10 m_xs_bottom_5 animate_ftr"><button class="button_type_2 bg_light_color_1 r_corners tr_delay_hover tt_uppercase box_s_none" data-filter=".promote">促销</button></li>
    </ul>
    <!--products-->
    <section class="products_container clearfix m_bottom_25 m_sm_bottom_15">

    <!--product item-->
    <?php
    $items = \star\catalog\models\Item::find()->where(['is_show'=>1])->limit(12)->all();
    if ($items) {
        /** @var \star\catalog\models\Item $item */
        foreach ($items as $key => $item) {
            ?>
            <div class="product_item <?= $item->is_hot? 'hot':''?> <?= $item->is_new? 'new':''?> <?= $item->is_best? 'best':''?> <?= $item->is_promote? 'promote':''?>">
                <figure class="r_corners photoframe shadow relative animate_ftb long">
                    <!--product preview-->
                    <a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>" class="d_block relative pp_wrap">
                        <?= $item->is_hot? '<span class="hot_stripe"><img src="'.$link.'/images/hot_product.png" alt=""></span>':''?>

                        <?= EasyThumbnailImage::thumbnailImg(
                            '@image/'.$item->getMainImage(),
                            242,
                            242,
                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                            ['class'=>"tr_all_hover"]
                        )?>
                        <span data-popup="#quick_view_product<?= $item->item_id?>"
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
                            <p class="scheme_color f_size_large f_left">￥<?= $item->price ?></p>
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
                            <a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>"
                                class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light f_left mw_0">
                                查看
                            </a>
                            <!--                                <button-->
                            <!--                                    class="compare button_type_4 bg_light_color_2 tr_all_hover f_right r_corners color_dark mw_0 m_left_5 p_hr_0"-->
                            <!--                                    data-compare_id="--><?//= $key?><!--"-->
                            <!--                                    data-item_id="--><?//= $item->item_id?><!--"-->
                            <!--                                    data-category_id="--><?//= $item->category_id?><!--"-->
                            <!--                                    data-selected= 0>-->
                            <!--                                    <i class="fa fa-files-o"></i></button>-->
                            <button
                                class="wishlist button_type_4 bg_light_color_2 tr_all_hover f_right r_corners color_dark mw_0 p_hr_0"
                                data-url="<?= Url::to(['/member/wishlist/add-wishlist'])?>"
                                data-csrf="<?= Yii::$app->request->csrfToken?>"
                                data-item_id="<?= $item->item_id?>">
                                <i class="fa fa-heart-o"></i></button>
                        </div>
                    </figcaption>
                </figure>
            </div>


            <div class="popup_wrap d_none" id="quick_view_product<?= $item->item_id?>">
                <section class="popup r_corners shadow">
                    <button class="bg_tr color_dark tr_all_hover text_cs_hover close f_size_large"><i class="fa fa-times"></i>
                    </button>
                    <div class="clearfix">
                        <div class="custom_scrollbar">
                            <!--left popup column-->
                            <div class="f_left half_column">
                                <div class="relative d_inline_b m_bottom_10 qv_preview">
                                    <span class="hot_stripe"><img src="<?= $link ?>/images/sale_product.png" alt=""></span>
                                    <?= EasyThumbnailImage::thumbnailImg(
                                        '@image/'.$item->getMainImage(),
                                        360,
                                        360,
                                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                        [ "class"=>"tr_all_hover"]
                                    )?>
                                </div>
                                <!--carousel-->
                                <div class="relative qv_carousel_wrap m_bottom_20">
                                    <button
                                        class="button_type_11 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_prev">
                                        <i class="fa fa-angle-left "></i>
                                    </button>
                                    <ul class="qv_carousel d_inline_middle">
                                        <?php
                                        foreach($item->itemImgs as $itemImage){ ?>
                                            <li data-src="<?= file_exists(Yii::getAlias( '@image/'.$itemImage->pic))?
                                            EasyThumbnailImage::thumbnailFileUrl(
                                                '@image/'.$itemImage->pic,
                                                360,
                                                360,
                                                EasyThumbnailImage::THUMBNAIL_OUTBOUND
                                            ):''?>" >
                                                <?= EasyThumbnailImage::thumbnailImg(
                                                    '@image/'.$itemImage->pic,
                                                    90,
                                                    90,
                                                    EasyThumbnailImage::THUMBNAIL_OUTBOUND
                                                )?>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                    <button
                                        class="button_type_11 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_next">
                                        <i class="fa fa-angle-right "></i>
                                    </button>
                                </div>
                                <div class="d_inline_middle">分享:</div>
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
                                <h2 class="m_bottom_10"><a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>" class="color_dark fw_medium"><?= $item->title?></a></h2>

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
                                    <a href="#" class="d_inline_middle default_t_color f_size_small m_left_5">1 评论 </a>
                                </div>
                                <hr class="m_bottom_10 divider_type_3">
                                <table class="description_table m_bottom_10">
                                    <tr>
                                        <td>库存:</td>
                                        <td ><span class="color_green"></span> <span id="stock"><?= $item->stock?></span> </td>
                                    </tr>

                                </table>
                                <hr class="divider_type_3 m_bottom_15">
                                <div class="m_bottom_15 deal_price">
                                    <s class="v_align_b f_size_ex_large">$152.00</s><span class="v_align_b f_size_big m_left_5 scheme_color fw_medium"><strong><?= $item->price ?></strong></span>
                                </div>

                                <?php
                                $skus = array();
                                $skuModels = $item->skus;
                                foreach ($skuModels as $sku) {

                                    $skuId[]=$sku->sku_id;
                                    $key = implode(';', json_decode($sku->props, true));
                                    $skus[$key] = json_encode(array('price' => $sku->price, 'stock' => $sku->quantity));
                                }
                                ?>
                                <form  method="post" id="deal">
                                    <input type="hidden" id="item_id" name="item_id" value="<?= $item->item_id; ?>"/>
                                    <input type="hidden" name="_frontendCSRF" value="<?= Yii::$app->request->csrfToken ?>"/>
                                    <input type="hidden" id="props" name="props" value="" />

                                    <div class="deal_size" data-sku-key='<?php echo json_encode(array_keys($skus)); ?>'
                                         data-sku-value='<?php echo json_encode($skus); ?>' data-sku-id="<?php if(isset($skuId))echo implode(',',$skuId);else echo $item->item_id; ?>">
                                        <table class="description_table type_2 m_bottom_15">

                                            <!-- Price Starts -->
                                            <!--            <div class="deal_price">-->
                                            <!--                <span class="cor_gray">市场价：<strong>--><?php //echo  $item->price ?><!--</strong>元</span>-->
                                            <!--            </div>-->

                                            <?php
                                            $itemProps = $propValues = array();
                                            $itemPropModels = \star\catalog\models\ItemProp::find()->where(['category_id'=>$item->category_id])->all();
                                            foreach ($itemPropModels as $itemProp) {
                                                $itemProps[$itemProp->prop_id] = $itemProp;
                                                foreach ($itemProp->propValues as $propValue) {
                                                    $propValues[$propValue->value_id] = $propValue;
                                                }
                                            }
                                            $pvids = json_decode($item->props);
                                            foreach ($pvids as $pid => $pvid) {
                                                if (isset($itemProps[$pid]) && $itemProps[$pid]->is_sale_prop) {
                                                    $itemProp = $itemProps[$pid];
                                                    ?>
                                                    <tr><td class="v_align_m"><?php echo $itemProp->prop_name ?>：</td>
                                                        <td class="v_align_m"><div class="custom_select f_size_medium relative d_inline_middle">
                                                                <?php if (is_array($pvid)) {
                                                                    foreach ($pvid as $v) {
                                                                        $ids = explode(':', $v);
                                                                        $propValue = $propValues[$ids[1]];
                                                                        if ($itemProp->is_color_prop && false) {
                                                                            ?>
                                                                            <a href="javascript:void(0)" data-value="<?php echo $v; ?>" id="prop<?php echo str_replace(':','-',$v); ?>">
                                                                                <img alt="<?php echo $propValue->prop_name; ?>"
                                                                                     src="<?php echo isset($propImgs[$v]) ? $propImgs[$v] : ''; ?>"
                                                                                     width="41" height="41"></a>
                                                                        <?php } else { ?>
                                                                            <a href="javascript:void(0)"
                                                                               data-value="<?php echo $v; ?>" id="prop<?php echo str_replace(':','-',$v); ?>"><?php echo $propValue->value_name; ?></a>
                                                                        <?php
                                                                        }
                                                                    }
                                                                } else {
                                                                    $ids = explode(':', $pvid);
                                                                    $propValue = $propValues[$ids[1]];
                                                                    if ($itemProp->is_color_prop && false) {
                                                                        ?>
                                                                        <a href="javascript:void(0)" data-value="<?php echo $pvid; ?>" id="prop<?php echo str_replace(':','-',$v); ?>">
                                                                            <img alt="<?php echo $propValue->prop_name; ?>"
                                                                                 src="<?php echo isset($propImgs[$pvid]) ? $propImgs[$pvid] : ''; ?>"
                                                                                 width="41" height="41"></a>
                                                                    <?php } else { ?>
                                                                        <a href="javascript:void(0)"
                                                                           data-value="<?php echo $pvid; ?>" id="prop<?php echo str_replace(':','-',$v); ?>"><?php echo $propValue->prop_name; ?></a>
                                                                    <?php
                                                                    }
                                                                } ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } ?>

                                            <!-- Price Ends -->
                                            <tr>
                                                <td class="v_align_m">数量:</td>
                                                <td class="v_align_m">
                                                    <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                                                        <button type="button" class="bg_tr d_block f_left" data-direction="down">-</button>
                                                        <input type="text"   value="1" class="f_left" name="qty" id="qty" data-stock="<?= $item->stock?>">
                                                        <button type="button" class="bg_tr d_block f_left" data-direction="up">+</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <?php }
    } ?>

    </section>
    <!--banners-->
    <section class="row clearfix m_bottom_45 m_sm_bottom_35">
        <div class="col-lg-6 col-md-6 col-sm-6 animate_half_tc">
            <a href="#" class="d_block banner wrapper r_corners relative m_xs_bottom_30">
                <img src="<?= $link ?>images/banner_img_1.png" alt="">
								<span class="banner_caption d_block vc_child t_align_c w_sm_auto">
									<span class="d_inline_middle">
										<span class="d_block color_dark tt_uppercase m_bottom_5 let_s">New Collection!</span>
										<span class="d_block divider_type_2 centered_db m_bottom_5"></span>
										<span class="d_block color_light tt_uppercase m_bottom_25 m_xs_bottom_10 banner_title"><b>Colored Fashion</b></span>
										<span class="button_type_6 bg_scheme_color tt_uppercase r_corners color_light d_inline_b tr_all_hover box_s_none f_size_ex_large">Shop Now!</span>
									</span>
								</span>
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 animate_half_tc">
            <a href="#" class="d_block banner wrapper r_corners type_2 relative">
                <img src="<?= $link ?>images/banner_img_2.png" alt="">
								<span class="banner_caption d_block vc_child t_align_c w_sm_auto">
									<span class="d_inline_middle">
										<span class="d_block scheme_color banner_title type_2 m_bottom_5 m_mxs_bottom_5"><b>-50%</b></span>
										<span class="d_block divider_type_2 centered_db m_bottom_5 d_sm_none"></span>
										<span class="d_block color_light tt_uppercase m_bottom_15 banner_title_3 m_md_bottom_5 d_mxs_none">On All<br><b>Sunglasses</b></span>
										<span class="button_type_6 bg_dark_color tt_uppercase r_corners color_light d_inline_b tr_all_hover box_s_none f_size_ex_large">Shop Now!</span>
									</span>
								</span>
            </a>
        </div>
    </section>
    <!--blog-->
    <div class="row clearfix m_bottom_45 m_sm_bottom_35">
        <div class="col-lg-6 col-md-6 col-sm-12 m_sm_bottom_35 blog_animate animate_ftr">
            <div class="clearfix m_bottom_25 m_sm_bottom_20">
                <h2 class="tt_uppercase color_dark f_left">博客</h2>
                <div class="f_right clearfix nav_buttons_wrap">
                    <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large bg_light_color_1 f_left tr_delay_hover r_corners blog_prev"><i class="fa fa-angle-left"></i></button>
                    <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners blog_next"><i class="fa fa-angle-right"></i></button>
                </div>
            </div>
            <!--blog carousel-->
            <div class="blog_carousel">
                <div class="clearfix">
                    <!--image-->
                    <a href="#" class="d_block photoframe relative shadow wrapper r_corners f_left m_right_20 animate_ftt f_mxs_none m_mxs_bottom_10">
                        <img class="tr_all_long_hover" src="<?= $link ?>/images/blog_img_1.jpg" alt="">
                    </a>
                    <!--post content-->
                    <div class="mini_post_content">
                        <h4 class="m_bottom_5 animate_ftr"><a href="#" class="color_dark"><b>Ut tellus dolor, dapibus eget, elementum vel</b></a></h4>
                        <p class="f_size_medium m_bottom_10 animate_ftr">25 January, 2013, 5 comments</p>
                        <p class="m_bottom_10 animate_ftr">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. </p>
                        <a class="tt_uppercase f_size_large animate_ftr" href="#">Read More</a>
                    </div>
                </div>
                <div class="clearfix">
                    <!--image-->
                    <a href="#" class="d_block photoframe relative shadow wrapper r_corners f_left m_right_20 animate_ftt f_mxs_none m_mxs_bottom_10">
                        <img class="tr_all_long_hover" src="<?= $link ?>/images/blog_img_2.jpg" alt="">
                    </a>
                    <!--post content-->
                    <div class="mini_post_content">
                        <h4 class="m_bottom_5 animate_ftr"><a href="#" class="color_dark"><b>Cursus eleifend, elit aenean set amet lorem</b></a></h4>
                        <p class="f_size_medium m_bottom_10 animate_ftr">30 January, 2013, 6 comments</p>
                        <p class="m_bottom_10 animate_ftr">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. </p>
                        <a class="tt_uppercase f_size_large animate_ftr" href="#">Read More</a>
                    </div>
                </div>
                <div class="clearfix">
                    <!--image-->
                    <a href="#" class="d_block photoframe relative shadow wrapper r_corners f_left m_right_20 animate_ftt f_mxs_none m_mxs_bottom_10">
                        <img class="tr_all_long_hover" src="<?= $link ?>/images/blog_img_3.jpg" alt="">
                    </a>
                    <!--post content-->
                    <div class="mini_post_content">
                        <h4 class="m_bottom_5 animate_ftr"><a href="#" class="color_dark"><b>In pede mi, aliquet sit ut tellus dolor</b></a></h4>
                        <p class="f_size_medium m_bottom_10 animate_ftr">1 February, 2013, 12 comments</p>
                        <p class="m_bottom_10 animate_ftr">Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris fermentum dictum magna. </p>
                        <a class="tt_uppercase f_size_large animate_ftr" href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!--testimonials-->
        <div class="col-lg-6 col-md-6 col-sm-12 ti_animate animate_ftr">
            <div class="clearfix m_bottom_25 m_sm_bottom_20">
                <h2 class="tt_uppercase color_dark f_left f_mxs_none m_mxs_bottom_15">评论</h2>
                <div class="f_right clearfix nav_buttons_wrap f_mxs_none">
                    <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large bg_light_color_1 f_left tr_delay_hover r_corners ti_prev"><i class="fa fa-angle-left"></i></button>
                    <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners ti_next"><i class="fa fa-angle-right"></i></button>
                </div>
            </div>
            <!--testimonials carousel-->
            <div class="testiomials_carousel">
                <div>
                    <blockquote class="r_corners shadow f_size_large relative m_bottom_15 animate_ftr">Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis.</blockquote>
                    <img class="circle m_left_20 d_inline_middle animate_ftr" src="<?= $link ?>/images/testimonial_img_1.jpg" alt="">
                    <div class="d_inline_middle m_left_15 animate_ftr">
                        <h5 class="color_dark"><b>Marta Healy</b></h5>
                        <p>Los Angeles</p>
                    </div>
                </div>
                <div>
                    <blockquote class="r_corners shadow f_size_large relative m_bottom_15">Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque.</blockquote>
                    <img class="circle m_left_20 d_inline_middle" src="<?= $link ?>/images/testimonial_img_2.jpg" alt="">
                    <div class="d_inline_middle m_left_15">
                        <h5 class="color_dark"><b>Alan Smith</b></h5>
                        <p>New York</p>
                    </div>
                </div>
                <div>
                    <blockquote class="r_corners shadow f_size_large relative m_bottom_15">Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo. Ut pharetra augue nec augue. Nam elit agna,endrerit sit amet, tincidunt.</blockquote>
                    <img class="circle m_left_20 d_inline_middle" src="<?= $link ?>/images/testimonial_img_3.jpg" alt="">
                    <div class="d_inline_middle m_left_15">
                        <h5 class="color_dark"><b>Anna Johnson</b></h5>
                        <p>Detroid</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--banners-->
    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="#" class="d_block animate_ftb h_md_auto m_xs_bottom_15 banner_type_2 r_corners red t_align_c tt_uppercase vc_child n_sm_vc_child">
								<span class="d_inline_middle">
									<img class="d_inline_middle m_md_bottom_5" src="<?= $link ?>/images/banner_img_3.png" alt="">
									<span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
										<b>100% 满意</b><br><br><span class="color_dark">质量有保证</span>
									</span>
								</span>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="#" class="d_block animate_ftb h_md_auto m_xs_bottom_15 banner_type_2 r_corners green t_align_c tt_uppercase vc_child n_sm_vc_child">
								<span class="d_inline_middle">
									<img class="d_inline_middle m_md_bottom_5" src="<?= $link ?>/images/banner_img_4.png" alt="">
									<span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
										<b>运费全免</b><br><br><span class="color_dark">所有的商品</span>
									</span>
								</span>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <a href="#" class="d_block animate_ftb h_md_auto banner_type_2 r_corners orange t_align_c tt_uppercase vc_child n_sm_vc_child">
								<span class="d_inline_middle">
									<img class="d_inline_middle m_md_bottom_5" src="<?= $link ?>/images/banner_img_5.png" alt="">
									<span class="d_inline_middle m_left_10 t_align_l d_md_block t_md_align_c">
										<b>愉快的交易体验</b><br><br><span class="color_dark">买买买</span>
									</span>
								</span>
            </a>
        </div>
    </div>
    </div>
    </div>
</div>

