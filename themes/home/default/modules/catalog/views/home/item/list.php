<?php
/**
 * if this view can't show , you should install imagick for php,The EasyThumbnailImage depend on it
 */
use himiklab\thumbnail\EasyThumbnailImage;
use star\system\models\Tree;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$link = $this->getAssetManager()->getPublishedUrl('@theme/home/default/assets');
$this->registerJsFile($link . '/js/wishlist.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($link . '/js/compare.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = [
    'label' => $currentCategory->name,
    'template' => '<li><span>{link}</span></li>',
];
?>
<!--content-->
<div class="page_content_offset">
<div class="container">
<div class="row clearfix">
<!--left content column-->
<section class="col-lg-9 col-md-9 col-sm-9">
<h2 class="tt_uppercase color_dark m_bottom_25"><?= $currentCategory->name ?></h2>

<div class="clearfix m_bottom_40">
    <div
        class="photoframe f_left shadow wrapper m_right_30 m_sm_bottom_5 m_sm_right_20 m_xs_bottom_15 f_xs_none d_xs_inline_b">
        <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $currentCategory->id])?>">
        <img class="tr_all_long_hover" src="<?= $link ?>/images/category_img_7.jpg" alt="">
        </a>
    </div>
    <p class="m_bottom_10">Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et
        urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consecvtetuer
        adipiscing elit. Mauris fermentum dictum magna. </p>

    <p>Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi
        et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel,
        scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. </p>
</div>
<!--categories nav-->
<?php if(count($categories) != 1 || current($categories)->level != $currentCategory->level) {?>
<nav class="m_bottom_40">
    <ul class="horizontal_list clearfix categories_nav_list m_xs_right_0 t_mxs_align_c">
        <?php
        foreach($categories as $category) {
        ?>
        <li class="m_right_15 f_mxs_none w_mxs_auto d_mxs_inline_b m_mxs_bottom_20">
            <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $category->id])?>" class="d_block photoframe tr_all_hover shadow color_dark r_corners">
											<span class="d_block wrapper">
												<img class="tr_all_long_hover"
                                                     src="<?= $link ?>/images/category_img_2.jpg" alt="">
											</span>
                <?= $category->name ?>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>
<?php }?>
<!--sort-->
<div class="row clearfix m_bottom_10">
    <div class="col-lg-7 col-md-8 col-sm-12 m_sm_bottom_10">
        <p class="d_inline_middle f_size_medium">Sort by:</p>

        <div class="clearfix d_inline_middle m_left_10">
            <!--product name select-->
            <div class="custom_select f_size_medium relative f_left">
                <div class="select_title r_corners relative color_dark">Product name</div>
                <ul class="select_list d_none"></ul>
                <select name="product_name">
                    <option value="Product SKU">Product SKU</option>
                    <option value="Product Price">Product Price</option>
                    <option value="Product ID">Product ID</option>
                </select>
            </div>
            <button
                class="button_type_7 bg_light_color_1 color_dark tr_all_hover r_corners mw_0 box_s_none bg_cs_hover f_left m_left_5">
                <i class="fa fa-sort-amount-asc m_left_0 m_right_0"></i></button>
        </div>
        <!--manufacturer select-->
        <div class="custom_select f_size_medium relative d_inline_middle m_left_15 m_mxs_left_0 m_mxs_top_10">
            <div class="select_title r_corners relative color_dark">Select manufacturer</div>
            <ul class="select_list d_none"></ul>
            <select name="manufacturer">
                <option value="Manufacture 1">Manufacture 1</option>
                <option value="Manufacture 2">Manufacture 2</option>
                <option value="Manufacture 3">Manufacture 3</option>
            </select>
        </div>
    </div>
</div>
<hr class="m_bottom_10 divider_type_3">

<!--products list type-->
<section class="products_container category_grid clearfix m_bottom_15">
<!--product item-->
<?php
/** @var \star\catalog\models\Item $item */
foreach($items as $key=>$item) {
?>
    <div class="product_item hit w_xs_full">
        <figure class="r_corners photoframe type_2 t_align_c tr_all_hover shadow relative">
            <!--product preview-->
            <a href="<?= Url::to(['home/item/view','id' => $item->item_id])?>" class="d_block relative wrapper pp_wrap m_bottom_15">
                <?= EasyThumbnailImage::thumbnailImg(
                    '@image/'.$item->getMainImage(),
                    242,
                    242,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    ['class'=>"tr_all_hover"]
                )?>
                <span role="button" data-popup="#quick_view_product" class="button_type_5 box_s_none color_light r_corners tr_all_hover d_xs_none">Quick View</span>
            </a>
            <!--description and price of product-->
            <figcaption>
                <h5 class="m_bottom_10"><a href="<?= Url::to(['home/item/view','id' => $item->item_id])?>" class="color_dark"><?= $item->title ?></a></h5>
                <!--rating-->
                <ul class="horizontal_list d_inline_b m_bottom_10 clearfix rating_list type_2 tr_all_hover">
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
                <p class="scheme_color f_size_large m_bottom_15">￥<?= $item->price ?></p>
                <a href="<?= Url::to(['home/item/view','id' => $item->item_id])?>" class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_15">查看</a>

            </figcaption>
        </figure>
    </div>

<?php } ?>
</section>
<hr class="m_bottom_10 divider_type_3">
<div class="row clearfix m_bottom_15 m_xs_bottom_30">
    <div class="col-lg-7 col-md-7 col-sm-8 m_xs_bottom_10">
    </div>
    <div class="col-lg-5 col-md-5 col-sm-4 t_align_r t_xs_align_l">
        <!--pagination-->
        <?= LinkPager::widget([
            'pagination' => $pages,
//            'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
//            'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
//            'options' => [
//                'class' => 'horizontal_list clearfix d_inline_middle f_size_medium m_left_10'
//            ],
//            'linkOptions' => [
//                'class' => 'm_right_10 m_left_10'
//            ]
        ]); ?>
    </div>
</div>
</section>
<!--right column-->
<aside class="col-lg-3 col-md-3 col-sm-3">
<!--widgets-->
<figure class="widget shadow r_corners wrapper m_bottom_30">
    <figcaption>
        <h3 class="color_light">Filter</h3>
    </figcaption>
    <div class="widget_content">
        <!--filter form-->
        <form>
            <!--checkboxes-->
            <fieldset class="m_bottom_15">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                    <b class="f_left">Manufacturers</b>
                    <button type="button" class="f_size_medium f_right color_dark bg_tr tr_all_hover close_fieldset"><i
                            class="fa fa-times lh_inherit"></i></button>
                </legend>
                <input type="checkbox" name="" id="checkbox_1" class="d_none"><label for="checkbox_1">Chanel</label><br>
                <input type="checkbox" checked name="" id="checkbox_2" class="d_none"><label for="checkbox_2">Calvin
                    Klein</label><br>
                <input type="checkbox" name="" id="checkbox_3" class="d_none"><label for="checkbox_3">Prada</label><br>
            </fieldset>
            <!--price-->
            <fieldset class="m_bottom_20">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                    <b class="f_left">Price</b>
                    <button type="button" class="f_size_medium f_right color_dark bg_tr tr_all_hover close_fieldset"><i
                            class="fa fa-times lh_inherit"></i></button>
                </legend>
                <div id="price" class="m_bottom_10"></div>
                <div class="clearfix range_values">
                    <input class="f_left first_limit" readonly name="" type="text" value="$0">
                    <input class="f_right last_limit t_align_r" readonly name="" type="text" value="$250">
                </div>
            </fieldset>
            <!--size-->
            <fieldset class="m_bottom_15">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                    <b class="f_left">Size</b>
                    <button type="button" class="f_size_medium f_right color_dark bg_tr tr_all_hover close_fieldset"><i
                            class="fa fa-times lh_inherit"></i></button>
                </legend>
                <input type="radio" name="size" id="radio_1" class="d_none"><label for="radio_1">S</label><br>
                <input type="radio" name="size" checked id="radio_2" class="d_none"><label for="radio_2">M</label><br>
                <input type="radio" name="size" id="radio_3" class="d_none"><label for="radio_3">L</label><br>
            </fieldset>
            <!--color-->
            <fieldset class="m_bottom_25 m_sm_bottom_20">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                    <b class="f_left">Color</b>
                    <button type="button" class="f_size_medium f_right color_dark bg_tr tr_all_hover close_fieldset"><i
                            class="fa fa-times lh_inherit"></i></button>
                </legend>
                <ul class="horizontal_list clearfix">
                    <li class="m_right_5 m_sm_bottom_5">
                        <button type="button" class="select_color red r_corners color_dark active"><i
                                class="fa fa-check lh_inherit tr_all_hover"></i></button>
                    </li>
                    <li class="m_right_5 m_sm_bottom_5">
                        <button type="button" class="select_color blue r_corners color_dark"><i
                                class="fa fa-check lh_inherit tr_all_hover"></i></button>
                    </li>
                    <li class="m_right_5 m_sm_bottom_5">
                        <button type="button" class="select_color green r_corners color_dark"><i
                                class="fa fa-check lh_inherit tr_all_hover"></i></button>
                    </li>
                    <li class="m_right_5 m_sm_bottom_5">
                        <button type="button" class="select_color grey r_corners color_dark"><i
                                class="fa fa-check lh_inherit tr_all_hover"></i></button>
                    </li>
                    <li class="m_right_5 m_sm_bottom_5">
                        <button type="button" class="select_color yellow r_corners color_dark"><i
                                class="fa fa-check lh_inherit tr_all_hover"></i></button>
                    </li>
                </ul>
            </fieldset>
            <fieldset class="m_bottom_25">
                <legend class="default_t_color f_size_large m_bottom_15 clearfix full_width relative">
                    <b class="f_left">Weight</b>
                    <button type="button" class="f_size_medium f_right color_dark bg_tr tr_all_hover close_fieldset"><i
                            class="fa fa-times lh_inherit"></i></button>
                </legend>
                <div class="clearfix">
                    <input type="text" name="" class="r_corners f_left type_2">
                    <input type="text" name="" class="r_corners f_left type_2 m_left_10">
                </div>
            </fieldset>
            <button type="reset" class="color_dark bg_tr text_cs_hover tr_all_hover"><i
                    class="fa fa-refresh lh_inherit m_right_10"></i>Reset
            </button>
        </form>
    </div>
</figure>
<figure class="widget shadow r_corners wrapper m_bottom_30">
    <figcaption>
        <h3 class="color_light">Categories</h3>
    </figcaption>
    <div class="widget_content">
        <!--Categories list-->
        <ul class="categories_list">
            <?php
            $tree = Tree::find()->where(['name' => '商品分类'])->one();
            $childrenTags = $tree->children('1')->all();
            foreach ($childrenTags as $childrenTag) {
                $secondChildren = $childrenTag->children('1')->all();
                ?>
                <li>
                    <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $childrenTag->id])?>" class="f_size_large color_dark d_block relative">
                        <b><?= $childrenTag->name ?></b>
                        <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                    </a>
                    <?php
                    if ($secondChildren) {
                        ?>
                        <ul class="d_none">
                            <?php
                            foreach ($secondChildren as $secondChild) {
                                $thirdChildren = $secondChild->children('1')->all();
                                ?>
                                <li>
                                    <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $secondChild->id])?>" class=" d_block f_size_large color_dark relative">
                                        <b><?= $secondChild->name ?></b>
                                        <span class="bg_light_color_1 r_corners f_right color_dark talign_c"></span>
                                    </a>
                                    <?php
                                    if ($thirdChildren) {
                                        ?>
                                        <ul class="d_none">
                                            <?php
                                            foreach ($thirdChildren as $thirdChild) {
                                                ?>
                                                <li><a href="<?= Url::to(['/catalog/home/item/list','catalog' => $thirdChild->id])?>" class="color_dark d_block"><?= $thirdChild->name ?></a>
                                                </li>
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
<div class="hidden">
<form id="compare_form" method="post" action="<?= Url::to(['/member/compare/index'])?>" >

<input type="text" name="_frontendCSRF" value="<?= Yii::$app->request->csrfToken?>">
</form>
</div>