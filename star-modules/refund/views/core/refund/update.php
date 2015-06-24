<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */

$this->title = Yii::t('refund', 'Update {modelClass}: ', [
    'modelClass' => 'Refund',
]) . ' ' . $model->refund_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('refund', 'Refunds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->refund_id, 'url' => ['view', 'id' => $model->refund_id]];
$this->params['breadcrumbs'][] = Yii::t('refund', 'Update');
?>
<div class="refund-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
