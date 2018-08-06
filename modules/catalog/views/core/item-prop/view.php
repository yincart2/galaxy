<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\catalog\models\ItemProp */

$this->title = $model->prop_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Item Props'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-prop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app','Update'), ['update', 'id' => $model->prop_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app','Delete'), ['delete', 'id' => $model->prop_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'prop_id',
            'category_id',
            'parent_prop_id',
            'parent_value_id',
            'prop_name',
            'prop_alias',
            'type',
            'is_key_prop',
            'is_sale_prop',
            'is_color_prop',
            'must',
            'multi',
            'status',
            'sort_order',
        ],
    ]) ?>

</div>
