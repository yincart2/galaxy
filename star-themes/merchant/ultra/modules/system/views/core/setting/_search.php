<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\system\models\SettingSearches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'setting_id') ?>

    <?= $form->field($model, 'menu_code') ?>

    <?= $form->field($model, 'menu_label') ?>

    <?= $form->field($model, 'group_code') ?>

    <?= $form->field($model, 'group_label') ?>

    <?php // echo $form->field($model, 'menu_sort') ?>

    <?php // echo $form->field($model, 'group_sort') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('system', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('system', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
