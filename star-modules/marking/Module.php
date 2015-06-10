<?php

namespace star\marking;

use Yii;
use yii\web\ForbiddenHttpException;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'star\marking\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
