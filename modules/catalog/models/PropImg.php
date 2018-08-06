<?php

namespace star\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%prop_img}}".
 *
 * @property string $prop_img_id
 * @property string $item_id
 * @property string $item_prop_value
 * @property string $pic
 * @property string $create_time
 *
 * @property Item $item
 */
class PropImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%prop_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'item_prop_value', 'pic', 'create_time'], 'required'],
            [['item_id', 'create_time'], 'integer'],
            [['item_prop_value', 'pic'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'prop_img_id' => Yii::t('catalog', 'Prop Img ID'),
            'item_id' => Yii::t('catalog', 'Item ID'),
            'item_prop_value' => Yii::t('catalog', '图片所对应的属性组合的字符串'),
            'pic' => Yii::t('catalog', '图片url'),
            'create_time' => Yii::t('catalog', '创建时间'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }
}
