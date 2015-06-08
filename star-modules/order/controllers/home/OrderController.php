<?php

namespace star\order\controllers\home;

use cluster\modules\cart\models\ShoppingCart;
use star\order\models\Order;
use star\catalog\models\Sku;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $shoppingCart = new ShoppingCart();
        $cartItems = $shoppingCart->cartItems;

        return $this->render('index', [
            'cartItems' => $cartItems,
        ]);
    }

    /**
     * Displays a single Order model in member center.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = '/member';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionOrderSave(){
        $orderModel = new Order();
        $orderModel->address = Yii::$app->request->post('address');
        $orderModel->memo = Yii::$app->request->post('memo');
        if ($orderModel->saveOrder()) {
            $item_id = Yii::$app->request->post('item_id');
            if(isset($item_id)) {
                $sku = Sku::find()->where(['sku_id'=>$item_id])->one();
                $item = $sku->item;
                if($item->type==$item::TYPE_CREDIT){
                    return Json::encode([ 'redirect' => Url::to(['customer/order'])]);
                }
            }
//            return $this->redirect(['alipay/index', 'id' => $orderModel->order_id]);
            return Json::encode(['message' => \Yii::t('app', 'create order success'), 'redirect' => 'success']);
        } else {
            return Json::encode(['message' =>'下单失败', 'redirect' => Url::to(['/order/order/index'])]);
        }
    }

    public function actionSuccess(){
        return $this->render('success');
    }

    /**
     * list orders in member center
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return string
     */
    public function actionList(){
        $this->layout = '/member';
        $condition = '';
        $query = Order::find()->where($condition);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $orderModels = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('list', [
            'orderModels' => $orderModels,
            'pages' => $pages,
        ]);
    }

}
