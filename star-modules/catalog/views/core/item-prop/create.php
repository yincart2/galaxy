<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model star\catalog\models\ItemProp */

$this->title = Yii::t('catalog','Create Item Prop');
$this->params['breadcrumbs'][] = ['label' => Yii::t('catalog','Item Props'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
