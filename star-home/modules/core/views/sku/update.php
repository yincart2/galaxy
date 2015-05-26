<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use radar\models\SkuPrice;

/* @var $this yii\web\View */
/* @var $model radar\models\SkuStandard */

$this->title = 'Update Sku Standard: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sku Standards', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sku-standard-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?php
    $priceItems = [];
    $skuPrices = $model->skuPrices;
    foreach ($skuPrices as $price) {
        $priceForm = $this->render('_form_price', [
            'model' => $price,
        ]);
        $priceItems[] = [
            'label' => $price->store->name,
            'content' => $priceForm,
            // open its content by default
//            'contentOptions' => ['class' => 'in']
        ];
    }
    $priceContent = Collapse::widget([
        'items' => $priceItems
    ]);

    $modalForm = Modal::begin([
        'header' => '<h2>Add Price</h2>',
        'toggleButton' => ['label' => 'Add Price', 'class' => 'btn btn-success'],
    ]);

    echo $this->render('_form_price', [
        'model' => new SkuPrice(['sku_id' => $model->id]),
    ]);

    $modalForm->end();
    //    $skuContent =  . $skuContent;
    ?>
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Sku',
                'content' => $form,
                'active' => true
            ],
            [
                'label' => 'Price',
                'content' => $priceContent,
                'active' => false
            ]
        ]
    ]); ?>

</div>
