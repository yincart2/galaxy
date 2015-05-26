<?php

use yii\helpers\Html;
use yii\bootstrap\Collapse;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;
use radar\models\SkuStandard;

/* @var $this yii\web\View */
/* @var $model radar\models\RadarProduct */

$this->title = 'Update Radar Product: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Radar Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radar-product-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php
    $skuItems = [];
    $skus = (new SkuStandard())->find()->andWhere(['product_id' => $model->id])->all();
    foreach ($skus as $sku) {
        $skuForm = $this->render('_form_sku', [
            'model' => $sku,
        ]);
        $skuItems[] = [
            'label' => $sku->name,
            'content' => $skuForm,
            // open its content by default
//            'contentOptions' => ['class' => 'in']
        ];
    }
    $skuContent = Collapse::widget([
        'items' => $skuItems
    ]);

    $modalForm = Modal::begin([
        'header' => '<h2>Add Sku</h2>',
        'toggleButton' => ['label' => 'Add Sku', 'class' => 'btn btn-success'],
    ]);

    echo $this->render('_form_sku', [
        'model' => new SkuStandard(['product_id' => $model->id]),
    ]);

    $modalForm->end();
    //    $skuContent =  . $skuContent;
    ?>
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Product',
                'content' => $form,
                'active' => true
            ],
            [
                'label' => 'Sku',
                'content' => $skuContent,
                'active' => false
            ]
        ]
    ]); ?>

</div>
