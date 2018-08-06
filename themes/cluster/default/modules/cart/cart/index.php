<?php
use yii\helpers\Html;
use yii\helpers\Url;
use himiklab\thumbnail\EasyThumbnailImage;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

list($url,$link) = $this->getAssetManager()->publish('@cluster/modules/cart/web');
$this->registerJsFile($link . '/js/cart.js',['depends' => [\yii\web\JqueryAsset::className()]] );

$link = $this->getAssetManager()->getPublishedUrl('@theme/cluster/default/assets');
$this->registerJsFile($link . '/js/coupon.js',['depends' => [\yii\web\JqueryAsset::className()]] );

$form = \yii\widgets\ActiveForm::begin();
?>

<input type="hidden" name="_frontendCSRF" id="_frontendCSRF" value="<?= Yii::$app->request->csrfToken ?>"/>
    <section class="section_offset">

    <h1>Shopping Cart</h1>

    <!-- - - - - - - - - - - - - - Shopping cart table - - - - - - - - - - - - - - - - -->
<?php
foreach ($cartItems as $star_id=>$carts) {
if($star_id != 0){
    //get store name by star_id
    echo 'Store Name';
}
?>
    <div class="table_wrap">

    <table class="table_type_1 shopping_cart_table">

    <thead>

    <tr>
        <th class="product_image_col">Product Image</th>
        <th class="product_title_col">Product Name</th>
<!--        <th>SKU</th>-->
        <th>Price</th>
        <th class="product_qty_col">Quantity</th>
        <th>Total</th>
        <th class="product_actions_col">Action</th>
    </tr>

    </thead>

    <tbody>
<?php
    foreach($carts as $cartItem){
    /**@var star\catalog\models\Item $item * */
    $sku = $cartItem->sku;
    $item = $sku->item;
    $itemImages = $item->itemImgs;
    if($sku && $item){
    ?>
    <tr>

        <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->

        <td class="product_image_col" data-title="Product Image">

            <a href="#">
                <?php $mainImage= isset($itemImages[0])?$itemImages[0]->pic:'';  ?>
                <?= EasyThumbnailImage::thumbnailImg(
                    '@image/'.$mainImage,
                    110,
                    110,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND
                )?>
               </a>
            <?= Html::hiddenInput('Cart[' . $cartItem->sku_id . '][item_id]', $cartItem->sku_id) ?>
            <?= Html::hiddenInput('Cart[' . $cartItem->sku_id . '][name]', $item->title); ?>
        </td>

        <!-- - - - - - - - - - - - - - End of product Image - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Product name - - - - - - - - - - - - - - - - -->

        <td data-title="Product Name">

            <a href="#" class="product_title"><?= $item->title?></a>

            <ul class="sc_product_info">

                <?php
                foreach( \yii\helpers\Json::decode($sku->props_name ) as $v){
                    echo '<li>'.$v.'</li>';
                }?>

            </ul>

        </td>

        <!-- - - - - - - - - - - - - - End of product name - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - SKU - - - - - - - - - - - - - - - - -->

<!--        <td data-title="SKU">-->
<!---->
<!--            --><?php
//            foreach( \yii\helpers\Json::decode($sku->props_name ) as $v){
//                echo $v.';';
//            }?>
<!---->
<!--        </td>-->

        <!-- - - - - - - - - - - - - - End of SKU - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->

        <td class="subtotal" data-title="Price">

            $<?= $sku->price?>

        </td>

        <!-- - - - - - - - - - - - - - End of Price - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Quantity - - - - - - - - - - - - - - - - -->

        <td data-title="Quantity">

            <div class="qty min clearfix">

                <button type="button" class="theme_button" data-direction="minus">&#45;</button>
                <input type="text" name="Cart[<?=  $cartItem->sku_id ?>][qty]" readonly value="<?=  $cartItem->qty ?>">
                <button type="button" class="theme_button" data-direction="plus">&#43;</button>

            </div><!--/ .qty.min.clearfix-->

        </td>

        <!-- - - - - - - - - - - - - - End of quantity - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Total - - - - - - - - - - - - - - - - -->

        <td class="total" data-title="Total">

            $<?=  $shoppingCartModel->getSubTotal($sku->sku_id) ?>

        </td>

        <!-- - - - - - - - - - - - - - End of total - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Action - - - - - - - - - - - - - - - - -->

        <td data-title="Action">


            <a href="javascript:;" class="button_dark_grey icon_btn remove_product  remove-item" data-item="<?= $sku->sku_id?>" data-url="<?= Url::to(['/cart/cart/remove'])?>"><i class="icon-cancel-2"></i></a>

        </td>

        <!-- - - - - - - - - - - - - - End of action - - - - - - - - - - - - - - - - -->

    </tr>
        <?php } ?>
    <?php } ?>

    </tbody>

    </table>

    </div><!--/ .table_wrap -->
    <?php if($star_id != 0){ ?>
    <div class="row">

        <section class=" col-md-4 col-md-offset-8 ">
            <div class="table_wrap">

                <table class="zebra">

                    <tfoot>

                    <tr>

                        <td>Shipment Fee:</td>
                        <td>$<?=  $shoppingCartModel->getShippingFee() ?></td>

                    </tr>

                    <tr class="total">

                        <td>Total</td>
                        <td>$<?=  $shoppingCartModel->getTotal(0,$star_id) ?></td>

                    </tr>

                    </tfoot>

                </table>

            </div>

            <footer class="bottom_box">

                <a class="button_blue middle_btn" href="<?= Url::to(['/order/home/order/checkout','star_id'=>$star_id])?>" >Proceed to Checkout</a>

                <div class="single_link_wrap">

                    <a href="#">Checkout with Multiple Addresses</a>

                </div>

            </footer>

        </section><!-- / [col] -->

    </div><!--/ .row -->
<?php }
} ?>


    <footer class="bottom_box on_the_sides">

        <div class="left_side">

            <a href="javascript:;" class="button_blue middle_btn update-cart" data-url = <?= Url::to(['cart/update'])?>>Update</a>

        </div>

        <div class="right_side">

            <a href="javascript:;" class="button_grey middle_btn clear-all"  data-url = <?= Url::to(['cart/clear-all'])?>>Clear Shopping Cart</a>

        </div>

    </footer><!--/ .bottom_box -->

    <!-- - - - - - - - - - - - - - End of shopping cart table - - - - - - - - - - - - - - - - -->

    </section><!--/ .section_offset -->
<?php $form->end()?>

<div class="section_offset">

    <div class="row">

        <section class="col-sm-4">

            <h3>Discount Codes</h3>

            <div class="theme_box">

                <p class="form_caption">Enter your coupon code if you have one.</p>

                <form id="discount_code">

                    <ul>

                        <li class="row">

                            <div class="col-xs-12">

                                <input type="text" name="couponCode">

                            </div>

                        </li>

                    </ul>

                </form>

            </div><!--/ .theme_box -->

            <footer class="bottom_box">

                <button type="button" form="discount_code" class="button_grey middle_btn" id="addCoupon" data-url="<?= Url::to(['/marketing/home/coupon/add-coupon'])?>">Apply Coupon</button>

            </footer>

        </section><!--/ [col] -->

        <section class="col-sm-4">

            <h3>Estimate Shipping and Tax</h3>

            <div class="theme_box">

                <p class="form_caption">Enter your destination to get a shipping estimate.</p>

                <form id="estimate_shipping" class="type_2">

                    <ul>

                        <li class="row">

                            <div class="col-xs-12">

                                <label>Country</label>

                                <div class="custom_select">

                                    <select>

                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Canada">Canada</option>
                                        <option selected value="USA">USA</option>

                                    </select>

                                </div>

                            </div>

                        </li>

                        <li class="row">

                            <div class="col-lg-7 col-md-6">

                                <label>State/Province</label>

                                <div class="custom_select">

                                    <select>

                                        <option value="Alabama">Alabama</option>
                                        <option value="Illinois">Illinois</option>
                                        <option value="Kansas">Kansas</option>

                                    </select>

                                </div>

                            </div><!--/ [col] -->

                            <div class="col-lg-5 col-md-6">

                                <label for="postal_code">Zip/Postal Code</label>
                                <input type="text" name="" id="postal_code">

                            </div><!--/ [col] -->

                        </li>

                    </ul>

                </form>

            </div><!--/ .theme_box -->

            <footer class="bottom_box">

                <button type="submit" form="estimate_shipping" class="button_grey middle_btn">Get a Quote</button>

            </footer><!--/ .bottom_box -->

        </section><!--/ [col] -->

        <section class="col-sm-4">

            <h3>Total</h3>

            <div class="table_wrap">

                <table class="zebra">

                    <tfoot>

                    <tr>

                        <td>Shipment Fee:</td>
                        <td>$<?=  $shoppingCartModel->getShippingFee() ?></td>

                    </tr>

                    <tr class="total">

                        <td>Total</td>
                        <td>$<?=  $shoppingCartModel->getTotal() ?></td>

                    </tr>

                    </tfoot>

                </table>

            </div>

            <footer class="bottom_box">

                <a class="button_blue middle_btn" href="<?= Url::to(['/order/home/order/checkout'])?>">Proceed to Checkout</a>

                <div class="single_link_wrap">

                    <a href="#">Checkout with Multiple Addresses</a>

                </div>

            </footer>

        </section><!-- / [col] -->

    </div><!--/ .row -->

</div><!--/ .section_offset -->