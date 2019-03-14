<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

list($path, $link) = $this->getAssetManager()->publish('@home/modules/cart/web/js');
$this->registerJsFile($link . '/cart.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = Yii::t('app', 'Carts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin();
    foreach ($cartItems as $cartItem) {
        /**@var star\catalog\models\Item $item * */
        $sku = $cartItem->sku;
        $item = $sku->item;
        ?>
        <div>
            <!--            --><?//= Html::img($item->itmImgs); ?>
            <?= Html::hiddenInput('Cart[' . $cartItem->sku_id . '][item_id]', $cartItem->sku_id) ?>
            <?= Html::textInput('Cart[' . $cartItem->sku_id . '][name]', $item->title); ?>
            <?= Html::textInput('Cart[' . $cartItem->sku_id . '][price]', $sku->price); ?>
            <?= Html::textInput('Cart[' . $cartItem->sku_id . '][qty]', $cartItem->qty); ?>
            <?= Html::button(Yii::t('app', 'Remove'), ['class' => 'btn btn-primary remove-item', 'data-item' => $cartItem->sku_id, 'data-url' => Url::to(['cart/remove'])]) ?>

        </div>
    <?php } ?>
    <?= Html::button(Yii::t('app', 'Clear All'), ['class' => 'btn btn-primary clear-all', 'data-url' => Url::to(['cart/clear-all'])]) ?>

    <?= Html::button(Yii::t('app', 'Update Cart'), ['class' => 'btn btn-primary update-cart', 'data-url' => Url::to(['cart/update'])]) ?>
    <?= Html::a(Yii::t('app', 'Create Order'), ['order/index']) ?>
    <?php $form->end(); ?>

</div>
