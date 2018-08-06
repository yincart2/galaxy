<?php
/**
 * Created by PhpStorm.
 * User: chalin
 * Date: 6/28/2015
 * Time: 12:08 PM
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $setting \star\system\models\Setting */

$this->title = Yii::t('core_system', 'Setting');
$this->params['breadcrumbs'][] = $this->title;
$this->params['topMenuKey'] = 'setting';
$this->params['leftMenuKey'] = 'setting';

$this->params['title'] = $this->title;
$this->params['menu']['system'] = true;
$this->params['sub-menu']['system'] = true;
?>
<div class="row">
    <div class="item-form col-md-12 col-sm-12 col-xs-12">

        <?php
        $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']]);
        echo $setting->renderForm($form);
        ?>

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group pull-right">
                <?= Html::submitButton(Yii::t('core_system', 'Save'), ['class' => 'btn btn-primary']); ?>
            </div>
        </div>

    </div>
</div>

