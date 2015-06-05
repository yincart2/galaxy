<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model star\order\models\Order */

$this->title = Yii::t('order', 'Update {modelClass}: ', [
    'modelClass' => 'Order',
]) . ' ' . $model->order_no;
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_no, 'url' => ['view', 'id' => $model->order_id]];
$this->params['breadcrumbs'][] = Yii::t('order', 'Update');
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $items = [];
    $orderInfo =  DetailView::widget([
        'model' => $model,
        'attributes' => [
            'total_price',
            'shipping_fee',
            'payment_fee',
            'address',
            'memo',
            'create_at:datetime',
            'update_at:datetime',
        ]
    ]);

    $orderInfo2 =  $this->render('_status', [
        'model' => $model,
    ]) ;

     $items = [
         ['label' => Yii::t('app', 'Order'), 'content' => $orderInfo.$orderInfo2],
//         ['label' => Yii::t('app', 'Payment'), 'content' => $paymentInfo],
         ['label' => Yii::t('app', 'Shipment'), 'content' => $shipmentInfo],
//        ['label' => Yii::t('app', 'Refund'), 'content' => ''],
     ];

    echo Tabs::widget(['items' => $items]);

    ?>

</div>
