<?php

namespace home\modules\member\controllers;

use home\modules\member\models\Wishlist;
use star\catalog\models\Item;
use yii\web\Controller;
use yii\data\Pagination;
use yii;

class CompareController extends Controller
{

    public function actionIndex()
    {
        $itemModels = Item::find()->where(['in','item_id',$_POST['itemId']])->all();
        
        return $this->render('compare',[
            'compareList' => $itemModels
        ]);
    }
}
