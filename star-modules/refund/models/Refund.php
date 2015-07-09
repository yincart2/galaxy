<?php
/**
 * Created by PhpStorm.
 * User: chalin
 * Date: 6/24/2015
 * Time: 2:50 PM
 */

namespace star\refund\models;


use yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * Class Refund
 *
 * @property integer $refund_id
 * @property integer $order_id
 * @property integer $refund_fee
 * @property string $reason
 * @property string $memo
 * @property string $image
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $status
 *
 * @package star\refund\models
 */

class Refund extends ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%refund}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'refund_fee', 'reason', 'memo'], 'required'],
            [['order_id', 'status'], 'integer'],
            [['refund_fee'], 'number'],
            [['reason', 'memo','image'], 'string', 'max' => 255],
            [['image'],'file','extensions' => 'png,jpg'],
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'refund_id' => Yii::t('refund', 'Refund ID'),
            'order_id' => Yii::t('refund', 'Order ID'),
            'refund_fee' => Yii::t('refund', 'Refund Fee'),
            'reason' => Yii::t('refund', 'Reason'),
            'memo' => Yii::t('refund', 'Memo'),
            'image' => Yii::t('refund', 'Image'),
            'create_at' => Yii::t('refund', 'Create At'),
            'update_at' => Yii::t('refund', 'Update At'),
            'status' => Yii::t('refund', 'Status'),
        ];
    }
} 