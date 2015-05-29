<?php

namespace star\catalog\controllers\home;

use common\models\Tree;
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
        $categories = Tree::getCategoriesById($catalog);
        if($items && $categories) {
            $pages = new Pagination(['totalCount' => $items->count(), 'pageSize' => '3']);
            $items = $items->offset($pages->offset)->limit($pages->limit)->all();
            if ($items) {
                return $this->render('list', [
                    'currentCategory' => Tree::findOne(['id' => $catalog]),
                    'categories' => $categories,
                    'items' => $items,
                    'pages' => $pages
                ]);
            }
        }
        return $this->render('//site/error', [
            'name' => 'catalog',
            'message' => 'Catalog does not exist'
            ]);
    }
}
