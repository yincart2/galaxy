<?php

namespace star\catalog\controllers\home;

use yii\web\Controller;

class ItemController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView(){
        return $this->render('view');
    }

    public function actionList(){
        return $this->render('list');
    }
}
