<?php

namespace tests\codeception\front\home\_pages;

use yii\codeception\BasePage;

/**
 * Represents about page
 * @property \codeception_front-home\AcceptanceTester|\codeception_front-home\FunctionalTester $actor
 */
class AboutPage extends BasePage
{
    public $route = 'site/about';
}
