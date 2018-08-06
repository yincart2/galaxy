<?php

namespace star\blog;

use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'star\blog\controllers';

    public function init()
    {
        parent::init();
//        $this->registerTranslations();
    }

//    public function registerTranslations()
//    {
//        Yii::$app->i18n->translations['modules/home/post/*'] = [
//            'class' => 'yii\i18n\PhpMessageSource',
//            'sourceLanguage' => 'en-US',
//            'basePath' => '@common/modules/blog/messages',
////            'fileMap' => [
////                'modules/blog/validation' => 'validation.php',
////                'modules/blog/form' => 'form.php',
////            ],
//        ];
//    }
//
//    public static function t($category, $message, $params = [], $language = null)
//    {
//        return Yii::t('modules/home/post/' . $category, $message, $params, $language);
//    }
}
