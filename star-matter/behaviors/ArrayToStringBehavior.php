<?php
/**
 * @author Lujie.Zhou(lujie.zhou@jago-ag.cn)
 * @Date 11/14/2014
 * @Time 4:10 PM
 */
namespace matter\behaviors;

use yii\db\ActiveRecord;
use yii\behaviors\AttributeBehavior;

class ArrayToStringBehavior extends AttributeBehavior
{
    /**
     * @var array the columns saved with json format
     * for example:
     * ['jsonEncode', 'jsonDecode']
     */
    public $attributes = [];
    public function init()
    {
        $events = [
            ActiveRecord::EVENT_AFTER_FIND,
            ActiveRecord::EVENT_AFTER_VALIDATE,
            ActiveRecord::EVENT_AFTER_INSERT,
            ActiveRecord::EVENT_AFTER_UPDATE,
            ActiveRecord::EVENT_BEFORE_VALIDATE,
            ActiveRecord::EVENT_BEFORE_INSERT,
            ActiveRecord::EVENT_BEFORE_UPDATE,
        ];
        $this->attributes = array_fill_keys($events, $this->attributes);
    }
    public $isArray = true;
    /**
     * Evaluates the attribute value and assigns it to the current attributes.
     * @param \yii\base\Event $event
     */
    public function evaluateAttributes($event)
    {
        if (!empty($this->attributes[$event->name])) {
            $attributes = (array)$this->attributes[$event->name];
            if (strpos($event->name, 'after') !== false) {
                foreach ($attributes as $attribute) {
                    if (!is_array($this->owner->$attribute)) {
                        $this->owner->$attribute = explode(', ', $this->owner->$attribute);
                    }
                }
            } else if (strpos($event->name, 'before') !== false) {
                foreach ($attributes as $attribute) {
                    if (is_array($this->owner->$attribute)) {
                        $this->owner->$attribute = implode(', ', $this->owner->$attribute);
                    }
                }
            }
        }
    }
}