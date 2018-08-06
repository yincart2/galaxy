<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\account\models\Recharge */

$this->title = Yii::t('order', 'Update {modelClass}: ', [
    'modelClass' => 'Recharge',
]) . ' ' . $model->recharge_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Recharges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->recharge_id, 'url' => ['view', 'id' => $model->recharge_id]];
$this->params['breadcrumbs'][] = Yii::t('order', 'Update');
?>
<div class="recharge-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
