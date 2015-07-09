<?php
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['/member/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Wishlist'),
    'template' => '<li><span>{link}</span></li>',
];
$this->params['wishlist'] = true;
$link = $this->getAssetManager()->getPublishedUrl('@theme/cluster/default/assets');
$this->registerJsFile($link . '/js/wishlist.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<h1>My Wishlist</h1>
<?php
if($items) {
?>
<div class="table_wrap">

<table class="table_type_1 wishlist_table">

<thead>

<tr>

    <th class="product_image_col">Product Image</th>
    <th class="product_title_col">Product Name and Category</th>
    <th class="product_price_col">Price</th>
    <th class="product_qty_col">Quantity</th>
    <th>Action</th>

</tr>

</thead>

<tbody>
<?php
/** @var \star\catalog\models\Item $item */
foreach($items as $item) {
    ?>
<tr>

    <!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->

    <td data-title="Product Image">

        <a href="#"><img src="<?= $link?>/images/product_thumb_4.jpg" alt=""></a>

    </td>

    <!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

    <td data-title="Product Name and Category">
<!--        <div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap;width:259px;" >-->
            <a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>" class="product_title" title="<?= $item->title ?>">
                <?= $item->title ?></a><br>
<!--        </div>-->
        <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $item->category->id])?>"><?= $item->category->name?></a>
    </td>

    <!-- - - - - - - - - - - - - - End of product name & category - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product price - - - - - - - - - - - - - - - - -->

    <td data-title="Price" class="total"><?= $item->price ?></td>

    <!-- - - - - - - - - - - - - - End of product price - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product quantity - - - - - - - - - - - - - - - - -->

    <td data-title="Quantity">

        <div class="qty min clearfix">

            <button class="theme_button" data-direction="minus">&#45;</button>
            <input type="text" name="" value="1">
            <button class="theme_button" data-direction="plus">&#43;</button>

        </div><!--/ .qty.min.clearfix-->

    </td>

    <!-- - - - - - - - - - - - - - End of product quantity - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

    <td data-title="Action">

        <ul class="buttons_col">

            <li>
                <a href="#" class="button_blue">Add to Cart</a>
            </li>

            <li>
                <?= Html::a('Remove', ['delete-wishlist', 'item_id' => $item->item_id], [
                    'class' => 'button_dark_grey',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </li>

        </ul>

    </td>

    <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

</tr>
<?php } ?>
</tbody>

</table>

</div><!--/ .table_wrap -->

<footer class="bottom_box on_the_sides">

    <div class="left_side v_centered">

    </div>

    <div class="right_side">

        <!--pagination-->
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>

    </div>

</footer><!--/ .bottom_box -->

<?php } else { ?>
    <div class="alert_box info">
        <p>No data in your wishlist!</p>
    </div>
<?php } ?>