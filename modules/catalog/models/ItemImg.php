<?php

namespace star\catalog\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "{{%item_img}}".
 *
 * @property string $img_id
 * @property string $item_id
 * @property string $pic
 * @property string $title
 * @property integer $position
 * @property string $create_time
 *
 * @property Item $item
 */
class ItemImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%item_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'pic', 'position','title', 'create_time'], 'required'],
            [['item_id', 'position', 'create_time'], 'integer'],
            [['pic','title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'img_id' => Yii::t('catalog', 'Item Img ID'),
            'item_id' => Yii::t('catalog', 'Item ID'),
            'pic' => Yii::t('catalog', '图片url'),
            'position' => Yii::t('catalog', '图片位置'),
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

    public function afterDelete(){
        unlink(Yii::getAlias('@image').'/'.$this->pic);
        parent::afterDelete();
    }
}
