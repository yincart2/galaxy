<?php

namespace star\shipment\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "shipment".
 *
 * @property integer $shipment_id
 * @property integer $order_id
 * @property string $shipment_method
 * @property string $trace_no
 * @property integer $create_at
 * @property integer $status
 */
class Shipment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shipment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'shipment_method', 'trace_no', 'status'], 'required'],
            [['order_id', 'create_at', 'status'], 'integer'],
            [['shipment_method', 'trace_no'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shipment_id' => Yii::t('shipment', 'Shipment ID'),
            'order_id' => Yii::t('shipment', 'Order ID'),
            'shipment_method' => Yii::t('shipment', 'Shipment Method'),
            'trace_no' => Yii::t('shipment', 'Trace No'),
            'create_at' => Yii::t('shipment', 'Create At'),
            'status' => Yii::t('shipment', 'Status'),
        ];
    }

    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => false,
            ]
        ];
    }
}
