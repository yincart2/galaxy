<?php
use yii\widgets\ActiveForm;


$form = ActiveForm::begin([
    'method' => 'post',
]);
echo $assignModel->role_name;
foreach($permissions as $key=>$permission){
    echo \yii\helpers\Html::label($key);
    echo \yii\helpers\Html::checkboxList('AssignModel[permissions]['.$key.']',NULL,$permission);
//    echo $form->field($assignModel, 'permissions['.$key.']')->checkboxList($permission)->label($key);
}

?>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ?Yii::t('catalog','Create')  : Yii::t('catalog','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php $form->end();?>