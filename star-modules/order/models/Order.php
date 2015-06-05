<?php

namespace star\order\models;

use dektrium\user\models\User;
use cluster\modules\cart\models\ShoppingCart;
use star\catalog\models\Sku;
use Yii;
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
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    public $orderItems;

    const STATUS_WAIT_PAYMENT = 1;
    const STATUS_WAIT_SHIPMENT = 2;
    const STATUS_WAIT_CONFIRM  = 3;
    const STATUS_COMPLETE  = 4;
    const STATUS_WAIT_REFUND  = 5;
    const STATUS_REFUND_FAILED  = 6;
    const STATUS_REFUND_PASS  = 7;

    public function getStatusArray(){
        return [
            self::STATUS_WAIT_PAYMENT => '待支付',
            self::STATUS_WAIT_SHIPMENT => '待发货',
            self::STATUS_WAIT_CONFIRM => '待收货',
            self::STATUS_COMPLETE => '订单完成',
            self::STATUS_WAIT_REFUND => '退货中',
            self::STATUS_REFUND_FAILED => '退货未通过',
            self::STATUS_REFUND_PASS => '退货通过',
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

    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'order_id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    //todo
//    public function getPayment()
//    {
//        return $this->hasOne(Payment::className(), ['order_id' => 'order_id']);
//    }

    //todo
//    public function getShipment()
//    {
//        return $this->hasOne(Shipment::className(), ['order_id' => 'order_id']);
//    }

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

    public function saveOrder()
    {
        $orderItems = [];
        $item_id = Yii::$app->request->post('item_id');
        $transaction=\Yii::$app->db->beginTransaction();
        try {
            if (isset($item_id)) {
                $qty = Yii::$app->request->post('qty');
                $data = Yii::$app->request->post('data');
                $sku = Sku::find()->where(['sku_id' => $item_id])->one();
                $item = $sku->item;
                $this->user_id = Yii::$app->user->id;
                $this->shipping_fee = $item->shipping_fee;
                $this->payment_fee = 0;
                $this->status = 1;

                $orderItem = new OrderItem();
                $orderItem->item_id = $item_id;
                //todo groupon
//            if(Yii::$app->session->get('groupon')&& $groupon = Groupon::find()->where(['item_id'=> $orderItem->item_id])->andWhere('begin_time < '.time().' and end_time > '.time())->one()){
//                $orderItem->price =$groupon->price;
//
//            }else{
                $orderItem->price = $sku->price;
//            }
                $this->total_price = $orderItem->price * $qty + $item->shipping_fee;
                $orderItem->qty = $qty;
                $orderItem->name = $item->title;
                if (isset($data)) {
                    $orderItem->data = $data;
                }
//            $pictures = explode(',',$item->pictures);
//            $picUrl = is_array($pictures)?$pictures[0]:$pictures;
//            $orderItem->picture = is_null($picUrl) ? 'default' :$picUrl ;
                $orderItem->picture = 'default';
                if ($this->save()) {
                    $orderItem->order_id = $this->order_id;
                    $orderItem->save();
                } else {
                    throw new Exception('Unable to save order record.');
                }
                $orderItems[] = $orderItem;
            } else {
                $ShoppingCart = new ShoppingCart();
                $this->user_id = Yii::$app->user->id;
                $this->total_price = $ShoppingCart->getTotal();
                /**@TODO attributes  * */
                $this->shipping_fee = $ShoppingCart->getShippingFee();
                $this->payment_fee = 0;
                $this->status = 1;
                if ($this->save()) {
                    $cartItems = $ShoppingCart->cartItems;
                    foreach ($cartItems as $cartItem) {
                        $key = $cartItem->data['key'];
                        $price_true = $cartItem->sku->price;
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $this->order_id;
                        $orderItem->item_id = $cartItem->sku->sku_id;
                        $orderItem->price = $price_true;
                        $orderItem->qty = $cartItem->qty;
                        $orderItem->name = $cartItem->sku->item->title;
                        $orderItem->data = $cartItem->data;
//                $pictures = explode(',',$cartItem->sku->item->pictures);
//                $picUrl = is_array($pictures)?$pictures[0]:$pictures;
//                $orderItem->picture = is_null($picUrl) ? 'default' :$picUrl ;
                        $orderItem->picture = 'default';
                        $orderItems[] = $orderItem;
                        if(!$orderItem->save()) {
                            throw new Exception('Unable to save order item record.');
                        }
                    }
                    $ShoppingCart->clearAll();
                } else {
                    throw new Exception('Unable to save order record.');
                }
            }
            $this->orderItems = $orderItems;
            $this->updateItemStock();
            $transaction->commit();
            return true;
        } catch (\yii\base\Exception $e) {
            $transaction->rollback();
            return false;
        }
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
        foreach($this->orderItems as $orderItem){
            /** @var \star\catalog\models\Sku $item */
            $item = Sku::findOne(['sku_id'=>$orderItem->item_id]);
            $item->quantity = $item->quantity - $orderItem->qty;
            if(!$item->save()){
                throw new Exception('update item fail');
            }
        }
    }
}