<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "friend_link".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $title
 * @property string $pic
 * @property string $url
 * @property string $memo
 * @property integer $sort_order
 * @property string $language
 * @property integer $create_time
 * @property integer $update_time
 */
class FriendLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'friend_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'sort_order', 'create_time', 'update_time'], 'integer'],
            [['title', 'pic', 'url', 'memo', 'language', 'create_time', 'update_time'], 'required'],
            [['memo'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['pic'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 200],
            [['language'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Link ID',
            'category_id' => 'Category ID',
            'title' => 'Title',
            'pic' => 'Pic',
            'url' => 'Url',
            'memo' => 'Memo',
            'sort_order' => 'Sort Order',
            'language' => 'Language',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
