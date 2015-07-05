<?php
/**
 * Created by PhpStorm.
 * User: Yinhe
 * Date: 3/23/2015
 * Time: 11:26 AM
 */

namespace cluster\controllers;

use yii\web\Controller;
use star\system\models\Tree;

class TreeController extends Controller
{
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