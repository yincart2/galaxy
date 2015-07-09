<?php

namespace star\catalog;

use matter\base\BaseModule;
use Yii;
use yii\web\ForbiddenHttpException;

class Module extends BaseModule
{
    public $controllerNamespace = 'star\catalog\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
