<?php

namespace star\system\controllers\core;

use star\system\models\SettingFields;
use Yii;
use star\system\models\Setting;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * SystemController implements the CRUD actions for Setting model.
 */
class SystemController extends Controller
{
    /**
     * Lists all Setting models.
     * @return mixed
     */
    public function actionIndex()
    {
        $setting = Yii::createObject(Setting::className());
        if (Yii::$app->getRequest()->getIsPost()) {
            $setting_codes = Yii::$app->request->post('setting_code');
            foreach($setting_codes as $setting_code => $chosen_value) {
                /** @var \star\system\models\SettingFields $settingField */
                $settingField = Yii::createObject(SettingFields::className());
                $settingField = $settingField::findOne(['setting_code' => $setting_code]);

                if(is_array($chosen_value)) {
                    $chosen_value = json_encode($chosen_value);
                }

                $settingField->chosen_value = $chosen_value;
                $settingField->save();
            }
        }
        return $this->render('index', ['setting' => $setting]);
    }

    /**
     * Updates an existing Setting model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->setting_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the Setting model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Setting the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $setting = Yii::createObject(Setting::className());
        if (($model = $setting::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
