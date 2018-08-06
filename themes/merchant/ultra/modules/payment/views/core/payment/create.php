<?php

/* @var $this yii\web\View */
/* @var $model star\payment\models\Payment */

$this->title = Yii::t('payment', 'Create Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('payment', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['payment'] = true;
?>
<div class="payment-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
