<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\account\models\Withdrawal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="withdrawal-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'withdrawal_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'account_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('coupon', 'Create') : Yii::t('coupon', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
