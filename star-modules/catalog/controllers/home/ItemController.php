<?php

namespace star\catalog\controllers\home;

use star\catalog\models\Item;
use yii\web\Controller;
use yii\data\Pagination;

class ItemController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id){
        /** @var  $itemModel  \star\catalog\models\Item*/
        $itemModel = Item::find()->where(['item_id'=>$id])->one();
        return $this->render('view', [
            'itemModel' => $itemModel,
            'itemImages' => $itemModel->itemImgs ? $itemModel->itemImgs:[],
            'skuModels' => $itemModel->skus,
        ]);
    }

    public function actionList(){
        $items = Item::getItemsByCategory('商品分类');
        $pages = new Pagination(['totalCount' =>$items->count(), 'pageSize' => '1']);
        $items = $items->offset($pages->offset)->limit($pages->limit)->all();
        if($items) {
            return $this->render('list', [
                'items' => $items,
                'pages' => $pages
            ]);
        }
    }
}
