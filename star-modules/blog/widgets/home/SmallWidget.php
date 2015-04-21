<?php

namespace common\modules\blog\widgets\home;

use yii\base\Widget;

class SmallWidget extends Widget
{
    public function run() {
        return $this->render('small_widget');
    }

}