<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model radar\models\SkuPrice */

$this->title = 'Create Sku Price';
$this->params['breadcrumbs'][] = ['label' => 'Sku Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sku-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
