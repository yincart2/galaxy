<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('refund', 'Refunds');
$this->params['breadcrumbs'][] = $this->title;
$this->params['refund-list'] = true;
?>
<div class="refund-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'order_id',
                'label' => '订单号',
                'format' => 'raw',
                'value' => function($model){
                        return Html::a($model->order->order_no,\yii\helpers\Url::to(['/order/home/order/view','id'=>$model->order_id]));
                    },
            ],
            'refund_fee',
            'reason',
            'memo',
             'create_at:datetime',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value' => function($model){
                        $statusList = $model->getStatusArray();
                    return $statusList[$model->status];
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div style="width: 32px">{view} </div>'
            ],
        ],
    ]); ?>

</div>
