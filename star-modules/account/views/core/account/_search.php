<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\account\models\WithdrawalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdrawal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'withdrawal_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'withdrawal_fee') ?>

    <?= $form->field($model, 'withdrawal_account') ?>

    <?= $form->field($model, 'account_name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('coupon', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('coupon', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
