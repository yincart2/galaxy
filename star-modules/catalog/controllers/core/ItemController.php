<?php

namespace star\catalog\controllers\core;

use star\catalog\models\ItemImg;
use star\catalog\models\ItemProp;
use star\catalog\models\PropValue;
use star\catalog\models\Sku;
use Yii;
use star\catalog\models\Item;
use star\catalog\models\ItemSearch;
use yii\base\ErrorException;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
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
            $transaction=Yii::$app->db->beginTransaction();

            $imagesArray = $model->getUploadImages();

            if($model->save()){
                foreach($imagesArray as $num=> $image){
                    $itemImg = new ItemImg();
                    $itemImg->item_id = $model->item_id;
                    $itemImg->pic = $image['pic'];
                    $itemImg->title = $image['title'];
                    $itemImg->position = $num;
                    $itemImg->create_time = time();
                   if(!$itemImg->save()) {
                       $model->addError('images',Yii::t('catalog','save images to database fail.'));
                   }
                }
            }
            if(!$model->hasErrors()){
                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->item_id]);
            }
            $transaction->rollBack();
        }

        return $this->render('create', [
            'model' => $model,
        ]);

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

        if ($model->load(Yii::$app->request->post())) {
            $itemData = $this->handlePostData($model);
            $model = $itemData[0];
            $model->save();
            $skus = $itemData[1];
            $model->saveSkus($model->item_id,$skus);

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

    public function actionItemProps($category_id,$item_id = 0, $tree_id)
    {
        $itemProps = ItemProp::findAll(['category_id' => $category_id]);
        $model = Item::findOne(['item_id' => $item_id]);
        return $this->renderPartial('_form_prop', array('itemProps' => $itemProps,'model' => $model, 'tree_id' => $tree_id));
    }

    public function actionAjaxSkus()
    {
        if (!Yii::$app->request->isAjax && empty($_POST['item_id'])) {
            return;
        }
        $skus = \star\catalog\models\Sku::findAll(["item_id" => $_POST["item_id"]]);
        $data = array();
        foreach ($skus as $sku) {
            $arr = array();
            $arr['sku_id'] = $sku->sku_id;
            $arr['props'] = F::convert_props_js_id($sku->props);
//            $arr['props'] = str_replace(":","-",$arr['props']);
            $arr['price'] = $sku->price;
            $arr['stock'] = $sku->quantity;
            $arr['outer_id'] = $sku->outer_id;
            $arr['tag'] = $sku->tag;
            $data[] = $arr;
        }
        echo json_encode($data);
    }

    public function actionBulk(){
        if(Yii::$app->request->isPost){
            $action = Yii::$app->request->post('act');
            $selection=(array)Yii::$app->request->post('selection');
            /**
             * actionName => [ 'attribute' , 'value']
             */
            $tmpAction = [
                'is_show'=>['is_show',1],'un_show'=>['is_show',0],
                'is_promote'=>['is_promote',1],'un_promote'=>['is_promote',0],
                'is_new'=>['is_new',1],'un_new'=>['is_new',0],
                'is_hot'=>['is_hot',1],'un_hot'=>['is_hot',0],
                'is_best'=>['is_best',1],'un_best'=>['is_best',0]
            ];
            foreach($selection as $value){
                $model = $this->findModel($value);
                if($model){
                    if($action == 'delete'){
                        $model->delete();
                    }else{
                        $model->$tmpAction[$action][0] = $tmpAction[$action][1];
                        $model->save();
                    }
                }
            }
        }
        return $this->redirect(['index']);
    }

    /**
     * format post props value
     * @author Lujie.Zhou(gao_lujie@live.cn, qq:821293064).
     */
    protected function handlePostData($item)
    {
        $stock = null;
        $itemProps = array();
        if (isset($_POST['ItemProp']) && is_array($_POST['ItemProp'])) {
            $itemProps = $_POST['ItemProp'];
            unset($_POST['ItemProp']);
        }
        if (isset($_POST['Item']['skus']['checkbox']) && is_array($_POST['Item']['skus']['checkbox'])) {
            $itemProps = ArrayHelper::merge($itemProps, $_POST['Item']['skus']['checkbox']);
        }
        list($item->props, $item->props_name) = $this->handleItemProps($itemProps);

        if (isset($_POST['Item']['skus']['table']) && is_array($_POST['Item']['skus']['table'])) {
            $skus = array();
            foreach ($_POST['Item']['skus']['table'] as $pid => $sku) {
                list($sku['props'], $sku['props_name']) = $this->handleItemProps($sku['props']);
                $stock = $sku['stock'] + $stock;
                $skus[] = $sku;
            }
//            $item->skus = $skus;
            $item->stock = $stock;
        }
        return array($item,$skus);
    }

    /**
     * format item prop data to json format from post
     * @param $itemProps
     * @return array
     * @author Lujie.Zhou(gao_lujie@live.cn, qq:821293064).
     */
    protected function handleItemProps($itemProps)
    {
        $props = array();
        $props_name = array();
        foreach ($itemProps as $pid => $vid) {
            $itemProp = ItemProp::findOne(['prop_id' => $pid]);
            $pname = $itemProp->prop_name;
            if (is_array($vid)) {
                $props[$pid] = array();
                $props_name[$pname] = array();
                foreach ($vid as $v) {
                    $props[$pid][] = $pid . ':' . $v;
                    $propValue = PropValue::findOne(['value_id' => $v]);
                    $vname = $propValue ? $propValue->value_name : $v;
                    $props_name[$pname][] = $pname . ':' . $vname;

                }
            } else {
                $props[$pid] = $pid . ':' . $vid;
                $propValue = PropValue::findOne(['value_id' => $vid]);
                $vname = $propValue ? $propValue->value_name : $vid;
                $props_name[$pname] = $pname . ':' . $vname;
            }
        }
        return array(json_encode($props), json_encode($props_name));
    }
}
