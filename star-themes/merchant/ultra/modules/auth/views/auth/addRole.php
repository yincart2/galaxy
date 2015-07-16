<?php
/* @var $this yii\web\View */
/* @var $roleModel star\auth\models\RoleModel */


use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('auth', 'Create Controller Permissions');
$this->params['breadcrumbs'][] = $this->title;

$this->params['title'] = $this->title;
$this->params['menu']['auth'] = true;
$this->params['sub-menu']['create'] = true;
?>

<div class="content-body">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <p>
                This generator helps you to quickly generate permissions list from a controller.
            </p>

            <p>This is the name of the controller class to be generated. You should
                provide a fully qualified namespaced class (e.g. <code>app\controllers\PostController</code>),
                and class name should be in CamelCase ending with the word <code>Controller</code>. Make sure the class
                is using the same namespace as specified by your application\'s controllerNamespace property.</p>

            <?php
            $form = ActiveForm::begin([
                'method' => 'post',
            ]);
            echo $form->field($roleModel, 'controllerClass');
            ?>
            <div class="form-group pull-right">
                <?= Html::submitButton(Yii::t('catalog', 'Create'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>
