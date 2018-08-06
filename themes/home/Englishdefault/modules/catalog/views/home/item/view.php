<?php
/**
 * if this view can't show , you should install imagick for php,The EasyThumbnailImage depend on it
 */
use himiklab\thumbnail\EasyThumbnailImage;
use star\system\models\Tree;
use yii\helpers\Url;

/** @var  $itemModel  \star\catalog\models\Item*/

$link = $this->getAssetManager()->getPublishedUrl('@theme/home/default/assets');

$this->registerJsFile($link . '/js/fsku.js',['depends' => [\yii\web\JqueryAsset::className()]] );
$this->registerCssFile($link . '/css/sku.css');

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('catalog','Item View'),
    'template' => '<li><span>{link}</span></li>',
];
?>
<!--content-->
<div class="page_content_offset">
<div class="container">
<div class="row clearfix">
<!--left content column-->
<section class="col-lg-9 col-md-9 col-sm-9 m_xs_bottom_30">
<div class="clearfix m_bottom_30 t_xs_align_c">
    <div class="photoframe type_2 shadow r_corners f_left f_sm_none d_xs_inline_b product_single_preview relative m_right_30 m_bottom_5 m_sm_bottom_20 m_xs_right_0 w_mxs_full">
        <span class="hot_stripe"><img src="images/sale_product.png" alt=""></span>
        <div class="relative d_inline_b m_bottom_10 qv_preview d_xs_block">
            <?php $mainImage= isset($itemImages[0])?$itemImages[0]->pic:'';  ?>
            <?= EasyThumbnailImage::thumbnailImg(
                '@image/'.$mainImage,
                430,
                430,
                EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                ['alt' => $itemImages[0]->title ,'id'=>"zoom_image" ,"data-zoom-image"=>Yii::$app->params['imageDomain'].'/'.$mainImage, "class"=>"tr_all_hover"]
            )?>
            <a href="<?=Yii::$app->params['imageDomain'].'/'.$mainImage?>" class="d_block button_type_5 r_corners tr_all_hover box_s_none color_light p_hr_0">
                <i class="fa fa-expand"></i>
            </a>
        </div>
        <!--carousel-->
        <div class="relative qv_carousel_wrap">
            <button class="button_type_11 bg_light_color_1 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_single_prev">
                <i class="fa fa-angle-left "></i>
            </button>
            <ul class="qv_carousel_single d_inline_middle">
                <?php
                foreach($itemImages as $itemImage){ ?>
                    <a href="#" data-image="<?= Yii::$app->params['imageDomain'].'/'.$itemImage->pic?>" data-zoom-image="images/preview_zoom_1.jpg">
                        <?= EasyThumbnailImage::thumbnailImg(
                            '@image/'.$itemImage->pic,
                            110,
                            110,
                            EasyThumbnailImage::THUMBNAIL_OUTBOUND
                        )?>
                       </a>
                <?php
                }
                ?>
            </ul>
            <button class="button_type_11 bg_light_color_1 t_align_c f_size_ex_large bg_cs_hover r_corners d_inline_middle bg_tr tr_all_hover qv_btn_single_next">
                <i class="fa fa-angle-right "></i>
            </button>
        </div>
    </div>
    <div class="p_top_10 t_xs_align_l">
        <!--description-->
        <h2 class="color_dark fw_medium m_bottom_10"><?= $itemModel->title?></h2>
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
                <td ><span class="color_green">in stock</span> <span id="stock"><?= $itemModel->stock?></span> item(s)</td>
            </tr>
            <tr>
                <td>Product Code:</td>
                <td>PS06</td>
            </tr>
        </table>

        <hr class="divider_type_3 m_bottom_10">
        <p class="m_bottom_10">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing. </p>
        <hr class="divider_type_3 m_bottom_15">
        <div class="m_bottom_15 deal_price">
            <s class="v_align_b f_size_ex_large">$152.00</s><span class="v_align_b f_size_big m_left_5 scheme_color fw_medium"><strong><?= $itemModel->price ?></strong></span>
        </div>

        <?php
        $skus = array();
        foreach ($skuModels as $sku) {

            $skuId[]=$sku->sku_id;
            $key = implode(';', json_decode($sku->props, true));
            $skus[$key] = json_encode(array('price' => $sku->price, 'stock' => $sku->quantity));
        }
        ?>
        <form  method="post" id="deal">
            <input type="hidden" id="item_id" name="item_id" value="<?= $itemModel->item_id; ?>"/>
            <input type="hidden" name="_frontendCSRF" value="<?= Yii::$app->request->csrfToken ?>"/>
            <input type="hidden" id="props" name="props" value="" />

        <div class="deal_size" data-sku-key='<?php echo json_encode(array_keys($skus)); ?>'
             data-sku-value='<?php echo json_encode($skus); ?>' data-sku-id="<?php if(isset($skuId))echo implode(',',$skuId);else echo $itemModel->item_id; ?>">
        <table class="description_table type_2 m_bottom_15">

            <!-- Price Starts -->
<!--            <div class="deal_price">-->
<!--                <span class="cor_gray">市场价：<strong>--><?php //echo  $itemModel->price ?><!--</strong>元</span>-->
<!--            </div>-->

                <?php
                $itemProps = $propValues = array();
                $itemPropModels = \star\catalog\models\ItemProp::find()->where(['category_id'=>$itemModel->category_id])->all();
                foreach ($itemPropModels as $itemProp) {
                    $itemProps[$itemProp->prop_id] = $itemProp;
                    foreach ($itemProp->propValues as $propValue) {
                        $propValues[$propValue->value_id] = $propValue;
                    }
                }
                $pvids = json_decode($itemModel->props);
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
                <td class="v_align_m">Quantity:</td>
                <td class="v_align_m">
                    <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                        <button type="button" class="bg_tr d_block f_left" data-direction="down">-</button>
                        <input type="text"   value="1" class="f_left" name="qty" id="qty" data-stock="<?= $itemModel->stock?>">
                        <button type="button" class="bg_tr d_block f_left" data-direction="up">+</button>
                    </div>
                </td>
            </tr>
        </table>
        </div>
        <div class="d_ib_offset_0 m_bottom_20">
            <button type="button" class="button_type_12 r_corners bg_scheme_color color_light tr_delay_hover d_inline_b f_size_large deal_add_car" data-url="<?= Url::to(['/cart/cart/add']); ?>">Add to Cart</button>
            <button type="button" class="button_type_12 bg_light_color_2 tr_delay_hover d_inline_b r_corners color_dark m_left_5 p_hr_0"><span class="tooltip tr_all_hover r_corners color_dark f_size_small">Wishlist</span><i class="fa fa-heart-o f_size_big"></i></button>
            <button type="button" class="button_type_12 bg_light_color_2 tr_delay_hover d_inline_b r_corners color_dark m_left_5 p_hr_0"><span class="tooltip tr_all_hover r_corners color_dark f_size_small">Compare</span><i class="fa fa-files-o f_size_big"></i></button>
            <button type="button" class="button_type_12 bg_light_color_2 tr_delay_hover d_inline_b r_corners color_dark m_left_5 p_hr_0 relative"><i class="fa fa-question-circle f_size_big"></i><span class="tooltip tr_all_hover r_corners color_dark f_size_small">Ask a Question</span></button>
        </div>
        <p class="d_inline_middle">Share this:</p>
        <div class="d_inline_middle m_left_5 addthis_widget_container">
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

        </form>
    </div>
</div>
<!--tabs-->
<div class="tabs m_bottom_45">
<!--tabs navigation-->
<nav>
    <ul class="tabs_nav horizontal_list clearfix">
        <li class="f_xs_none"><a href="#tab-1" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Description</a></li>
        <li class="f_xs_none"><a href="#tab-2" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Specifications</a></li>
        <li class="f_xs_none"><a href="#tab-3" class="bg_light_color_1 color_dark tr_delay_hover r_corners d_block">Reviews</a></li>
    </ul>
</nav>
<section class="tabs_content shadow r_corners">
<div id="tab-1">
    <?= $itemModel->desc?>
</div>
<div id="tab-2">
    <h5 class="fw_medium m_bottom_15">Item specifics:</h5>
    <div class="row clearfix">
        <?php
        $propName = (array)json_decode($itemModel->props_name);
        $num = count($propName);
        $propName1= array_slice($propName,0,$num/2);
        $propName2= array_slice($propName,$num/2);
        ?>
        <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_15">
            <div class="table_sm_wrap">
                <table class="description_table type_3 m_xs_bottom_10">
                    <?php
                    foreach($propName2 as $key=>$value){
                        $propValue = '';
                        if(is_array($value)){
                            foreach($value as $v){
                                $tmpValue = explode(':',$v);
                                $propValue = $propValue ."'".$tmpValue[1]."', ";
                            }
                        }else{
                            $tmpValue = explode(':',$value);
                            $propValue = $tmpValue[1];
                        }
                        ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $propValue ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_15">
            <div class="table_sm_wrap">
                <table class="description_table type_3 m_xs_bottom_10">
                    <?php
                    foreach($propName1 as $key=>$value){
                        $propValue = '';
                        if(is_array($value)){
                            foreach($value as $v){
                                $tmpValue = explode(':',$v);
                                $propValue = $propValue ."'".$tmpValue[1]."', ";
                            }
                        }else{
                            $tmpValue = explode(':',$value);
                            $propValue = $tmpValue[1];
                        }
                        ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $propValue ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!--<div id="tab-3">-->
<!--    <div class="row clearfix">-->
<!--        <div class="col-lg-8 col-md-8 col-sm-8">-->
<!--            <h5 class="fw_medium m_bottom_15">Last Reviews</h5>-->
<!--            <!--review-->
<!--            <article>-->
<!--                <div class="clearfix m_bottom_10">-->
<!--                    <p class="f_size_medium f_left f_mxs_none m_mxs_bottom_5">By John Smith - Thursday, 26 December 2013</p>-->
<!--                    <!--rating-->
<!--                    <ul class="horizontal_list f_right f_mxs_none clearfix rating_list type_2">-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <p class="m_bottom_15">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit.</p>-->
<!--            </article>-->
<!--            <hr class="m_bottom_15">-->
<!--            <!--review-->
<!--            <article>-->
<!--                <div class="clearfix m_bottom_10">-->
<!--                    <p class="f_size_medium f_left f_mxs_none m_mxs_bottom_5">By Admin - Thursday, 26 December 2013</p>-->
<!--                    <!--rating-->
<!--                    <ul class="horizontal_list f_right f_mxs_none clearfix rating_list type_2">-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <p class="m_bottom_15">Vivamus eget nibh. Etiam cursus leo vel metus. Nulla facilisi. Aenean nec eros. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse sollicitudin velit sed leo.</p>-->
<!--            </article>-->
<!--            <hr class="m_bottom_15">-->
<!--            <!--review-->
<!--            <article>-->
<!--                <div class="clearfix m_bottom_10">-->
<!--                    <p class="f_size_medium f_left f_mxs_none m_mxs_bottom_5">By Alan Doe - Thursday, 26 December 2013</p>-->
<!--                    <!--rating-->
<!--                    <ul class="horizontal_list f_right f_mxs_none clearfix rating_list type_2">-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li class="active">-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                            <i class="fa fa-star active tr_all_hover"></i>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <p class="m_bottom_15">Ut pharetra augue nec augue. Nam elit agna,endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est.</p>-->
<!--            </article>-->
<!--        </div>-->
<!--        <div class="col-lg-4 col-md-4 col-sm-4">-->
<!--            <h5 class="fw_medium m_bottom_15">Write a Review</h5>-->
<!--            <p class="f_size_medium m_bottom_15">Now please write a (short) review....(min. 100, max. 2000 characters)</p>-->
<!--            <form>-->
<!--                <textarea class="r_corners full_width m_bottom_10 review_tarea"></textarea>-->
<!--                <p class="f_size_medium m_bottom_5">First: Rate the product. Please select a rating between 0 (poorest) and 5 stars (best).</p>-->
<!--                <div class="d_block full_width m_bottom_10">-->
<!--                    <div class="d_block m_bottom_5 v_align_m">-->
<!--                        <p class="f_size_medium d_inline_middle m_right_5">Rating:</p>-->
<!--                        <!--rating-->
<!--                        <ul class="horizontal_list clearfix rating_list type_2 d_inline_middle">-->
<!--                            <li class="active">-->
<!--                                <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                                <i class="fa fa-star active tr_all_hover"></i>-->
<!--                            </li>-->
<!--                            <li class="active">-->
<!--                                <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                                <i class="fa fa-star active tr_all_hover"></i>-->
<!--                            </li>-->
<!--                            <li class="active">-->
<!--                                <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                                <i class="fa fa-star active tr_all_hover"></i>-->
<!--                            </li>-->
<!--                            <li class="active">-->
<!--                                <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                                <i class="fa fa-star active tr_all_hover"></i>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                                <i class="fa fa-star active tr_all_hover"></i>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                    <div class="f_size_medium m_bottom_10 d_block">-->
<!--                        <p class="d_inline_middle">Characters written:</p>-->
<!--                        <input type="text" class="r_corners d_inline_middle type_2 m_left_5 m_sm_left_0 m_xs_left_5 mxw_0 small_field" value="0">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <button type="submit" class="r_corners button_type_4 tr_all_hover mw_0 color_dark bg_light_color_2">Submit</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
</section>
</div>
<!--<div class="clearfix">-->
<!--    <h2 class="color_dark tt_uppercase f_left m_bottom_15 f_mxs_none">Related Products</h2>-->
<!--    <div class="f_right clearfix nav_buttons_wrap f_mxs_none m_mxs_bottom_5">-->
<!--        <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left tr_delay_hover r_corners rp_prev"><i class="fa fa-angle-left"></i></button>-->
<!--        <button class="button_type_7 bg_cs_hover box_s_none f_size_ex_large t_align_c bg_light_color_1 f_left m_left_5 tr_delay_hover r_corners rp_next"><i class="fa fa-angle-right"></i></button>-->
<!--    </div>-->
<!--</div>-->
<!--<div class="related_projects m_bottom_15 m_sm_bottom_0 m_xs_bottom_15">-->
<!--<figure class="r_corners photoframe shadow relative d_xs_inline_b tr_all_hover">-->
<!--    <!--product preview-->
<!--    <a href="#" class="d_block relative pp_wrap">-->
<!--        <!--hot product-->
<!--        <span class="hot_stripe type_2"><img src="images/hot_product_type_2.png" alt=""></span>-->
<!--        <img src="images/product_img_5.jpg" class="tr_all_hover" alt="">-->
<!--        <span data-popup="#quick_view_product" class="t_md_align_c button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>-->
<!--    </a>-->
<!--    <!--description and price of product-->
<!--    <figcaption class="t_xs_align_l">-->
<!--        <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Eget elementum vel</a></h5>-->
<!--        <div class="clearfix">-->
<!--            <p class="scheme_color f_left f_size_large m_bottom_15">$102.00</p>-->
<!--            <!--rating-->
<!--            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>-->
<!--    </figcaption>-->
<!--</figure>-->
<!--<figure class="r_corners photoframe shadow relative d_xs_inline_b tr_all_hover">-->
<!--    <!--product preview-->
<!--    <a href="#" class="d_block relative pp_wrap">-->
<!--        <img src="images/product_img_7.jpg" class="tr_all_hover" alt="">-->
<!--        <span data-popup="#quick_view_product" class="t_md_align_c button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>-->
<!--    </a>-->
<!--    <!--description and price of product-->
<!--    <figcaption class="t_xs_align_l">-->
<!--        <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Cursus eleifend elit aenean elit aenean</a></h5>-->
<!--        <div class="clearfix">-->
<!--            <p class="scheme_color f_left f_size_large m_bottom_15">$99.00</p>-->
<!--            <!--rating-->
<!--            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>-->
<!--    </figcaption>-->
<!--</figure>-->
<!--<figure class="r_corners photoframe shadow relative d_xs_inline_b tr_all_hover">-->
<!--    <!--product preview-->
<!--    <a href="#" class="d_block relative pp_wrap">-->
<!--        <!--sale product-->
<!--        <span class="hot_stripe type_2"><img src="images/sale_product_type_2.png" alt=""></span>-->
<!--        <img src="images/product_img_8.jpg" class="tr_all_hover" alt="">-->
<!--        <span data-popup="#quick_view_product" class="t_md_align_c button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>-->
<!--    </a>-->
<!--    <!--description and price of product-->
<!--    <figcaption class="t_xs_align_l">-->
<!--        <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Aliquam erat volutpat</a></h5>-->
<!--        <div class="clearfix">-->
<!--            <p class="scheme_color f_left f_size_large m_bottom_15">$36.00</p>-->
<!--            <!--rating-->
<!--            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>-->
<!--    </figcaption>-->
<!--</figure>-->
<!--<figure class="r_corners photoframe shadow relative d_xs_inline_b tr_all_hover">-->
<!--    <!--product preview-->
<!--    <a href="#" class="d_block relative pp_wrap">-->
<!--        <!--hot product-->
<!--        <span class="hot_stripe type_2"><img src="images/hot_product_type_2.png" alt=""></span>-->
<!--        <img src="images/product_img_3.jpg" class="tr_all_hover" alt="">-->
<!--        <span data-popup="#quick_view_product" class="t_md_align_c button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>-->
<!--    </a>-->
<!--    <!--description and price of product-->
<!--    <figcaption class="t_xs_align_l">-->
<!--        <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Eget elementum vel</a></h5>-->
<!--        <div class="clearfix">-->
<!--            <p class="scheme_color f_left f_size_large m_bottom_15">$102.00</p>-->
<!--            <!--rating-->
<!--            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>-->
<!--    </figcaption>-->
<!--</figure>-->
<!--<figure class="r_corners photoframe shadow relative d_xs_inline_b tr_all_hover">-->
<!--    <!--product preview-->
<!--    <a href="#" class="d_block relative pp_wrap">-->
<!--        <img src="images/product_img_1.jpg" class="tr_all_hover" alt="">-->
<!--        <span data-popup="#quick_view_product" class="t_md_align_c button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>-->
<!--    </a>-->
<!--    <!--description and price of product-->
<!--    <figcaption class="t_xs_align_l">-->
<!--        <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Cursus eleifend elit aenean...</a></h5>-->
<!--        <div class="clearfix">-->
<!--            <p class="scheme_color f_left f_size_large m_bottom_15">$99.00</p>-->
<!--            <!--rating-->
<!--            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>-->
<!--    </figcaption>-->
<!--</figure>-->
<!--<figure class="r_corners photoframe shadow relative d_xs_inline_b tr_all_hover">-->
<!--    <!--product preview-->
<!--    <a href="#" class="d_block relative pp_wrap">-->
<!--        <!--sale product-->
<!--        <span class="hot_stripe type_2"><img src="images/sale_product_type_2.png" alt=""></span>-->
<!--        <img src="images/product_img_9.jpg" class="tr_all_hover" alt="">-->
<!--        <span data-popup="#quick_view_product" class="t_md_align_c button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>-->
<!--    </a>-->
<!--    <!--description and price of product-->
<!--    <figcaption class="t_xs_align_l">-->
<!--        <h5 class="m_bottom_10"><a href="#" class="color_dark ellipsis">Aliquam erat volutpat</a></h5>-->
<!--        <div class="clearfix">-->
<!--            <p class="scheme_color f_left f_size_large m_bottom_15">$36.00</p>-->
<!--            <!--rating-->
<!--            <ul class="horizontal_list f_right clearfix rating_list tr_all_hover">-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li class="active">-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <i class="fa fa-star-o empty tr_all_hover"></i>-->
<!--                    <i class="fa fa-star active tr_all_hover"></i>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0">Add to Cart</button>-->
<!--    </figcaption>-->
<!--</figure>-->
<!--</div>-->
<hr class="divider_type_3 m_bottom_15">
<a href="category_grid.html" role="button" class="d_inline_b bg_light_color_2 color_dark tr_all_hover button_type_4 r_corners"><i class="fa fa-reply m_left_5 m_right_10 f_size_large"></i>Back to: Woman</a>
</section>
<!--right column-->
<aside class="col-lg-3 col-md-3 col-sm-3">
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Categories</h3>
        </figcaption>
        <div class="widget_content">
            <!--Categories list-->
            <ul class="categories_list">
                <?php
                $tree = Tree::find()->where(['name'=>'商品分类'])->one();
                $childrenTags = $tree->children('1')->all();
                foreach($childrenTags as $childrenTag){
                    $secondChildren = $childrenTag->children('1')->all();
                    ?>
                    <li>
                        <a href="#" class="f_size_large color_dark d_block relative">
                            <b><?= $childrenTag->name?></b>
                            <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                        </a>
                    <?php
                    if($secondChildren){ ?>
                        <ul class="d_none">
                            <?php
                            foreach($secondChildren as $secondChild){
                                $thirdChildren = $secondChild->children('1')->all();
                            ?>
                            <li>
                                <a href="#" class=" d_block f_size_large color_dark relative">
                                    <b><?= $secondChild->name?></b>
                                    <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                </a>
                                <?php
                                if($thirdChildren){?>
                                <ul class="d_none">
                                <?php
                                foreach($thirdChildren as $thirdChild){
                                ?>
                                    <li><a href="#" class="color_dark d_block"><?= $thirdChild->name?></a></li>
                                 <?php } ?>
                                </ul>
                                <?php } ?>
                            </li>
                             <?php } ?>
                        </ul>
                    <?php
                    }?>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </figure>
    <!--compare products-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Compare Products</h3>
        </figcaption>
        <div class="widget_content">
            You have no product to compare.
        </div>
    </figure>
    <!--banner-->
    <a href="#" class="d_block r_corners m_bottom_30">
        <img src="images/banner_img_6.jpg" alt="">
    </a>
    <!--Bestsellers-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Bestsellers</h3>
        </figcaption>
        <div class="widget_content">
            <div class="clearfix m_bottom_15">
                <img src="images/bestsellers_img_1.jpg" alt="" class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
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
                <img src="images/bestsellers_img_2.jpg" alt="" class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
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
                <img src="images/bestsellers_img_3.jpg" alt="" class="f_left m_right_15 m_sm_bottom_10 f_sm_none f_xs_left m_xs_bottom_0">
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
    <!--tags-->
    <figure class="widget shadow r_corners wrapper m_bottom_30">
        <figcaption>
            <h3 class="color_light">Tags</h3>
        </figcaption>
        <div class="widget_content">
            <div class="tags_list">
                <a href="#" class="color_dark d_inline_b v_align_b">accessories,</a>
                <a href="#" class="color_dark d_inline_b f_size_ex_large v_align_b">bestseller,</a>
                <a href="#" class="color_dark d_inline_b v_align_b">clothes,</a>
                <a href="#" class="color_dark d_inline_b f_size_big v_align_b">dresses,</a>
                <a href="#" class="color_dark d_inline_b v_align_b">fashion,</a>
                <a href="#" class="color_dark d_inline_b f_size_large v_align_b">men,</a>
                <a href="#" class="color_dark d_inline_b v_align_b">pants,</a>
                <a href="#" class="color_dark d_inline_b v_align_b">sale,</a>
                <a href="#" class="color_dark d_inline_b v_align_b">short,</a>
                <a href="#" class="color_dark d_inline_b f_size_ex_large v_align_b">skirt,</a>
                <a href="#" class="color_dark d_inline_b v_align_b">top,</a>
                <a href="#" class="color_dark d_inline_b f_size_big v_align_b">women</a>
            </div>
        </div>
    </figure>
</aside>
</div>
</div>
</div>
<!--markup footer-->