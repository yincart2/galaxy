<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model star\shipment\models\Shipment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="shipment-form">

    <?php $form = ActiveForm::begin(['action' => Url::to(['/shipment/core/shipment/create'])]); ?>

    <?= Html::hiddenInput('Shipment[order_id])', $orderModel->order_id) ?>

    <?= $form->field($model, 'shipment_method')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'trace_no')->textInput(['maxlength' => 255]) ?>

    <?= Html::hiddenInput('Shipment[status])', 1) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>