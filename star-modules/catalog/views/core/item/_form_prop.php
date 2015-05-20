<div id="item_prop_values">
    <?php
    use yii\helpers\Html;

    $itemPropValues = json_decode($model->props, true);
    if (!isset($itemProps)) {
        $itemProps = \star\catalog\models\ItemProp::findAll(['category_id' => $tree_id]);
    }
    $i = 0;
    /** @var \star\catalog\models\ItemProp $itemProp */
    foreach ($itemProps as $itemProp) {
        if (!$itemProp->is_sale_prop) {
            $propValues = $itemProp->propValues;
            $propValueData = array();
            foreach ($propValues as $propValue) {
                $propValueData[$propValue->value_id] = $propValue->value_name;
            }

            $itemPropValue =  '';
            if (isset($itemPropValues[$itemProp->prop_id])) {
                if (is_array($itemPropValues[$itemProp->prop_id])) {
                    $itemPropValue = array();
                    foreach ($itemPropValues[$itemProp->prop_id] as $value) {
                        $values = explode(':', $value);
                        $itemPropValue[] = $values[1];
                    }
                } else {
                    $values = explode(':', $itemPropValues[$itemProp->prop_id]);
                    $itemPropValue = $values[1];
                }
            }

            $name = 'ItemProp[' . $itemProp->prop_id . ']';
            switch ($itemProp->type) {
                case 1:
                    echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                        Html::input('input', $name, $itemPropValue, array(
                            'label' => $itemProp->prop_name, 'class' => 'form-control'
                        )) . '</div>';
                    break;
                case 2:
                    echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                        Html::dropDownList($name, $itemPropValue, $propValueData, array(
                            'label' => $itemProp->prop_name, 'class' => 'form-control'
                        )) . '</div>';
                    break;
                case 3:
                    echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                        Html::checkboxList($name, $itemPropValue, $propValueData ,array(
                            'label' => $itemProp->prop_name, 'class' => 'inline checkbox', 'id' => 'Item_skus_checkbox_' . $itemProp->prop_id . '_' . $i++, 'itemOptions' => array(
                                'data-id' => $itemProp->prop_id,
                            )
                        )) . '</div>';
                    break;
            }
        }
    }
    ?>
    <hr>
    <?php
    $thead = '';
    $i = 0;
    foreach ($itemProps as $itemProp) {
        if ($itemProp->is_sale_prop) {
            $propValues = $itemProp->propValues;
            $propValueData = array();
            foreach ($propValues as $propValue) {
                $propValueData[$propValue->value_id] = $propValue->value_name;
            }

            $itemPropValue =  '';
            if (isset($itemPropValues[$itemProp->prop_id])) {
                if (is_array($itemPropValues[$itemProp->prop_id])) {
                    $itemPropValue = array();
                    foreach ($itemPropValues[$itemProp->prop_id] as $value) {
                        $values = explode(':', $value);
                        $itemPropValue[] = $values[1];
                    }
                } else {
                    $values = explode(':', $itemPropValues[$itemProp->prop_id]);
                    $itemPropValue = $values[1];
                }
            }

            $name = 'Item[skus][checkbox][' . $itemProp->prop_id . ']';
            echo '<div class="form-group"><label class="control-label">' . $itemProp->prop_name . '</label>' .
                Html::checkboxList($name, $itemPropValue, $propValueData, array(
                    'label' => $itemProp->prop_name, 'class' => 'inline checkbox', 'id' => 'Item_skus_checkbox_' . $itemProp->prop_id . '_' . $i++, 'itemOptions' => array(
                        'class' => 'change',
                        'data-id' => $itemProp->prop_id,
                        'id' => 'Item_skus_checkbox_' . $itemProp->prop_id . '_' . $i++
                    )
                )) . '</div>';
            $thead .= '<th><span id="thop_' . $i++ . '">' . $itemProp->prop_name . '</span></th>';
        }
    }
    ?>
    <hr id="output" />
    <div id="sku_error" class="alert alert-info">您需要选择所有的销售属性，才能组合成完整的规格信息。</div>
    <div class="control-group">
        <div class="sku-map">
            <table id="sku" class="table table-bordered">
                <thead>
                <tr>
                    <?php echo $thead; ?>
<!--                    <th>标签</th>-->
                    <th>价格</th>
                    <th>数量</th>
                    <th>商家编码</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

</div>
<input type="hidden" id="currentRow" value="0"/>
<input type="hidden" id="skus_info" data-id="<?php echo $model && $model->item_id ? $model->item_id : 0; ?>"
       data-url="<?= \yii\helpers\Url::to(['/catalog/core/item/ajax-skus']); ?>" value=""/>

<div id="hint-contentbox" style="display: none">
    <div class="batch-body">
    </div>
    <div class="batch-foot">
        <a class="btn btn-success" id="btnPopSub" href="javascript:void(0)">确定</a>
        <a class="btn btn-info cancel" id="btnPopCancel" href="javascript:void(0)">取消</a>
    </div>
</div>