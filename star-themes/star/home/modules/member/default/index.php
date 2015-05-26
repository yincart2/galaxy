<?php
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Member Center'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('member','Information'),
    'template' => '<li><span>{link}</span></li>',
];
?>
<div class="member-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>I want to try. I want to fly.</p>
</div>
