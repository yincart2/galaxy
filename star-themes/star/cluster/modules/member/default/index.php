<?php
use star\account\models\UserProfile;
use yii\helpers\Html;
use yii\helpers\Url;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Information'),
    'template' => '<li><span>{link}</span></li>',
];
$this->params['information'] = true;

$userProfileModel =  new UserProfile();
$userProfileModel = $userProfileModel->getUserProfileModel();
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
    <tr>
        <td><?= Yii::t('member','Money')?></td>
        <td><?= $userProfileModel->money ?></td>
    </tr>
</table>
<section class="theme_box">
    <div class="buttons_row">
        <?= Html::a(Yii::t('account','withdrawal'),Url::to(['/account/home/account/withdrawal']),['class'=>"button_grey middle_btn"])?>
        <?= Html::a(Yii::t('account','recharge'),Url::to(['/account/home/account/recharge']),['class'=>"button_grey middle_btn"])?>
    </div>
</section>