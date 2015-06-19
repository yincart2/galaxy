<?php

namespace star\catalog\models;

use Yii;

/**
 * This is the model class for table "{{%sku}}".
 *
 * @property string $sku_id
 * @property string $item_id
 * @property string $tag
 * @property string $props
 * @property string $props_name
 * @property string $quantity
 * @property string $price
 * @property string $outer_id
 * @property integer $status
 *
 * @property Item $item
 */
class Sku extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sku}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'props', 'props_name', 'quantity', 'price'], 'required'],
            [['item_id', 'quantity', 'status'], 'integer'],
            [['props', 'props_name'], 'string'],
            [['price'], 'number'],
            [['tag', 'outer_id'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sku_id' => Yii::t('catalog', 'SKU ID'),
            'item_id' => Yii::t('catalog', 'Item ID'),
            'tag' => Yii::t('catalog', 'Tag'),
            'props' => Yii::t('catalog', 'sku的销售属性组合字符串（颜色，大小，等等，可通过类目API获取某类目下的销售属性）,格式是p1:v1;p2:v2'),
            'props_name' => Yii::t('catalog', 'sku所对应的销售属性的中文名字串，格式如：pid1:vid1:pid_name1:vid_name1;pid2:vid2:pid_name2:vid_name2……'),
            'quantity' => Yii::t('catalog', 'sku商品库存'),
            'price' => Yii::t('catalog', 'sku的商品价格'),
            'outer_id' => Yii::t('catalog', '商家设置的外部id'),
            'status' => Yii::t('catalog', 'sku状态。 normal:正常 ；delete:删除'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['item_id' => 'item_id']);
    }

    /**
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return string
     */
    public function getPrice(){
        return $this->price;
    }
}
