<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\account\models\Withdrawal */

$this->title = $model->withdrawal_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coupon', 'Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('coupon', 'Update'), ['update', 'id' => $model->withdrawal_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('coupon', 'Delete'), ['delete', 'id' => $model->withdrawal_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('coupon', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'withdrawal_id',
            'user_id',
            'withdrawal_fee',
            'withdrawal_account',
            'account_name',
            'status',
            'create_at',
            'update_at',
        ],
    ]) ?>

</div>
