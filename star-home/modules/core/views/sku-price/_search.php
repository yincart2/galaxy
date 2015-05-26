<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model radar\models\SkuPriceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sku-price-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'price_id') ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'sku_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'mode') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'is_safe') ?>

    <?php // echo $form->field($model, 'shipping_method') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'hao') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
