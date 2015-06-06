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
    $orderItemArray = '';
    $orderItems = $model->orderItem;

    foreach($orderItems as $orderItem){
        $orderItemArray .= DetailView::widget([
            'model' => $orderItem,
            'attributes' => [
                'name',
                'price',
                'qty',
                'picture:image',
            ]
        ]);
    }
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
         ['label' => Yii::t('order', 'Order'), 'content' => $orderItemArray.$orderInfo.$orderInfo2],
//         ['label' => Yii::t('app', 'Payment'), 'content' => $paymentInfo],
         ['label' => Yii::t('order', 'Shipment'), 'content' => $shipmentInfo],
//        ['label' => Yii::t('app', 'Refund'), 'content' => ''],
     ];

    echo Tabs::widget(['items' => $items]);

    ?>

</div>
