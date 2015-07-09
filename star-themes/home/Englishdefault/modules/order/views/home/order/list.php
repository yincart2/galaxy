<?php
/* @var $this yii\web\View */
/* @var $orderModel  star\order\models\order */

use yii\helpers\Url;

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['/member/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Order List'),
    'template' => '<li><span>{link}</span></li>',
];
$this->params['order-list'] = true;
?>

<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

<div class="row">



<header class="top_box on_the_sides">


    <div class="right_side">

            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
                'options' => ['class' => 'pagination pags']
            ]); ?>

    </div>

</header><!--/ .top_box -->
    <h2 class="tt_uppercase color_dark m_bottom_20">订单</h2>
<div class="table_wrap">

    <table class="table_type_1 orders_table">

        <thead>

        <tr>

            <th class="order_number_col">订单号</th>
            <th>下单日期</th>
            <th>订单状态</th>
            <th class="order_total_col">总价</th>
            <th class="product_action_col">操作</th>

        </tr>

        </thead>

        <tbody>
    <?php  foreach($orderModels as $orderModel){ ?>
        <tr>

            <td data-title="Order Number"><a href="<?= Url::to(['/order/home/order/view','id'=>$orderModel->order_id])?>"><?= $orderModel->order_no?></a></td>

            <td data-title="Order Date"><?= date('m/d/Y H:i:s',$orderModel->create_at)?></td>

            <td data-title="Order Status"><?= $orderModel->getStatusArray()[$orderModel->status]?> </td>

            <td data-title="Total" class="total"><?= $orderModel->total_price?></td>

            <td data-title="Action">

                <ul class="buttons_col">

                    <li>

                        <a href="<?= Url::to(['/order/home/order/view','id'=>$orderModel->order_id])?>" class="button_grey">查看</a>

                    </li>

                    <li>

                        <a href="#" class="button_grey">Reorder</a>

                    </li>

                </ul>

            </td>

        </tr>
<?php } ?>

        </tbody>

    </table>

</div>




</div><!--/ .row-->