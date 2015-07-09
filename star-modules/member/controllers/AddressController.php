<?php

namespace star\member\controllers;

use star\system\models\Area;
use yii\helpers\Json;
use star\member\models\DeliveryAddress;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii;

class AddressController extends Controller
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
    /**
     * find member's address
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     * @return string
     */
    public function actionDeliveryAddress(){
        $model = Yii::createObject(DeliveryAddress::className()) ;

        $dataProvider = new ActiveDataProvider([
            'query' =>  $model::find()->where(['user_id'=>Yii::$app->user->id]),
        ]);

        //view
        if(Yii::$app->request->get('view_id')){
            $model = $model->find()->where(['delivery_address_id'=>Yii::$app->request->get('view_id'),'user_id'=>Yii::$app->user->id])->one();
        }

        //create and update
        if ($model->load(Yii::$app->request->post()) ) {
            $deliveryAddress = Yii::$app->request->post('DeliveryAddress');
            $deliveryAddress['user_id'] = Yii::$app->user->id;

            $model->user_id = Yii::$app->user->id;

            //prevent causing multiple submissions when F5 to refresh the page
            if(!DeliveryAddress::find()->where($deliveryAddress)->all()) {
                /**
                 * ensure only one default deliveryAddress
                 */
                if ($model->is_default == 1) {
                    $deliveryAddress = DeliveryAddress::find()->where(['is_default' => 1, 'user_id' => Yii::$app->user->id])->all();
                    foreach ($deliveryAddress as $address) {
                        $address->is_default = 0;
                        $address->save();
                    }
                }
                if ($model->save()) {
                    if (Yii::$app->request->get('view_id')) {
                        $this->redirect(['address/delivery-address']);
                    }
                }
            }
        }


        $area = Area::find()->where(['parent_id'=>100000])->all();
        $catList = [];

        foreach($area as $s){
            $catList[$s->area_id] = $s->name;
        }
        return $this->render('delivery_address',[
            'model' => $model,
            'catList' => $catList,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * get cities list
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     */
    public function actionGetCities() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getList($cat_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * get district list
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     */
    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $data = self::getList($subcat_id,false);
//                echo Json::encode(['output'=>$data['out'], 'selected'=>$data['selected']]);
                echo Json::encode(['output'=>$data['out'], 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * get catList
     * @author Cangzhou Wu<wucang.zhou@jago-ag.cn>
     * @param $cat_id
     * @param bool $city  city list flag
     * @return array
     */
    public function getList($cat_id,$city=true){
        $cities =  Area::find()->where(['parent_id'=>$cat_id])->all();
        $catList = [];
        if($city){
            foreach($cities as $s){
                $catList[] = ['id'=>$s->area_id, 'name'=>$s->name];
            }
        }else{
            foreach($cities as $s){
                $catList[ 'out'][] = ['id'=>$s->area_id, 'name'=>$s->name];
            }
            $catList['selected'] = $s->area_id;
        }

        return $catList;
    }

    /**
     * Deletes an existing customerAddress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findDeliveryAddressModel($id)->delete();

        return $this->redirect(['delivery-address']);
    }

    /**
     * Finds the customerAddress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return customerAddress the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findDeliveryAddressModel($id)
    {
        $model = Yii::createObject(DeliveryAddress::className()) ;
        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new yii\web\NotFoundHttpException('The requested page does not exist.');
        }
    }
}