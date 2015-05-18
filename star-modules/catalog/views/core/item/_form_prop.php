<div id="item_prop_values">
    <?php
    use yii\helpers\Html;

    if (!isset($itemProps)) {
        $itemProps = \star\catalog\models\ItemProp::findAll(['category_id' => $model->category_id]);
    }
    $i = 0;
    /** @var \star\catalog\models\ItemProp $itemProp */
    foreach ($itemProps as $itemProp) {
        $propValues = $itemProp->propValues;
        $propValueData = array();
        foreach ($propValues as $propValue) {
            $propValueData[$propValue->value_id] = $propValue->value_name;
        }
        $name = 'ItemProp[' . $itemProp->prop_id . ']';
        switch ($itemProp->type) {
            case 1:
                echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                    Html::input('input', $name, null, array(
                        'label' => $itemProp->prop_name, 'class' => 'form-control'
                    )) . '</div>';
                break;
            case 2:
                echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                    Html::dropDownList($name, null, $propValueData, array(
                        'label' => $itemProp->prop_name, 'class' => 'form-control'
                    )) . '</div>';
                break;
            case 3:
                echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                    Html::checkboxList($name, null, $propValueData, array(
                        'label' => $itemProp->prop_name, 'class' => 'inline checkbox', 'id' => 'Item_skus_checkbox_'.$itemProp->prop_id.'_'.$i++,'itemOptions' => array(
                            'class' => 'change',
                            'data-id' => $itemProp->prop_id,
                            'id' => 'Item_skus_checkbox_'.$itemProp->prop_id.'_'.$i++
                        )
                    )) . '</div>';
                break;
        }
    }
    ?>

    <div id="sku_error" class="alert alert-info">您需要选择所有的销售属性，才能组合成完整的规格信息。</div>
    <div class="control-group">
        <div class="sku-map">
            <table id="sku" class="table table-bordered">
                <thead>
                <tr>
                    <th>标签</th>
                    <!--                <th>价格</th>-->
                    <!--                <th>数量</th>-->
                    <!--                <th>商家编码</th>-->
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    <input type="hidden" id="currentRow" value="0"/>
    <input type="hidden" id="skus_info" data-id="<?php echo ($model->item_id) ? $model->item_id : 0; ?>"
           data-url="<?= \yii\helpers\Url::to(['/catalog/core/item/ajax-skus']); ?>" value=""/>
</div>