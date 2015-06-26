<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('account', '流水账');
$this->params['breadcrumbs'] = [
    'title' => '流水账',
];
$this->params['money-log'] = true;
?>
<div class="withdrawal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'money',
            [
                'attribute' => 'type',
                'value' => function($model){
                    $dataList = $model->getStatusArray();
                    return $dataList[$model->type];
                },
            ],
            'create_at:date',
            'update_at:date',

//            [
//                'class' => 'yii\grid\ActionColumn',
//                'buttons' => [
//                    'view' => function ($url,$model){
//                        return Html::a('查看', ['withdrawal/view','id'=>$model->withdrawal_id]);
//                    },
//                    'update' => function ($url,$model){
//                            return ;
//                    },
//                    'delete' => function (){
//                        return ;
//                    },
//                ],
//            ],
        ],
    ]); ?>

</div>
