<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model star\marketing\models\Coupon */
/* @var $form yii\widgets\ActiveForm */

if(isset($model->start_at) && isset($model->end_at)) {
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

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'star_id')->dropDownList($stationArray); ?>

    <?= $form->field($model, 'status')->dropDownList([1 => '是',0 => '否']); ?>

    <?= $form->field($model, 'start_at')->widget(DateTimePicker::className(),[
        'options' => [
            'value' => $start_at,
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose'=>true,
        ]
    ]); ?>

    <?= $form->field($model, 'end_at')->widget(DateTimePicker::className(),[
        'options' => [
            'value' => $end_at,
        ],
        'pluginOptions' => [
            'language' => 'zh-CN',
            'autoclose'=>true,
        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('coupon', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
