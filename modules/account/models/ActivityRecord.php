<?php

namespace star\account\models;

use Yii;

/**
 * This is the model class for table "activity_record".
 *
 * @property integer $activity_records_id
 * @property integer $user_id
 * @property integer $activity_id
 * @property string $note
 * @property string $create_time
 * @property integer $is_delete
 *
 * @property Activity $activity
 * @property Member $member
 */
class ActivityRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'activity_id', 'create_time'], 'required'],
            [['user_id', 'activity_id', 'is_delete'], 'integer'],
            [['note'], 'string', 'max' => 50],
            [['create_time'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'activity_records_id' => Yii::t('account', 'Activity Records ID'),
            'user_id' => Yii::t('account', 'Member ID'),
            'activity_id' => Yii::t('account', 'Activity ID'),
            'note' => Yii::t('account', 'Note'),
            'create_time' => Yii::t('account', 'Create Time'),
            'is_delete' => Yii::t('account', 'Is Delete'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activity::className(), ['activity_id' => 'activity_id']);
    }



}