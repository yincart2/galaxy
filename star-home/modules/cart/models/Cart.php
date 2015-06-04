<?php

namespace home\modules\cart\models;

use star\catalog\models\Sku;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cart".
 *
 * @property string $cart_id
 * @property string $user_id
 * @property string $sku_id
 * @property string $star_id
 * @property string $qty
 * @property string $data
 * @property string $create_time
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sku_id', 'qty' ], 'required'],
            [['user_id', 'sku_id', 'qty', 'create_time','star_id'], 'integer'],
            [['data'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cart_id' => Yii::t('app', 'Cart ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'sku_id' => Yii::t('app', 'Sku ID'),
            'qty' => Yii::t('app', 'Qty'),
            'data' => Yii::t('app', 'Data'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    public function getSku(){
        return $this->hasOne(Sku::className(), ['sku_id' => 'sku_id']);
    }

}
