<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\coupon\models\Coupon */

$this->title = Yii::t('coupon', 'Create Coupon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('coupon', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
