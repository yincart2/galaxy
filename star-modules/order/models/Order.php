<?php

namespace star\order\models;

use dektrium\user\models\User;
use cluster\modules\cart\models\ShoppingCart;
use star\catalog\models\Sku;
use star\payment\models\Payment;
use star\shipment\models\Shipment;
use Yii;
use yii\base\ModelEvent;
use yii\behaviors\TimestampBehavior;
use yii\db\Exception;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $order_no
 * @property string $total_price
 * @property string $shipping_fee
 * @property string $payment_fee
 * @property string $address
 * @property string $memo
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $status
 *
 */
class Order extends \yii\db\ActiveRecord
{
    public $items = [];

    const STATUS_WAIT_PAYMENT = 1;
    const STATUS_WAIT_SHIPMENT = 2;
    const STATUS_WAIT_CONFIRM  = 3;
    const STATUS_COMPLETE  = 4;
    const STATUS_WAIT_REFUND_CHECK  = 5;
    const STATUS_WAIT_REFUND  = 6;
    const STATUS_REFUND_FAILED  = 7;
    const STATUS_REFUND_PASS  = 8;

    const EVENT_CHANGE_PRICE  = 'changeOrderPrice';

    public function getStatusArray(){
        return [
            self::STATUS_WAIT_PAYMENT => Yii::t('order','Wait Payment'),
            self::STATUS_WAIT_SHIPMENT => Yii::t('order','Wait Shipment'),
            self::STATUS_WAIT_CONFIRM => Yii::t('order','Wait Confirm'),
            self::STATUS_COMPLETE => Yii::t('order','Complete'),
            self::STATUS_WAIT_REFUND_CHECK =>  Yii::t('order','Wait Refund Checks'),
            self::STATUS_WAIT_REFUND =>  Yii::t('order','Wait Refund'),
            self::STATUS_REFUND_FAILED =>  Yii::t('order','Refund Failed'),
            self::STATUS_REFUND_PASS => Yii::t('order','Refund Pass'),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['memo', 'default', 'value' => ''],
            ['status', 'integer'],
            [['address', 'memo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('order', 'Order ID'),
            'order_no' => Yii::t('order', 'Order No'),
            'user_id' => Yii::t('order', 'User ID'),
            'total_price' => Yii::t('order', 'Total Price'),
            'shipping_fee' => Yii::t('order', 'Shipping Fee'),
            'payment_fee' => Yii::t('order', 'Payment Fee'),
            'address' => Yii::t('order', 'Address'),
            'memo' => Yii::t('order', 'Memo'),
            'create_at' => Yii::t('order', 'Create At'),
            'update_at' => Yii::t('order', 'Update At'),
            'status' => Yii::t('order', 'Status'),
        ];
    }

    public function getOrderItem()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    //todo
    public function getPayment()
    {
        return $this->hasOne(Payment::className(), ['order_id' => 'order_id']);
    }

    //todo
    public function getShipment()
    {
        return $this->hasOne(Shipment::className(), ['order_id' => 'order_id']);
    }

    //todo
//    public function getRefund()
//    {
//        return $this->hasOne(Refund::className(), ['order_id' => 'order_id']);
//    }

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
     * save order
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return bool
     */
    public function saveOrder()
    {
        $ShoppingCart = Yii::createObject(ShoppingCart::className()) ;
        $cartItems = $ShoppingCart->cartItems;
        foreach($this->items as $skuId => $v){
            $this->items[$skuId] = $cartItems[$skuId];
        }

        $carItems = [];
        foreach($this->items as $skuId=>$carItem){
            $starId = $carItem->star_id;
            $carItems[$carItem->star_id][$skuId] = $carItem;
        }

        if(count($carItems)>1){
            return $this->saveSeveralOrders($carItems);
        }else{
            return $this->saveSingleOrder($this->items,$starId);
        }
    }

    /**
     * todo save several orders
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $carItems, it should be [ 'store_id' => ['sku_id'=> cartModel] ]
     * @return bool
     */
    public function saveSeveralOrders($carItems){ return false;}

    /**
     * save a order for one store
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $carItems , it should be  ['sku_id'=> cartModel]
     * @param $starId
     * @return bool
     */
    public function saveSingleOrder($carItems,$starId){
        $ShoppingCart = Yii::createObject(ShoppingCart::className());
        $transaction=\Yii::$app->db->beginTransaction();
        try {
            $this->user_id = Yii::$app->user->id;
            $this->shipping_fee = $ShoppingCart->getShippingFee();
            $this->payment_fee = 0;
            $this->total_price = $ShoppingCart->getSubTotal(0,$starId)+$this->shipping_fee+$this->payment_fee;
            $this->status =  self::STATUS_WAIT_PAYMENT;
            $this->changePrice();
            if ($this->save()) {
                foreach ($carItems as $cartItem) {
                    $sku =  $cartItem->sku;
                    $item = $sku->item;
                    $price_true =$sku->price;

                    $orderItem = Yii::createObject(OrderItem::className()) ;
                    $orderItem->order_id = $this->order_id;
                    $orderItem->item_id = $sku->sku_id;
                    $orderItem->price = $price_true;
                    $orderItem->qty = $cartItem->qty;
                    $orderItem->name = $item->title;
                    $orderItem->picture =$item->getMainImage();
                    $orderItems[] = $orderItem;
                    if(!$orderItem->save()) {
                        throw new Exception('Unable to save order item record.');
                    }
                }
                foreach ($carItems as $cartItem) {
                    $ShoppingCart->remove($cartItem->sku_id);
                }
            } else {
                throw new Exception('Unable to save order record.');
            }
            $this->items = $orderItems;
            $this->updateItemStock();
            $transaction->commit();
            return true;
        } catch (\yii\base\Exception $e) {
            $transaction->rollback();
            return false;
        }
    }

    /**
     * this event is used to change price before save
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return bool
     */
    public function changePrice()
    {
       $event = new ModelEvent();
       $this->trigger( self::EVENT_CHANGE_PRICE , $event);
    }

    public function getOrderName()
    {
        return $this->order_no;
    }

    public function init()
    {
        parent::init();
        $this->attachEvents();
    }

    public function attachEvents()
    {
        $this->on(static::EVENT_BEFORE_INSERT, [$this, 'generateOrderNo']);
//        $this->on(static::EVENT_AFTER_INSERT, [$this, 'updateItemStock']);
    }

    public function generateOrderNo()
    {
        $this->order_no = date('YmdHis') . rand(1000, 9999);
    }


    public function updateItemStock()
    {
        foreach($this->items as $orderItem){
            /** @var \star\catalog\models\Sku $item */
            $item = Sku::findOne(['sku_id'=>$orderItem->item_id]);
            $item->quantity = $item->quantity - $orderItem->qty;
            if(!$item->save()){
                throw new Exception('update item fail');
            }
        }
    }
}