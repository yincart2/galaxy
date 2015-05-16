<?php

namespace star\catalog\controllers\core;

use Yii;
use star\catalog\models\Item;
use star\catalog\models\ItemSearch;
use yii\base\ErrorException;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{

    public $layout = 'catalog';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();
        if ($model->load(Yii::$app->request->post()) ) {

            $images = $model->loadUploadImages('Item');
            $imagesArray = [];
            foreach($images['images'] as $image){
                $imagesArray[] = $model ->saveImage($image);
            }


            if($model->hasErrors()){
                return $this->render('create', [
                    'model' => $model,
                ]);
            };
             $model->save();
            return $this->redirect(['view', 'id' => $model->item_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->item_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUploadImage(){
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $model = new Item();
        $image = UploadedFile::getInstance($model, 'itemImgs');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return json_encode(['error'=>Yii::t('catalog','There is no image')]);
        }
        $imageName = $image->baseName . time() . '.' . $image->extension;
        $image->saveAs(\Yii::getAlias('@image/') . $imageName);
        list($path, $link) = Yii::$app->getAssetManager()->publish('@image');
        return json_encode(['initialPreview'=>"<img src='".$link.'/' .$imageName. "' class='file-preview-image' alt='Desert' title='Desert'>",'initialPreviewConfig'=>['caption'=>$imageName,'key'=>$imageName]]);
    }
}
