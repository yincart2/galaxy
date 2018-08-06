<?php

namespace star\member;

use matter\base\BaseModule;
use Yii;
use yii\web\ForbiddenHttpException;
class Module extends BaseModule
{
    public $controllerNamespace = 'star\member\controllers';
    public $layout = '/member';
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
