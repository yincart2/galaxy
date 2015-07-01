<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\system\models\Setting */
/* @var $form yii\widgets\ActiveForm */

list($path,$url) = Yii::$app->assetManager->publish('@star/system/assets');

$this->registerJsFile($url . '/js/dynoTable.js', ['depends' => [\core\assets\AppAsset::className()]]);
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'menu_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'group_label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'menu_sort')->textInput() ?>

    <?= $form->field($model, 'group_sort')->textInput() ?>

    <h2><a id="add-row" href="javascript:void(0) ">添加属性值</a></h2>
    如果选择type是 radio或者Checklist，  value填入的值需要是json数组，例子：{"1":"激活","2":"未激活"} 默认选择放在最后的值
    <fieldset>
        <legend>属性值</legend>
        <div class="PropValues">
            <table id="add_prop" class="example">
                <tr>
                    <th>移动</th>
                    <th>属性值名称</th>
                    <th>克隆</th>
                    <th>删除</th>
                </tr>
                <?php
                $SettingFieldsModel = Yii::createObject(\star\system\models\SettingFields::className());
                if ($model->isNewRecord) {
                    ?>
                    <tr id="add-template">
                        <td class="icons">
                            <img class="drag-handle"
                                 src="<?= $url ?>/img/drag.png"
                                 alt="click and drag to rearrange"/>
                        </td>
                        <td>
                            <?= Html::label(Yii::t('system','type').':')?>
                            <?= Html::dropDownList('SettingFields[type][]',null,[$SettingFieldsModel->getStatusArray()],['id'=>'tf1'])?>
                            <?= Html::label(Yii::t('system','fields code').':')?>
                            <?= Html::textInput('SettingFields[fields_code][]',null,['id'=>'tf1'])?>
                            <?= Html::label(Yii::t('system','fields label').':')?>
                            <?= Html::textInput('SettingFields[fields_label][]',null,['id'=>'tf1'])?>
                            <?= Html::label(Yii::t('system','value').':')?>
                            <?= Html::textInput('SettingFields[value][]',null,['id'=>'tf1'])?>
                        </td>
                        <td class="icons">
                            <img class="row-cloner"
                                 src="<?= $url ?>/img/clone.png"
                                 alt="Clone Row"/>
                        </td>
                        <td class="icons">
                            <img class="row-remover"
                                 src="<?= $url ?>/img/remove.png"
                                 alt="Remove Row"/>
                        </td>
                    </tr>
                <?php
                } else {
                    $SettingFields = $model->settingFields;

                    foreach ($SettingFields as $k => $SettingFieldsModel) {
                        ?>
                        <tr id="update-template">
                            <td class="icons">
                                <img class="drag-handle"
                                     src="<?= $url ?>/img/drag.png"
                                     alt="click and drag to rearrange"/>
                            </td>
                            <td>
                                <?= Html::hiddenInput('SettingFields[setting_fields_id][]',$SettingFieldsModel->setting_fields_id)?>
                                <?= Html::label(Yii::t('system','type').':')?>
                                <?= Html::dropDownList('SettingFields[type][]',$SettingFieldsModel->type,[$SettingFieldsModel->getStatusArray()],['id'=>'tf1'])?>
                                <?= Html::label(Yii::t('system','fields code').':')?>
                                <?= Html::textInput('SettingFields[fields_code][]',$SettingFieldsModel->fields_code,['id'=>'tf1'])?>
                                <?= Html::label(Yii::t('system','fields label').':')?>
                                <?= Html::textInput('SettingFields[fields_label][]',$SettingFieldsModel->fields_label,['id'=>'tf1'])?>
                                <?= Html::label(Yii::t('system','value').':')?>
                                <?= Html::textInput('SettingFields[value][]',$SettingFieldsModel->value,['id'=>'tf1'])?>
                            </td>
                            <td class="icons">
                                <img class="row-cloner"
                                     src="<?= $url ?>/img/clone.png"
                                     alt="Clone Row"/>
                            </td>
                            <td class="icons">
                                <img class="row-remover"
                                     src="<?= $url ?>/img/remove.png"
                                     alt="Remove Row"/>
                            </td>
                        </tr>
                    <?php }?>

                    <tr id="add-template">
                        <td class="icons">
                            <img class="drag-handle"
                                 src="<?= $url ?>/img/drag.png"
                                 alt="click and drag to rearrange"/>
                        </td>
                        <td>
                            <?= Html::hiddenInput('SettingFields[setting_fields_id][]')?>
                            <?= Html::label(Yii::t('system','type').':')?>
                            <?= Html::dropDownList('SettingFields[type][]',null,[$SettingFieldsModel->getStatusArray()],['id'=>'tf1'])?>
                            <?= Html::label(Yii::t('system','fields code').':')?>
                            <?= Html::textInput('SettingFields[fields_code][]',null,['id'=>'tf1'])?>
                            <?= Html::label(Yii::t('system','fields label').':')?>
                            <?= Html::textInput('SettingFields[fields_label][]',null,['id'=>'tf1'])?>
                            <?= Html::label(Yii::t('system','value').':')?>
                            <?= Html::textInput('SettingFields[value][]',null,['id'=>'tf1'])?>
                        </td>
                        <td class="icons">
                            <img class="row-cloner"
                                 src="<?= $url ?>/img/clone.png"
                                 alt="Clone Row"/>
                        </td>
                        <td class="icons">
                            <img class="row-remover"
                                 src="<?= $url ?>/img/remove.png"
                                 alt="Remove Row"/>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </fieldset>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('system', 'Create') : Yii::t('system', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
