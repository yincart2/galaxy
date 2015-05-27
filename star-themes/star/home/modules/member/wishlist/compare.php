<?php
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['/member/default/index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Compare List'),
    'template' => '<li><span>{link}</span></li>',
];
?>
<h2 class="tt_uppercase color_dark m_bottom_30">Compare Products</h2>
<!--compare products table-->
<table class="table_type_2 responsive_table type_2 full_width r_corners wraper shadow t_align_l m_bottom_30">
<tr>
    <!--titles for td-->
    <th class="f_size_large d_xs_none">Product Image,Name &amp; Category</th>
    <td data-title="Product Image,Name &amp; Category">
        <img class="m_bottom_10" src="images/quick_view_img_10.jpg" alt=""><br>
        <a href="#" class="fw_medium d_inline_b f_size_ex_large color_dark m_bottom_5">Eget elementum vel</a><br>
        <a href="#" class="default_t_color">Dresses</a>
    </td>
    <td data-title="Product Image,Name &amp; Category">
        <img class="m_bottom_10" src="images/wishlist_img_1.jpg" alt=""><br>
        <a href="#" class="fw_medium d_inline_b f_size_ex_large color_dark m_bottom_5">Eget elementum vel</a><br>
        <a href="#" class="default_t_color">Dresses</a>
    </td>
    <td data-title="Product Image,Name &amp; Category">
        <img class="m_bottom_10" src="images/wishlist_img_3.jpg" alt=""><br>
        <a href="#" class="fw_medium d_inline_b f_size_ex_large color_dark m_bottom_5">Eget elementum vel</a><br>
        <a href="#" class="default_t_color">Dresses</a>
    </td>
</tr>
<tr>
    <!--rating-->
    <td class="f_size_large d_xs_none">Rating</td>
    <td data-title="Rating">
        <!--rating-->
        <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover">
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li>
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
        </ul>
        <a href="#" class="d_inline_middle default_t_color f_size_medium m_left_5">1 Review(s) </a>
    </td>
    <td data-title="Rating">
        <!--rating-->
        <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover">
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li>
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
        </ul>
        <a href="#" class="d_inline_middle default_t_color f_size_medium m_left_5">1 Review(s) </a>
    </td>
    <td data-title="Rating">
        <!--rating-->
        <ul class="horizontal_list d_inline_middle type_2 clearfix rating_list tr_all_hover">
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li class="active">
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
            <li>
                <i class="fa fa-star-o empty tr_all_hover"></i>
                <i class="fa fa-star active tr_all_hover"></i>
            </li>
        </ul>
        <a href="#" class="d_inline_middle default_t_color f_size_medium m_left_5">1 Review(s) </a>
    </td>
</tr>
<tr>
    <!--price-->
    <td class="f_size_large d_xs_none">Price</td>
    <td data-title="Price">
        <span class="fw_medium f_size_large scheme_color">$102.00</span>
    </td>
    <td data-title="Price">
        <span class="fw_medium f_size_large scheme_color">$102.00</span>
    </td>
    <td data-title="Price">
        <span class="fw_medium f_size_large scheme_color">$102.00</span>
    </td>
</tr>
<tr>
    <!--description-->
    <td class="f_size_large d_xs_none">Description</td>
    <td data-title="Description">
        <p>Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. </p>
    </td>
    <td data-title="Description">
        <p>Lorem ipsum dolor sit amet, consecvtetuer adipiscing elit. Mauris fermentum dictum magna. Sed laoreet aliquam leo. </p>
    </td>
    <td data-title="Description">
        <p> Duis ac turpis. Integer rutrum ante eu lacus.Vestibulum libero nisl, porta vel, scelerisque eget, malesuada at, neque. Vivamus eget nibh. Etiam cursus leo vel metus. </p>
    </td>
</tr>
<tr>
    <!--description-->
    <td class="f_size_large d_xs_none">Manufacturer</td>
    <td data-title="Manufacturer">
        <p class="color_dark">Chanel</p>
    </td>
    <td data-title="Manufacturer">
        <p class="color_dark">Chanel</p>
    </td>
    <td data-title="Manufacturer">
        <p class="color_dark">Chanel</p>
    </td>
</tr>
<tr>
    <!--description-->
    <td class="f_size_large d_xs_none">Availability</td>
    <td data-title="Availability">
        <p>in <span class="color_green">stock 20</span> item(s)</p>
    </td>
    <td data-title="Availability">
        <p class="scheme_color">out of stock</p>
    </td>
    <td data-title="Availability">
        <p>in <span class="color_green">stock 20</span> item(s)</p>
    </td>
</tr>
<tr>
    <!--product code-->
    <td class="f_size_large d_xs_none">Product Code</td>
    <td data-title="Product Code">
        <p>PS06</p>
    </td>
    <td data-title="Product Code">
        <p>PS06</p>
    </td>
    <td data-title="Product Code">
        <p>PS06</p>
    </td>
</tr>
<tr>
    <!--size-->
    <td class="f_size_large d_xs_none">Size</td>
    <td data-title="Size">
        <p>S, M, L</p>
    </td>
    <td data-title="Size">
        <p>S, M, L</p>
    </td>
    <td data-title="Size">
        <p>S, M, L</p>
    </td>
</tr>
<tr>
    <!--color-->
    <td class="f_size_large d_xs_none">Color</td>
    <td data-title="Color">
        <p>Green, Black, Red</p>
    </td>
    <td data-title="Color">
        <p>Green, Black, Red</p>
    </td>
    <td data-title="Color">
        <p>Green, Black, Red</p>
    </td>
</tr>
<tr>
    <!--quanity-->
    <td class="f_size_large v_align_m d_xs_none">Quanity</td>
    <td data-title="Quanity">
        <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
            <button class="bg_tr d_block f_left" data-direction="down">-</button>
            <input type="text" name="" readonly value="1" class="f_left">
            <button class="bg_tr d_block f_left" data-direction="up">+</button>
        </div>
    </td>
    <td data-title="Quanity">
        <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
            <button class="bg_tr d_block f_left" data-direction="down">-</button>
            <input type="text" name="" readonly value="1" class="f_left">
            <button class="bg_tr d_block f_left" data-direction="up">+</button>
        </div>
    </td>
    <td data-title="Quanity">
        <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
            <button class="bg_tr d_block f_left" data-direction="down">-</button>
            <input type="text" name="" readonly value="1" class="f_left">
            <button class="bg_tr d_block f_left" data-direction="up">+</button>
        </div>
    </td>
</tr>
<tr>
    <!--action-->
    <td class="f_size_large d_xs_none">Action</td>
    <td data-title="Action">
        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_10">Add to Cart</button><br>
        <a href="#" class="color_dark d_inline_b m_bottom_5"><i class="fa fa-heart-o m_right_5 f_size_large"></i> Add to Wishlist</a><br>
        <a href="#" class="color_dark d_inline_b"><i class="fa fa-times m_right_5"></i> Remove</a>
    </td>
    <td data-title="Action">
        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_10">Add to Cart</button><br>
        <a href="#" class="color_dark d_inline_b m_bottom_5"><i class="fa fa-heart-o m_right_5 f_size_large"></i> Add to Wishlist</a><br>
        <a href="#" class="color_dark d_inline_b"><i class="fa fa-times m_right_5"></i> Remove</a>
    </td>
    <td data-title="Action">
        <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_10">Add to Cart</button><br>
        <a href="#" class="color_dark d_inline_b m_bottom_5"><i class="fa fa-heart-o m_right_5 f_size_large"></i> Add to Wishlist</a><br>
        <a href="#" class="color_dark d_inline_b"><i class="fa fa-times m_right_5"></i> Remove</a>
    </td>
</tr>
</table>