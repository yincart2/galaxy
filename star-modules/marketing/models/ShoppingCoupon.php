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
use yii\helpers\Json;

class ShoppingCoupon extends Component{

    public function validate(Coupon $couponModel){
        if($couponModel->start_at<time() && $couponModel->end_at>time() && $couponModel->status == 1){
            $this->validateRule($couponModel->couponRule);
        }
        return false;
    }



    public function validateRule(CouponRule $couponRuleModel){
        $condition = Json::decode($couponRuleModel->condition);
        foreach($condition as $key=> $value){

        }
    }
} 