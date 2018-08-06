<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('refund', 'Refunds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'refund_id',
            [
                'attribute' => 'order_id',
                'label' => '订单号',
                'format' => 'raw',
                'value' => function($model){
                        return Html::a($model->order->order_no,\yii\helpers\Url::to(['/order/core/order/update','id'=>$model->order_id]));
                    },
            ],
            'refund_fee',
            'reason',
            'memo',
             'create_at:date',
            // 'update_at',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value' => function($model){
                        $statusList = $model->getStatusArray();
                        return $statusList[$model->status];
                    },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'export' => false,
        'responsive' => true,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'headerRowOptions' => ['class' => 'kartik-sheet-style'],
        'filterRowOptions' => ['class' => 'kartik-sheet-style'],
        'panelHeadingTemplate' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Html::encode($this->title) . '</h3>',
        'panel' => [
            'type' => GridView::TYPE_SUCCESS,
            'before' => false,
            'after' => false,
            'footer' => false
        ],
    ]); ?>

</div>
