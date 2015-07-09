<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\catalog\models\ItemProp */

$this->title = Yii::t('catalog', 'Create Item Prop');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog', 'Item Props'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['catalog'] = true;
$this->params['sub-menu']['item-prop'] = true;
?>
<div class="item-prop-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
