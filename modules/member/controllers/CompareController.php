<?php

namespace star\member\controllers;

use star\catalog\models\Item;
use yii\web\Controller;
use yii;

class CompareController extends Controller
{

    public $layout="/main";

    public function actionIndex()
    {
        $itemModels = Item::find()->where(['in','item_id',$_POST['itemId']])->all();

        return $this->render('compare',[
            'itemModels' => $itemModels
        ]);
    }
}
