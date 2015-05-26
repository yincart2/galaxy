<?php

namespace star\catalog\controllers\core;

use yii\web\Controller;
use yii\filters\AccessControl;

class DefaultController extends Controller
{

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

    public $layout = 'catalog';

    public function actionIndex()
    {
        return $this->render('index');
    }
}
