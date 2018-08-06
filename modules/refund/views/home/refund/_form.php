<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */
/* @var $form yii\widgets\ActiveForm */

/** @var \star\order\models\Order $order */
$order = Yii::createObject(\star\order\models\Order::className());
$order = $order::findOne(['order_id' => $order_id]);
?>

<div class="refund-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'order_id')->textInput(['value' => $order_id,'disabled'=>'disabled']) ?>

    <?= $form->field($model, 'refund_fee')->textInput(['maxlength' => 10,'value' => $order->total_price]) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'image')->fileInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
