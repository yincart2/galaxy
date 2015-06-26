<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */

$this->title = '查看退货';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Refunds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['refund-list'] = true;
?>
<div class="refund-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $dataList = [0 => '待审核', 1 => '审核中', 2 => '审核通过'];
    $model->create_at = date("Y-m-d H:i",$model->create_at);
    $model->status = $dataList[$model->status];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'refund_id',
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

    <footer class="bottom_box">

        <a href="<?= \yii\helpers\Url::to(['/refund/home/refund/index'])?>" class="button_grey middle_btn"><?= Yii::t('refund', 'Back to My Refunds')?></a>

    </footer>

</div>
