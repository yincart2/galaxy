<?php

namespace star\system\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "station".
 *
 * @property integer $id
 * @property string $name
 * @property string $detail
 * @property integer $enabled
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $create_time
 * @property integer $update_time
 */
class Station extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enabled'], 'default',  'value' => 1],
            [['detail'], 'string'],
            [['enabled'], 'integer'],
            [['name'], 'string', 'max' => 100],
            ['start_date', 'date', 'timestampAttribute' => 'start_date', 'format' => 'yyyy-MM-dd'],
            ['end_date', 'date', 'timestampAttribute' => 'end_date', 'format' => 'yyyy-MM-dd'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'detail' => 'Detail',
            'enabled' => 'Enabled',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
            ],
        ];
    }
}
