<?php
/**
 * Created by PhpStorm.
 * User: heyin
 * Date: 2015/5/6
 * Time: 19:12
 */

namespace star\catalog\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}