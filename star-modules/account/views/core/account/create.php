<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\account\models\Withdrawal */

$this->title = Yii::t('coupon', 'Create Withdrawal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('coupon', 'Withdrawals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
