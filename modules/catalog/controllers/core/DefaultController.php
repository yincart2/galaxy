<?php

namespace star\catalog\controllers\core;

use yii\web\Controller;


class DefaultController extends Controller
{

    public $layout = '/catalog';

    public function actionIndex()
    {
        return $this->render('index');
    }
}
