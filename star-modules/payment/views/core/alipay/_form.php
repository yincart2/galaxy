<?php
/**
 * Created by changhai.lin.
 * Date: 11/27/2014 10:20 AM
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\payment\forms\AlipayForm */
/* @var $form ActiveForm */
?>
<div class="AlipayForm">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'seller_email')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'out_trade_no')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'subject')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'price')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'body')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'show_url')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'receive_name')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'receive_address')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'receive_zip')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'receive_phone')->input('text',['value' => 'test','readonly' => 'readonly']) ?>
    <?= $form->field($model, 'receive_mobile')->input('text',['value' => 'test','readonly' => 'readonly']) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>