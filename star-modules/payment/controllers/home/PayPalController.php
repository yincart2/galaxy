<?php

namespace star\payment\controllers\home;


use star\payment\models\Payment;
use star\payment\models\paypal\PayPal;
use yii\base\Exception;
use yii\filters\AccessControl;
use Yii;
class PayPalController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionReturn(){
        if (isset($_GET['success']) && $_GET['success'] == '1') {
            $PayPalModel =  Yii::createObject(PayPal::className());
            $payPalPayment = $PayPalModel->executePayment(\Yii::$app->request->get('paymentId'),\Yii::$app->request->get('PayerID'));
            if($payPalPayment->state == 'approved'){
                $paymentModel = Yii::createObject(Payment::className())->find()->where(['transcation_no'=>$payPalPayment->id])->one();
                $paymentModel->status = $paymentModel::STATUS_BUYER_PAY;
                if(!$paymentModel->save()){
                    throw new Exception('change payment status failed');
                }
            }
            $result = $PayPalModel->getOrder($payPalPayment);
            if($result->state=='completed'){
                return $this->render('success');
            }
        }
    }


} 