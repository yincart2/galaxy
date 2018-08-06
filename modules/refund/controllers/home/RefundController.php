<?php

namespace star\refund\controllers\home;

use star\order\models\Order;
use Yii;
use yii\base\Exception;
use star\refund\models\Refund;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RefundController implements the CRUD actions for Refund model.
 */
class RefundController extends Controller
{
    public $layout = "/member";

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
     * Lists all Refund models.
     * @return mixed
     */
    public function actionIndex()
    {
        $refund = Yii::createObject(Refund::className());
        $dataProvider = new ActiveDataProvider([
            'query' => $refund::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Refund model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Refund model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $order_id = Yii::$app->request->get('order_id');
        $model = Yii::createObject(Refund::className());
        $model->order_id = $order_id;
        $refund = $model::find()->where(['order_id' => $order_id])->one();
        $order = Yii::createObject(Order::className());
        $order = $order::find()->where(['order_id' => $order_id, 'user_id' => Yii::$app->user->id])->one();

        if (isset($refund)) {
            if ($order->status != 7) {
                return $this->render('view', [
                    'model' => $refund,
                ]);
            } else {
                $model = Yii::createObject(Refund::className());
                $model->order_id = $order_id;
            }
        }
        $file = UploadedFile::getInstance($model, 'image');
        if ($model->load(Yii::$app->request->post())) {
            if ($file) {
                $fileDir = \Yii::getAlias('@image/refund/');
                if (!file_exists($fileDir)) {
                    if (!mkdir($fileDir, 0777, true)) {
                        throw new Exception(404, Yii::t('app', 'Directory create error!'));
                    }
                }
                $file->saveAs($fileDir . $file->baseName . time() . '.' . $file->extension);
                $model->image = Yii::$app->params['imageDomain'] . '/refund/' . $file->baseName . time() . '.' . $file->extension;
            }
            if ($model->save()) {
                $order->status = $order::STATUS_WAIT_REFUND_CHECK;
                if(!$order->save()){
                    throw new Exception(404, Yii::t('app', 'order create error!'));
                }
                return $this->redirect(['view', 'id' => $model->refund_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'order_id' => $order_id,
        ]);

    }

    /**
     * Updates an existing Refund model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->refund_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Refund model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Refund model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Refund the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $refund = Yii::createObject(Refund::className());
        if (($model = $refund::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
