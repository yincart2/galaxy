<?php

namespace star\marking\models;

use Yii;

/**
 * This is the model class for table "coupon_rule".
 *
 * @property integer $rule_id
 * @property string $desc
 * @property string $condition
 * @property string $result
 */
class CouponRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rule_id', 'result'], 'required'],
            [['rule_id'], 'integer'],
            [['desc', 'condition', 'result'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rule_id' => Yii::t('coupon', 'Rule ID'),
            'desc' => Yii::t('coupon', 'Desc'),
            'condition' => Yii::t('coupon', 'Condition'),
            'result' => Yii::t('coupon', 'Result'),
        ];
    }
}
