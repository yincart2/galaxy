<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-19
 * Time: 下午3:32
 */

namespace star\payment\controllers\core;

use Yii;
use yii\web\Controller;

class PaymentController extends Controller{
    public function actionIndex(){
        return $this->render('index');
    }
} 