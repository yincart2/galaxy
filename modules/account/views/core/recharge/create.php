<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\account\models\Recharge */

$this->title = Yii::t('order', 'Create Recharge');
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Recharges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recharge-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
