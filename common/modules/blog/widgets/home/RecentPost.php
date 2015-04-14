<?php

namespace common\modules\blog\widgets\home;

use yii\base\Widget;

class RecentPost extends Widget
{
    public function run() {
        return $this->render('recent_post');
    }
}