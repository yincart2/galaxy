<?php

namespace star\account\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "money_log".
 *
 * @property integer $money_log_id
 * @property integer $user_id
 * @property integer $money
 * @property integer $type
 * @property string $info
 * @property integer $create_at
 * @property integer $update_at
 */
class MoneyLog extends \yii\db\ActiveRecord
{
    const STATUS_INCOME = 1;
    const STATUS_EXPEND = 2;

    public function getStatusArray()
    {
        return [
            self::STATUS_INCOME => Yii::t('account', 'Wait Pay'),
            self::STATUS_EXPEND => Yii::t('account', 'Has Payed'),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'money_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','money', 'type',], 'required'],
            [['user_id', 'money', 'type', 'create_at', 'update_at'], 'integer'],
            [['info'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'money_log_id' => Yii::t('account', 'Money Log ID'),
            'user_id' => Yii::t('account', 'User ID'),
            'money' => Yii::t('account', 'Money'),
            'type' => Yii::t('account', 'Type'),
            'info' => Yii::t('account', 'Info'),
            'create_at' => Yii::t('account', 'Create Time'),
            'update_at' => Yii::t('account', 'Update Time'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
            ]
        ];
    }
}
