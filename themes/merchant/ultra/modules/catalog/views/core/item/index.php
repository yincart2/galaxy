<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel star\catalog\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('catalog', 'Items');
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['catalog'] = true;
$this->params['sub-menu']['item-list'] = true;
?>
<div class="item-index">
    <?php $form = ActiveForm::begin([
        'action' => ['/catalog/core/item/bulk'],
        'method' => 'post'
    ]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
            ],
            ['class' => 'yii\grid\SerialColumn'],
//            'item_id',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return '[' . $model->category->name . ']';
                },
            ],
//            'outer_id',
            'title',
            [
                'attribute' => 'stock',
                'value' => function ($model) {
                    $skus = $model->skus;
                    $a = 0;
                    foreach ($skus as $sku) {
                        $a += $sku->quantity;
                    }
                    return $a;
                },
            ],
            // 'min_number',
            // 'price',
            // 'currency',
            // 'props:ntext',
            // 'props_name:ntext',
            // 'desc:ntext',
            // 'shipping_fee',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_show',
                'vAlign' => 'middle'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_promote',
                'vAlign' => 'middle'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_new',
                'vAlign' => 'middle'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_hot',
                'vAlign' => 'middle'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_best',
                'vAlign' => 'middle'
            ],
            // 'click_count',
            // 'wish_count',
            // 'review_count',
            // 'deal_count',
            // 'create_time',
            // 'update_time',
            // 'language',
            // 'country',
            // 'state',
            // 'city',

            [
                'class' => 'kartik\grid\ActionColumn',
                'headerOptions' => ['class' => 'kartik-sheet-style'],
            ],
        ],
        'export' => false,
        'responsive' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Yii::t('catalog', 'Items') . '</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('catalog', 'Create Items'), ['create'], ['class' => 'btn btn-success']),
            'footer' => false,
            'after' => false
        ],
        'toolbar' => [
            [
                'content' =>
                    Html::dropDownList('act', '',
                        [
                            '' => Yii::t('catalog', 'Choose Action'),
                            'delete' => Yii::t('catalog', 'delete'),
                            'is_show' => Yii::t('catalog', 'show'),
                            'un_show' => Yii::t('catalog', 'un_show'),
                            'is_promote' => Yii::t('catalog', 'promote'),
                            'un_promote' => Yii::t('catalog', 'un_promote'),
                            'is_new' => Yii::t('catalog', 'new'),
                            'un_new' => Yii::t('catalog', 'un_new'),
                            'is_hot' => Yii::t('catalog', 'hot'),
                            'un_hot' => Yii::t('catalog', 'un_hot'),
                            'is_best' => Yii::t('catalog', 'best'),
                            'un_best' => Yii::t('catalog', 'un_best'),
                        ], ['class' => 'btn btn-default', 'style' => 'margin-right:10px']) . Html::submitButton(Yii::t('catalog', 'Save'), ['class' => 'btn btn-success']),
                'options' => ['class' => 'btn-group-sm']
            ],
            '{export}',
            '{toggleData}'
        ],
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
        'exportContainer' => ['class' => 'btn-group-sm']
    ]); ?>

    <?php ActiveForm::end(); ?>
</div>
