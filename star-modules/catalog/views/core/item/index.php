<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel star\catalog\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            // 'is_show',
            // 'is_promote',
            // 'is_new',
            // 'is_hot',
            // 'is_best',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
