<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\coupon\models\Coupon */

$this->title = $model->coupon_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coupon', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('coupon', 'Update'), ['update', 'id' => $model->coupon_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('coupon', 'Delete'), ['delete', 'id' => $model->coupon_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('coupon', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'coupon_id',
            'coupon_no',
            'rule_id',
            'order_id',
            'user_id',
            'status',
            'created_at',
            'updated_at',
            'start_at',
            'end_at',
            'star_id',
        ],
    ]) ?>

</div>
