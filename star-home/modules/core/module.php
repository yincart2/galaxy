<?php

namespace home\modules\core;

use Yii;
use yii\web\ForbiddenHttpException;

class module extends \yii\base\Module
{
    public $controllerNamespace = 'home\modules\core\controllers';

    public function init()
    {
        parent::init();
        if(!(Yii::$app->user->can('Merchant')||Yii::$app->user->can('administrator'))){
            throw new ForbiddenHttpException(\Yii::t('yii', 'You are not allowed to perform this action.'));
        }
        // custom initialization code goes here
    }
}
