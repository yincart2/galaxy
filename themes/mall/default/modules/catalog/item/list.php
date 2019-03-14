
<?php
use star\system\models\Tree;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$link = $this->getAssetManager()->getPublishedUrl('@theme/cluster/default/assets');
$this->registerJsFile($link . '/js/wishlist.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($link . '/js/compare.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = [
    'label' => $currentCategory->name,
    'template' => '<li><span>{link}</span></li>',
];

?>


<div class="row">

<main class="col-md-9 col-sm-8">

<section class="section_offset">

    <h1>Beauty</h1>

    <a href="#" class="banner">

        <img src="<?= $link ?>/images/banner_img_14.jpg" alt="">

    </a>

    <p>Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Nulla venenatis. In pede mi, aliquet sit amet, euismod in, auctor ut, ligula. Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem. Vestibulum sed ante. Donec sagittis euismod purus. Sed ut perspiciatis sit voluptatem accusantim doloremque laudantim.</p>

    <!-- - - - - - - - - - - - - - Subcategories - - - - - - - - - - - - - - - - -->

    <div class="table_layout subcategories">

        <div class="table_row">

            <!-- - - - - - - - - - - - - - Subcategory - - - - - - - - - - - - - - - - -->

            <div class="table_cell">

                <figure class="subcategory">

                    <a href="#" class="thumbnail">

                        <img src="<?= $link ?>/images/subcategory_img_1.jpg" alt="">

                    </a>

                    <figcaption>

                        <a href="#">Bath &amp; Spa (830)</a>

                    </figcaption>

                </figure>

            </div>

            <!-- - - - - - - - - - - - - - End of subcategory - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Subcategory - - - - - - - - - - - - - - - - -->

            <div class="table_cell">

                <figure class="subcategory">

                    <a href="#" class="thumbnail">

                        <img src="<?= $link ?>/images/subcategory_img_2.jpg" alt="">

                    </a>

                    <figcaption>

                        <a href="#">Beauty Clearance (91)</a>

                    </figcaption>

                </figure>

            </div>

            <!-- - - - - - - - - - - - - - End of subcategory - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Subcategory - - - - - - - - - - - - - - - - -->

            <div class="table_cell">

                <figure class="subcategory">

                    <a href="#" class="thumbnail">

                        <img src="<?= $link ?>/images/subcategory_img_3.jpg" alt="">

                    </a>

                    <figcaption>

                        <a href="#">Gift Sets (178)</a>

                    </figcaption>

                </figure>

            </div>

            <!-- - - - - - - - - - - - - - End of subcategory - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Subcategory - - - - - - - - - - - - - - - - -->

            <div class="table_cell">

                <figure class="subcategory">

                    <a href="#" class="thumbnail">

                        <img src="<?= $link ?>/images/subcategory_img_4.jpg" alt="">

                    </a>

                    <figcaption>

                        <a href="#">Hair Care (491)</a>

                    </figcaption>

                </figure>

            </div>

            <!-- - - - - - - - - - - - - - End of subcategory - - - - - - - - - - - - - - - - -->

            <!-- - - - - - - - - - - - - - Subcategory - - - - - - - - - - - - - - - - -->

            <div class="table_cell">

                <figure class="subcategory">

                    <a href="#" class="thumbnail">

                        <img src="<?= $link ?>/images/subcategory_img_5.jpg" alt="">

                    </a>

                    <figcaption>

                        <a href="#">Makeup &amp; Accessories (226)</a>

                    </figcaption>

                </figure>

            </div>

            <!-- - - - - - - - - - - - - - End of subcategory - - - - - - - - - - - - - - - - -->

        </div>

    </div>

    <!-- - - - - - - - - - - - - - End of subcategories - - - - - - - - - - - - - - - - -->

</section>

<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

<div class="section_offset">

<header class="top_box on_the_sides">

    <div class="left_side clearfix v_centered">

        <!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->

        <div class="v_centered">

            <span>Sort by:</span>

            <div class="custom_select sort_select">

                <select name="">

                    <option value="Default">Default</option>
                    <option value="Price">Price</option>
                    <option value="Name">Name</option>
                    <option value="Date">Date</option>

                </select>

            </div>

        </div>

        <!-- - - - - - - - - - - - - - End of sort by - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Number of products shown - - - - - - - - - - - - - - - - -->

        <div class="v_centered">

            <span>Show:</span>

            <div class="custom_select">

                <select name="">

                    <option value="15">15</option>
                    <option value="12">12</option>
                    <option selected value="9">9</option>
                    <option value="6">6</option>
                    <option value="3">3</option>

                </select>

            </div>

        </div>

        <!-- - - - - - - - - - - - - - End of number of products shown - - - - - - - - - - - - - - - - -->

    </div>

    <div class="right_side">

        <!-- - - - - - - - - - - - - - Product layout type - - - - - - - - - - - - - - - - -->

        <div class="layout_type buttons_row" data-table-container="#products_container">

            <a href="#" data-table-layout="grid_view" class="button_grey middle_btn icon_btn tooltip_container"><i class="icon-th"></i><span class="tooltip top">Grid View</span></a>

            <a href="#" data-table-layout="list_view list_view_products" class="button_grey middle_btn icon_btn active tooltip_container"><i class="icon-th-list"></i><span class="tooltip top">List View</span></a>

        </div>

        <!-- - - - - - - - - - - - - - End of product layout type - - - - - - - - - - - - - - - - -->

    </div>

</header>

<div class="table_layout list_view list_view_products" id="products_container">

<div class="table_row">

<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
<?php
/** @var \star\catalog\models\Item $item */
foreach($items as $key=>$item) {
?>
<div class="table_cell">

    <div class="product_item">

        <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

        <div class="image_wrap">

            <img src="<?= $link ?>/images/product_img_7.jpg" alt="">

            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

            <div class="actions_wrap">

                <div class="centered_buttons">

                    <a href="<?= Url::to(['home/item/view','id' => $item->item_id])?>" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>

                    <a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>

                </div><!--/ .centered_buttons -->

                <a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container">
                    <span class="tooltip right">Add to Wishlist</span>
                </a>

                <a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

            </div><!--/ .actions_wrap-->

            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

        </div><!--/. image_wrap-->

        <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

        <div class="description">

            <a href="<?= Url::to(['home/item/view','id' => $item->item_id])?>"><?= $item->title ?></a>

            <div class="clearfix product_info">

                <p class="product_price alignleft"><b><?= $item->price ?></b></p>

                <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                <ul class="rating alignright">

                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li></li>

                </ul>

                <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

            </div>

        </div>

        <!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

        <div class="full_description">

            <div style="overflow:hidden;text-overflow:ellipsis;white-space: nowrap;width:363px;" class="product_title">
                <a href="<?= Url::to(['home/item/view','id' => $item->item_id])?>" title="<?= $item->title ?>"><?= $item->title ?></a>
            </div>

            <a href="<?= Url::to(['/catalog/home/item/list','catalog' => $item->category->id])?>" class="product_category"><?= $currentCategory->name ?></a>

            <div class="v_centered product_reviews">

                <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                <ul class="rating">

                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li class="active"></li>
                    <li></li>

                </ul>

                <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

                <ul class="topbar">

                    <li><a href="#">3 Review(s)</a></li>
                    <li><a href="#">Add Your Review</a></li>

                </ul>

                <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

            </div>

            <div style="height: 166px;overflow: hidden;"><?= $item->desc ?></div>

            <a href="#" class="learn_more">Learn More</a>

        </div>

        <!-- - - - - - - - - - - - - - End of full description (only for list view) - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

        <div class="actions">

            <p class="product_price bold">$<?= $item->price ?></p>

            <ul class="seller_stats">

                <li>Shipping: <span class="success">Free Shipping</span></li>
                <li>Availability: <span class="success">in stock</span></li>
                <li class="seller_info_wrap">

                    Seller: <span class="seller_name">johnsmith</span>

                    <div class="seller_info_dropdown">

                        <ul class="seller_stats">

                            <li>

                                <ul class="topbar">

                                    <li>China (Mainland)</li>

                                    <li><a href="#">Contact Details</a></li>

                                </ul>

                            </li>

                            <li><span class="bold">99.8%</span> Positive Feedback</li>

                        </ul>

                        <div class="v_centered">

                            <a href="#" class="button_blue mini_btn">Contact Seller</a>

                            <a href="#" class="small_link">Chat Now</a>

                        </div>

                    </div>

                </li>

            </ul>

            <ul class="buttons_col">

                <li><a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a></li>

                <li><a href="javascript:void(0);" class="wishlist icon_link"
                       data-url="<?= Url::to(['/member/wishlist/add-wishlist'])?>"
                       data-csrf="<?= Yii::$app->request->csrfToken?>"
                       data-item_id="<?= $item->item_id?>">
                        <i class="icon-heart-5"></i>Add to Wishlist
                    </a>
                </li>

                <li><a href="javascript:void(0);" class="compare icon_link"
                       data-compare_id="<?= $key?>"
                       data-item_id="<?= $item->item_id?>"
                       data-category_id="<?= $item->category_id?>"
                       data-selected= 0>
                        <i class="icon-resize-small"></i>Add to Compare
                    </a>
                </li>

            </ul>

        </div>

        <!-- - - - - - - - - - - - - - Product price & actions (only for list view) - - - - - - - - - - - - - - - - -->

    </div><!--/ .product_item-->

</div>
<?php } ?>
<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

</div><!--/ .table_row -->

</div><!--/ .table_layout -->

<footer class="bottom_box on_the_sides">

    <div class="left_side">

    </div>

    <div class="right_side">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>

    </div>

</footer>

</div>

<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

</main>

<aside class="col-md-3 col-sm-4">

<!-- - - - - - - - - - - - - - Today's deals - - - - - - - - - - - - - - - - -->

<section class="section_offset">

<h3 class="widget_title">Today's Deals</h3>

<!-- - - - - - - - - - - - - - Carousel of today's deals - - - - - - - - - - - - - - - - -->

<div class="owl_carousel widgets_carousel">

<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

<div class="product_item">

    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

    <div class="image_wrap">

        <img src="<?= $link ?>/images/deals_img_1.jpg" alt="">

        <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

        <div class="actions_wrap">

            <div class="centered_buttons">

                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>

                <a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>

            </div><!--/ .centered_buttons -->

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

        </div><!--/ .actions_wrap-->

        <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

        <div class="label_offer percentage">

            <div>30%</div>OFF

        </div>

        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

    </div><!--/. image_wrap-->

    <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->

    <div class="countdown" data-year="2016" data-month="11" data-day="6" data-hours="15" data-minutes="0" data-seconds="0"></div>

    <!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

    <div class="description">

        <p><a href="#">Ut pharetra augue, Original 24 fl oz</a></p>

        <div class="clearfix product_info">

            <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

            <ul class="rating alignright">

                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li></li>

            </ul>

            <!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->

            <p class="product_price alignleft"><s>$9.99</s> <b>$5.99</b></p>

        </div><!--/ .clearfix.product_info-->

    </div>

    <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

</div><!--/ .product_item-->

<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

<div class="product_item">

    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

    <div class="image_wrap">

        <img src="<?= $link ?>/images/deals_img_2.jpg" alt="">

        <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

        <div class="actions_wrap">

            <div class="centered_buttons">

                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>

                <a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>

            </div><!--/ .centered_buttons -->

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

        </div><!--/ .actions_wrap-->

        <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

        <div class="label_offer percentage">

            <div>25%</div>OFF

        </div>

        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

    </div><!--/. image_wrap-->

    <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->

    <div class="countdown" data-year="2016" data-month="2" data-day="9" data-hours="10" data-minutes="30" data-seconds="30"></div>

    <!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

    <div class="description">

        <p><a href="#">Donec in velit vel, Size 4 Diapers 29 ea</a></p>

        <div class="clearfix product_info">

            <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

            <ul class="rating alignright">

                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>

            </ul>

            <!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->

            <p class="product_price alignleft"><s>$16.99</s> <b>$14.99</b></p>

        </div><!--/ .clearfix.product_info-->

    </div>

    <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

</div><!--/ .product_item-->

<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

<div class="product_item">

    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

    <div class="image_wrap">

        <img src="<?= $link ?>/images/deals_img_3.jpg" alt="">

        <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

        <div class="actions_wrap">

            <div class="centered_buttons">

                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>

                <a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>

            </div><!--/ .centered_buttons -->

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

        </div><!--/ .actions_wrap-->

        <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

        <div class="label_offer percentage">

            <div>40%</div>OFF

        </div>

        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

    </div><!--/. image_wrap-->

    <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->

    <div class="countdown" data-year="2016" data-month="2" data-day="9" data-hours="10" data-minutes="30" data-seconds="30"></div>

    <!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

    <div class="description">

        <p><a href="#">Vestibulum iaculis lacinia est, 1000mg, Tablets, 120 ea</a></p>

        <div class="clearfix product_info">

            <p class="product_price alignleft"><s>$103.99</s> <b>$73.99</b></p>

        </div><!--/ .clearfix.product_info-->

    </div>

    <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

</div><!--/ .product_item-->

<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

<div class="product_item">

    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

    <div class="image_wrap">

        <img src="<?= $link ?>/images/deals_img_4.jpg" alt="">

        <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

        <div class="actions_wrap">

            <div class="centered_buttons">

                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>

                <a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>

            </div><!--/ .centered_buttons -->

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

            <a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

        </div><!--/ .actions_wrap-->

        <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

        <div class="label_offer percentage">

            <div>15%</div>OFF

        </div>

        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

    </div><!--/. image_wrap-->

    <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->

    <div class="countdown" data-year="2016" data-month="1" data-day="31" data-hours="18" data-minutes="40" data-seconds="40"></div>

    <!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

    <div class="description">

        <p><a href="#">Quisque diam lorem, 1 each</a></p>

        <div class="clearfix product_info">

            <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

            <ul class="rating alignright">

                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li></li>
                <li></li>

            </ul>

            <!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->

            <p class="product_price alignleft"><s>$5.99</s> <b>$2.99</b></p>

        </div><!--/ .clearfix.product_info-->

    </div>

    <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

</div><!--/ .product_item-->

<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

<div class="product_item">

    <!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->

    <div class="image_wrap">

        <img src="<?= $link ?>/images/deals_img_5.jpg" alt="">

        <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

        <div class="actions_wrap">

            <div class="centered_buttons">

                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>

                <a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>

            </div><!--/ .centered_buttons -->

            <a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

            <a href="#" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

        </div><!--/ .actions_wrap-->

        <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->

        <div class="label_offer percentage">

            <div>50%</div>OFF

        </div>

        <!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->

    </div><!--/. image_wrap-->

    <!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->

    <div class="countdown" data-year="2016" data-month="3" data-day="16" data-hours="11" data-minutes="10" data-seconds="10"></div>

    <!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->

    <div class="description">

        <p><a href="#">Suspendisse sollicitudin velit sed leo 4 ea</a></p>

        <div class="clearfix product_info">

            <p class="product_price alignleft"><s>$19.99</s> <b>$13.99</b></p>

        </div><!--/ .clearfix.product_info-->

    </div>

    <!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->

</div><!--/ .product_item-->

<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

</div><!--/ .widgets_carousel-->

<!-- - - - - - - - - - - - - - End of carousel of today's deals - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - View all deals of the day - - - - - - - - - - - - - - - - -->

<footer class="bottom_box">

    <a href="#" class="button_grey middle_btn">View All Deals</a>

</footer>

<!-- - - - - - - - - - - - - - End of view all deals of the day - - - - - - - - - - - - - - - - -->

</section><!--/ .section_offset.animated.transparent-->

<!-- - - - - - - - - - - - - - End of today's deals - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Filter</h3>

    <form class="type_2">

        <div class="table_layout list_view">

            <div class="table_row">

                <!-- - - - - - - - - - - - - - Category filter - - - - - - - - - - - - - - - - -->

                <div class="table_cell">

                    <label>Category</label>

                    <div class="custom_select">

                        <select name="">

                            <option value="Beauty">Beauty</option>
                            <option value="Personal Care">Personal Care</option>
                            <option value="Diet &amp; Fitness">Diet &amp; Fitness</option>
                            <option value="Baby Needs">Baby Needs</option>

                        </select>

                    </div>

                </div><!--/ .table_cell -->

                <!-- - - - - - - - - - - - - - End of category filter - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->

                <div class="table_cell">

                    <fieldset>

                        <legend>Manufacturer</legend>

                        <ul class="checkboxes_list">

                            <li>

                                <input type="checkbox" checked name="manufacturer" id="manufacturer_1">
                                <label for="manufacturer_1">Manufacturer 1</label>

                            </li>

                            <li>

                                <input type="checkbox" name="manufacturer" id="manufacturer_2">
                                <label for="manufacturer_2">Manufacturer 2</label>

                            </li>

                            <li>

                                <input type="checkbox" name="manufacturer" id="manufacturer_3">
                                <label for="manufacturer_3">Manufacturer 3</label>

                            </li>

                        </ul>

                    </fieldset>

                </div><!--/ .table_cell -->

                <!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->

                <div class="table_cell">

                    <fieldset>

                        <legend>Price</legend>

                        <div class="range">

                            Range :

                            <span class="min_val"></span> -
                            <span class="max_val"></span>

                            <input type="hidden" name="" class="min_value">

                            <input type="hidden" name="" class="max_value">

                        </div>

                        <div id="slider"></div>

                    </fieldset>

                </div><!--/ .table_cell -->

                <!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->

                <div class="table_cell">

                    <fieldset>

                        <legend>Color</legend>

                        <div class="row">

                            <div class="col-sm-6">

                                <ul class="simple_vertical_list">

                                    <li>

                                        <input type="checkbox" name="" id="color_btn_1">
                                        <label for="color_btn_1" class="color_btn green">Green</label>

                                    </li>

                                    <li>

                                        <input type="checkbox" name="" id="color_btn_2">
                                        <label for="color_btn_2" class="color_btn yellow">Yellow</label>

                                    </li>

                                    <li>

                                        <input type="checkbox" name="" id="color_btn_3">
                                        <label for="color_btn_3" class="color_btn red">Red</label>

                                    </li>

                                </ul>

                            </div>

                            <div class="col-sm-6">

                                <ul class="simple_vertical_list">

                                    <li>

                                        <input type="checkbox" name="" id="color_btn_4">
                                        <label for="color_btn_4" class="color_btn blue">Blue</label>

                                    </li>

                                    <li>

                                        <input type="checkbox" name="" id="color_btn_5">
                                        <label for="color_btn_5" class="color_btn grey">Grey</label>

                                    </li>

                                    <li>

                                        <input type="checkbox" name="" id="color_btn_6">
                                        <label for="color_btn_6" class="color_btn orange">Orange</label>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </fieldset>

                </div><!--/ .table_cell -->

                <!-- - - - - - - - - - - - - - End price - - - - - - - - - - - - - - - - -->

            </div><!--/ .table_row -->

        </div><!--/ .table_layout -->

        <footer class="bottom_box">

            <div class="buttons_row">

                <button type="submit" class="button_blue middle_btn">Search</button>

                <button type="reset" class="button_grey middle_btn filter_reset">Reset</button>

            </div>

        </footer>

    </form>

</section>

<!-- - - - - - - - - - - - - - End of filter - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->

<div class="section_offset">

    <a href="#" class="banner">

        <img src="<?= $link ?>/images/banner_img_10.png" alt="">

    </a>

</div>

<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Already viewed products - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Already Viewed Products</h3>

    <ul class="products_list_widget">

        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

        <li>

            <a href="#" class="product_thumb">

                <img src="<?= $link ?>/images/product_thumb_4.jpg" alt="">

            </a>

            <div class="wrapper">

                <a href="#" class="product_title">Suspendisse sollicitudin velit...</a>

                <div class="clearfix product_info">

                    <p class="product_price alignleft"><b>$5.99</b></p>

                    <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                    <ul class="rating alignright">

                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>

                    </ul>

                    <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                </div>

            </div>

        </li>

        <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

    </ul><!--/ .list_of_products-->

</section>

<!-- - - - - - - - - - - - - - End of already viewed products - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Compare products - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Compare Products</h3>

    <div class="theme_box">

        You do not have any product to compare.

    </div>

</section>

<!-- - - - - - - - - - - - - - End of compare products - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Tags - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Tags</h3>

    <div class="tags_container">

        <ul class="tags_cloud">

            <li><a href="#" class="button_grey">allergy</a></li>
            <li><a href="#" class="button_grey">baby</a></li>
            <li><a href="#" class="button_grey">beauty</a></li>
            <li><a href="#" class="button_grey">ear care</a></li>
            <li><a href="#" class="button_grey">for her</a></li>
            <li><a href="#" class="button_grey">for him</a></li>
            <li><a href="#" class="button_grey">first aid</a></li>
            <li><a href="#" class="button_grey">gift sets</a></li>
            <li><a href="#" class="button_grey">spa</a></li>
            <li><a href="#" class="button_grey">hair care</a></li>
            <li><a href="#" class="button_grey">herbs</a></li>
            <li><a href="#" class="button_grey">medicine</a></li>
            <li><a href="#" class="button_grey">natural</a></li>
            <li><a href="#" class="button_grey">oral care</a></li>
            <li><a href="#" class="button_grey">pain</a></li>
            <li><a href="#" class="button_grey">pedicure</a></li>
            <li><a href="#" class="button_grey">personal care</a></li>
            <li><a href="#" class="button_grey">probiotics</a></li>

        </ul><!--/ .tags_cloud-->

    </div><!--/ .tags_container-->

</section>

<!-- - - - - - - - - - - - - - End of tags - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->

<div class="section_offset">

    <a href="#" class="banner">

        <img src="<?= $link ?>/images/banner_img_11.png" alt="">

    </a>

</div>

<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Bestseller Products - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Bestseller Products</h3>

    <ul class="products_list_widget">

        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

        <li>

            <a href="#" class="product_thumb">

                <img src="<?= $link ?>/images/product_thumb_4.jpg" alt="">

            </a>

            <div class="wrapper">

                <a href="#" class="product_title">Suspendisse sollicitudin velit...</a>

                <div class="clearfix product_info">

                    <p class="product_price alignleft"><b>$5.99</b></p>

                    <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                    <ul class="rating alignright">

                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li></li>

                    </ul>

                    <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                </div>

            </div>

        </li>

        <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

        <li>

            <a href="#" class="product_thumb">

                <img src="<?= $link ?>/images/product_thumb_5.jpg" alt="">

            </a>

            <div class="wrapper">

                <a href="#" class="product_title">Donec sagittis euismod purus...</a>

                <div class="clearfix product_info">

                    <p class="product_price alignleft"><b>$8.99</b></p>

                    <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                    <ul class="rating alignright">

                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>

                    </ul>

                    <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                </div>

            </div>

        </li>

        <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

        <li>

            <a href="#" class="product_thumb">

                <img src="<?= $link ?>/images/product_thumb_6.jpg" alt="">

            </a>

            <div class="wrapper">

                <a href="#" class="product_title">Sed ut perspiciatis unde, 2mg, White...</a>

                <div class="clearfix product_info">

                    <p class="product_price alignleft"><b>$76.99</b></p>

                    <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                    <ul class="rating alignright">

                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>
                        <li class="active"></li>

                    </ul>

                    <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                </div>

            </div>

        </li>

        <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

    </ul><!--/ .list_of_products-->

    <footer class="bottom_box">

        <a href="#" class="button_grey middle_btn">View All</a>

    </footer>

</section>

<!-- - - - - - - - - - - - - - End of Bestseller Products - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Testimonials - - - - - - - - - - - - - - - - -->

<section class="section_offset">

    <h3>Testimonials</h3>

    <!-- - - - - - - - - - - - - - Carousel of testimonials - - - - - - - - - - - - - - - - -->

    <div class="owl_carousel widgets_carousel">

        <!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

        <blockquote>

            <div class="author_info"><b>Alan, Los Angeles</b></div>

            <p>Ut tellus dolor, dapibus eget, elementum vel, cursus elefiend, elit. Aenean wisi et urna. Aliquam erat volutpat. Duis ac turpis.</p>

        </blockquote>

        <!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

        <blockquote>

            <div class="author_info"><b>Tracy, New York</b></div>

            <p>Donec sit amet eros. Lorem ipsum dolor sit amet elit. Mauris amet fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget.</p>

        </blockquote>

        <!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Testimonial - - - - - - - - - - - - - - - - -->

        <blockquote>

            <div class="author_info"><b>Nikki, Boston</b></div>

            <p>Ut tellus dolor, dapibus eget, elementum vel, cursus elefiend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat.</p>

        </blockquote>

        <!-- - - - - - - - - - - - - - End testimonial - - - - - - - - - - - - - - - - -->

    </div><!--/ .widgets_carousel-->

    <!-- - - - - - - - - - - - - - End of carousel of testimonials - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - View all testimonials - - - - - - - - - - - - - - - - -->

    <footer class="bottom_box">

        <a href="#" class="button_grey middle_btn">View All Testimonials</a>

    </footer>

    <!-- - - - - - - - - - - - - - End of view all testimonials - - - - - - - - - - - - - - - - -->

</section><!--/ .section_offset.animated.transparent-->

<!-- - - - - - - - - - - - - - End of testimonials - - - - - - - - - - - - - - - - -->

</aside>

</div><!--/ .row -->