<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var $dataProvider array
 * @var $filterModel  dektrium\rbac\models\Search
 * @var $this         yii\web\View
 */

use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Url;

$this->title = Yii::t('rbac', 'Roles');
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['auth'] = true;
$this->params['sub-menu']['list-role'] = true;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        [
            'attribute' => 'name',
            'header' => Yii::t('rbac', 'Name'),
            'options' => [
                'style' => 'width: 20%'
            ],
        ],
        [
            'attribute' => 'description',
            'header' => Yii::t('rbac', 'Description'),
            'options' => [
                'style' => 'width: 55%'
            ],
        ],
        [
            'attribute' => 'rule_name',
            'header' => Yii::t('rbac', 'Rule name'),
            'options' => [
                'style' => 'width: 20%'
            ],
        ],
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $model) {
                return Url::to(['/auth/auth/' . $action, 'name' => $model['name']]);
            },
            'options' => [
                'style' => 'width: 5%'
            ],
        ]
    ],
    'export' => false,
    'responsive' => true,
    'panel' => [
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Yii::t('rbac', 'Roles') . '</h3>',
        'type' => 'success',
        'before' => false,
        'footer' => false,
        'after' => false
    ],
]) ?>

