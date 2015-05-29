<?php

namespace home\modules\member\controllers;
use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}