<?php

namespace star\refund\controllers\core;

use star\catalog\models\Sku;
use star\order\models\Order;
use Yii;
use star\refund\models\Refund;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RefundController implements the CRUD actions for Refund model.
 */
class RefundController extends Controller
{
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
            'query' => $refund::find()->orderBy(['status' => SORT_ASC,'create_at' => SORT_DESC]),
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
        $model = Yii::createObject(Refund::className());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->refund_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Refund model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        /** @var \star\refund\models\Refund $model */
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /** @var \star\order\models\Order $orderModel */
            $order = Yii::createObject(Order::className());
            $orderModel = $order::find()->where(['order_id'=>$model->order_id])->one();
            if($model->status==0){
                $orderModel->status = 6;
            }
            if($model->status==1){
                $orderModel->status = 8;
                $orderItems = $orderModel->orderItems;
                foreach($orderItems as $orderItem) {
                    /** @var \star\catalog\models\Sku $sku */
                    $sku = Sku::findOne(['item_id' => $orderItem->item_id]);
                    $sku->quantity += $orderItem->qty;
                    $sku->update();
                }
            }
            if($model->status==3){
                $orderModel->status = 7;
            }
            $orderModel->save();
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
