<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\catalog\models\Item */

$this->title = Yii::t('catalog', 'Create Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['catalog'] = true;
$this->params['sub-menu']['item-list'] = true;
?>
<div class="item-create">

    <?php if (Yii::$app->session->getFlash('sku-error')) { ?>
        <div class="alert alert-danger"><?= Yii::$app->session->getFlash('sku-error') ?></div>
    <?php } ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
