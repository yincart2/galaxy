<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model star\system\models\Setting */

$this->title = $model->setting_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('system', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('system', 'Update'), ['update', 'id' => $model->setting_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('system', 'Delete'), ['delete', 'id' => $model->setting_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('system', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'setting_id',
            'menu_code',
            'menu_label',
            'group_code',
            'group_label',
            'menu_sort',
            'group_sort',
        ],
    ]) ?>

</div>
