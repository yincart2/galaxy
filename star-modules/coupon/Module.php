<?php

namespace star\coupon;

use Yii;
use yii\web\ForbiddenHttpException;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'star\coupon\controllers';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
