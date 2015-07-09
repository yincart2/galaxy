<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel star\account\models\WithdrawalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('account', 'Withdrawals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawal-index">
    <?= GridView::widget([
        'export'=>false,
        'responsive'=>false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'withdrawal_id',
            'user_id',
            'withdrawal_fee',
            'withdrawal_account',
            'account_name',
            [
                'attribute'=>'status',
                'value'=>function ($model) {
                        $status = $model->getStatusArray();
                        return $status[$model->status];
                    },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>Yii::createObject(\star\account\models\Withdrawal::className())->getStatusArray(),
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                ],
                'filterInputOptions'=>['placeholder'=>'Status'],
                'format'=>'raw'
            ],
            'create_at:datetime',
            'update_at:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.Yii::t('account','Withdrawals').'</h3>',
            'type'=>'success',
            'footer'=>false
        ],
        'toolbar' => [

            '{export}',
            '{toggleData}'
        ],
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
        'exportContainer' => ['class' => 'btn-group-sm']
    ]); ?>


</div>
