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
        $orderModel->items = Yii::$app->request->post('items');
        if ($orderModel->saveOrder()) {

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
        //@todo add status
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

    /**
     * checkout view
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionCheckout(){
        $star_id = (int)Yii::$app->request->get('star_id');

        $shoppingCart = new ShoppingCart();
        $cartItems = $shoppingCart->cartItems;

        if($star_id){
            $cartItems = $shoppingCart->serialCartItems();
            if(isset($cartItems[$star_id])){
                $cartItems = $cartItems[$star_id];
            }else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        return $this->render('index', [
            'cartItems' => $cartItems,
        ]);
    }
}
