<?php

namespace merchant\modules\site\controllers;

use yii\filters\AccessControl;
use dektrium\user\controllers\SecurityController as BaseSecurityController;
use dektrium\user\models\LoginForm;
use yii\filters\VerbFilter;

class LoginController extends BaseSecurityController
{
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'actions' => ['index'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//        ];
//    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
////                    ['allow' => true, 'actions' => ['login', 'auth'], 'roles' => ['?']],
////                    ['allow' => true, 'actions' => ['logout'], 'roles' => ['@']],
//                ]
//            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = false;

        $model = \Yii::createObject(LoginForm::className());

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('index', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }

}
