<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\marketing\models\Coupon */

$this->title = Yii::t('marketing', 'Create Coupon');
$this->params['breadcrumbs'][] = ['label' => Yii::t('marketing', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
