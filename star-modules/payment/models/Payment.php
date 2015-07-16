<?php

namespace star\payment\models;

use star\payment\models\paypal\PayPal;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "payment".
 *
 * @property integer $payment_id
 * @property integer $order_id
 * @property integer $payment_method
 * @property string $payment_fee
 * @property string $transcation_no
 * @property integer $create_at
 * @property integer $status
 */
class Payment extends \yii\db\ActiveRecord
{
    const ALIPAY = 1;
    const PAYPAL = 2;

    const STATUS_WAIT_BUYER_PAY = 0;
    const STATUS_BUYER_PAY = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'payment_method', 'payment_fee', 'transcation_no',  'status'], 'required'],
            [['order_id', 'payment_method', 'create_at', 'status'], 'integer'],
            [['payment_fee'], 'number'],
            [['transcation_no'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'payment_id' => Yii::t('payment', 'Payment ID'),
            'order_id' => Yii::t('payment', 'Order ID'),
            'payment_method' => Yii::t('payment', 'Payment Method'),
            'payment_fee' => Yii::t('payment', 'Payment Fee'),
            'transcation_no' => Yii::t('payment', 'Transcation No'),
            'create_at' => Yii::t('payment', 'Create At'),
            'status' => Yii::t('payment', 'Status'),
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

    public function getPayList(){
        return [
            self::ALIPAY=>Yii::t('payment','AliPay'),
            self::PAYPAL=>Yii::t('payment','PayPal'),
        ];
    }

    public function getRedirectUrl($payMethod,$orderId){
        switch($payMethod){
            case  self::ALIPAY:
                return Url::to(['/payment/home/alipay/index', 'id' => $orderId]);
            case  self::PAYPAL:
                return Yii::createObject(PayPal::className())->pay($orderId);
        }
    }
}
