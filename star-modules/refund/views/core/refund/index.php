<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('refund', 'Refunds');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'refund_id',
            'order_id',
            'refund_fee',
            'reason',
            'memo',
             'create_at:date',
            // 'update_at',
            [
                'attribute' => 'status',
                'label' => '审核状态',
                'value' => function($model){
                        return [0 => '待审核', 1 => '审核中', 2 => '审核通过'];
                    },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
