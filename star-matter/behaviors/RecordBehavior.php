<?php

namespace matter\behaviors;


use kiwi\helpers\CheckHelper;
use Yii;
use yii\base\Behavior;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class RecordBehavior extends Behavior
{
    public $targetClass = '';

    public $condition ='';

    /** @var \yii\db\ActiveRecord */
    protected $target;

    public $attributes = [];


    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'createRecord',
        ];
    }

    public function init(){
        parent::init();
        $this->target = Yii::createObject($this->targetClass);
        if(!$this->condition){
            $this->target = $this->target->findOne($this->condition);
        }
    }

    /**
     * @param \yii\base\ModelEvent $event
     * @throws Exception
     */
    public function createRecord($event)
    {
        foreach ($this->attributes as $key => $value) {
            if (is_string($value)) {
                $this->target->$key = ArrayHelper::getValue($event->sender, $value);
            } else if (CheckHelper::isCallable($value)) {
                $this->target->$key = call_user_func($value, $event->sender);
            } else {
                throw new Exception();
            }
        }

        if (!$this->target->save()) {
            throw new Exception('Save target error: ' . Json::encode($this->target));
        }
    }
}