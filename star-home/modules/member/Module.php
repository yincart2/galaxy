<?php

namespace home\modules\member;

use Yii;
use yii\web\ForbiddenHttpException;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'home\modules\member\controllers';
    public $layout = '/member';
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
