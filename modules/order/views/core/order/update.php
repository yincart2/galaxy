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

    if ($model->payment) {
        $paymentInfo = DetailView::widget([
            'model' => $model->payment,
            'attributes' => [
                'payment_method',
                'payment_fee',
                'transcation_no',
                'create_at:datetime',

            ]
        ]);
    } else {
        $paymentInfo = Yii::t('order', 'Not Paid');
    }

    if ($model->payment) {
        if ($model->shipment) {
            if($model->shipment->status!= 1){
                $shipmentInfo = $this->render('_shipment', [
                    'model' => $model->shipment,
                ]);
            }else{
                $shipmentInfo = DetailView::widget([
                    'model' => $model->shipment,
                    'attributes' => [
                        'shipment_method',
                        'trace_no',
                        'create_at:datetime',
                    ]
                ]);
            }
        } else {
            $shipment = Yii::createObject(\star\shipment\models\Shipment::className());
            $shipmentInfo = $this->render('_shipment', [
                'model' => $shipment,
                'orderModel'=>$model,
            ]);
        }
    } else {
        $shipmentInfo = Yii::t('order', 'Not Paid');
    }


     $items = [
         ['label' => Yii::t('order', 'Order'), 'content' => $orderItemArray.$orderInfo.$orderInfo2],
         ['label' => Yii::t('app', 'Payment'), 'content' => $paymentInfo],
         ['label' => Yii::t('order', 'Shipment'), 'content' => $shipmentInfo],
//        ['label' => Yii::t('app', 'Refund'), 'content' => ''],
     ];

    echo Tabs::widget(['items' => $items]);

    ?>

</div>
