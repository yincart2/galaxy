<?php

/* @var $this yii\web\View */
/* @var $model star\system\models\Setting */

$this->title = Yii::t('system', 'Update {modelClass}: ', [
        'modelClass' => 'Setting',
    ]) . ' ' . $model->setting_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->setting_id, 'url' => ['view', 'id' => $model->setting_id]];
$this->params['breadcrumbs'][] = Yii::t('system', 'Update');

$this->params['title'] = $this->title;
$this->params['menu']['system'] = true;
$this->params['sub-menu']['setting'] = true;
?>
<div class="setting-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
