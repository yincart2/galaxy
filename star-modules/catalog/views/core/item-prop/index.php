<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel star\catalog\models\ItemPropSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Props';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prop-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Item Prop', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'prop_id',
            [
                'attribute'=>'category_id',
                'value'=>function ($model) {
                    return '['.$model->category->name.']';
                },
            ],
//            'parent_prop_id',
//            'parent_value_id',
            'prop_name',
            // 'prop_alias',
            // 'type',
            // 'is_key_prop',
            // 'is_sale_prop',
            // 'is_color_prop',
            // 'must',
            // 'multi',
            // 'status',
            // 'sort_order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
