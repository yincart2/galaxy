<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-10
 * Time: 下午7:21
 */
namespace star\marketing\controllers\home;

use star\marketing\models\Coupon;
use star\marketing\models\ShoppingCoupon;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use Yii;
class CouponController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' =>AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionValidate(){
        $couponId = Yii::$app->request->post('couponId');
        $shoppingCoupon = Yii::createObject(ShoppingCoupon::className());
        if($couponId!=0){
            if(in_array($couponId, Yii::$app->getSession()->get($shoppingCoupon::SESSION_KEY))){
                return $shoppingCoupon->getResult($couponId);
            }else{
                return Json::encode(['status'=>'fail']);
            }
        }
    }

    /**
     * add a coupon for a user
     * @return string
     */
    public function actionAddCoupon(){
        $couponCode = Yii::$app->request->post('couponCode');
        /**@var $couponModel \star\marketing\models\Coupon **/
        $coupon = Yii::createObject(Coupon::className());
        $couponModel = $coupon::find()->where(['coupon_no'=>$couponCode])->one();
        if($couponModel){
            if($couponModel->end_at>time() && $couponModel->status == 1 && $couponModel-> user_id ==0){
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