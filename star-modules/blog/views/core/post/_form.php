<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use star\system\models\Tree;
use mihaildev\ckeditor\CKEditor;
use kartik\widgets\Select2;
use common\modules\blog\models\Tag;
use yii\helpers\ArrayHelper;
use common\modules\blog\models\Lookup;

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

    <?= $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]) ?>

    <?= $form->field($model, 'tags')->textInput()
//    widget(Select2::classname(), [
//        'data' => ArrayHelper::map(Tag::find()->select('name')->all(), 'name', 'name'),
//        'language' => 'zh-CN',
//        'options' => ['multiple' => true, 'placeholder' => 'Select a state ...'],
//        'pluginOptions' => [
//            'allowClear' => true
//        ],
//    ]) ?>

    <?= $form->field($model, 'status')->dropDownList(Lookup::items('PostStatus')) ?>

    <?php // $form->field($model, 'status')->dropDownList(['0'=>'草稿', '1'=>'审核', '2'=>'已发布']) ?>

    <?= $form->field($model, 'allow_comment')->radioList(['0'=>'不允许', '1'=>'允许']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>