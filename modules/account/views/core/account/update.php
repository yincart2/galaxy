<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\account\models\Withdrawal */

$this->title = Yii::t('coupon', 'Update {modelClass}: ', [
    'modelClass' => 'Withdrawal',
]) . ' ' . $model->withdrawal_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coupon', 'Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->withdrawal_id, 'url' => ['view', 'id' => $model->withdrawal_id]];
$this->params['breadcrumbs'][] = Yii::t('coupon', 'Update');
?>
<div class="withdrawal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
