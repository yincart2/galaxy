<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Withdrawals');
$this->params['breadcrumbs'] = [
    'title' => '提现记录',
];
$this->params['withdrawal-log'] = true;
?>
<div class="withdrawal-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'withdrawal_fee',
            'withdrawal_account',
            'account_name',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value' => function($model){
                    $dataList = $model->getStatusArray();
                    return $dataList[$model->status];
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
