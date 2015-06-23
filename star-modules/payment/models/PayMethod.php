<?php

namespace star\payment\models;

use Yii;

/**
 * This is the model class for table "pay_method".
 *
 * @property string $name
 * @property string $config
 * @property integer $status
 */
class PayMethod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pay_method';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name', 'config'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('payment', 'Name'),
            'config' => Yii::t('payment', 'Config'),
            'status' => Yii::t('payment', 'Status'),
        ];
    }

    public static function getName(){
        return 1;
    }
}
