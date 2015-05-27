<?php

namespace home\modules\member\controllers;

use home\modules\member\models\Wishlist;
use yii\web\Controller;
use yii\data\Pagination;
use yii;

class WishlistController extends Controller
{
    public function actionAddWishlist()
    {
        $user_id = Yii::$app->user->id;
        $item_id = Yii::$app->request->post('item_id');
        $category_id = Yii::$app->request->post('category_id');
        $type = Yii::$app->request->post('type');//type 1 is favorite,type 2 is compare
        if($item_id && $category_id && $type && $user_id) {
            $wishlist = new Wishlist();
            if($type == 1) {
                if(Wishlist::findOne(['item_id' => $item_id, 'category_id' => $category_id, 'type' => $type, 'user_id' => $user_id])) {
                    return json_encode('You have already add the item to favorite list!');
                } else {
                    $result = json_encode('Success');
                }
            }
            if($type == 2) {
                if(Wishlist::findOne(['item_id' => $item_id, 'category_id' => $category_id, 'type' => $type, 'user_id' => $user_id])) {
                    return json_encode('You have already add the item to compare list!');
                }
                //compare items already exist
                if((count(Wishlist::findAll(['type' => 2, 'user_id' => $user_id]))>0) &&
                    (!Wishlist::findOne(['category_id' => $category_id,'type' => 2, 'user_id' => $user_id]))) {
                    return json_encode('Different category can not add to compare!');
                } else {
                    $result = json_encode('Success');
                }
            }
            $wishlist->user_id = $user_id;
            $wishlist->item_id = $item_id;
            $wishlist->category_id = $category_id;
            $wishlist->type = $type;
            $wishlist->created_at = time();
            if($wishlist->save()) {
                return $result;
            }
        }
    }

    public function actionGetWishlist()
    {
        $user_id = Yii::$app->user->id;
        $type = Yii::$app->request->get('type');//type 1 is favorite,type 2 is compare
        if($user_id && $type) {
            if($type == 1) {
                $favorites= Wishlist::find()->where(['type' => $type, 'user_id' => $user_id]);
                $pages = new Pagination(['totalCount' =>$favorites->count(), 'pageSize' => '1']);
                $favoriteList = $favorites->offset($pages->offset)->limit($pages->limit)->all();
                return $this->render('favorite',[
                    'favoriteList' => $favoriteList,
                    'pages' => $pages
                ]);
            }
            if($type == 2) {
                $compareList = Wishlist::findAll(['type' => $type, 'user_id' => $user_id]);
                return $this->render('compare',[
                    'compareList' => $compareList
                ]);
            }
        }
    }
}
