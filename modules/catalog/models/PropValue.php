<?php

namespace star\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%prop_value}}".
 *
 * @property string $value_id
 * @property string $prop_id
 * @property string $value_name
 * @property string $value_alias
 * @property integer $status
 * @property integer $sort_order
 *
 * @property ItemProp $prop
 */
class PropValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%prop_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prop_id', 'value_name', 'value_alias', 'status'], 'required'],
            [['prop_id', 'status', 'sort_order'], 'integer'],
            [['value_name', 'value_alias'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'value_id' => Yii::t('catalog', '属性值ID'),
            'prop_id' => Yii::t('catalog', 'Prop ID'),
            'value_name' => Yii::t('catalog', '属性值'),
            'value_alias' => Yii::t('catalog', '属性值别名'),
            'status' => Yii::t('catalog', '状态。可选值:normal(正常),deleted(删除)'),
            'sort_order' => Yii::t('catalog', '排列序号。取值范围:大于零的整数'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProp()
    {
        return $this->hasOne(ItemProp::className(), ['prop_id' => 'prop_id']);
    }
}
