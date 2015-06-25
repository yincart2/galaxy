<?php

namespace star\catalog\controllers\core;

use star\catalog\models\PropValue;
use Yii;
use star\catalog\models\ItemProp;
use star\catalog\models\ItemPropSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemPropController implements the CRUD actions for ItemProp model.
 */
class ItemPropController extends DefaultController
{



    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all ItemProp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = Yii::createObject(ItemPropSearch::className());
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemProp model.
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
     * Creates a new ItemProp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::createObject(ItemProp::className());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->savePropValue($model->prop_id);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ItemProp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->savePropValue($model->prop_id);
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ItemProp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $propValue = Yii::createObject(PropValue::className());
        $propValue::deleteAll(['prop_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemProp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ItemProp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $itemProp = Yii::createObject(ItemProp::className());
        if (($model = $itemProp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function savePropValue($prop_id)
    {
        if (isset($_POST['PropValue'])) {
            $propValues = $_POST['PropValue'];
            unset($_POST['PropValue']);
            if (is_array($propValues['value_name']) && $count = count($propValues['value_name'])) {
                for ($i = 0; $i < $count; $i++) {
                    if(isset($propValues['value_id'][$i]) && $propValues['value_id'][$i]) {
                        $propValue = Yii::createObject(PropValue::className());
                        $propValue = $propValue::find()->where(['value_id' => $propValues['value_id'][$i]])->one();;
                    } else {
                        $propValue = Yii::createObject(PropValue::className());
                    }
                    $propValue->setAttributes(array(
                        'prop_id' => $prop_id,
                        'value_name' => $propValues['value_name'][$i],
                        'sort_order' => $i,
                        'value_alias' => $propValues['value_name'][$i],
                        'status' => 1,
                    ));
                    if(isset($propValues['value_id'][$i]) && $propValues['value_id'][$i]) {
                        $propValue->update();
                    } else {
                        $propValue->save();
                    }
                    $propValues['value_id'][$i] = $propValue->value_id;
                }
                $propValueModel = Yii::createObject(PropValue::className());
                //删除
                $models = $propValueModel::findAll(['prop_id' => $prop_id]);
                $delArr = array();
                foreach ($models as $k1 => $v1) {
                    if (!in_array($v1->value_id, $propValues['value_id'])) {
                        $delArr[] = $v1->value_id;
                    }
                }
                if (count($delArr)) {
                    $propValueModel = Yii::createObject(PropValue::className());
                    $propValueModel::deleteAll('value_id IN (' . implode(', ', $delArr) . ')');
                }
            } else {
                //已经没有属性了，要清除数据表内容
                $propValueModel = Yii::createObject(PropValue::className());
                $propValueModel::deleteAll('prop_id = ' . $prop_id);
            }
        }
    }
}
