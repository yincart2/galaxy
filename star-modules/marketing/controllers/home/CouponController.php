<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-10
 * Time: 下午7:21
 */
namespace star\marketing\controllers\home;

use star\marketing\models\Coupon;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;
class CouponController extends Controller
{

    public function actionValidate(){

    }

    /**
     * add a coupon for a user
     * @return string
     */
    public function actionAddCoupon(){
        $couponCode = Yii::$app->request->post('couponCode');
        /**@var $couponModel \star\marketing\models\Coupon **/
        $couponModel = Coupon::find()->where(['coupon_no'=>$couponCode])->one();
        if($couponModel){
            if($couponModel->start_at<time() && $couponModel->end_at>time() && $couponModel->status == 1 && $couponModel-> user_id ==0){
                $couponModel->user_id = Yii::$app->user->id;
                if($couponModel->save()){
                    return Json::encode(['message'=>Yii::t('coupon','add coupon success!')]);
                }
            }
            return Json::encode(['message'=>Yii::t('coupon','the coupon is useless')]);
        }else{
            return Json::encode(['message'=>Yii::t('coupon','the coupon is not exist')]);
        }
    }
} 