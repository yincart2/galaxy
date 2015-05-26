<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model radar\models\SkuPrice */

$this->title = 'Update Sku Price: ' . ' ' . $model->price_id;
$this->params['breadcrumbs'][] = ['label' => 'Sku Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->price_id, 'url' => ['view', 'id' => $model->price_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sku-price-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
