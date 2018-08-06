<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\marketing\models\Coupon */

$this->title = $model->coupon_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coupon', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$dateList = [0 => '未激活',1 => '已激活',2 => '已使用'];
$model->status = $dateList[$model->status];
$model->start_at = date('Y-m-d h:i:s', $model->start_at);
$model->end_at = date('Y-m-d h:i:s', $model->end_at);
?>
<div class="coupon-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'coupon_id',
            'coupon_no',
//            'rule_id',
//            'order_id',
//            'user_id',
            'couponRule.desc',
            'status',
//            'created_at',
//            'updated_at',
            'start_at',
            'end_at',
//            'star_id',
        ],
    ]) ?>

</div>
