<?php

namespace star\marketing;

use Yii;
use yii\web\ForbiddenHttpException;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'star\marketing\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
