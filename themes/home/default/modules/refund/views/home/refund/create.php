<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */

$this->title = Yii::t('refund', '申请退货', [
    'modelClass' => 'Refund',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('refund', 'Refunds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="refund-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'order_id' => $order_id,
    ]) ?>

</div>
