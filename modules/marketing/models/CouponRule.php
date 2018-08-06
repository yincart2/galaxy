<?php

namespace star\marketing\models;

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
            [['result'], 'required'],
            [['desc', 'condition', 'result'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rule_id' => Yii::t('marketing', 'Rule ID'),
            'desc' => Yii::t('marketing', 'Desc'),
            'condition' => Yii::t('marketing', 'Condition'),
            'result' => Yii::t('marketing', 'Result'),
        ];
    }
}
