<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Tree;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(Tree::getTreesByName('商品分类')) ?>

    <?= $form->field($model, 'outer_id')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'stock')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'min_number')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'currency')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'props')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'props_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'shipping_fee')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'is_show')->textInput() ?>

    <?= $form->field($model, 'is_promote')->textInput() ?>

    <?= $form->field($model, 'is_new')->textInput() ?>

    <?= $form->field($model, 'is_hot')->textInput() ?>

    <?= $form->field($model, 'is_best')->textInput() ?>

    <?= $form->field($model, 'click_count')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'wish_count')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'review_count')->textInput() ?>

    <?= $form->field($model, 'deal_count')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'update_time')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
