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

<h2 class="tt_uppercase color_dark m_bottom_25">Order Information</h2>
<!--order info tables-->
<table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
    <tr>
        <td class="f_size_large d_xs_none">Order Number</td>
        <td data-title="Order Number"><?= $model->order_no?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Order Date</td>
        <td data-title="Order Date"><?= date('Y-m-d H:i:s',$model->create_at)?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Order Status</td>
        <td data-title="Order Status"><?= $model->getStatusArray()[$model->status]?> </td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Last Updated</td>
        <td data-title="Last Update"><?= date('Y-m-d H:i:s',$model->update_at)?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Shipment</td>
        <td data-title="Shipment">&nbsp;</td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Payment</td>
        <td data-title="Payment">&nbsp;</td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Comment</td>
        <td data-title="Comment">&nbsp;</td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">Total</td>
        <td data-title="Total"><p class="fw_medium f_size_large scheme_color">$<?= $model->total_price?></p></td>
    </tr>
</table>
<div class="row clearfix m_bottom_30">
    <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
        <h2 class="tt_uppercase color_dark m_bottom_25">Bill To</h2>
        <table class="table_type_6 responsive_table full_width t_align_l r_corners shadow bg_light_color_3 wrapper w_break">
            <tr>
                <td class="f_size_large half_column d_xs_none">E-Mail</td>
                <td data-title="E-Mail" class="half_column"><a href="mailto:#" class="color_dark">info@companyname.com</a></td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Company Name</td>
                <td data-title="Company Name" class="half_column">Company Name</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Title</td>
                <td data-title="Title" class="half_column">Mr</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">First Name</td>
                <td data-title="First Name" class="half_column">John</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Middle Name</td>
                <td data-title="Middle Name" class="half_column">-</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Last Name</td>
                <td data-title="Last Name" class="half_column">Smith</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Address 1</td>
                <td data-title="Address 1" class="half_column">Street Name 24</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Zip / Postal Code</td>
                <td data-title="Zip / Postal Code" class="half_column">9000</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">City</td>
                <td data-title="City" class="half_column">City Name</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Country</td>
                <td data-title="Country" class="half_column">Slovenia</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">State/Province/Region</td>
                <td data-title="State/Region" class="half_column">-</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Phone</td>
                <td data-title="Phone" class="half_column">555-55-55</td>
            </tr>
        </table>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="tt_uppercase color_dark m_bottom_25">Ship To</h2>
        <table class="table_type_6 responsive_table full_width t_align_l r_corners shadow bg_light_color_3 w_break">
            <tr>
                <td class="f_size_large half_column d_xs_none">Company Name</td>
                <td data-title="Company Name" class="half_column">Company Name</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">First Name</td>
                <td data-title="First Name" class="half_column">John</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Middle Name</td>
                <td data-title="Middle Name" class="half_column">-</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Last Name</td>
                <td data-title="Last Name" class="half_column">Smith</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Address 1</td>
                <td data-title="Address 1" class="half_column">Street Name 24</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Zip / Postal Code</td>
                <td data-title="Code" class="half_column">9000</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">City</td>
                <td data-title="City" class="half_column">City Name</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Country</td>
                <td data-title="Country" class="half_column">Slovenia</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">State/Province/Region</td>
                <td data-title="State/Region" class="half_column">-</td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">Phone</td>
                <td data-title="Phone" class="half_column">555-55-55</td>
            </tr>
        </table>
    </div>
</div>
<div class="tabs m_bottom_45">
    <section class="tabs_content shadow r_corners p_hr_0 p_vr_0 wrapper">
        <div id="tab-1">
            <table class="table_type_7 responsive_table full_width t_align_l">
                <thead>
                <tr class="f_size_large">
                    <th>SKU</th>
                    <th>Product Name</th>
                    <th>Product Status</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Tax</th>
                    <th>Discount</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $orderItems = $model->orderItem;
                /**@var $orderItem star\order\models\orderItem **/
                foreach($orderItems as $orderItem){
                ?>
                <tr>
                    <td data-title="SKU">PS01</td>
                    <td data-title="Product Name">
                        <a href="#" class="color_dark d_inline_b m_bottom_5"><?= $orderItem->name?></a><br>
                        <ul>
                            <li>Color: red</li>
                            <li>Size: M</li>
                        </ul>
                    </td>
                    <td data-title="Product Status">Confirmed by<br> shopper</td>
                    <td data-title="Price">
                        <s>$102.00</s>
                        <p class="f_size_large color_dark">$<?= $orderItem->price?></p>
                    </td>
                    <td data-title="Qty"><?= $orderItem->qty?></td>
                    <td data-title="Tax">$13.99</td>
                    <td data-title="Discount">-$29.00</td>
                    <td data-title="Total"><p class="color_dark f_size_large">$<?= $orderItem->price * $orderItem->qty?></p></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="7">
                        <p class="fw_medium f_size_large t_xs_align_c t_align_r">Shipment Fee:</p>
                    </td>
                    <td colspan="1" class="color_dark"><p class="fw_medium f_size_large">$<?= $model->shipping_fee?></p></td>
                </tr>
                <tr>
                    <td colspan="7">
                        <p class="fw_medium f_size_large t_align_r t_xs_align_c scheme_color">Total:</p>
                    </td>
                    <td colspan="1" class="color_dark"><p class="fw_medium f_size_large scheme_color">$<?= $model->total_price?></p></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

