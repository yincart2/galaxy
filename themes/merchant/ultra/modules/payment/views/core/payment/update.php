<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\payment\models\Payment */

$this->title = Yii::t('payment', 'Update {modelClass}: ', [
        'modelClass' => 'Payment',
    ]) . ' ' . $model->payment_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('payment', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->payment_id, 'url' => ['view', 'id' => $model->payment_id]];
$this->params['breadcrumbs'][] = Yii::t('payment', 'Update');

$this->params['title'] = $this->title;
$this->params['menu']['payment'] = true;
?>
<div class="payment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
