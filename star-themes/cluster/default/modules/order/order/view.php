<?php
/* @var $this yii\web\View */
/* @var $model  star\order\models\order */

$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['/member/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Order List'),
    'url' => ['/order/home/order/list'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Order View'),
    'template' => '<li><span>{link}</span></li>',
];
$this->params['order-list'] = true;

?>

<h1>Order #<?= $model->order_no?> </h1>

<!-- - - - - - - - - - - - - - Order table - - - - - - - - - - - - - - - - -->

<div class="section_offset">

    <header class="top_box">

        <div class="buttons_row">

            <a href="#" class="button_grey middle_btn">Reorder</a>

            <a href="#" class="button_grey middle_btn">Print Order</a>

        </div>

    </header>

    <div class="table_wrap">

        <table class="table_type_1 order_table">

            <tbody>

            <tr>

                <th>Order Number</th>

                <td><a href="#"><?= $model->order_no?></a></td>

            </tr>

            <tr>

                <th>Order Date</th>

                <td><?= date('Y-m-d H:i:s',$model->create_at)?></td>

            </tr>

            <tr>

                <th>Product Status</th>

                <td><?= $model->getStatusArray()[$model->status]?> </td>

            </tr>

            <tr>

                <th>Last Updated</th>

                <td><?= date('Y-m-d H:i:s',$model->update_at)?></td>

            </tr>

            <tr>

                <th>Shipment</th>

                <td>United Parcel Service - Worldwide Expedited</td>

            </tr>

            <tr>

                <th>Payment</th>

                <td>Cash On Delivery</td>

            </tr>

            <tr>

                <th>Total</th>

                <td class="total"><?= $model->total_price?></td>

            </tr>

            </tbody>

        </table>

    </div>

</div><!--/ .section_offset -->

<!-- - - - - - - - - - - - - - End of order table - - - - - - - - - - - - - - - - -->

<div class="section_offset">

    <div class="row">

        <div class="col-md-6">

            <!-- - - - - - - - - - - - - - Bill to - - - - - - - - - - - - - - - - -->

            <section>

                <h3>Bill To</h3>

                <div class="table_wrap">

                    <table class="table_type_1 order_table">

                        <tbody>

                        <tr>

                            <th>Email</th>

                            <td><a href="mailto:#">john.doe@gmail.com</a></td>

                        </tr>

                        <tr>

                            <th>Company Name</th>

                            <td>-</td>

                        </tr>

                        <tr>

                            <th>Name</th>

                            <td>John Doe</td>

                        </tr>

                        <tr>

                            <th>Address</th>

                            <td>Street Name 123</td>

                        </tr>

                        <tr>

                            <th>Zip/Postal Code</th>

                            <td>2000</td>

                        </tr>

                        <tr>

                            <th>City</th>

                            <td>New York</td>

                        </tr>

                        <tr>

                            <th>Country</th>

                            <td>USA</td>

                        </tr>

                        <tr>

                            <th>State</th>

                            <td>NY</td>

                        </tr>

                        <tr>

                            <th>Phone</th>

                            <td>876-54-32</td>

                        </tr>

                        </tbody>

                    </table>

                </div>

            </section>

            <!-- - - - - - - - - - - - - - End of bill to - - - - - - - - - - - - - - - - -->

        </div><!--/ [col] -->

        <div class="col-md-6">

            <!-- - - - - - - - - - - - - - Ship to - - - - - - - - - - - - - - - - -->

            <section>

                <h3>Ship To</h3>

                <div class="table_wrap">

                    <table class="table_type_1 order_table">

                        <tbody>

                        <tr>

                            <th>Company Name</th>

                            <td>-</td>

                        </tr>

                        <tr>

                            <th>Name</th>

                            <td>John Doe</td>

                        </tr>

                        <tr>

                            <th>Address</th>

                            <td>Street Name 123</td>

                        </tr>

                        <tr>

                            <th>Zip/Postal Code</th>

                            <td>2000</td>

                        </tr>

                        <tr>

                            <th>City</th>

                            <td>New York</td>

                        </tr>

                        <tr>

                            <th>Country</th>

                            <td>USA</td>

                        </tr>

                        <tr>

                            <th>State</th>

                            <td>NY</td>

                        </tr>

                        <tr>

                            <th>Phone</th>

                            <td>876-54-32</td>

                        </tr>

                        </tbody>

                    </table>

                </div>

            </section>

            <!-- - - - - - - - - - - - - - End of ship to - - - - - - - - - - - - - - - - -->

        </div><!--/ [col] -->

    </div><!--/ .row -->

</div><!--/ .section_offset -->

<!-- - - - - - - - - - - - - - Items ordered - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Items Ordered</h3>

    <div class="table_wrap">

        <table class="table_type_1 order_review">

            <thead>

            <tr>

                <th class="product_title_col">Product Name</th>
                <th class="product_sku_col">SKU</th>
                <th class="product_price_col">Price</th>
                <th class="product_qty_col">Quantity</th>
                <th class="product_total_col">Total</th>

            </tr>

            </thead>

            <tbody>
            <?php
            $orderItems = $model->orderItem;
            /**@var $orderItem star\order\models\orderItem **/
            foreach($orderItems as $orderItem){
            ?>
            <tr>

                <td data-title="Product Name">

                    <a href="#" class="product_title"><?= $orderItem->name?></a>

                    <ul class="sc_product_info">

                        <li>Size: Big</li>
                        <li>Color: Red</li>

                    </ul>

                </td>

                <td data-title="SKU">PS01</td>

                <td data-title="Price" class="subtotal">$<?= $orderItem->price?></td>

                <td data-title="Quantity"><?= $orderItem->qty?></td>

                <td data-title="Total" class="total">$<?= $orderItem->price * $orderItem->qty?></td>

            </tr>
            <?php } ?>


            </tbody>

            <tfoot>


            <tr>

                <td colspan="4" class="bold">Shipping &amp; Heading (Flat Rate - Fixed)</td>
                <td class="total">$<?= $model->shipping_fee?></td>

            </tr>

            <tr>

                <td colspan="4" class="grandtotal">Grand Total</td>
                <td class="grandtotal">$<?= $model->total_price?></td>

            </tr>

            </tfoot>

        </table>

    </div><!--/ .table_wrap -->

    <footer class="bottom_box">

        <a href="<?= \yii\helpers\Url::to(['/order/home/order/list'])?>" class="button_grey middle_btn">Back to My Orders</a>

    </footer>

</section>

<!-- - - - - - - - - - - - - - End of items ordered - - - - - - - - - - - - - - - - -->

