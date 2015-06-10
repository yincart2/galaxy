<?php

namespace star\marking\models;

use Yii;

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
            [['coupon_id', 'coupon_no', 'rule_id', 'created_at', 'updated_at', 'start_at', 'end_at'], 'required'],
            [['coupon_id', 'rule_id', 'order_id', 'user_id', 'status', 'created_at', 'updated_at', 'start_at', 'end_at', 'star_id'], 'integer'],
            [['coupon_no'], 'string', 'max' => 225]
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
}
