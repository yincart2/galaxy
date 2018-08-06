<?php

namespace star\auth;

use matter\base\BaseModule;
use Yii;

class Module extends BaseModule
{
    public $controllerNamespace = 'star\auth\controllers';
    public $defaultRoute = 'auth/create';
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
