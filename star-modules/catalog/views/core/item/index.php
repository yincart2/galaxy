<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel star\catalog\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">
    <?php $form = ActiveForm::begin([
        'action' =>['/catalog/core/item/bulk'],
        'method' => 'post'
    ]);?>
    <?= GridView::widget([
        'export'=>false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn',
            ],
            ['class' => 'yii\grid\SerialColumn'],
//            'item_id',
            [
                'attribute'=>'category_id',
                'value'=>function ($model) {
                    return '['.$model->category->name.']';
                },
            ],
//            'outer_id',
            'title',
            'stock',
            // 'min_number',
            // 'price',
            // 'currency',
            // 'props:ntext',
            // 'props_name:ntext',
            // 'desc:ntext',
            // 'shipping_fee',
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'is_show',
                'vAlign'=>'middle'
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'is_promote',
                'vAlign'=>'middle'
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'is_new',
                'vAlign'=>'middle'
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'is_hot',
                'vAlign'=>'middle'
            ],
            [
                'class'=>'kartik\grid\BooleanColumn',
                'attribute'=>'is_best',
                'vAlign'=>'middle'
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
                'dropdown'=>true,
                'dropdownOptions'=>['class'=>'pull-right'],
                'headerOptions'=>['class'=>'kartik-sheet-style'],
            ],
        ],
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Items</h3>',
            'type'=>'success',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i>'.Yii::t('catalog','Create Items') , ['create'], ['class' => 'btn btn-success']),
            'footer'=>false
        ],
        'toolbar' => [
            [
                'content'=>
                    Html::dropDownList('act','',
                        [
                            ''  =>'选择操作',
                        'delete' => '删除产品',
                        'is_show' => '上架',
                        'un_show' => '下架',
                        'is_promote' => '促销',
                        'un_promote' => '取消促销',
                        'is_new' => '新品',
                        'un_new' => '取消新品',
                        'is_hot' => '热卖',
                        'un_hot' => '取消热卖',
                        'is_best' => '精品',
                        'un_best' => '取消精品',
                    ],['class' => 'btn btn-default','style'=>'margin-right:10px']). Html::submitButton(Yii::t('catalog','Save'), ['class' => 'btn btn-success'])  ,
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
