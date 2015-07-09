<?php

/* @var $this yii\web\View */
/* @var $model star\system\models\Station */

$this->title = 'Create Station';
$this->params['breadcrumbs'][] = ['label' => 'Stations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['system'] = true;
$this->params['sub-menu']['station'] = true;
?>
<div class="station-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
