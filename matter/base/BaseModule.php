<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-30
 * Time: 下午2:49
 */

namespace matter\base;


use yii\base\Module;

class BaseModule extends Module
{

    public $modelMap = [];

    /**
     * @var string The prefix for user module URL.
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix;

    /** @var array The rules to be used in URL management. */
    public $urlRules = [];
} 