<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel star\catalog\models\ItemPropSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('catalog', 'Item Props');
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['catalog'] = true;
$this->params['sub-menu']['item-prop'] = true;
?>
<div class="item-prop-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'prop_id',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return '[' . $model->category->name . ']';
                },
            ],
//            'parent_prop_id',
//            'parent_value_id',
            'prop_name',
            // 'prop_alias',
            // 'type',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_key_prop',
                'vAlign' => 'middle'
            ],
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'is_sale_prop',
                'vAlign' => 'middle'
            ],
            // 'multi',

            // 'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'export' => false,
        'responsive' => true,
        'panel' => [
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> ' . Yii::t('catalog', 'Item Props') . '</h3>',
            'type' => 'success',
            'before' => Html::a('<i class="glyphicon glyphicon-plus"></i>' . Yii::t('catalog', 'Create Item Props'), ['create'], ['class' => 'btn btn-success']),
            'footer' => false,
            'after' => false
        ],
    ]); ?>

</div>
