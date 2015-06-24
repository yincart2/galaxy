<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="refund-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'refund_fee')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'create_at')->textInput(['value' => date("Y-m-d H:i",$model->create_at), 'disabled' => TRUE]) ?>

<!--    --><?php //echo $form->field($model, 'update_at')->textInput(['value' => date("Y-m-d H:i",$model->update_at), 'disabled' => TRUE]) ?>

    <?= $form->field($model, 'status')->dropDownList([0 => '待审核', 1 => '审核中', 2 => '审核通过']) ?>

    <img alt="No Image" src="<?= $model->image?>" width="190" height="190">

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
