<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model radar\models\RadarProduct */

$this->title = 'Update Radar Product: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Radar Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="radar-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
