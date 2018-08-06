<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\system\models\Setting */

$this->title = Yii::t('system', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['system'] = true;
$this->params['sub-menu']['setting'] = true;
?>
<div class="setting-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
