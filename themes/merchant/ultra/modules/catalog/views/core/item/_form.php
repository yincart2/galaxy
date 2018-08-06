<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use star\system\models\Tree;
use yii\bootstrap\Tabs;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Url;
use kartik\file\FileInput;
use star\catalog\models\Language;
use star\catalog\models\Currency;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\Item */
/* @var $form yii\widgets\ActiveForm */

list($path, $url) = Yii::$app->assetManager->publish('@star/catalog/assets/js');
$this->registerJsFile($url . '/skus.js', ['depends' => [\core\assets\AppAsset::className()]]);

?>

<div class="row">
    <div class="item-form col-md-12 col-sm-12 col-xs-12">

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]);

        $fieldGroups = [];
        $fields = [];
        $fields[] = $form->field($model, 'title')->textInput(['maxlength' => 255]);
        $currency = Currency::find()->all();
        $fields[] = $form->field($model, 'currency')->dropDownList(ArrayHelper::map($currency, 'currency_id', 'name'));
        $language = Language::find()->all();
        $fields[] = $form->field($model, 'language')->dropDownList(ArrayHelper::map($language, 'language_id', 'name'));
        $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-th-large"></i>' . Yii::t('catalog', 'Base Info'), 'content' => implode('', $fields)];

        $fields = [];
        $fields[] = $form->field($model, 'desc')->widget(CKEditor::className(), [
            'editorOptions' => [
                'filebrowserBrowseUrl' => Url::to(['/elfinder/manager', 'filter' => 'image']),
            ]]);
        $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-edit"></i>' . Yii::t('catalog', 'Detailed Info'), 'content' => implode('', $fields)];

        $fields = [];
        $fields[] = $form->field($model, 'shipping_fee')->textInput(['maxlength' => 255]);
        $fields[] = $form->field($model, 'is_show')->radioList(['No', 'Yes']);
        $fields[] = $form->field($model, 'is_promote')->radioList(['No', 'Yes']);
        $fields[] = $form->field($model, 'is_new')->radioList(['No', 'Yes']);
        $fields[] = $form->field($model, 'is_hot')->radioList(['No', 'Yes']);
        $fields[] = $form->field($model, 'is_best')->radioList(['No', 'Yes']);

        $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-list-alt"></i>' . Yii::t('catalog', 'Other Info'), 'content' => implode('', $fields)];

        $fields = [];
        $fields[] = $form->field($model, 'category_id')->dropDownList(Tree::getTreesByName('商品分类'), [
            'data-url' => Url::to(['/catalog/core/item/item-props']),
            'data-item_id' => $model->item_id,
            'data-tree_id' => $model->category_id ? $model->category_id : key(Tree::getTreesByName('商品分类')),
        ]);
        $fields[] = $this->render('_form_prop', ['model' => $model, 'tree_id' => $model->category_id ? $model->category_id : key(Tree::getTreesByName('商品分类'))]);

        $fieldGroups[] = ['label' => '<i class="glyphicon glyphicon-tag"></i>' . Yii::t('catalog', 'Product Info'), 'content' => implode('', $fields)];

        $fields = [];
        if ($model->isNewRecord) {
            $fields[] = $form->field($model, 'images[]')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => [
                    'allowedFileExtensions' => ['jpg', 'gif', 'png']
                ]
            ]);
        } else {
            $itemImages = $model->itemImgs;
            $initialPreview = $initialPreviewConfig = [];
            foreach ($itemImages as $itemImage) {
                $initialPreview[] = "<img src='" . Yii::$app->params['imageDomain'] . '/' . $itemImage->pic . "' class='file-preview-image'>";
                $initialPreviewConfig[] = [
                    'caption' => $itemImage->title,
                    'url' => Url::to(['/catalog/core/item-img/delete', 'id' => $itemImage->img_id]),
                ];
            }

            $fields[] = $form->field($model, 'images[]')->label(Yii::t('catalog', 'Image(If update,Please upload first)'))->widget(FileInput::classname(), [
                'language' => 'zh',
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => [
                    'initialPreview' => $initialPreview,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'overwriteInitial' => false,
                    'uploadUrl' => Url::to(['/catalog/core/item-img/create']),
                    'uploadExtraData' => [
                        'item_id' => $model->item_id,
                        'position' => count($itemImages)//TODO:  js
                    ],
                    'maxFileCount' => 10,
                    'allowedFileExtensions' => ['jpg', 'gif', 'png']
                ]
            ]);
        }
        $fieldGroups[] = ['label' => '<i class="fa fa-file-image-o"></i>' . Yii::t('catalog', 'Product Image'), 'content' => implode('', $fields)];
        echo Tabs::widget(['items' => $fieldGroups, 'navType' => 'nav-tabs', 'encodeLabels' => false]);
        ?>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('catalog', 'Create') : Yii::t('catalog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
