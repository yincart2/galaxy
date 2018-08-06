<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\marketing\models\Coupon */

$this->params['breadcrumbs'][] = ['label' => Yii::t('marketing', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('marketing', 'Update');
?>
<div class="coupon-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update', [
        'model' => $model,
    ]) ?>

</div>
