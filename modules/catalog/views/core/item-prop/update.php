<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\ItemProp */

$this->title = Yii::t('catalog','Update Item Prop').': ' . ' ' . $model->prop_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog','Item Props'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->prop_id, 'url' => ['view', 'id' => $model->prop_id]];
$this->params['breadcrumbs'][] = Yii::t('catalog','Update');
?>
<div class="item-prop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
