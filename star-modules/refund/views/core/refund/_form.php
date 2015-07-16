<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model star\refund\models\Refund */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="refund-form">

    <?php $form = ActiveForm::begin([
        'id' => 'refund-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'formConfig' => ['labelSpan' => 2],
        'fullSpan' => 11
    ]); ?>

    <?= $form->field($model, 'order_id')->textInput() ?>

    <?= $form->field($model, 'refund_fee')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'reason')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'memo')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'create_at')->textInput(['value' => date("Y-m-d H:i", $model->create_at), 'disabled' => TRUE]) ?>

    <!--    --><?php //echo $form->field($model, 'update_at')->textInput(['value' => date("Y-m-d H:i",$model->update_at), 'disabled' => TRUE]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusArray()) ?>

    <div class="form-group">
        <label class="control-label col-lg-2" for="refund-image"><?= Yii::t('refund', 'Image')?></label>
        <div class="col-lg-9">
            <img alt="No Image" src="<?= $model->image ?>" width="190" height="190">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
