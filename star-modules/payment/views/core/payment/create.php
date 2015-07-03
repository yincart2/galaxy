<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\payment\models\Payment */

$this->title = Yii::t('payment', 'Create Payment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('payment', 'Payments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
