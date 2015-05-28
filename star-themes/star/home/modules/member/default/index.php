<?php
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Information'),
    'template' => '<li><span>{link}</span></li>',
];
?>
<h2 class="tt_uppercase color_dark m_bottom_25"><?= Yii::t('member','Member Information')?></h2>
<!--order info tables-->
<table class="table_type_6 responsive_table full_width r_corners shadow m_bottom_45 t_align_l">
    <tr>
        <td class="f_size_large d_xs_none"><?= Yii::t('member','Username')?></td>
        <td data-title="Order Number"><?= $user->username ?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none"><?= Yii::t('member','Email')?></td>
        <td data-title="Order Date"><?= $user->email ?></td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none"><?= Yii::t('member','Phone')?></td>
        <td data-title="Order Status">(0547) 800-820-8820</td>
    </tr>
    <tr>
        <td class="f_size_large d_xs_none"><?= Yii::t('member','Registered At')?></td>
        <td data-title="Last Update"><?= date('Y-m-d', $user->created_at) ?></td>
    </tr>
</table>
