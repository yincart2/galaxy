<?php

namespace home\modules\member\controllers;

use home\modules\member\models\Wishlist;
use yii\web\Controller;
use yii;

class WishlistController extends Controller
{
    public function actionAddCompare()
    {
        $this->layout= '/main';
        return $this->render('compare');
    }

    public function actionAddWishlist()
    {
        $item_id = Yii::$app->request->get('id');
        $category_id = Yii::$app->request->get('category_id');
        $type = Yii::$app->request->get('type');//type 1 is favorite,type 2 is compare
        if($item_id && $category_id && $type) {
            $wishlist = new Wishlist();
            if($type == 1) {
                if(Wishlist::findOne(['item_id' => $item_id, 'category_id' => $category_id, 'type' => $type])) {
                    var_dump('You have already add the item to favorite list!');
                    exit;
                }
            }
            if($type == 2) {
                //compare items already exist
                if((count(Wishlist::findAll(['type' => 2]))>0) &&
                    (!Wishlist::findOne(['category_id' => $category_id,'type' => 2]))) {
                    var_dump('Different category can not add to compare!');
                    exit;
                }
            }
            $wishlist->user_id = Yii::$app->user->id;
            $wishlist->item_id = $item_id;
            $wishlist->category_id = $category_id;
            $wishlist->type = $type;
            $wishlist->created_at = time();
            $wishlist->save();
        }
    }
}
