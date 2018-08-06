<?php
use yii\widgets\ActiveForm;

/**@var $assignModel \star\auth\models\AssignModel**/
/**@var $permissions [] **/

$this->title = Yii::t('auth', 'Assign Permissions');
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin([
    'method' => 'post',
]);

echo '<h3>'.$assignModel->role_name.'</h3>';

foreach($permissions as $key=>$permission){
    echo '<div class="form-group"><label class="control-label">' .$key . '</label>' ;
    echo \yii\helpers\Html::checkboxList('AssignModel[permissions]['.$key.']',isset($selected[$key])?$selected[$key]:NULL,$permission,['class' => 'inline checkbox']);

}

?>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton( Yii::t('catalog','Update'), ['class' =>  'btn btn-primary']) ?>
    </div>
<?php $form->end();?>