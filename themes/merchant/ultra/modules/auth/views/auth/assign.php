<?php
use yii\widgets\ActiveForm;

/**@var $assignModel \star\auth\models\AssignModel* */
/**@var $permissions [] * */

$this->title = Yii::t('auth', 'Assign Permissions');
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['auth'] = true;
$this->params['sub-menu']['list-role'] = true;

$form = ActiveForm::begin([
    'method' => 'post',
]);
?>

<div class="content-body">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <?php
            echo '<h3>' . $assignModel->role_name . '</h3>';

            foreach ($permissions as $key => $permission) {
                echo '<div class="form-group"><label class="control-label">' . $key . '</label>';
                echo \yii\helpers\Html::checkboxList('AssignModel[permissions][' . $key . ']', isset($selected[$key]) ? $selected[$key] : NULL, $permission, ['class' => 'inline checkbox']);

            }

            ?>
            <div class="form-group">
                <?= \yii\helpers\Html::submitButton(Yii::t('catalog', 'Update'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>