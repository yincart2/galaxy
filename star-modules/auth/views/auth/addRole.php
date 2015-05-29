<?php
/* @var $this yii\web\View */
/* @var $roleModel star\auth\models\RoleModel */


use yii\widgets\ActiveForm;
$form = ActiveForm::begin([
          'method' => 'post',
      ]);
echo $form->field($roleModel, 'controllerClass');
?>
<div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ?Yii::t('catalog','Create')  : Yii::t('catalog','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>
<?php $form->end();?>