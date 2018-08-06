<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel star\system\models\SettingSearches */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('system', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('system', 'Create Setting'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'setting_id',
            'menu_code',
            'menu_label',
            'group_code',
            'group_label',
            // 'menu_sort',
            // 'group_sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
