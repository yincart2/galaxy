<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use star\system\models\Tree;

/* @var $this yii\web\View */
/* @var $model common\modules\blog\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(Tree::getTreesByName('内容分类')) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->widget(\mihaildev\ckeditor\CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]) ?>

    <?= $form->field($model, 'tags')->widget(\kartik\widgets\Select2::classname(), [
        'data' => ['aaa' => 'aaa', 'bbb' => 'bbb'],
        'language' => 'de',
        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'status')->dropDownList([]) ?>

    <?= $form->field($model, 'views')->textInput() ?>

    <?= $form->field($model, 'allow_comment')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>