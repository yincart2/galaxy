<?php
use yii\helpers\Html;
use home\assets\AppAsset;
use home\widgets\Alert;

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
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <?php
    $this->head();
    list($path, $link) = $this->getAssetManager()->publish('@theme/star/cluster/assets');
    $this->registerCssFile($link . '/css/animate.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/fontello.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/js/rs-plugin/css/settings.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/js/owlcarousel/owl.carousel.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/css/style.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
    $this->registerCssFile($link . '/js/arcticmodal/jquery.arcticmodal.css', ['depends' => [\yii\web\JqueryAsset::className()]]);

    $this->registerJsFile($link . '/js/modernizr.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
    ?>
</head>
<body class="front_page promo_popup">
<?php $this->beginBody() ?>
<!-- - - - - - - - - - - - - - Cookie Message - - - - - - - - - - - - - - - - -->

<div class="cookie_message">

    <div class="container">

        <div class="on_the_sides">

            <div class="left_side">Please note this website requires cookies in order to function correctly, they do not store any specific information about your personally.</div>

            <div class="right_side">

                <div class="buttons_row">

                    <a href="#" class="button_blue accept_cookie">Accept Cookies</a>

                    <a href="#" class="button_dark_grey">Read More</a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- - - - - - - - - - - - - - End of Cookie Message - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Old ie alert message - - - - - - - - - - - - - - - - -->

<!--[if lt IE 9]>

<div class="ie_alert_message">

    <div class="container">

        <div class="on_the_sides">

            <div class="left_side">

                <i class="icon-attention-5"></i> <span class="bold">Attention!</span> This page may not display correctly. You are using an outdated version of Internet Explorer. For a faster, safer browsing experience.</span>

            </div>

            <div class="right_side">

                <a target="_blank" href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode" class="button_black">Update Now!</a>

            </div>

        </div>

    </div>

</div>

<![endif]-->

<!-- - - - - - - - - - - - - - End of old ie alert message - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

<div class="wide_layout">

<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

<header id="header" class="type_6">

<!-- - - - - - - - - - - - - - Top part - - - - - - - - - - - - - - - - -->

<div class="top_part">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 col-md-7 col-sm-8">

                <!-- - - - - - - - - - - - - - Login - - - - - - - - - - - - - - - - -->

                <p>Welcom visitor <a href="#" data-modal-url="modals/login.html">Login</a> or <a href="#">Register</a></p>

                <!-- - - - - - - - - - - - - - End login - - - - - - - - - - - - - - - - -->

            </div> <!--/ [col]-->

            <div class="col-lg-6 col-md-5 col-sm-4">

                <div class="clearfix">

                    <!-- - - - - - - - - - - - - - Language change - - - - - - - - - - - - - - - - -->

                    <div class="alignright site_settings">

                        <span class="current open_"><img src="images/flag_en.jpg" alt="">English</span>

                        <ul class="dropdown site_setting_list language">

                            <li class="animated_item"><a href="#"><img src="images/flag_en.jpg" alt=""> English</a></li>
                            <li class="animated_item"><a href="#"><img src="images/flag_g.jpg" alt=""> German</a></li>
                            <li class="animated_item"><a href="#"><img src="images/flag_s.jpg" alt=""> Spanish</a></li>

                        </ul>

                    </div><!--/ .alignright.site_settings-->

                    <!-- - - - - - - - - - - - - - End of language change - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Currency change - - - - - - - - - - - - - - - - -->

                    <div class="alignright site_settings currency">

                        <span class="current open_">USD</span>

                        <ul class="dropdown site_setting_list">

                            <li class="animated_item"><a href="#">USD</a></li>
                            <li class="animated_item"><a href="#">EUR</a></li>
                            <li class="animated_item"><a href="#">GBP</a></li>

                        </ul>

                    </div><!--/ .alignright.site_settings.currency-->

                    <!-- - - - - - - - - - - - - - End of currency change - - - - - - - - - - - - - - - - -->

                </div><!--/ .clearfix-->

            </div><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container -->

</div><!--/ .top_part -->

<!-- - - - - - - - - - - - - - End of top part - - - - - - - - - - - - - - - - -->

<hr>

<!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->

<div class="bottom_part">

    <div class="container">

        <div class="row">

            <div class="main_header_row">

                <div class="col-sm-3">

                    <!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

                    <a href="index.html" class="logo">

                        <img src="images/logo.png" alt="">

                    </a>

                    <!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->

                </div><!--/ [col]-->

                <div class="col-sm-3">

                    <!-- - - - - - - - - - - - - - Call to action - - - - - - - - - - - - - - - - -->

                    <div class="call_us">

                        <span>Call us toll free:</span> <b>+1888 234 5678</b>

                    </div><!--/ .call_us-->

                    <!-- - - - - - - - - - - - - - End call to action - - - - - - - - - - - - - - - - -->

                </div><!--/ [col]-->

                <div class="col-sm-6">

                    <!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->

                    <form class="clearfix search">

                        <input type="text" name="" tabindex="1" placeholder="Search..." class="alignleft">

                        <!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->

                        <div class="search_category alignleft">

                            <div class="open_categories">All Categories</div>

                            <ul class="categories_list dropdown">

                                <li class="animated_item"><a href="#">Medicine &amp; Health</a></li>
                                <li class="animated_item"><a href="#">Beauty</a></li>
                                <li class="animated_item"><a href="#">Personal Care</a></li>
                                <li class="animated_item"><a href="#">Vitamins &amp; Supplements</a></li>
                                <li class="animated_item"><a href="#">Baby Needs</a></li>
                                <li class="animated_item"><a href="#">Diet &amp; Fitness</a></li>
                                <li class="animated_item"><a href="#">Sexual Well-being</a></li>

                            </ul>

                        </div><!--/ .search_category.alignleft-->

                        <!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->

                        <button class="button_blue def_icon_btn alignleft"></button>

                    </form><!--/ #search-->

                    <!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->

                </div><!--/ [col]-->

            </div><!--/ .main_header_row-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .bottom_part -->

<!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Main navigation wrapper - - - - - - - - - - - - - - - - -->

<div id="main_navigation_wrap">

<div class="container">

<div class="row">

<div class="col-xs-12">

<!-- - - - - - - - - - - - - - Sticky container - - - - - - - - - - - - - - - - -->

<div class="sticky_inner type_2">

<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

<div class="nav_item size_4">

<button class="open_menu"></button>

<!-- - - - - - - - - - - - - - Main navigation - - - - - - - - - - - - - - - - -->

<ul class="theme_menu cats dropdown">

<li class="has_megamenu animated_item">

    <a href="#">Medicine &amp; Health (1375)</a>

    <!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

    <div class="mega_menu clearfix">

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <ul class="list_of_links">

                <li><a href="#">Allergy &amp; Sinus</a></li>
                <li><a href="#">Children's Healthcare</a></li>
                <li><a href="#">Cough, Cold &amp; Flu</a></li>
                <li><a href="#">Diabetes Management</a></li>
                <li><a href="#">Digestion &amp; Nausea</a></li>
                <li><a href="#">Eye Care</a></li>
                <li><a href="#">First Aid</a></li>
                <li><a href="#">Foot Care</a></li>
                <li><a href="#">Health Clearance</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <ul class="list_of_links">

                <li><a href="#">Home Health Care</a></li>
                <li><a href="#">Home Tests</a></li>
                <li><a href="#">Incontinence Aids</a></li>
                <li><a href="#">Natural &amp; Homeopathic</a></li>
                <li><a href="#">Pain &amp; Fever Relief</a></li>
                <li><a href="#">Skin Condition Treatments</a></li>
                <li><a href="#">Sleep &amp; Snoring aids</a></li>
                <li><a href="#">Stop Smoking Aids</a></li>
                <li><a href="#">Support &amp; Braces</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

    </div><!--/ .mega_menu-->

    <!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

</li>
<li class="has_megamenu animated_item">

    <a href="#">Beauty (1687)</a>

    <!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

    <div class="mega_menu type_2 clearfix">

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <h6><b>By Category</b></h6>

            <ul class="list_of_links">

                <li><a href="#">Bath &amp; Spa</a></li>
                <li><a href="#">Beauty Clearance</a></li>
                <li><a href="#">Gift Sets</a></li>
                <li><a href="#">Hair Care</a></li>
                <li><a href="#">Makeup &amp; Accessories</a></li>
                <li><a href="#">Skin Care</a></li>
                <li><a href="#">Tools &amp; Accessories</a></li>
                <li><a href="#" class="all">View All Categories</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <h6><b>By Brand</b></h6>

            <ul class="list_of_links">

                <li><a href="#">Abibas</a></li>
                <li><a href="#">Agedir</a></li>
                <li><a href="#">Aldan</a></li>
                <li><a href="#">Biomask</a></li>
                <li><a href="#">Gamman</a></li>
                <li><a href="#">Pallona</a></li>
                <li><a href="#">Pure Care</a></li>
                <li><a href="#" class="all">View All Brands</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <a href="#">
                <img src="images/mega_menu_img_1.jpg" alt="">
            </a>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

    </div><!--/ .mega_menu-->

    <!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

</li>
<li class="has_megamenu animated_item">

    <a href="#">Personal Care (1036)</a>

    <!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

    <div class="mega_menu type_3 clearfix">

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <ul class="list_of_links">

                <li><a href="#">Oral Care</a></li>
                <li><a href="#">Shaving &amp; Hair Removal</a></li>
                <li><a href="#">Men's</a></li>
                <li><a href="#">Sun Care</a></li>
                <li><a href="#">Clearance</a></li>
                <li><a href="#">Feminine Care</a></li>
                <li><a href="#">Gift Sets</a></li>
                <li><a href="#">Soaps &amp; Bodywash</a></li>
                <li><a href="#">Massage &amp; Relaxation</a></li>
                <li><a href="#">Foot Care</a></li>
                <li><a href="#" class="all">View All Categories</a></li>

            </ul>

        </div><!--/ .mega_menu_item -->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item products_in_mega_menu">

            <h6 class="widget_title"><b>Today's Deals</b></h6>

            <div class="row">

                <div class="col-sm-4">

                    <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

                    <div class="product_item">

                        <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

                        <div class="image_wrap">

                            <img src="images/product_img_11.jpg" alt="">

                        </div><!--/. image_wrap-->

                        <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

                        <div class="label_offer percentage">

                            <div>30%</div>OFF

                        </div>

                        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

                        <div class="description">

                            <p><a href="#">Ivory Body Wash, Original 24 fl oz</a></p>

                            <div class="clearfix product_info">

                                <p class="product_price alignleft"><s>$9.99</s> <b>$5.99</b></p>

                            </div><!--/ .clearfix.product_info-->

                        </div>

                        <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

                    </div><!--/ .product_item-->

                    <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

                </div><!--/ [col]-->

                <div class="col-sm-4">

                    <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

                    <div class="product_item">

                        <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

                        <div class="image_wrap">

                            <img src="images/product_img_12.jpg" alt="">

                        </div><!--/. image_wrap-->

                        <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

                        <div class="label_offer percentage">

                            <div>25%</div>OFF

                        </div>

                        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

                        <div class="description">

                            <p><a href="#">Luvs with Leakguards, Size 4 Diapers 29 ea</a></p>

                            <div class="clearfix product_info">

                                <p class="product_price alignleft"><s>$16.99</s> <b>$14.99</b></p>

                            </div><!--/ .clearfix.product_info-->

                        </div>

                        <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

                    </div><!--/ .product_item-->

                    <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

                </div><!--/ [col]-->

                <div class="col-sm-4">

                    <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

                    <div class="product_item">

                        <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

                        <div class="image_wrap">

                            <img src="images/product_img_13.jpg" alt="">

                        </div><!--/. image_wrap-->

                        <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

                        <div class="label_offer percentage">

                            <div>40%</div>OFF

                        </div>

                        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

                        <div class="description">

                            <p><a href="#">Doctor's Best Curcumin C3 Complex with...</a></p>

                            <div class="clearfix product_info">

                                <p class="product_price alignleft"><s>$103.99</s> <b>$73.99</b></p>

                            </div><!--/ .clearfix.product_info-->

                        </div>

                        <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

                    </div><!--/ .product_item-->

                    <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

                </div><!--/ [col]-->

            </div><!--/ .row-->

            <hr>

            <a href="#" class="button_grey">View All Deals</a>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

    </div><!--/ .mega_menu-->

    <!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

</li>
<li class="has_megamenu animated_item">

    <a href="#">Vitamins &amp; Supplements (202)</a>

    <!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

    <div class="mega_menu type_4 clearfix">

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <h6><b>By Condition</b></h6>

            <ul class="list_of_links">

                <li><a href="#">Aches &amp; Pains</a></li>
                <li><a href="#">Acne Solutions</a></li>
                <li><a href="#">Allergy &amp; Sinus</a></li>
                <li><a href="#" class="all">View All</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <h6><b>Multivitamins</b></h6>

            <ul class="list_of_links">

                <li><a href="#">50+ Multivitamins</a></li>
                <li><a href="#">Children's Multivitamins</a></li>
                <li><a href="#">Men's Multivitamins</a></li>
                <li><a href="#" class="all">View All</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Mega menu item - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_item">

            <h6><b>Herbs</b></h6>

            <ul class="list_of_links">

                <li><a href="#">Aloe Vera</a></li>
                <li><a href="#">Ashwagandha</a></li>
                <li><a href="#">Astragalus</a></li>
                <li><a href="#" class="all">View All</a></li>

            </ul>

        </div><!--/ .mega_menu_item-->

        <!-- - - - - - - - - - - - - - End of mega menu item - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->

        <div class="mega_menu_banner">

            <a href="#">
                <img src="images/mega_menu_img_2.jpg" alt="">
            </a>

        </div><!--/ .mega_menu_banner-->

        <!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

    </div><!--/ .mega_menu-->

    <!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->

</li>
<li class="has_megamenu animated_item"><a href="#">Baby Needs (525)</a></li>
<li class="has_megamenu animated_item"><a href="#">Diet &amp; Fitness (135)</a></li>
<li class="has_megamenu animated_item"><a href="#">Sexuall Well-being (298)</a></li>
<li class="has_megamenu animated_item"><a href="#" class="all"><b>All Categories</b></a></li>

</ul>

<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

</div><!--/ .nav_item-->

<!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

<div class="nav_item">

    <nav class="main_navigation">

        <ul>

            <li class="current"><a href="index.html">Home</a></li>
            <li><a href="shop_my_account.html">My Account</a></li>
            <li><a href="shop_shopping_cart.html">Shopping Cart</a></li>
            <li><a href="shop_checkout.html">Checkout</a></li>
            <li><a href="blog_v1.html">Blog</a></li>
            <li><a href="additional_page_contact.html">Contact Us</a></li>

            <li class="has_submenu">

                <a href="index.html">Pages</a>

                <!-- - - - - - - - - - - - - - Submenu (level 2) - - - - - - - - - - - - - - - - -->

                <ul class="theme_menu submenu">

                    <li class="has_submenu current">

                        <a href="index.html">Homepage Layouts</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li class="current"><a href="index.html">Home 1</a></li>
                            <li><a href="home_v2.html">Home 2</a></li>
                            <li><a href="home_v3.html">Home 3</a></li>
                            <li><a href="home_v4.html">Home 4</a></li>
                            <li><a href="home_v5.html">Home 5</a></li>
                            <li><a href="home_v6.html">Home 6</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                    <li class="has_submenu">

                        <a href="category_page_v1.html">Category Page Layouts</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li><a href="category_page_v1.html">Category page 1</a></li>
                            <li><a href="category_page_v2.html">Category page 2</a></li>
                            <li><a href="category_page_v3.html">Category page 3</a></li>
                            <li><a href="category_page_v4.html">Category page 4</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                    <li class="has_submenu">

                        <a href="product_page_v1.html">Product Page Layouts</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li><a href="product_page_v1.html">Product page 1</a></li>
                            <li><a href="product_page_v2.html">Product page 2</a></li>
                            <li><a href="product_page_v3.html">Product page 3</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                    <li class="has_submenu">

                        <a href="shop_shopping_cart.html">Other Shop Pages</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li><a href="shop_shopping_cart.html">Shopping cart</a></li>
                            <li><a href="shop_checkout.html">Checkout</a></li>
                            <li><a href="shop_wishlist.html">Wishlist</a></li>
                            <li><a href="shop_product_comparison.html">Product Comparison</a></li>
                            <li><a href="shop_my_account.html">My Account</a></li>
                            <li><a href="shop_manufacturers.html">Manufacturers</a></li>
                            <li><a href="shop_manufacturer_page.html">Manufacturer Page</a></li>
                            <li><a href="shop_orders_list.html">Order List</a></li>
                            <li><a href="shop_order_page.html">Order Page</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                    <li class="has_submenu">

                        <a href="additional_page_about.html">Additional Pages</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li><a href="additional_page_about.html">About Us</a></li>
                            <li><a href="additional_page_contact.html">Contact Us</a></li>
                            <li><a href="additional_page_faq.html">FAQ</a></li>
                            <li><a href="additional_page_404.html">404 Page</a></li>
                            <li><a href="additional_page_sitemap.html">Sitemap</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                    <li class="has_submenu">

                        <a href="extra_stuff_elements.html">Extra Stuff</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li><a href="extra_stuff_elements.html">Elements</a></li>
                            <li><a href="extra_stuff_typography.html">Typography</a></li>
                            <li><a href="extra_stuff_columns.html">Columns</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                    <li class="has_submenu">

                        <a href="blog_v1.html">Blog Pages</a>

                        <!-- - - - - - - - - - - - - - Submenu (level 3) - - - - - - - - - - - - - - - - -->

                        <ul class="theme_menu submenu">

                            <li><a href="blog_v1.html">Blog v1</a></li>
                            <li><a href="blog_v2.html">Blog v2</a></li>
                            <li><a href="blog_v3.html">Blog v3</a></li>
                            <li><a href="blog_post_v1.html">Blog Post v1</a></li>
                            <li><a href="blog_post_v2.html">Blog Post v2</a></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End submenu (level 3) - - - - - - - - - - - - - - - - -->

                    </li>

                </ul>

                <!-- - - - - - - - - - - - - - End submenu (level 2) - - - - - - - - - - - - - - - - -->

            </li>

        </ul>

    </nav><!--/ .main_navigation-->

</div>

<!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

<div class="nav_item size_4">

    <a href="#" class="wishlist_button" data-amount="7"></a>

</div><!--/ .nav_item-->

<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

<div class="nav_item size_4">

    <a href="#" class="compare_button" data-amount="3"></a>

</div><!--/ .nav_item-->

<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

<div class="nav_item size_3">

    <button id="open_shopping_cart" class="open_button" data-amount="3">
        <b class="title">My Cart</b>
        <b class="total_price">$999.00</b>
    </button>

    <!-- - - - - - - - - - - - - - Products list - - - - - - - - - - - - - - - - -->

    <div class="shopping_cart dropdown">

        <div class="animated_item">

            <p class="title">Recently added item(s)</p>

            <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

            <div class="clearfix sc_product">

                <a href="#" class="product_thumb"><img src="images/sc_img_1.jpg" alt=""></a>

                <a href="#" class="product_name">Natural Factors PGX Daily Ultra Matrix...</a>

                <p>1 x $499.00</p>

                <button class="close"></button>

            </div><!--/ .clearfix.sc_product-->

            <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

        </div><!--/ .animated_item-->

        <div class="animated_item">

            <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

            <div class="clearfix sc_product">

                <a href="#" class="product_thumb"><img src="images/sc_img_2.jpg" alt=""></a>

                <a href="#" class="product_name">Oral-B Glide Pro-Health Floss...</a>

                <p>1 x $499.00</p>

                <button class="close"></button>

            </div><!--/ .clearfix.sc_product-->

            <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

        </div><!--/ .animated_item-->

        <div class="animated_item">

            <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

            <div class="clearfix sc_product">

                <a href="#" class="product_thumb"><img src="images/sc_img_3.jpg" alt=""></a>

                <a href="#" class="product_name">Culturelle Kids! Probi-<br>otic Packets 30 ea</a>

                <p>1 x $499.00</p>

                <button class="close"></button>

            </div><!--/ .clearfix.sc_product-->

            <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

        </div><!--/ .animated_item-->

        <div class="animated_item">

            <!-- - - - - - - - - - - - - - Total info - - - - - - - - - - - - - - - - -->

            <ul class="total_info">

                <li><span class="price">Tax:</span> $0.00</li>

                <li><span class="price">Discount:</span> $37.00</li>

                <li class="total"><b><span class="price">Total:</span> $999.00</b></li>

            </ul>

            <!-- - - - - - - - - - - - - - End of total info - - - - - - - - - - - - - - - - -->

        </div><!--/ .animated_item-->

        <div class="animated_item">

            <a href="#" class="button_grey">View Cart</a>

            <a href="#" class="button_blue">Checkout</a>

        </div><!--/ .animated_item-->

    </div><!--/ .shopping_cart.dropdown-->

    <!-- - - - - - - - - - - - - - End of products list - - - - - - - - - - - - - - - - -->

</div><!--/ .nav_item-->

<!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

</div><!--/ .sticky_inner -->

<!-- - - - - - - - - - - - - - End of sticky container - - - - - - - - - - - - - - - - -->

</div><!--/ [col]-->

</div><!--/ .row-->

</div><!--/ .container-->

</div><!--/ .main_navigation_wrap-->

<!-- - - - - - - - - - - - - - End of main navigation wrapper - - - - - - - - - - - - - - - - -->

</header>

<!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="page_wrapper">

<div class="container">

    <?= $content ?>

</div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

<footer id="footer">

<div class="container">

    <!-- - - - - - - - - - - - - - Infoblocks - - - - - - - - - - - - - - - - -->

    <div class="infoblocks_container">

        <ul class="infoblocks_wrap">

            <li>
                <a href="#" class="infoblock type_1">

                    <i class="icon-paper-plane"></i>
                    <span class="caption"><b>Fast &amp; Free Delivery</b></span>

                </a><!--/ .infoblock-->
            </li>

            <li>
                <a href="#" class="infoblock type_1">

                    <i class="icon-lock"></i>
                    <span class="caption"><b>Safe &amp; Secure Payment</b></span>

                </a><!--/ .infoblock-->
            </li>

            <li>
                <a href="#" class="infoblock type_1">

                    <i class="icon-money"></i>
                    <span class="caption"><b>100% Money back Guaranted</b></span>

                </a><!--/ .infoblock-->
            </li>

        </ul><!--/ .infoblocks_wrap.section_offset.clearfix-->

    </div><!--/ .infoblocks_container -->

    <!-- - - - - - - - - - - - - - End of infoblocks - - - - - - - - - - - - - - - - -->

</div><!--/ .container -->

<!-- - - - - - - - - - - - - - Footer section- - - - - - - - - - - - - - - - -->

<div class="footer_section">

<div class="container">

<div class="row">

<div class="col-md-3 col-sm-6">

    <!-- - - - - - - - - - - - - - About us widget- - - - - - - - - - - - - - - - -->

    <section class="widget">

        <h4>About Us</h4>

        <p class="about_us">Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euis- mod in auctor ut, ligula. Aliquam dapibus tincidunt metus.</p>

        <!-- - - - - - - - - - - - - - Social icon's list - - - - - - - - - - - - - - - - -->

        <ul class="social_btns">

            <li>
                <a href="#" class="icon_btn middle_btn social_facebook tooltip_container"><i class="icon-facebook-1"></i><span class="tooltip top">Facebook</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn  social_twitter tooltip_container"><i class="icon-twitter"></i><span class="tooltip top">Twitter</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_googleplus tooltip_container"><i class="icon-gplus-2"></i><span class="tooltip top">GooglePlus</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_pinterest tooltip_container"><i class="icon-pinterest-3"></i><span class="tooltip top">Pinterest</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_flickr tooltip_container"><i class="icon-flickr-1"></i><span class="tooltip top">Flickr</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_youtube tooltip_container"><i class="icon-youtube"></i><span class="tooltip top">Youtube</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_vimeo tooltip_container"><i class="icon-vimeo-2"></i><span class="tooltip top">Vimeo</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_instagram tooltip_container"><i class="icon-instagram-4"></i><span class="tooltip top">Instagram</span></a>
            </li>

            <li>
                <a href="#" class="icon_btn middle_btn social_linkedin tooltip_container"><i class="icon-linkedin-5"></i><span class="tooltip top">LinkedIn</span></a>
            </li>

        </ul>

        <!-- - - - - - - - - - - - - - End social icon's list - - - - - - - - - - - - - - - - -->

    </section>

    <!-- - - - - - - - - - - - - - End of about us widget - - - - - - - - - - - - - - - - -->

</div><!--/ [col]-->

<div class="col-md-2 col-sm-6">

    <!-- - - - - - - - - - - - - - Information widget - - - - - - - - - - - - - - - - -->

    <section class="widget">

        <h4>Information</h4>

        <ul class="list_of_links">

            <li><a href="#">About Us</a></li>
            <li><a href="#">Delivery Information</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms &amp; Conditions</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">FAQ</a></li>

        </ul>

    </section><!--/ .widget-->

    <!-- - - - - - - - - - - - - - End of information widget - - - - - - - - - - - - - - - - -->

</div><!--/ [col]-->

<div class="col-md-2 col-sm-6">

    <!-- - - - - - - - - - - - - - Extras widget - - - - - - - - - - - - - - - - -->

    <section class="widget">

        <h4>Extras</h4>

        <ul class="list_of_links">

            <li><a href="#">Brands</a></li>
            <li><a href="#">Gift Vouchers</a></li>
            <li><a href="#">Affiliates</a></li>
            <li><a href="#">Specials</a></li>
            <li><a href="#">Deals</a></li>

        </ul>

    </section><!--/ .widget-->

    <!-- - - - - - - - - - - - - - End of extras widget - - - - - - - - - - - - - - - - -->

</div><!--/ [col]-->

<div class="col-md-2 col-sm-6">

    <!-- - - - - - - - - - - - - - My account widget - - - - - - - - - - - - - - - - -->

    <section class="widget">

        <h4>My Account</h4>

        <ul class="list_of_links">

            <li><a href="#">My Account</a></li>
            <li><a href="#">Order History</a></li>
            <li><a href="#">Returns</a></li>
            <li><a href="#">Wish List</a></li>
            <li><a href="#">Newsletter</a></li>

        </ul>

    </section><!--/ .widget-->

    <!-- - - - - - - - - - - - - - End my account widget - - - - - - - - - - - - - - - - -->

</div>

<div class="col-md-3 col-sm-6">

    <!-- - - - - - - - - - - - - - Blog widget - - - - - - - - - - - - - - - - -->

    <section class="widget">

        <h4>Latest News</h4>

        <ul class="list_of_entries">

            <!-- - - - - - - - - - - - - - Entry - - - - - - - - - - - - - - - - -->

            <li>

                <article class="entry">

                    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

                    <a href="#" class="entry_thumb">

                        <img src="images/latest_news_thumb_1.jpg" alt="">

                    </a>

                    <!-- - - - - - - - - - - - - - End of thumbnail - - - - - - - - - - - - - - - - -->

                    <div class="wrapper">

                        <h6 class="entry_title"><a href="#">Vestibulum sed ante</a></h6>

                        <!-- - - - - - - - - - - - - - Byline - - - - - - - - - - - - - - - - -->

                        <div class="entry_meta">

                            <span><i class="icon-calendar"></i> 2014-08-05 07:01:49</span>

                        </div><!--/ .entry_meta-->

                        <!-- - - - - - - - - - - - - - End of byline - - - - - - - - - - - - - - - - -->

                    </div><!--/ .wrapper-->

                </article><!--/ .clearfix-->

            </li>

            <!-- - - - - - - - - - - - - - End of entry - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Entry - - - - - - - - - - - - - - - - -->

            <li>

                <article class="entry">

                    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

                    <a href="#" class="entry_thumb">

                        <img src="images/latest_news_thumb_2.jpg" alt="">

                    </a>

                    <!-- - - - - - - - - - - - - - End of thumbnail - - - - - - - - - - - - - - - - -->

                    <div class="wrapper">

                        <h6 class="entry_title"><a href="#">Nulla venenatis</a></h6>

                        <!-- - - - - - - - - - - - - - Byline - - - - - - - - - - - - - - - - -->

                        <div class="entry_meta">

                            <span><i class="icon-calendar"></i> 2014-08-05 07:01:49</span>

                        </div><!--/ .entry_meta-->

                        <!-- - - - - - - - - - - - - - End of byline - - - - - - - - - - - - - - - - -->

                    </div><!--/ .wrapper-->

                </article><!--/ .clearfix-->

            </li>

            <!-- - - - - - - - - - - - - - End of entry - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Entry - - - - - - - - - - - - - - - - -->

            <li>

                <article class="entry">

                    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

                    <a href="#" class="entry_thumb">

                        <img src="images/latest_news_thumb_3.jpg" alt="">

                    </a>

                    <!-- - - - - - - - - - - - - - End of thumbnail - - - - - - - - - - - - - - - - -->

                    <div class="wrapper">

                        <h6 class="entry_title"><a href="#">Pellentesque sed dolor</a></h6>

                        <!-- - - - - - - - - - - - - - Byline - - - - - - - - - - - - - - - - -->

                        <div class="entry_meta">

                            <span><i class="icon-calendar"></i> 2014-08-05 07:01:49</span>

                        </div><!--/ .entry_meta-->

                        <!-- - - - - - - - - - - - - - End of byline - - - - - - - - - - - - - - - - -->

                    </div><!--/ .wrapper-->

                </article><!--/ .clearfix-->

            </li>

            <!-- - - - - - - - - - - - - - End of entry - - - - - - - - - - - - - - - - -->

        </ul>

    </section><!--/ .widget-->

    <!-- - - - - - - - - - - - - - End of blog widget - - - - - - - - - - - - - - - - -->

</div><!--/ [col]-->

</div><!--/ .row-->

</div><!--/ .container -->

</div><!--/ .footer_section_2-->

<!-- - - - - - - - - - - - - - End footer section- - - - - - - - - - - - - - - - -->

<hr>

<!-- - - - - - - - - - - - - - Footer section - - - - - - - - - - - - - - - - -->

<div class="footer_section_3 align_center">

    <div class="container">

        <!-- - - - - - - - - - - - - - Payments - - - - - - - - - - - - - - - - -->

        <ul class="payments">

            <li><img src="images/payment_1.png" alt=""></li>
            <li><img src="images/payment_2.png" alt=""></li>
            <li><img src="images/payment_3.png" alt=""></li>
            <li><img src="images/payment_4.png" alt=""></li>
            <li><img src="images/payment_5.png" alt=""></li>
            <li><img src="images/payment_6.png" alt=""></li>
            <li><img src="images/payment_7.png" alt=""></li>
            <li><img src="images/payment_8.png" alt=""></li>

        </ul>

        <!-- - - - - - - - - - - - - - End of payments - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Footer navigation - - - - - - - - - - - - - - - - -->

        <nav class="footer_nav">

            <ul class="bottombar">

                <li><a href="#">Medicine &amp; Health</a></li>
                <li><a href="#">Beauty</a></li>
                <li><a href="#">Personal Care</a></li>
                <li><a href="#">Vitamins &amp; Supplements</a></li>
                <li><a href="#">Baby Needs</a></li>
                <li><a href="#">Diet &amp; Fitness</a></li>
                <li><a href="#">Sexual Well-being</a></li>

            </ul>

        </nav>

        <!-- - - - - - - - - - - - - - End of footer navigation - - - - - - - - - - - - - - - - -->

        <p class="copyright">&copy; 2015 <a href="index.html">Shopme</a>. All Rights Reserved.</p>

    </div><!--/ .container -->

</div><!--/ .footer_section-->

<!-- - - - - - - - - - - - - - End footer section - - - - - - - - - - - - - - - - -->

</footer>

<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

</div><!--/ [layout]-->

<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->

<ul class="social_feeds">

    <!-- - - - - - - - - - - - - - Facebook - - - - - - - - - - - - - - - - -->

    <li>

        <button class="icon_btn middle_btn social_facebook open_"><i class="icon-facebook-1"></i></button>


        <section class="dropdown">

            <div class="animated_item">

                <h3 class="title">Join Us on Facebook</h3>

            </div><!--/ .animated_item-->

            <div class="animated_item">

                <iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fthemeforest&amp;width=235&amp;height=345&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=438889712801266" style="border:none; overflow:hidden; width:235px; height:345px;"></iframe>

            </div><!--/ .animated_item-->

        </section><!--/ .dropdown-->

    </li>

    <!-- - - - - - - - - - - - - - End of Facebook - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Twitter - - - - - - - - - - - - - - - - -->

    <li>

        <button class="icon_btn middle_btn social_twitter open_"><i class="icon-twitter"></i></button>

        <section class="dropdown">

            <div class="animated_item">

                <h3 class="title">Latest Tweets</h3>

            </div><!--/ .animated_item-->

            <div class="tweet_list_wrap"></div>

            <footer class="animated_item bottom_box">

                <a href="#" class="button_grey middle_btn twitter_follow">Follow Us</a>

            </footer><!--/ .animated_item-->

        </section><!--/ .dropdown-->

    </li>

    <!-- - - - - - - - - - - - - - End of Twitter - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Contact us - - - - - - - - - - - - - - - - -->

    <li>

        <button class="icon_btn middle_btn social_contact open_"><i class="icon-mail-8"></i></button>

        <section class="dropdown">

            <div class="animated_item">

                <h3 class="title">Contact Us</h3>

            </div><!--/ .animated_item-->

            <div class="animated_item">

                <p class="form_caption">Lorem ipsum dolor sit amet, adipis mauris accumsan.</p>

                <form class="contactform" novalidate>

                    <ul>

                        <li class="row">

                            <div class="col-xs-12">

                                <input type="text" required title="Name" name="cf_name" placeholder="Your name">

                            </div>

                        </li>

                        <li class="row">

                            <div class="col-xs-12">

                                <input type="email" required title="Email" name="cf_email" placeholder="Your address">

                            </div>

                        </li>

                        <li class="row">

                            <div class="col-xs-12">

                                <textarea placeholder="Message" required title="Message" name="cf_message" rows="6"></textarea>

                            </div>

                        </li>

                        <li class="row">

                            <div class="col-xs-12">

                                <button class="button_grey middle_btn">Send</button>

                            </div>

                        </li>

                    </ul>

                </form>

            </div><!--/ .animated_item-->

        </section><!--/ .dropdown-->

    </li>

    <!-- - - - - - - - - - - - - - End contact us - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Google map - - - - - - - - - - - - - - - - -->

    <li>

        <button class="icon_btn middle_btn social_gmap open_"><i class="icon-location-4"></i></button>

        <!--Location-->

        <section class="dropdown">

            <div class="animated_item">

                <h3 class="title">Store Location</h3>

            </div><!--/ .animated_item-->

            <div class="animated_item">

                <p class="c_info_location">8901 Marmora Road,<br>Glasgow, D04 89GR.</p>

                <div class="proportional_frame">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3024.238131852431!2d-74.006059!3d40.712773999999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258fda88cefb3%3A0x7f1e88758d210007!2z0J3RjNGOLdC50L7RgNC60YHQutC40Lkg0KHQuNGC0Lgt0YXQvtC70Ls!5e0!3m2!1sru!2sua!4v1415946524959" style="border:0"></iframe>

                </div>

                <ul class="c_info_list">

                    <li class="c_info_phone">800-599-65-80</li>
                    <li class="c_info_mail"><a href="mailto:#">info@companyname.com</a></li>
                    <li class="c_info_schedule">

                        <ul>

                            <li>Monday-Friday: 8.00-20.00</li>
                            <li>Saturday: 9.00-15.00</li>
                            <li>Sunday: closed</li>

                        </ul>

                    </li>

                </ul>

            </div><!--/ .animated_item-->

        </section><!--/ .dropdown-->

    </li>

    <!-- - - - - - - - - - - - - - End google map - - - - - - - - - - - - - - - - -->

</ul>

<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->

<!-- Include Libs & Plugins
		============================================ -->
<?php
$tmpJs = ["js/jquery-2.1.0.min.js", "js/queryloader2.min.js", "js/rs-plugin/js/jquery.themepunch.tools.min.js", "js/rs-plugin/js/jquery.themepunch.revolution.min.js", "js/jquery.appear.js", "js/owlcarousel/owl.carousel.min.js",
    "js/jquery.countdown.plugin.min.js", "js/jquery.countdown.min.js",
    "js/arcticmodal/jquery.arcticmodal.js", "twitter/jquery.tweet.min.js", "js/colorpicker/colorpicker.js", "js/retina.min.js", "js/theme.plugins.js", "js/theme.core.js",
];
foreach ($tmpJs as $v) {
    $this->registerJsFile($link . '/' . $v, ['depends' => [\yii\web\JqueryAsset::className()]]);
}
?>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
