<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\Item */

$this->title = Yii::t('catalog', 'Update Item: ') . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->item_id]];
$this->params['breadcrumbs'][] = Yii::t('catalog', 'Update');

$this->params['title'] = $this->title;
$this->params['menu']['catalog'] = true;
$this->params['sub-menu']['item-list'] = true;
?>
<div class="item-update">

    <?php if (Yii::$app->session->getFlash('sku-error')) { ?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('sku-error') ?></div>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
