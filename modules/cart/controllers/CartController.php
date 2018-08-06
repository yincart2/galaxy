<?php

namespace star\cart\controllers;

use star\cart\models\ShoppingCart;
use star\catalog\models\Sku;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class CartController extends Controller
{
    public function actionIndex()
    {
        $shoppingCartModel = Yii::createObject(ShoppingCart::className());
        $cartItems = $shoppingCartModel->serialCartItems();

        return $this->render('index', [
            'cartItems' => $cartItems,
            'shoppingCartModel'=>$shoppingCartModel,
        ]);
    }

    /**
     * add item to cart, it should have ['item_id','star_id','qty','props']
     * @return string
     */
    public function actionAdd()
    {
        $item_id = (int)Yii::$app->request->post('item_id');
        $star_id = (int)Yii::$app->request->post('star_id');
        $qty = (int)Yii::$app->request->post('qty');
        $data = Yii::$app->request->post('data');
        $props = Yii::$app->request->post('props');
        if($props){
            $tmp = explode(';',$props);
            $props =[];
            foreach($tmp as $v){
                $a = explode(':',$v);
                $props[$a[0]] =$v;
            }
            $sku = Sku::find()->where(['item_id'=>$item_id,'props'=>Json::encode($props)])->one();
            $sku_id = $sku->sku_id;
        }

        $shoppingCartModel = Yii::createObject(ShoppingCart::className()) ;
        if($shoppingCartModel->add($sku_id,$star_id, $qty,$data)) {
            return Json::encode(['status'=>'success','message' => \Yii::t('cart', 'add to cart success')]);
        } else {
            return Json::encode(['status'=>'fail','message' => \Yii::t('cart', 'add to cart fail')]);
        }
    }

    /**
     * update cart
     */
    public function actionUpdate()
    {
        $shoppingCartModel =Yii::createObject(ShoppingCart::className());
        $cart = Yii::$app->request->post('Cart');
        $message = null;
        foreach($cart as $cartItem){
            if($shoppingCartModel->update($cartItem['item_id'],$cartItem['qty'],'')){
//                $message  =$message . $cartItem['name'].' update success  ';
            }else {
                $message  =$message . $cartItem['name'].' update fail  ';
            }
        }
        return Json::encode(['message' => $message,'redirect' =>'index']);
    }

    /**
     * remove item from cart
     */
    public function actionRemove()
    {
        $shoppingCartModel = Yii::createObject(ShoppingCart::className());
        $sku_id = Yii::$app->request->post('sku_id');
        if ($shoppingCartModel->remove($sku_id)) {
            echo Json::encode(['message' => \Yii::t('cart', 'remove success'),'redirect' =>'index']);
        } else {
            echo Json::encode(['message' =>\Yii::t('cart', 'remove fail') ,'redirect' =>'index']);
        }
    }

    /**
     * remove all items
     */
    public function actionClearAll(){
        $shoppingCartModel = Yii::createObject(ShoppingCart::className());
        if ($shoppingCartModel->clearAll()) {
            echo Json::encode(['message' => \Yii::t('cart', 'remove success'),'redirect' =>'index']);
        } else {
            echo Json::encode(['message' => \Yii::t('cart', 'remove fail'),'redirect' =>'index']);
        }
    }
} 