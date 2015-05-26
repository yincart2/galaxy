<?php

namespace star\catalog;

use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'star\catalog\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
