<?php

namespace star\catalog\controllers\core;

use star\catalog\models\Item;
use Yii;
use star\catalog\models\ItemImg;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemController implements the CRUD actions for ItemImg model.
 */
class ItemImgController extends DefaultController
{

    /**
     * Creates a new ItemImg model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $itemModel = Yii::createObject(Item::className());
        $imagesArray = $itemModel->getUploadImages();
        foreach($imagesArray as  $image){
            $itemImg = Yii::createObject(ItemImg::className());
            $itemImg->item_id = Yii::$app->request->post('item_id');
            $itemImg->pic = $image['pic'];
            $itemImg->title = $image['title'];
            $itemImg->position = Yii::$app->request->post('position');
            $itemImg->create_time = time();
            if(!$itemImg->save()) {
                return json_encode(['error'=>Yii::t('catalog','save images to database fail.')]);
            }
        }
        return json_encode([]);
    }

    /**
     * Deletes an existing ItemImg model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(!$model->delete()){
            return json_encode(['error',Yii::t('catalog','delete image fail')]);
        }

        return json_encode([]);
    }

    /**
     * Finds the ItemImg model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ItemImg the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $itemImg = Yii::createObject(ItemImg::className());
        if (($model = $itemImg::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
} 