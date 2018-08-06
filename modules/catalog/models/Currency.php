<?php

namespace star\catalog\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $currency_id
 * @property string $code
 * @property string $name
 * @property string $sign
 * @property string $rate
 * @property integer $is_default
 * @property integer $enabled
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate'], 'number'],
            [['is_default', 'enabled'], 'integer'],
            [['code'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 20],
            [['sign'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currency_id' => Yii::t('catalog', 'Currency ID'),
            'code' => Yii::t('catalog', 'Code'),
            'name' => Yii::t('catalog', 'Name'),
            'sign' => Yii::t('catalog', 'Sign'),
            'rate' => Yii::t('catalog', 'Rate'),
            'is_default' => Yii::t('catalog', 'Is Default'),
            'enabled' => Yii::t('catalog', 'Enabled'),
        ];
    }
}
