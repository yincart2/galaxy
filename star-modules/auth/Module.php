<?php

namespace star\auth;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'star\auth\controllers';
    public $defaultRoute = 'auth/create';
    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
