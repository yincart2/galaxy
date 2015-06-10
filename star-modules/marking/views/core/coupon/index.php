<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('coupon', 'Coupons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('coupon', 'Create Coupon'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'coupon_id',
            'coupon_no',
            'rule_id',
            'order_id',
            'user_id',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'start_at',
            // 'end_at',
            // 'star_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
