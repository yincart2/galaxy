<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Tree;

/* @var $this yii\web\View */
/* @var $model radar\models\SkuStandard */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sku-standard-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->dropDownList(Tree::getTreesByName('Star Radar')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'attribute')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
