<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model star\account\models\Withdrawal */

$this->params['breadcrumbs'] = [
    'title' => '提现',
    'title2' => '申请提现'
];
?>
<div class="withdrawal-create">

    <h1>申请提现</h1>

    <div class="withdrawal-form">

        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" name="Withdrawal[user_id]" value="<?= Yii::$app->user->id ?>">

        <?= $form->field($model, 'withdrawal_fee')->textInput(['maxlength' => 10]) ?>

        <?= $form->field($model, 'withdrawal_account')->textInput(['maxlength' => 20]) ?>

        <?= $form->field($model, 'account_name')->textInput(['maxlength' => 20]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
