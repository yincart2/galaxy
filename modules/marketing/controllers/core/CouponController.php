<?php

namespace star\marketing\controllers\core;

use star\marketing\models\CouponForm;
use star\marketing\models\CouponRule;
use Yii;
use star\marketing\models\Coupon;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CouponController implements the CRUD actions for Coupon model.
 */
class CouponController extends Controller
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
     * Lists all Coupon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $couponRule = Yii::createObject(CouponRule::className());
        $dataProvider = new ActiveDataProvider([
            'query' => $couponRule::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Coupon model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $coupon = Yii::createObject(Coupon::className());
        $dataProvider = new ActiveDataProvider([
            'query' => $coupon::find()->where(['rule_id' => $id]),
        ]);

        return $this->render('index_coupon', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewDetail($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Coupon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::createObject(CouponForm::className());
        if ($model->load(Yii::$app->request->post()) && $model->saveCoupon()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Coupon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = Yii::createObject(CouponForm::className());
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->updateCoupon($id)) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Coupon model.
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
     * Finds the Coupon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Coupon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $coupon = Yii::createObject(Coupon::className());
        if (($model = $coupon::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeleteRule($id)
    {
        $this->findRuleModel($id)->delete();
        $coupon = Yii::createObject(Coupon::className());
        $coupon::deleteAll(['rule_id' => $id]);

        return $this->redirect(['index']);
    }

    protected function findRuleModel($id)
    {
        $couponRule = Yii::createObject(CouponRule::className());
        if (($model = $couponRule::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
