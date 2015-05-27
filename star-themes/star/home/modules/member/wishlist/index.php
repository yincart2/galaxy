<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['/member/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Wishlist'),
    'template' => '<li><span>{link}</span></li>',
];
$link = $this->getAssetManager()->getPublishedUrl('@theme/star/home/assets');
$this->registerJsFile($link . '/js/wishlist.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<h2 class="tt_uppercase color_dark m_bottom_20">My Wishlist</h2>

<!--wishlist table-->
<?php
if($items) {
?>
<table class="table_type_1 responsive_table full_width t_align_l r_corners wraper shadow bg_light_color_1 m_bottom_30">
    <thead>
    <tr class="f_size_large">
        <!--titles for td-->
        <th>Product Image</th>
        <th>Product Name &amp; Category</th>
        <th>Price</th>
        <th>Quanity</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    /** @var \star\catalog\models\Item $item */
    foreach($items as $item) {
    ?>
    <tr>
        <!--product image-->
        <td data-title="Product Image"><img src="<?= $link?>/images/quick_view_img_10.jpg" alt=""></td>
        <!--product name and category-->
        <td data-title="Product Name">
            <a href="#" class="fw_medium d_inline_b f_size_ex_large color_dark m_bottom_5"><?= $item->title ?></a><br>
            <a href="#" class="default_t_color"><?= $item->category->name?></a>
        </td>
        <!--product price-->
        <td data-title="Price">
            <span class="scheme_color fw_medium f_size_large"><?= $item->price ?></span>
        </td>
        <!--quanity-->
        <td data-title="Quantity">
            <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                <button class="bg_tr d_block f_left" data-direction="down">-</button>
                <input type="text" name="" readonly value="<?= $item->stock ?>" class="f_left">
                <button class="bg_tr d_block f_left" data-direction="up">+</button>
            </div>
        </td>
        <!--add or remove buttons-->
        <td data-title="Action">
            <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_10">Add to
                Cart
            </button>
            <br>
            <a href="#" data-url="<?= Url::to(['/member/wishlist/delete-wishlist','item_id' => $item->item_id])?>" class="delete_wishlist color_dark"><i class="fa fa-times m_right_5"></i> Remove</a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
<hr class="m_bottom_10 divider_type_3">
<div class="row clearfix m_bottom_40">
    <div class="col-lg-7 col-md-7 col-sm-7 f_sx_none m_xs_bottom_10">
        <p class="d_inline_middle f_size_medium">Results 1 - 5 of 45</p>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 t_align_r f_sx_none t_xs_align_l">
        <!--pagination-->
        <?= LinkPager::widget([
            'pagination' => $pages,
            'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
            'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
            'options' => [
                'class' => 'horizontal_list clearfix d_inline_middle f_size_medium m_left_10'
            ],
            'linkOptions' => [
                'class' => 'm_right_10 m_left_10'
            ]
        ]); ?>
    </div>
</div>
<?php } else { ?>
<div class="alert_box r_corners info m_bottom_10">
    <i class="fa fa-info-circle"></i><p>No data in your wishlist!</p>
</div>
<?php } ?>