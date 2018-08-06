<?php

namespace star\member\controllers;

use star\member\models\Wishlist;
use star\catalog\models\Item;
use yii\web\Controller;
use yii\data\Pagination;
use yii;

class WishlistController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAddWishlist()
    {
        $user_id = Yii::$app->user->id;
        $item_id = Yii::$app->request->post('item_id');
        if($user_id) {
            if ($item_id) {
                $wishlist = Yii::createObject(Wishlist::className()) ;
                if (Wishlist::findOne(['item_id' => $item_id, 'user_id' => $user_id])) {
                    return json_encode('You have already add the item to wishlist !');
                } else {
                    $result = json_encode('Success');
                }
                $wishlist->user_id = $user_id;
                $wishlist->item_id = $item_id;
                $wishlist->created_at = time();
                if ($wishlist->save()) {
                    return $result;
                }
            }
        } else {
            return json_encode('Please login first !');
        }
    }

    public function actionGetWishlist()
    {
        $user_id = Yii::$app->user->id;
        if($user_id) {
            $items= Item::find()->innerJoin('wishlist','item.item_id = wishlist.item_id',['wishlist.user_id' => $user_id]);
            $pages = new Pagination(['totalCount' =>$items->count(), 'pageSize' => '3']);
            $items = $items->offset($pages->offset)->limit($pages->limit)->all();
            return $this->render('index',[
                'items' => $items,
                'pages' => $pages
            ]);
        } else {
            return $this->redirect(['/user/login']);
        }
    }

    public function actionDeleteWishlist()
    {
        $user_id = Yii::$app->user->id;
        $item_id = Yii::$app->request->get('item_id');
        if($user_id) {
            /** @var \home\modules\member\models\Wishlist $wishlist */
            $wishlist = Wishlist::findOne(['item_id' => $item_id, 'user_id' => $user_id]);
            if($wishlist) {
                $wishlist->delete();
                return $this->redirect(['get-wishlist']);
            }
        }
    }
}
