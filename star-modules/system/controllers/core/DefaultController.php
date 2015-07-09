<?php

namespace star\system\controllers\core;

use yii\web\Controller;


class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
