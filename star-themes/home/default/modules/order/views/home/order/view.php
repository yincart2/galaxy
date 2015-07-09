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

<h2 class="tt_uppercase color_dark m_bottom_25">订单详情</h2>
<!--order info tables-->
<table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
    <tr>
        <td class="f_size_large d_xs_none">订单号</td>
        <td data-title="Order Number"><?= $model->order_no?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">收货信息</td>
        <td data-title="Shipment"><?= $model->address?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">订单状态</td>
        <td data-title="Order Status"><?= $model->getStatusArray()[$model->status]?> </td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">下单时间</td>
        <td data-title="Order Date"><?= date('Y-m-d H:i:s',$model->create_at)?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none">更新时间</td>
        <td data-title="Last Update"><?= date('Y-m-d H:i:s',$model->update_at)?></td>
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
        <td class="f_size_large d_xs_none">总价</td>
        <td data-title="Total"><p class="fw_medium f_size_large scheme_color">$<?= $model->total_price?></p></td>
    </tr>
</table>
<?php
$shipment = $model->shipment;
if($shipment){
?>
<div class="row clearfix m_bottom_30">
    <div class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
        <h2 class="tt_uppercase color_dark m_bottom_25">物流</h2>
        <table class="table_type_6 responsive_table full_width t_align_l r_corners shadow bg_light_color_3 wrapper w_break">
            <tr>
                <td class="f_size_large half_column d_xs_none">物流单号</td>
                <td data-title="Company Name" class="half_column"><?= $shipment->trace_no?></td>
            </tr>
            <tr>
                <td class="f_size_large half_column d_xs_none">发出时间</td>
                <td data-title="Title" class="half_column"><?= $shipment->create_at?></td>
            </tr>

        </table>
    </div>

</div>
<?php
}
?>
<div class="tabs m_bottom_45">
    <section class="tabs_content shadow r_corners p_hr_0 p_vr_0 wrapper">
        <div id="tab-1">
            <table class="table_type_7 responsive_table full_width t_align_l">
                <thead>
                <tr class="f_size_large">
                    <th>图片</th>
                    <th>商品名称</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>总价</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $orderItems = $model->orderItem;
                /**@var $orderItem star\order\models\orderItem **/
                foreach($orderItems as $orderItem){
                ?>
                <tr>
                    <td data-title="SKU"><img src="<?=Yii::$app->params['imageDomain'].'/'.$orderItem->item->getMainImage()?>" alt=""></td>
                    <td data-title="Product Name">
                        <a href="#" class="color_dark d_inline_b m_bottom_5"><?= $orderItem->name?></a><br>
                        <ul>
                            <?php
                            foreach( \yii\helpers\Json::decode($orderItem->sku->props_name ) as $v){
                            echo '<li>'.$v.'</li>';
                            }?>
                        </ul>
                    </td>
                    <td data-title="Price">
                        <p class="f_size_large color_dark">$<?= $orderItem->price?></p>
                    </td>
                    <td data-title="Qty"><?= $orderItem->qty?></td>
                    <td data-title="Total"><p class="color_dark f_size_large">$<?= $orderItem->price * $orderItem->qty?></p></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="4">
                        <p class="fw_medium f_size_large t_xs_align_c t_align_r">税:</p>
                    </td>
                    <td colspan="1" class="color_dark"><p class="fw_medium f_size_large">$<?= $model->shipping_fee?></p></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p class="fw_medium f_size_large t_align_r t_xs_align_c scheme_color">总价:</p>
                    </td>
                    <td colspan="1" class="color_dark"><p class="fw_medium f_size_large scheme_color">$<?= $model->total_price?></p></td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
</div>

