<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-25
 * Time: 下午4:08
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\account\models\Withdrawal */

$this->params['breadcrumbs'] = [
    'title' => '充值',
];
?>
<div class="withdrawal-create">

    <h1>充值</h1>

    <div class="withdrawal-form">

        <?php $form = ActiveForm::begin(); ?>
        <input type="hidden" name="Recharge[user_id]" value="<?= Yii::$app->user->id ?>">

        <?= $form->field($model, 'money')->textInput(['maxlength' => 10]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>