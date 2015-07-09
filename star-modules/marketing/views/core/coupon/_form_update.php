<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model star\marketing\models\Coupon */
/* @var $form yii\widgets\ActiveForm */

if (isset($model->start_at) && isset($model->end_at)) {
    $model->start_at = date('Y-m-d H:i', $model->start_at);
    $model->end_at = date('Y-m-d H:i', $model->end_at);
    $start_at = $model->start_at;
    $end_at = $model->end_at;
} else {
    $start_at = date('Y-m-d H:i', time());
    $end_at = date('Y-m-d H:i', time());
}
$stations = \core\models\Station::findAll(['enabled' => 1]);
$stationArray = ArrayHelper::map($stations, 'id', 'name');
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin([
        'id' => 'coupon-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]);?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'star_id')->dropDownList($stationArray); ?>

    <?= $form->field($model, 'status')->dropDownList([1 => '是', 0 => '否']); ?>

    <?= $form->field($model, 'start_at')->widget(DateTimePicker::className(), [
        'options' => [
            'value' => $start_at,
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose' => true,
        ]
    ]); ?>

    <?= $form->field($model, 'end_at')->widget(DateTimePicker::className(), [
        'options' => [
            'value' => $end_at,
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose' => true,
        ]
    ]); ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton(Yii::t('marketing', 'Create Coupon'), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
