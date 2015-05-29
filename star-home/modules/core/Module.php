<?php

namespace home\modules\core;

use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'home\modules\core\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
