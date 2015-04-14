<?php

use yii\helpers\Html;
use yii\grid\GridView;
use matter\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\blog\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],

//            'id',
//            'category_id',
//            'user_id',
//            'language_id',
//            'star_id',
            // 'cluster_id',
            [
                'attribute'=>'station_id',
                'value'=>function ($model) {
                    return '['.$model->station->name.']';
                },
            ],
            [
                'attribute'=>'title',
                'value'=>function ($model) {
                    return '['.$model->category->name.']'.StringHelper::sub($model->title, 75, true);
                },
            ],
//            'url:url',
            // 'source',
            // 'summary:ntext',
            // 'content:ntext',
            // 'tags:ntext',
//            'status',
             'views',
            // 'allow_comment',
//             'create_time:datetime',
            // 'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
