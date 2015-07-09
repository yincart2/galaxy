<?php

namespace star\member\controllers;
use core\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

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
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        if(!Yii::$app->user->isGuest) {
            $user = User::findOne(['id' => Yii::$app->user->id]);
            return $this->render('index', [
                'user' => $user
            ]);
        }
    }

}