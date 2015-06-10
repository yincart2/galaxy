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

class ShoppingCoupon extends Component{
    public function init(){
        $this->attachEvent();
    }

    public function attachEvent(){
        $this->on(Order::EVENT_CHANGE_PRICE, [$this, 'validate']);
    }

    public function validate($event){
        /** @var \yii\base\ModelEvent $event */

        $orderModel = $event->sender;
        var_dump($orderModel);exit;
    }

    public function validateCoupon(Coupon $couponModel){
        if($couponModel->start_at<time() && $couponModel->end_at>time() && $couponModel->status == 1){
            return true;
        }
        return false;
    }

    public function validateRule(CouponRule $couponRuleModel){

    }
} 