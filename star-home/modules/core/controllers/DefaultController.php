<?php

namespace home\modules\core\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
{

    public $layout = '/core';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['Merchant','administrator'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
