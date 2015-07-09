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
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
    ?>
    <td data-title="Product Image,Name &amp; Category">
        <img class="m_bottom_10" src="images/quick_view_img_10.jpg" alt=""><br>
        <a href="#" class="fw_medium d_inline_b f_size_ex_large color_dark m_bottom_5"><?= $item->title?></a><br>
    </td>
    <?php
    }
    ?>
</tr>
<tr>
    <!--rating-->
    <td class="f_size_large d_xs_none">Rating</td>
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
        ?>
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
    <?php
    }
    ?>
</tr>
<tr>
    <!--price-->
    <td class="f_size_large d_xs_none">Price</td>
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
        ?>
        <td data-title="Price">
            <span class="fw_medium f_size_large scheme_color"><?= $item->price?></span>
        </td>
    <?php
    }
    ?>
</tr>
<tr>
    <!--description-->
    <td class="f_size_large d_xs_none">Availability</td>
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
        ?>
        <td data-title="Availability">
            <p>in <span class="color_green">stock <?= $item->stock?></span> item(s)</p>
        </td>
    <?php
    }
    ?>
</tr>
<?php
$itemProps = \star\catalog\models\ItemProp::find()->where(['category_id'=>$item->category_id])->all();
foreach($itemProps as $itemProp){
?>
<tr>
    <!--size-->
    <td class="f_size_large d_xs_none"><?= $itemProp->prop_name?></td>
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
        $propName = (array)json_decode($item->props_name);
        if(is_array($propName[$itemProp->prop_name])){
            $propValue = '';
            foreach($propName[$itemProp->prop_name] as $v){
                $tmpValue = explode(':',$v);
                $propValue = $propValue ."".$tmpValue[1].", ";
            }
        }else{
            $tmpValue = explode(':',$propName[$itemProp->prop_name]);
            $propValue = $tmpValue[1];
        }
        ?>
        <td data-title="<?= $itemProp->prop_name?>">
            <p><?= $propValue?></p>
        </td>
    <?php
    }
    ?>

</tr>
<?php
}
?>
<tr>
    <!--quanity-->
    <td class="f_size_large v_align_m d_xs_none">Quanity</td>
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
        ?>
        <td data-title="Quanity">
            <div class="clearfix quantity r_corners d_inline_middle f_size_medium color_dark">
                <button class="bg_tr d_block f_left" data-direction="down">-</button>
                <input type="text" name="" readonly value="1" class="f_left">
                <button class="bg_tr d_block f_left" data-direction="up">+</button>
            </div>
        </td>
    <?php
    }
    ?>


</tr>
<tr>
    <!--action-->
    <td class="f_size_large d_xs_none">Action</td>
    <?php
    /**@var $item \star\catalog\models\Item **/
    foreach($itemModels as $item){
        ?>
        <td data-title="Action">
            <button class="button_type_4 bg_scheme_color r_corners tr_all_hover color_light mw_0 m_bottom_10">Add to Cart</button><br>
            <a href="#" class="color_dark d_inline_b m_bottom_5"><i class="fa fa-heart-o m_right_5 f_size_large"></i> Add to Wishlist</a><br>
        </td>
    <?php
    }
    ?>

</tr>
</table>