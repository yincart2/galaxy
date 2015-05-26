<?php

namespace home\modules\member\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCompare()
    {

    }

    public function actionAddWishList()
    {
        var_dump('WishList');
    }
}
