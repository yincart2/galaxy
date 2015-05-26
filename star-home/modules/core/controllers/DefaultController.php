<?php

namespace home\modules\core\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{

    public $layout = '/core';

    public function actionIndex()
    {
        return $this->render('index');
    }
}
