<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\system\models\Setting */

$this->title = Yii::t('system', 'Create Setting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
