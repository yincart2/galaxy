<?php

namespace star\system;


use matter\base\BaseModule;

class Module extends BaseModule
{

    public $layout = '/system';

    public $defaultRoute = 'default';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
} 