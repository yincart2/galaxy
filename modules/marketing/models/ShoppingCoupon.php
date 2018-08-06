<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-10
 * Time: 下午3:13
 */

namespace star\marketing\models;


use star\order\models\Order;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\Json;
use Yii;

class ShoppingCoupon extends Component
{
    const SESSION_KEY = 'couponId';
    const SESSION_COUPON_MODEL_KEY = 'couponModel';

    public function validate(Coupon $couponModel, $cartItems)
    {
        if ($couponModel->start_at < time() && $couponModel->end_at > time() && $couponModel->status == 1 && $couponModel->user_id == \Yii::$app->user->id) {
            $couponRuleModel = $couponModel->couponRule;
            if($couponRuleModel){
                $condition = Json::decode($couponRuleModel->condition);
                $category_id = isset($condition['category_id']) ? $condition['category_id'] : null;
                $orderModel = $this->getOrderModel($category_id, $cartItems);
                foreach ($condition as $key => $value) {
                    if($key!='category_id'){
                        if (!$orderModel->$key >= $value) {
                            return false;
                        }
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * get Order's validate attributes and save them in CouponForm model.
     * @param $category_id
     * @param $cartItems
     * @return CouponForm
     */
    public function getOrderModel($category_id, $cartItems)
    {
        if ($category_id) {
            $tmp = [];
            foreach ($cartItems as $key => $cartItem) {
                if (is_array($category_id)) {
                    if (in_array($cartItem->sku->item->category_id, $category_id)) {
                        $tmp[$key] = $cartItem;
                    }
                } else {
                    if ($cartItem->sku->item->category_id == $category_id) {
                        $tmp[$key] = $cartItem;
                    }
                }
            }
            $cartItems = $tmp;
        }
        $orderModel = Yii::createObject(CouponForm::className());
        if ($cartItems) {
            //todo  $shippingFee
            $totalPrice = $qty = $shippingFee = 0;
            foreach ($cartItems as $carItem) {
                $sku = $carItem->sku;
                $totalPrice += $carItem->qty * $sku->getPrice();
                $qty += $carItem->qty;
            }
        }
        $orderModel->total_price = isset($totalPrice) ?$totalPrice : 0;
        $orderModel->qty = isset($qty) ? $qty: 0;
        $orderModel->shippingFee = isset($shippingFee) ? $shippingFee: 0;
        return $orderModel;
    }


    /**
     * get current user's coupon
     * @param $cartItems
     * @return array
     */
    public function getCouponList($cartItems)
    {
        /** @var  $coupon Coupon */
        $coupons = Coupon::find()->where(['user_id' => \Yii::$app->user->id, 'status' => 1])->all();
        $result = ['usable'=>[\Yii::t('coupon','Please Select One')],'useless'=>[]];
        $couponIdArray = [];
        foreach ($coupons as $coupon) {
            if ($this->validate($coupon, $cartItems)) {
                $couponIdArray[] = $coupon->coupon_id;
                $result['usable'][$coupon->coupon_id] = $coupon->coupon_no;
            } else {
                $result['useless'][$coupon->coupon_id] = $coupon->coupon_no;
            }
        }
        Yii::$app->getSession()->set(self::SESSION_KEY,$couponIdArray);
        return $result;
    }

    /**
     * return couponRule's result to order view
     * @param $couponId
     * @return array
     */
    public function getResult($couponId){
        $couponModel = Coupon::findOne($couponId);
        $couponRuleModel =  $couponModel->couponRule;
        if($couponRuleModel){
            Yii::$app->getSession()->set(self::SESSION_COUPON_MODEL_KEY,$couponId);
            return $couponRuleModel->result;
        }
        return [];
    }

    /**
     * use coupon before create order
     * @param $event
     */
    public function useCoupon($event){
        /** @var  $order Order */
        $order = $event->sender;
        /** @var  $couponModel  Coupon */
        $couponModel = Coupon::findOne(Yii::$app->getSession()->get(self::SESSION_COUPON_MODEL_KEY));
        if($couponModel){
            $couponRuleModel = $couponModel->couponRule;
            $result = Json::decode($couponRuleModel->result);
            if($result['type']){
                $order->total_price = $order->total_price * $result['number'];
            }else{
                $order->total_price = $order->total_price - $result['number'];
            }
            switch($result['shipping']){
                case 1:
                    $order->shipping_fee = $order->shipping_fee - $result['shippingFee'];
                    break;
                case 2:
                    $order->shipping_fee = 0;
            }
            Event::on(Order::className(),Order::EVENT_AFTER_INSERT,[ShoppingCoupon::className(),'updateCouponStatus'],['couponModel'=>$couponModel]);
        }
    }

    /**
     * update coupon's status after order is created
     * @param $event
     */
    public  function updateCouponStatus($event){
        /** @var  $order Order */
        $order = $event->sender;
        $data = $event->data;
        $couponModel = $data['couponModel'];
        $couponModel->order_id = $order->order_id;
        $couponModel->status = $couponModel::STATUS_USED;
        $couponModel->save();
    }
} 