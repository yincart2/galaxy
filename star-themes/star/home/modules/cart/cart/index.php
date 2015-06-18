<?php
use yii\helpers\Html;
use yii\helpers\Url;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

list($url,$link) = $this->getAssetManager()->publish('@home/modules/cart/web');
$this->registerJsFile($link . '/js/cart.js',['depends' => [\yii\web\JqueryAsset::className()]] );

$form = \yii\widgets\ActiveForm::begin();
?>

<input type="hidden" name="_frontendCSRF" id="_frontendCSRF" value="<?= Yii::$app->request->csrfToken ?>"/>
    <section class="col-lg-12 col-md-12 col-sm-12 m_xs_bottom_30">
        <h2 class="tt_uppercase color_dark m_bottom_25">Cart</h2>
        <!--cart table-->
        <table class="table_type_4 responsive_table full_width r_corners wraper shadow t_align_l t_xs_align_c m_bottom_30">
            <thead>
            <tr class="f_size_large">
                <!--titles for td-->
                <th>Product Image &amp; Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $cartItems = isset($cartItems[0])? $cartItems[0]:$cartItems;
            foreach ($cartItems as $cartItem) {
            /**@var star\catalog\models\Item $item * */
            $sku = $cartItem->sku;
            $item = $sku->item;
            $itemImages = $item->itemImgs;

            ?>
            <tr>
                <!--Product name and image-->
                <td data-title="Product Image &amp; name" class="t_md_align_c">
                    <?php $mainImage= isset($itemImages[0])?$itemImages[0]->pic:'';  ?>
                    <?= EasyThumbnailImage::thumbnailImg(
                        '@image/'.$mainImage,
                        110,
                        110,
                        EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        ['alt' => $itemImages[0]->title , "class"=>"m_md_bottom_5 d_xs_block d_xs_centered"]
                    )?>
                    <a href="#" class="d_inline_b m_left_5 color_dark"><?= $item->title?></a>
                    <?= Html::hiddenInput('Cart[' . $cartItem->sku_id . '][item_id]', $cartItem->sku_id) ?>
                    <?= Html::hiddenInput('Cart[' . $cartItem->sku_id . '][name]', $item->title); ?>
                </td>
                <!--product key-->
                <td data-title="SKU"><?php
                    foreach( \yii\helpers\Json::decode($sku->props_name ) as $v){
                        echo $v.';';
                    }?></td>
                <!--product price-->
                <td data-title="Price">
                    <p class="f_size_large color_dark"><?= $sku->price?></p>
                </td>
                <!--quantity-->
                <td data-title="Quantity">
                    <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark m_bottom_10">
                        <button type="button" class="bg_tr d_block f_left" data-direction="down">-</button>
                        <input type="text" name="Cart[<?=  $cartItem->sku_id ?>][qty]" readonly value="<?=  $cartItem->qty ?>" class="f_left">
                        <button type="button" class="bg_tr d_block f_left" data-direction="up">+</button>
                    </div>
                    <div>
                        <a href="javascript:;" class="color_dark remove-item" data-item="<?= $sku->sku_id?>" data-url="<?= Url::to(['/cart/cart/remove'])?>"><i class="fa fa-times f_size_medium m_right_5"></i>Remove</a><br>
                    </div>
                </td>
                <!--subtotal-->
                <td data-title="Subtotal">
                    <p class="f_size_large fw_medium scheme_color"><?=  $shoppingCartModel->getSubTotal($sku->sku_id) ?></p>
                </td>
            </tr>
            <?php } ?>
            <!--prices-->

            <tr>
                <td colspan="4">
                    <p class="fw_medium f_size_large t_align_r t_xs_align_c">Shipment Fee:</p>
                </td>
                <td colspan="1">
                    <p class="fw_medium f_size_large color_dark">$<?=  $shoppingCartModel->getShippingFee() ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p class="fw_medium f_size_large t_align_r t_xs_align_c">Tax Total:</p>
                </td>
                <td colspan="1">
                    <p class="fw_medium f_size_large color_dark">$17.54</p>
                </td>
            </tr>
            <!--total-->
            <tr>
                <td colspan="4" class="v_align_m d_ib_offset_large t_xs_align_l">
                    <!--coupon-->
                    <div class="d_ib_offset_0 d_inline_middle half_column d_xs_block w_xs_full m_xs_bottom_5">
                        <?= Html::button(Yii::t('app', 'Clear All'), ['class' => 'button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark clear-all', 'data-url' => Url::to(['cart/clear-all'])]) ?>

                        <?= Html::button(Yii::t('app', 'Update Cart'), ['class' => 'button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark update-cart', 'data-url' => Url::to(['cart/update'])]) ?>


                    </div>
                    <p class="fw_medium f_size_large t_align_r scheme_color p_xs_hr_0 d_inline_middle half_column d_ib_offset_normal d_xs_block w_xs_full t_xs_align_c">Total:</p>
                </td>
                <td colspan="1" class="v_align_m">
                    <p class="fw_medium f_size_large scheme_color m_xs_bottom_10">$<?=  $shoppingCartModel->getTotal() ?></p>
                </td>
            </tr>
            <tr>

                <td colspan="4" class="v_align_m d_ib_offset_large t_xs_align_l">
                    <!--coupon-->
                    <form class="d_ib_offset_0 d_inline_middle half_column d_xs_block w_xs_full m_xs_bottom_5"  id="discount_code">
                        <input placeholder="Enter your coupon code" name="couponCode" class="r_corners f_size_medium" type="text">
                        <button type="button" class="button_type_4 r_corners bg_light_color_2 m_left_5 mw_0 tr_all_hover color_dark" id="addCoupon" data-url="<?= Url::to(['/marketing/home/coupon/add-coupon'])?>">Apply Coupon</button>
                    </form>
                </td>
                <td colspan="1" class="v_align_m">
                    <?= Html::a(Yii::t('app', 'Checkout'),Url::to(['/order/home/order/checkout']), ['class' => 'button_type_6 bg_scheme_color f_size_large r_corners tr_all_hover color_light m_bottom_20']) ?>

                </td>
            </tr>


            </tbody>
        </table>
    </section>
<?php $form->end()?>