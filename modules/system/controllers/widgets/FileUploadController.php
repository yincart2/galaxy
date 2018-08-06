<?php

namespace star\system\controllers\widgets;

use star\system\models\File;
use Yii;
use star\system\models\Setting;
use star\system\models\SettingSearches;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SystemController implements the CRUD actions for Setting model.
 */
class FileUploadController extends Controller
{


    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionUpload()
    {
        $fileModel = Yii::createObject(File::className());
        $imagesArray = $fileModel->getUploadImages();
        foreach($imagesArray as  $image){
            $fileModel->model = Yii::$app->request->post('model');
            $fileModel->model_id = Yii::$app->request->post('modelId');
            $fileModel->type = 1;
            $fileModel->name = $image['title'];
            $fileModel->url = $image['pic'];
            if(!$fileModel->save()) {
                return json_encode(['error'=>Yii::t('catalog','save images to database fail.')]);
            }
        }
        return json_encode([]);
    }

    /**
     * Deletes an existing Setting model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return json_encode([]);
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = File::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
