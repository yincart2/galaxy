<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\system\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'setting_id')->textInput() ?>

    <?= $form->field($model, 'menu_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_sort')->textInput() ?>

    <?= $form->field($model, 'group_sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('system', 'Create') : Yii::t('system', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
