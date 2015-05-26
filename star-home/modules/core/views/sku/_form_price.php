<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model radar\models\SkuPrice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sku-price-form">

    <?php $form = ActiveForm::begin(['action' => ['update-price', 'id' => !$model->isNewRecord ? $model->price_id : 0]]); ?>

    <?= $form->field($model, 'store_id')->textInput() ?>

    <?= Html::activeHiddenInput($model, 'sku_id') ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'mode')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'currency_id')->textInput() ?>

    <?= $form->field($model, 'is_safe')->textInput() ?>

    <?= $form->field($model, 'shipping_method')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'hao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if (!$model->isNewRecord) { echo  Html::a('Delete', ['delete-price', 'id' => $model->price_id], ['class' => 'btn', 'data' => ['method' => 'post']]); } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
