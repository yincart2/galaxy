<?php

namespace home\modules\member;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'home\modules\member\controllers';
    public $layout = '@theme/star/home/layouts/member.php';
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
