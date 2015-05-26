<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model radar\models\RadarProduct */

$this->title = 'Create Radar Product';
$this->params['breadcrumbs'][] = ['label' => 'Radar Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="radar-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
