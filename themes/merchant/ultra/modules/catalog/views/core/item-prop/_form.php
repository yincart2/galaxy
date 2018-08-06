<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use star\system\models\Tree;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\ItemProp */
/* @var $form yii\widgets\ActiveForm */

list($path, $url) = Yii::$app->assetManager->publish('@star/catalog/assets');

$this->registerJsFile($url . '/js/dynoTable.js', ['depends' => [\core\assets\AppAsset::className()]]);

?>
<div class="content-body">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'category_id')->dropDownList(Tree::getTreesByName('商品分类')) ?>

            <?= $form->field($model, 'prop_name')->textInput(['maxlength' => 100]) ?>

            <?= $form->field($model, 'prop_alias')->textInput(['maxlength' => 100]) ?>

            <?= $form->field($model, 'type')->radioList(['1' => '文本框', '2' => '下拉列表', '3' => '多选']) ?>

            <?= $form->field($model, 'is_key_prop')->dropDownList(['0' => '否', '1' => '是']) ?>

            <?= $form->field($model, 'is_sale_prop')->dropDownList(['0' => '否', '1' => '是']) ?>

            <?= $form->field($model, 'is_color_prop')->dropDownList(['0' => '否', '1' => '是']) ?>

            <?= $form->field($model, 'must')->dropDownList(['0' => '否', '1' => '是']) ?>

            <?= $form->field($model, 'multi')->dropDownList(['0' => '否', '1' => '是']) ?>

            <?= $form->field($model, 'status')->dropDownList(['0' => '正常', '1' => '已删除']) ?>

            <?= $form->field($model, 'sort_order')->textInput() ?>

            <h2><a id="add-row" href="javascript:void(0) ">添加属性值</a></h2>
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
                        if ($model->isNewRecord) {
                            ?>
                            <tr id="add-template">
                                <td class="icons">
                                    <img class="drag-handle"
                                         src="<?= $url ?>/img/drag.png"
                                         alt="click and drag to rearrange"/>
                                </td>
                                <td>
                                    <input id="tf1" type="text" name="PropValue[value_name][]"/>
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
//                    $cri = array(
//                        'prop_id ' . $model->prop_id,
//                        'order' => 'sort_order asc, value_id asc'
//                    );
                            $propValues = star\catalog\models\PropValue::find()->where(['prop_id' => $model->prop_id])
                                ->orderBy(['sort_order' => SORT_ASC, 'value_id' => SORT_ASC])->all();

                            foreach ($propValues as $k => $sv) {
                                ?>
                                <tr id="update-template">
                                    <td class="icons">
                                        <img class="drag-handle"
                                             src="<?= $url ?>/img/drag.png"
                                             alt="click and drag to rearrange"/>
                                    </td>
                                    <td>
                                        <input type="hidden" name="PropValue[value_id][]"
                                               value="<?php echo $sv->value_id; ?>"/>
                                        <input id="tf1__c" type="text" name="PropValue[value_name][]"
                                               value="<?php echo $sv->value_name ?>"/>
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

                            <tr id="add-template">
                                <td class="icons">
                                    <img class="drag-handle"
                                         src="<?= $url ?>/img/drag.png"
                                         alt="click and drag to rearrange"/>
                                </td>
                                <td>
                                    <input type="hidden" name="PropValue[value_id][]"/>
                                    <input id="tf1" type="text" name="PropValue[value_name][]"/>
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

            <div class="form-group pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('catalog', 'Create') : Yii::t('catalog', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
