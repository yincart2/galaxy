<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */

$this->title = $model->refund_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('refund', 'Refunds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->refund_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->refund_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $dataList = $model->getStatusArray();
    $model->create_at = date("Y-m-d H:i",$model->create_at);
    $model->status = $dataList[$model->status];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'refund_id',
            'order_id',
            'refund_fee',
            'reason',
            'memo',
            'create_at',
//            'update_at',
            'status',
        ],
    ]) ?>

    <img alt="No Image" src="<?= $model->image?>" width="190" height="190">

</div>
