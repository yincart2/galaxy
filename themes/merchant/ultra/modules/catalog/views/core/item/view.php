<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\Item */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['menu']['catalog'] = true;
$this->params['sub-menu']['item-list'] = true;
?>
<div class="item-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->item_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->item_id], [
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
            'item_id',
            'category_id',
            'outer_id',
            'title',
            'stock',
            'min_number',
            'price',
            'currency',
            'props:ntext',
            'props_name:ntext',
            'desc:ntext',
            'shipping_fee',
            'is_show',
            'is_promote',
            'is_new',
            'is_hot',
            'is_best',
            'click_count',
            'wish_count',
            'review_count',
            'deal_count',
            'create_time',
            'update_time',
            'language',
            'country',
            'state',
            'city',
        ],
    ]) ?>

</div>
