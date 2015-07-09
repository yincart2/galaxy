<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\system\models\Station */

$this->title = 'Update Station: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Stations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$this->params['title'] = $this->title;
$this->params['menu']['system'] = true;
$this->params['sub-menu']['station'] = true;
?>
<div class="station-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
