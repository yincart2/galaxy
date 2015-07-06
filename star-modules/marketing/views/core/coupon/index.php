<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('marketing', 'Coupons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'desc',
            'condition',
            'result',

            [
                'class' => 'yii\grid\ActionColumn',
                "buttons" =>
                    [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view', 'id' => $model->rule_id]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->rule_id]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-rule', 'id' => $model->rule_id], [
                                'data' => [
                                    'confirm' => Yii::t('marketing', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ]
            ],
        ],
        'export'=>false,
        'responsive'=>true,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.Yii::t('marketing','Coupon').'</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i>'.Yii::t('marketing', 'Create Coupon'), ['create'], ['class' => 'btn btn-success']),
            'after'=>false,
            'footer'=>false
        ],
    ]); ?>

</div>
