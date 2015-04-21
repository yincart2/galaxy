<?php

namespace common\modules\blog\widgets\home;

use yii\base\Widget;
use common\modules\blog\models\Tag;

class TagCloud extends Widget
{
    public $maxTags=20;

    public function run() {
        $tags=Tag::findTagWeights($this->maxTags);

        return $this->render('tag_cloud', array(
            'tags' => $tags
        ));
    }

}