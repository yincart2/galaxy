<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\shipment\models\Shipment */

$this->title = Yii::t('system', 'Create Shipment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Shipments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shipment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
