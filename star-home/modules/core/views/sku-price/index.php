<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel radar\models\SkuPriceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sku Prices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sku-price-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sku Price', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'price_id',
            'store_id',
            'sku_id',
            'user_id',
            'mode',
            // 'price',
            // 'currency_id',
            // 'is_safe',
            // 'shipping_method',
            // 'url:url',
            // 'hao',
            // 'create_time:datetime',
            // 'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
