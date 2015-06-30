<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\account\models\Activity*/

$this->title = Yii::t('account', 'Update {modelClass}: ', [
        'modelClass' => 'Activity',
    ]) . ' ' . $model->activity_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('account', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->activity_id, 'url' => ['view', 'id' => $model->activity_id]];
$this->params['breadcrumbs'][] = Yii::t('account', 'Update');
?>
<div class="activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>