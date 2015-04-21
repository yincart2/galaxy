<?php

namespace common\modules\blog\widgets\home;

use yii\base\Widget;

class PhotoStream extends Widget
{
    public function run() {
        return $this->render('photo_stream');
    }

}