<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-5-28
 * Time: 下午1:44
 */
namespace star\auth\controllers;

use star\auth\models\AssignModel;
use star\auth\models\RoleModel;
use yii\web\Controller;
use dektrium\rbac\models\Search;

class AuthController  extends Controller{

    public $layout = '/auth';
     public function actionCreate(){
         $role = \Yii::createObject(RoleModel::className());
         if ($role->load(\Yii::$app->request->post()) ){
             $role->validate();
             if(!$role->hasErrors()){
                  $role->savePermissions();
             }
         }
         return $this->render('addRole',[
            'roleModel' => $role
        ]);
     }

    public function actionUpdate($name){
        $assignModel = \Yii::createObject(AssignModel::className()) ;
        $assignModel->role_name = $name;
        $permissions = $assignModel->getPermissions();
        if ($assignModel->load(\Yii::$app->request->post()) ){
            $assignModel->save();
        }
        $selected = $assignModel->loadPermissions();


        return $this->render('assign',[
            'permissions' => $permissions,
            'assignModel' => $assignModel,
            'selected' => $selected,
        ]);
    }

    public function actionListRole(){
        $filterModel = new Search('1');
        return $this->render('listRole', [
            'filterModel'  => $filterModel,
            'dataProvider' => $filterModel->search(\Yii::$app->request->get()),
        ]);
    }
} 