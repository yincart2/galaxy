<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\account\models\Activity*/

$this->title = Yii::t('account', 'Create Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('account', 'Activities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>