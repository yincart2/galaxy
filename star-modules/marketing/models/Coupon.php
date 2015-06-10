<?php

namespace star\marketing\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "coupon".
 *
 * @property integer $coupon_id
 * @property string $coupon_no
 * @property integer $rule_id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $start_at
 * @property integer $end_at
 * @property integer $star_id
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_at', 'end_at'], 'required'],
            [['rule_id', 'order_id', 'user_id', 'status', 'created_at', 'updated_at', 'star_id'], 'integer'],
            ['start_at', 'date', 'format' => 'yyyy-MM-dd HH:mm', 'timestampAttribute' => 'start_at', 'on' => ['insert']],
            ['end_at', 'date', 'format' => 'yyyy-MM-dd HH:mm', 'timestampAttribute' => 'end_at', 'on' => ['insert']],
            ['start_at', 'validateStartAt', 'on' => ['insert']],
            ['end_at', 'validateEndAt', 'on' => ['insert']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'coupon_id' => Yii::t('coupon', 'Coupon ID'),
            'coupon_no' => Yii::t('coupon', 'Coupon No'),
            'rule_id' => Yii::t('coupon', 'Rule ID'),
            'order_id' => Yii::t('coupon', 'Order ID'),
            'user_id' => Yii::t('coupon', 'User ID'),
            'status' => Yii::t('coupon', 'Status'),
            'created_at' => Yii::t('coupon', 'Created At'),
            'updated_at' => Yii::t('coupon', 'Updated At'),
            'start_at' => Yii::t('coupon', 'Start At'),
            'end_at' => Yii::t('coupon', 'End At'),
            'star_id' => Yii::t('coupon', 'Star ID'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ]
        ];
    }

    public function validateStartAt()
    {
        if($this->start_at < time()) {
            $this->addError('start_at', '开始时间不能早于当前时间！');
        }
    }

    public function validateEndAt()
    {
        if($this->start_at > $this->end_at) {
            $this->addError('end_at', '结束时间不能早于开始时间！');
        }
    }
}
