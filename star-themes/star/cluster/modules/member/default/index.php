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
<h1 class="tt_uppercase color_dark m_bottom_25"><?= Yii::t('member','Member Information')?></h1>
<!--order info tables-->
<table>
    <tr>
        <td><?= Yii::t('member','Username')?></td>
        <td><?= $user->username ?></td>
    </tr>
    <tr>
        <td><?= Yii::t('member','Email')?></td>
        <td><?= $user->email ?></td>
    </tr>
    <tr>
        <td><?= Yii::t('member','Phone')?></td>
        <td>(0547) 800-820-8820</td>
    </tr>
    <tr>
        <td><?= Yii::t('member','Registered At')?></td>
        <td><?= date('Y-m-d', $user->created_at) ?></td>
    </tr>
</table>
<!--<section class="theme_box">-->
<!--    <div class="buttons_row">-->
<!--        <a href="#" class="button_grey middle_btn">Edit Account Information</a>-->
<!--        <a href="#" class="button_grey middle_btn">Change Password</a>-->
<!--    </div>-->
<!--</section>-->