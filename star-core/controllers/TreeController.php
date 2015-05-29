<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/23/2015
 * Time: 11:26 AM
 */

namespace core\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\Tree;

class TreeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['Administrator'],
                    ],
                ],
            ],
            ];
    }
    public function actions() {
        return [
            'nodeChildren' => [
                'class' => 'gilek\gtreetable\actions\NodeChildrenAction',
                'treeModelName' => Tree::className()
            ],
            'nodeCreate' => [
                'class' => 'gilek\gtreetable\actions\NodeCreateAction',
                'treeModelName' => Tree::className()
            ],
            'nodeUpdate' => [
                'class' => 'gilek\gtreetable\actions\NodeUpdateAction',
                'treeModelName' => Tree::className()
            ],
            'nodeDelete' => [
                'class' => 'gilek\gtreetable\actions\NodeDeleteAction',
                'treeModelName' => Tree::className()
            ],
            'nodeMove' => [
                'class' => 'gilek\gtreetable\actions\NodeMoveAction',
                'treeModelName' => Tree::className()
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('@gilek/gtreetable/views/widget', ['options'=>[
             'manyroots' => true,
             'draggable' => true
        ]]);
    }
}