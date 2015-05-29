<?php
use yii\widgets\ActiveForm;

$this->title = Yii::t('auth', 'Assign Permissions');
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'method' => 'post',
]);

echo '<h3>'.$assignModel->role_name.'</h3>';

foreach($permissions as $key=>$permission){
    echo '<div class="form-group"><label class="control-label">' .$key . '</label>' ;
    echo \yii\helpers\Html::checkboxList('AssignModel[permissions]['.$key.']',$selected[$key],$permission,['class' => 'inline checkbox']);

}

?>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ?Yii::t('catalog','Create')  : Yii::t('catalog','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php $form->end();?>