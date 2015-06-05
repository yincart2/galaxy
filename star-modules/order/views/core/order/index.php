<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel star\catalog\models\ItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('order', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?= GridView::widget([
        'export'=>false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'order_id',
//            'user_id',
//            'star_id',
            'order_no',
            'total_price',
             'shipping_fee',
             'payment_fee',
            // 'address',
            // 'memo',
             'create_at:datetime',
             'update_at:datetime',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'panel'=>[
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.Yii::t('order','Orders').'</h3>',
            'type'=>'success',
            'footer'=>false
        ],
        'toolbar' => [

            '{export}',
            '{toggleData}'
        ],
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
        'exportContainer' => ['class' => 'btn-group-sm']
    ]); ?>

</div>
