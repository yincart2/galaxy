<?php
/* @var $this yii\web\View */
/* @var $orderModel  star\order\models\order */

use yii\helpers\Url;
?>

<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

<div class="row">




<h1>My Orders</h1>

<header class="top_box on_the_sides">


    <div class="right_side">

            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
                'options' => ['class' => 'pagination pags']
            ]); ?>

    </div>

</header><!--/ .top_box -->

<div class="table_wrap">

    <table class="table_type_1 orders_table">

        <thead>

        <tr>

            <th class="order_number_col">Order Number</th>
            <th>Order Date</th>
            <th class="ship_col">Ship To</th>
            <th>Order Status</th>
            <th class="order_total_col">Total</th>
            <th class="product_action_col">Action</th>

        </tr>

        </thead>

        <tbody>
    <?php  foreach($orderModels as $orderModel){ ?>
        <tr>

            <td data-title="Order Number"><a href="<?= Url::to(['/order/home/order/view','id'=>$orderModel->order_id])?>"><?= $orderModel->order_no?></a></td>

            <td data-title="Order Date"><?= date('m/d/Y H:i:s',$orderModel->create_at)?></td>

            <td data-title="Ship To">John Doe</td>

            <td data-title="Order Status"><?= $orderModel->getStatusArray()[$orderModel->status]?> </td>

            <td data-title="Total" class="total"><?= $orderModel->total_price?></td>

            <td data-title="Action">

                <ul class="buttons_col">

                    <li>

                        <a href="<?= Url::to(['/order/home/order/view','id'=>$orderModel->order_id])?>" class="button_grey">View Order</a>

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

<footer class="bottom_box">

    <a href="#" class="button_grey middle_btn">Back</a>

</footer><!--/ .bottom_box -->



</div><!--/ .row-->