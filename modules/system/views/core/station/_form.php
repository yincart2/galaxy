<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model core\models\Station */
/* @var $form yii\widgets\ActiveForm */

$model->start_date = date('Y-m-d', $model->start_date);
$model->end_date = date('Y-m-d', $model->end_date);
?>

<div class="station-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'detail')->widget(\mihaildev\ckeditor\CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]) ?>

    <?= $form->field($model, 'enabled')->dropDownList(['0'=>'不启用', '1'=>'启用']) ?>

    <?= $form->field($model, 'start_date')->widget(\kartik\widgets\DatePicker::className(), [
        'options' => ['placeholder' => 'Select operating time ...', 'value'=>date('Y-m-d', time())],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'todayHighlight' => true
        ]
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(\kartik\widgets\DatePicker::className(), [
        'options' => ['placeholder' => 'Select operating time ...', 'value'=>date('Y-m-d', time()+365*24*60*60)],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'yyyy-MM-dd',
            'todayHighlight' => true
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
