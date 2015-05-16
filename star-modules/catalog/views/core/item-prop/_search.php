<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\ItemPropSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-prop-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'prop_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'parent_prop_id') ?>

    <?= $form->field($model, 'parent_value_id') ?>

    <?= $form->field($model, 'prop_name') ?>

    <?php // echo $form->field($model, 'prop_alias') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'is_key_prop') ?>

    <?php // echo $form->field($model, 'is_sale_prop') ?>

    <?php // echo $form->field($model, 'is_color_prop') ?>

    <?php // echo $form->field($model, 'must') ?>

    <?php // echo $form->field($model, 'multi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'sort_order') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app','Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app','Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
