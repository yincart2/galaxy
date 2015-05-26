<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model radar\models\SkuStandard */

$this->title = 'Create Sku Standard';
$this->params['breadcrumbs'][] = ['label' => 'Sku Standards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sku-standard-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
