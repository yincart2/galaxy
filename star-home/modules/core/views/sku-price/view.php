<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model radar\models\SkuPrice */

$this->title = $model->price_id;
$this->params['breadcrumbs'][] = ['label' => 'Sku Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sku-price-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->price_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->price_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'price_id',
            'store_id',
            'sku_id',
            'user_id',
            'mode',
            'price',
            'currency_id',
            'is_safe',
            'shipping_method',
            'url:url',
            'hao',
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]) ?>

</div>
