<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\shipment\models\Shipment */

$this->title = Yii::t('system', 'Update {modelClass}: ', [
    'modelClass' => 'Shipment',
]) . ' ' . $model->shipment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shipment_id, 'url' => ['view', 'id' => $model->shipment_id]];
$this->params['breadcrumbs'][] = Yii::t('system', 'Update');
?>
<div class="shipment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
