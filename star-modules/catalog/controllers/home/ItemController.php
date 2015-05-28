<?php

namespace star\catalog\controllers\home;

use star\catalog\models\Item;
use yii\web\Controller;
use yii\data\Pagination;
use yii\web\HttpException;
use Yii;

class ItemController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id){
        /** @var  $itemModel  \star\catalog\models\Item*/
        $itemModel = Item::find()->where(['item_id'=>$id])->one();
        if($itemModel){
            return $this->render('view', [
                'itemModel' => $itemModel,
                'itemImages' => $itemModel->itemImgs ,
                'skuModels' => $itemModel->skus,
            ]);
        }
        else{
            throw new HttpException(404, \Yii::t('catalog','The requested Item could not be found.'));
        }
    }

    public function actionList(){
        $catalog = Yii::$app->request->get('catalog');
        $items = Item::getItemsByCategory($catalog);
        if($items) {
            $pages = new Pagination(['totalCount' => $items->count(), 'pageSize' => '3']);
            $items = $items->offset($pages->offset)->limit($pages->limit)->all();
            if ($items) {
                return $this->render('list', [
                    'items' => $items,
                    'pages' => $pages
                ]);
            }
        } else {
            return $this->render('//site/error', [
                'name' => 'catalog',
                'message' => 'Catalog does not exist'
                ]);
        }
    }
}
