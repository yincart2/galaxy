<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use home\assets\AppAsset;
use home\widgets\Alert;
use dektrium\user\models\LoginForm;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use star\member\models\Wishlist;
use himiklab\thumbnail\EasyThumbnailImage;
/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
    $this->head();
    list($path, $link) = $this->getAssetManager()->publish('@theme/home/default/assets');
    $this->registerCssFile($link . '/css/camera.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/owl.carousel.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/owl.transitions.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/jquery.custom-scrollbar.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/style.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/font-awesome.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);

    $this->registerJsFile($link . '/js/modernizr.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--login popup-->
<div class="popup_wrap d_none" id="login_popup">
    <section class="popup r_corners shadow">
        <button class="bg_tr color_dark tr_all_hover text_cs_hover close f_size_large"><i class="fa fa-times"></i>
        </button>
        <h3 class="m_bottom_20 color_dark">登陆</h3>
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => false,
            'validateOnBlur' => false,
            'validateOnType' => false,
            'validateOnChange' => false,
            'action' => Url::to(['/user/security/login']),
        ]);
        /** @var dektrium\user\models\LoginForm $model */
        $model = \Yii::createObject(LoginForm::className());;

        ?>
        <ul>
            <li class="m_bottom_15">
                <?= $form->field($model, 'login', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'r_corners full_width', 'tabindex' => '1']])->textInput()->label('用户名', ['class' => 'm_bottom_5 d_inline_b']) ?>
            </li>
            <li class="m_bottom_25">
                <?= $form->field($model, 'password', ['inputOptions' => ['class' => 'r_corners full_width', 'tabindex' => '2']])->passwordInput()->label(Yii::t('user', 'Password')) ?>
            </li>
            <li class="m_bottom_15">
                <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4', 'class' => 'd_none']) ?>
            </li>
            <li class="clearfix m_bottom_30">
                <?= Html::submitButton(Yii::t('user', 'Sign in'), ['class' => 'button_type_4 tr_all_hover r_corners f_left bg_scheme_color color_light f_mxs_none m_mxs_bottom_15']) ?>
                <div class="f_right f_size_medium f_mxs_none">
                    <a href="<?= Url::to(['/user/security/login']) ?>" class="color_dark">忘记密码?</a>
                </div>
            </li>
        </ul>
        <?php ActiveForm::end(); ?>

        <footer class="bg_light_color_1 t_mxs_align_c">
            <h3 class="color_dark d_inline_middle d_mxs_block m_mxs_bottom_15">新用户?    </h3>
            <a href="<?= Url::to(['/user/registration/register']) ?>" role="button"
               class="tr_all_hover r_corners button_type_4 bg_dark_color bg_cs_hover color_light d_inline_middle m_mxs_left_0">创建账号</a>
        </footer>
    </section>
</div>
<div class="boxed_layout relative w_xs_auto">
<header role="banner">
<!--header top part-->
<section class="h_top_part">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-4 col-sm-5 t_xs_align_c">
                <?php
                if (Yii::$app->user->isGuest) {
                    ?>
                    <p class="f_size_small">欢迎,您可以 <a href="#" data-popup="#login_popup">登陆</a> 或者
                        <a href="<?= Url::to(['/user/registration/register']) ?>">创建账号</a></p>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 t_align_c t_xs_align_c">
                <p class="f_size_small">Call us toll free: <b class="color_dark">(0547) 800-820-8820</b></p>
            </div>
            <nav class="col-lg-4 col-md-4 col-sm-5 t_align_r t_xs_align_c">
                <?php
                if (!Yii::$app->user->isGuest) {
                $countWishlist = count(Wishlist::findAll(['user_id' => Yii::$app->user->id]));
                ?>
                <ul class="d_inline_b horizontal_list clearfix f_size_small users_nav">
                    <li><a href="<?= Url::to(['/member']) ?>" class="default_t_color">我的的账号</a></li>
                    <li><a href="<?= Url::to(['/order/home/order/list'])?>" class="default_t_color">订单列表</a></li>
                    <li><a href="<?= Url::to(['/member/wishlist/get-wishlist'])?>" class="default_t_color">愿望清单</a></li>
                    <li><a href="<?= Url::to(['/cart/cart/index']) ?>" class="default_t_color">购物车</a></li>
                    <li><a href="<?= Url::to(['/user/security/logout']) ?>" class="default_t_color" data-method='post'>登出</a>
                    </li>
                </ul>
            </nav>
            <?php } ?>
        </div>
    </div>
</section>
<!--header bottom part-->
<section class="h_bot_part container">
    <div class="clearfix row">
        <div class="col-lg-6 col-md-6 col-sm-4 t_xs_align_c">
            <a href="<?= Url::to(['/']) ?>" class="logo m_xs_bottom_15 d_xs_inline_b">
                <img src="<?= $link ?>/images/logo.png" alt="">
            </a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-8 t_align_r t_xs_align_c">
            <ul class="d_inline_b horizontal_list clearfix t_align_l site_settings">
                <!--like-->
                <li>
                    <a role="button" href="<?= Url::to(['/member/wishlist/get-wishlist'])?>"
                       class="button_type_1 color_dark d_block bg_light_color_1 r_corners tr_delay_hover box_s_none"><i
                            class="fa fa-heart-o f_size_ex_large"></i><span class="count-wishlist count circle t_align_c"><?= Yii::$app->user->isGuest ? 0 : $countWishlist ?></span></a>
                </li>
                <li class="m_left_5" id="compare">
                    <a role="button"
                       class="button_type_1 color_dark d_block bg_light_color_1 r_corners tr_delay_hover box_s_none"><i
                            class="fa fa-files-o f_size_ex_large"></i><span class="count-compare count circle t_align_c" id="countCompare">0</span></a>
                </li>
                <!--language settings-->
                <li class="m_left_5 relative container3d">
                    <a role="button" href="#"
                       class="button_type_2 color_dark d_block bg_light_color_1 r_corners tr_delay_hover box_s_none"
                       id="lang_button"><img class="d_inline_middle m_right_10 m_mxs_right_0"
                                             src="<?= $link ?>/images/flag_en.jpg" alt=""><span class="d_mxs_none">English</span></a>
                    <ul class="dropdown_list top_arrow color_light">
                        <li><a href="#" class="tr_delay_hover color_light"><img class="d_inline_middle"
                                                                                src="<?= $link ?>/images/flag_en.jpg"
                                                                                alt="">English</a></li>
                        <li><a href="#" class="tr_delay_hover color_light"><img class="d_inline_middle"
                                                                                src="<?= $link ?>/images/flag_fr.jpg"
                                                                                alt="">French</a></li>
                        <li><a href="#" class="tr_delay_hover color_light"><img class="d_inline_middle"
                                                                                src="<?= $link ?>/images/flag_g.jpg"
                                                                                alt="">German</a></li>
                        <li><a href="#" class="tr_delay_hover color_light"><img class="d_inline_middle"
                                                                                src="<?= $link ?>/images/flag_i.jpg"
                                                                                alt="">Italian</a></li>
                        <li><a href="#" class="tr_delay_hover color_light"><img class="d_inline_middle"
                                                                                src="<?= $link ?>/images/flag_s.jpg"
                                                                                alt="">Spanish</a></li>
                    </ul>
                </li>
                <!--currency settings-->
                <li class="m_left_5 relative container3d">
                    <a role="button" href="#"
                       class="button_type_2 color_dark d_block bg_light_color_1 r_corners tr_delay_hover box_s_none"
                       id="currency_button"><span class="scheme_color">$</span> <span
                            class="d_mxs_none">US Dollar</span></a>
                    <ul class="dropdown_list top_arrow color_light">
                        <li><a href="#" class="tr_delay_hover color_light"><span class="scheme_color">$</span> US Dollar</a>
                        </li>
                        <li><a href="#" class="tr_delay_hover color_light"><span class="scheme_color">&#8364;</span>
                                Euro</a></li>
                        <li><a href="#" class="tr_delay_hover color_light"><span class="scheme_color">&#163;</span>
                                Pound</a></li>
                    </ul>
                </li>
                <!--shopping cart-->
                <li class="m_left_5 relative container3d" id="shopping_button">
                    <a role="button" href="#"
                       class="button_type_3 color_light bg_scheme_color d_block r_corners tr_delay_hover box_s_none">
										<span class="d_inline_middle shop_icon m_mxs_right_0">
											<i class="fa fa-shopping-cart"></i>
											<span class="count tr_delay_hover type_2 circle t_align_c" id="shopping_car"><?php
                                                $shoppingCartModel = new \star\cart\models\ShoppingCart();

                                                echo $shoppingCartModel->getTotalQty();
                                                ?></span>
										</span>
                        <b class="d_mxs_none">$<?= $shoppingCartModel->getTotal() ?></b>
                    </a>

                    <div class="shopping_cart top_arrow tr_all_hover r_corners">
                        <div class="f_size_medium sc_header">最近添加的商品</div>
                        <ul class="products_list">
                            <?php
                            $cartItems = $shoppingCartModel->cartItems;
                            foreach ($cartItems as $cartItem) {
                                /**@var star\catalog\models\Item $item * */
                                $sku = $cartItem->sku;
                                $item = $sku->item;
                            ?>
                                <li>
                                    <div class="clearfix">
    <!--                                    <!--product image-->
                                        <?= EasyThumbnailImage::thumbnailImg(
                                            '@image/'.$item->getMainImage(),
                                            30,
                                            30,
                                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                            ['class'=>"f_left m_right_10"]
                                        )?>
    <!--                                    <!--product description-->
                                        <div class="f_left product_description">
                                            <a href="<?= Url::to(['/catalog/home/item/view','id' => $item->item_id])?>" class="color_dark m_bottom_5 d_block"><?= $item->title?></a>
                                        </div>
    <!--                                    <!--product price-->
                                        <div class="f_left f_size_medium">
                                            <div class="clearfix">
                                                <?=  $cartItem->qty ?> x <b class="color_dark">￥<?= $sku->price?></b>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php  } ?>
                        </ul>
<!--                        <!--total price-->
                        <ul class="total_price bg_light_color_1 t_align_r color_dark">
                            <li class="m_bottom_10">运费: <span
                                    class="f_size_large sc_price t_align_l d_inline_b m_left_15">￥<?=  $shoppingCartModel->getShippingFee() ?></span></li>
                            <li>总价: <b
                                    class="f_size_large bold scheme_color sc_price t_align_l d_inline_b m_left_15">￥<?=  $shoppingCartModel->getTotal() ?></b>
                            </li>
                        </ul>
                        <div class="sc_footer t_align_c">
                            <a href="<?= Url::to(['/cart/cart/index'])?>" role="button"
                               class="button_type_4 d_inline_middle bg_light_color_2 r_corners color_dark t_align_c tr_all_hover m_mxs_bottom_5">查看购物车</a>
                            <a href="<?= Url::to(['/order/home/order/checkout'])?>" role="button"
                               class="button_type_4 bg_scheme_color d_inline_middle r_corners tr_all_hover color_light">下单</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<!--main menu container-->
<section class="menu_wrap relative">
    <div class="container clearfix">
        <!--button for responsive menu-->
        <button id="menu_button" class="r_corners centered_db d_none tr_all_hover d_xs_block m_bottom_10">
            <span class="centered_db r_corners"></span>
            <span class="centered_db r_corners"></span>
            <span class="centered_db r_corners"></span>
        </button>
        <!--main menu-->
        <nav role="navigation" class="f_left f_xs_none d_xs_none">
            <ul class="horizontal_list main_menu clearfix">
                <li class="<?= Yii::$app->request->get('catalog') || Yii::$app->request->get('tab') ? '' : 'current'?> relative f_xs_none m_xs_bottom_5">
                    <a href="<?= Url::to(['/'])?>" class="tr_delay_hover color_light tt_uppercase"><b>首页</b></a>
                </li>
                <?php
                $root = \star\system\models\Tree::find()->where(['name' => '商品分类'])->one();
                if ($root) {
                    $categories = $root->children(1)->indexBy('id')->limit(5)->all();
                    if($categories) {
                        foreach($categories as $category) {
                ?>
                <li class="<?= Yii::$app->request->get('catalog') == $category->id ? 'current' : ''?> relative f_xs_none m_xs_bottom_5">
                    <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $category->id])?>" class="tr_delay_hover color_light tt_uppercase"><b><?= $category->name?></b></a>
                    <?php
                    $children = $category->children(1)->indexBy('id')->all();
                    if($children){
                    ?>
                    <div class="sub_menu_wrap top_arrow d_xs_none type_2 tr_all_hover clearfix r_corners">
                        <ul class="sub_menu">
                            <?php  foreach($children as $child){?>
                            <li><a class="color_dark tr_delay_hover" href="<?= Url::to(['/catalog/home/item/list','catalog' => $child->id])?>"><?= $child->name?></a></li>
                            <?php } ?>

                        </ul>
                    </div>
                    <?php } ?>
                </li>
                <?php } } } ?>
                <li class="<?= Yii::$app->request->get('tab') ? 'current' : ''?> relative f_xs_none m_xs_bottom_5">
                    <a href="<?= Url::to(['/blog/home/default','tab' =>'blog'])?>" class="tr_delay_hover color_light tt_uppercase"><b>Blog</b></a>
                </li>
            </ul>
        </nav>
        <button class="f_right search_button tr_all_hover f_xs_none d_xs_none">
            <i class="fa fa-search"></i>
        </button>
    </div>
    <!--search form-->
    <div class="searchform_wrap tf_xs_none tr_all_hover">
        <div class="container vc_child h_inherit relative">
            <form role="search" class="d_inline_middle full_width">
                <input type="text" name="search" placeholder="Type text and hit enter" class="f_size_large">
            </form>
            <button class="close_search_form tr_all_hover d_xs_none color_dark">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</section>
</header>
<section class="breadcrumbs">
    <div class="container">
        <?=
        Breadcrumbs::widget([
            'itemTemplate' => '<li class="m_right_10 current"><a>{link}<i class="fa fa-angle-right d_inline_middle m_left_10"></i></a></li>',
            'options' => ['class' => 'horizontal_list clearfix bc_list f_size_medium'],
            'homeLink' => [
                'label' => Yii::t('app', 'Home'),
                'url' => Yii::$app->homeUrl,
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]);
        ?>
    </div>
</section>
<?= $content ?>;
<footer id="footer">
    <div class="footer_top_part">
        <div class="container">
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30">
                    <h3 class="color_light_2 m_bottom_20">About</h3>

                    <p class="m_bottom_25">Ut pharetra augue nec augue. Nam elit agna, endrerit sit amet, tincidunt ac,
                        viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac,
                        scelerisque.</p>
                    <!--social icons-->
                    <ul class="clearfix horizontal_list social_icons">
                        <li class="facebook m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Facebook</span>
                            <a href="#" class="r_corners t_align_c tr_delay_hover f_size_ex_large">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="twitter m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Twitter</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="google_plus m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Google Plus</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="rss m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Rss</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-rss"></i>
                            </a>
                        </li>
                        <li class="pinterest m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Pinterest</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                        <li class="instagram m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Instagram</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li class="linkedin m_bottom_5 m_sm_left_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">LinkedIn</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </li>
                        <li class="vimeo m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Vimeo</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-vimeo-square"></i>
                            </a>
                        </li>
                        <li class="youtube m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Youtube</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-youtube-play"></i>
                            </a>
                        </li>
                        <li class="flickr m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Flickr</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-flickr"></i>
                            </a>
                        </li>
                        <li class="envelope m_left_5 m_bottom_5 relative">
                            <span class="tooltip tr_all_hover r_corners color_dark f_size_small">Contact Us</span>
                            <a href="#" class="r_corners f_size_ex_large t_align_c tr_delay_hover">
                                <i class="fa fa-envelope-o"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30">
                    <h3 class="color_light_2 m_bottom_20">The Service</h3>
                    <ul class="vertical_list">
                        <li><a class="color_light tr_delay_hover" href="#">My account<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Order history<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Wishlist<i class="fa fa-angle-right"></i></a>
                        </li>
                        <li><a class="color_light tr_delay_hover" href="#">Vendor contact<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Front page<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Virtuemart categories<i
                                    class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 m_xs_bottom_30">
                    <h3 class="color_light_2 m_bottom_20">Information</h3>
                    <ul class="vertical_list">
                        <li><a class="color_light tr_delay_hover" href="#">About us<i class="fa fa-angle-right"></i></a>
                        </li>
                        <li><a class="color_light tr_delay_hover" href="#">New collection<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Best sellers<i class="fa fa-angle-right"></i></a>
                        </li>
                        <li><a class="color_light tr_delay_hover" href="#">Manufacturers<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Privacy policy<i
                                    class="fa fa-angle-right"></i></a></li>
                        <li><a class="color_light tr_delay_hover" href="#">Terms &amp; condition<i
                                    class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <h3 class="color_light_2 m_bottom_20">Newsletter</h3>

                    <p class="f_size_medium m_bottom_15">Sign up to our newsletter and get exclusive deals you wont find
                        anywhere else straight to your inbox!</p>

                    <form id="newsletter">
                        <input type="email" placeholder="Your email address"
                               class="m_bottom_20 r_corners f_size_medium full_width" name="newsletter-email">
                        <button type="submit" class="button_type_8 r_corners bg_scheme_color color_light tr_all_hover">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--copyright part-->
    <div class="footer_bottom_part">
        <div class="container clearfix t_mxs_align_c">
            <p class="f_left f_mxs_none m_mxs_bottom_10">&copy; 2014 <span class="color_light">Flatastic</span>. All
                Rights Reserved.</p>
            <ul class="f_right horizontal_list clearfix f_mxs_none d_mxs_inline_b">
                <li><img src="<?= $link ?>/images/payment_img_1.png" alt=""></li>
                <li class="m_left_5"><img src="<?= $link ?>/images/payment_img_2.png" alt=""></li>
                <li class="m_left_5"><img src="<?= $link ?>/images/payment_img_3.png" alt=""></li>
                <li class="m_left_5"><img src="<?= $link ?>/images/payment_img_4.png" alt=""></li>
                <li class="m_left_5"><img src="<?= $link ?>/images/payment_img_5.png" alt=""></li>
            </ul>
        </div>
    </div>
</footer>
</div>
<!--social widgets-->
<ul class="social_widgets d_xs_none">
    <!--facebook-->
    <li class="relative">
        <button class="sw_button t_align_c facebook"><i class="fa fa-facebook"></i></button>
        <div class="sw_content">
            <h3 class="color_dark m_bottom_20">Join Us on Facebook</h3>
            <!--            <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fenvato&amp;width=235&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=438889712801266" style="border:none; overflow:hidden; width:235px; height:258px;"></iframe>-->
        </div>
    </li>
    <!--twitter feed-->
    <li class="relative">
        <button class="sw_button t_align_c twitter"><i class="fa fa-twitter"></i></button>
        <div class="sw_content">
            <h3 class="color_dark m_bottom_20">Latest Tweets</h3>

            <div class="twitterfeed m_bottom_25"></div>
            <a role="button" class="button_type_4 d_inline_b r_corners tr_all_hover color_light tw_color"
               href="https://twitter.com/fanfbmltemplate">Follow on Twitter</a>
        </div>
    </li>
    <!--contact form-->
    <li class="relative">
        <button class="sw_button t_align_c contact"><i class="fa fa-envelope-o"></i></button>
        <div class="sw_content">
            <h3 class="color_dark m_bottom_20">Contact Us</h3>

            <p class="f_size_medium m_bottom_15">Lorem ipsum dolor sit amet, consectetuer adipis mauris</p>

            <form id="contactform" class="mini">
                <input class="f_size_medium m_bottom_10 r_corners full_width" type="text" name="cf_name"
                       placeholder="Your name">
                <input class="f_size_medium m_bottom_10 r_corners full_width" type="email" name="cf_email"
                       placeholder="Email">
                <textarea class="f_size_medium r_corners full_width m_bottom_20" placeholder="Message"
                          name="cf_message"></textarea>
                <button type="submit" class="button_type_4 r_corners mw_0 tr_all_hover color_dark bg_light_color_2">
                    Send
                </button>
            </form>
        </div>
    </li>
    <!--contact info-->
    <li class="relative">
        <button class="sw_button t_align_c googlemap"><i class="fa fa-map-marker"></i></button>
        <div class="sw_content">
            <h3 class="color_dark m_bottom_20">Store Location</h3>
            <ul class="c_info_list">
                <li class="m_bottom_10">
                    <div class="clearfix m_bottom_15">
                        <i class="fa fa-map-marker f_left color_dark"></i>

                        <p class="contact_e">8901 Marmora Road,<br> Glasgow, D04 89GR.</p>
                    </div>
                    <!--                    <iframe class="r_corners full_width" id="gmap_mini" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=ru&amp;geocode=&amp;q=Manhattan,+New+York,+NY,+United+States&amp;aq=0&amp;oq=monheten&amp;sll=37.0625,-95.677068&amp;sspn=65.430355,129.814453&amp;t=m&amp;ie=UTF8&amp;hq=&amp;hnear=%D0%9C%D0%B0%D0%BD%D1%85%D1%8D%D1%82%D1%82%D0%B5%D0%BD,+%D0%9D%D1%8C%D1%8E-%D0%99%D0%BE%D1%80%D0%BA,+%D0%9D%D1%8C%D1%8E+%D0%99%D0%BE%D1%80%D0%BA,+%D0%9D%D1%8C%D1%8E-%D0%99%D0%BE%D1%80%D0%BA&amp;ll=40.790278,-73.959722&amp;spn=0.015612,0.031693&amp;z=13&amp;output=embed"></iframe>-->
                </li>
                <li class="m_bottom_10">
                    <div class="clearfix m_bottom_10">
                        <i class="fa fa-phone f_left color_dark"></i>

                        <p class="contact_e">800-559-65-80</p>
                    </div>
                </li>
                <li class="m_bottom_10">
                    <div class="clearfix m_bottom_10">
                        <i class="fa fa-envelope f_left color_dark"></i>
                        <a class="contact_e default_t_color" href="mailto:#">info@companyname.com</a>
                    </div>
                </li>
                <li>
                    <div class="clearfix">
                        <i class="fa fa-clock-o f_left color_dark"></i>

                        <p class="contact_e">Monday - Friday: 08.00-20.00 <br>Saturday: 09.00-15.00<br> Sunday: closed
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </li>
</ul>

<!--custom popup-->

<button class="t_align_c r_corners tr_all_hover animate_ftl" id="go_to_top"><i class="fa fa-angle-up"></i></button>
<?php
$tmpJs = ["js/jquery-2.1.0.min.js", "js/jquery-ui.min.js", "js/jquery-migrate-1.2.1.min.js", "js/retina.js", "js/camera.min.js",   "js/elevatezoom.min.js", "js/jquery.fancybox-1.3.4.js",
    "js/waypoints.min.js", "js/jquery.isotope.min.js", "js/owl.carousel.min.js", "js/jquery.tweet.min.js", "js/jquery.custom-scrollbar.js", "js/scripts.js",'js/bootstrap.min.js',
];
foreach ($tmpJs as $v) {
    $this->registerJsFile($link . '/' . $v);
}
?>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5306f8f674bfda4c"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
