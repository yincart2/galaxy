<?php

namespace common\modules\blog\widgets\home;

use yii\base\Widget;

class SocialIcons extends Widget
{
    public function run() {
        return $this->render('social_icons');
    }

}