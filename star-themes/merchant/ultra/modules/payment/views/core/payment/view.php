<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\payment\models\Payment */

$this->title = $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('payment', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['payment'] = true;
?>
<div class="payment-view">

    <p>
        <?= Html::a(Yii::t('payment', 'Update'), ['update', 'id' => $model->payment_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('payment', 'Delete'), ['delete', 'id' => $model->payment_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('payment', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'payment_id',
            'order_id',
            'payment_method',
            'payment_fee',
            'transcation_no',
            'create_at',
            'status',
        ],
    ]) ?>

</div>
