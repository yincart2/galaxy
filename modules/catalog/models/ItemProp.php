<?php

namespace star\catalog\models;

use Yii;
use star\system\models\Tree;

/**
 * This is the model class for table "{{%item_prop}}".
 *
 * @property string $prop_id
 * @property string $category_id
 * @property string $parent_prop_id
 * @property string $parent_value_id
 * @property string $prop_name
 * @property string $prop_alias
 * @property integer $type
 * @property integer $is_key_prop
 * @property integer $is_sale_prop
 * @property integer $is_color_prop
 * @property integer $must
 * @property integer $multi
 * @property integer $status
 * @property integer $sort_order
 *
 * @property PropValue[] $propValues
 */
class ItemProp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_prop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'prop_name', 'type'], 'required'],
            [['category_id', 'parent_prop_id', 'parent_value_id', 'type', 'is_key_prop', 'is_sale_prop', 'is_color_prop', 'must', 'multi', 'status', 'sort_order'], 'integer'],
            [['prop_name', 'prop_alias'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prop_id' => Yii::t('catalog', '属性 ID 例：品牌的PID=20000'),
            'category_id' => Yii::t('catalog', '分类'),
            'parent_prop_id' => Yii::t('catalog', '上级属性ID'),
            'parent_value_id' => Yii::t('catalog', '上级属性值ID'),
            'prop_name' => Yii::t('catalog', '属性名称'),
            'prop_alias' => Yii::t('catalog', '属性别名'),
            'type' => Yii::t('catalog', '属性值类型。可选值：input(输入)、optional（枚举）multiCheck （多选）'),
            'is_key_prop' => Yii::t('catalog', '是否关键属性。可选值:1(是),0(否),搜索属性'),
            'is_sale_prop' => Yii::t('catalog', '是否销售属性。可选值:1(是),0(否)'),
            'is_color_prop' => Yii::t('catalog', '是否颜色属性。可选值:1(是),0(否)'),
            'must' => Yii::t('catalog', '发布产品或商品时是否为必选属性。可选值:1(是),0(否)'),
            'multi' => Yii::t('catalog', '发布产品或商品时是否可以多选。可选值:1(是),0(否)'),
            'status' => Yii::t('catalog', '状态。可选值:0(正常),1(删除)'),
            'sort_order' => Yii::t('catalog', '排序'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropValues()
    {
        return $this->hasMany(PropValue::className(), ['prop_id' => 'prop_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Tree::className(), ['id' => 'category_id']);
    }

}
