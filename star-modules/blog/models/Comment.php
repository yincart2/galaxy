<?php

namespace star\blog\models;

use Yii;
use dektrium\user\models\User;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $post_id
 * @property integer $user_id
 * @property string $text
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $status
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    const STATUS_PENDING=1;
    const STATUS_APPROVED=2;
    const PARENT_COMMENT=0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'post_id', 'user_id', 'create_time', 'update_time', 'status'], 'integer'],
            [['post_id'], 'required'],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'post_id' => 'Post ID',
            'user_id' => 'User ID',
            'text' => '内容',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * get child comment
     * @param $id
     * @return CActiveRecord[]
     */
    public function getChildComments($id){
        return static::find()->where(['parent_id'=>$id])->all();
    }

    /**
     * @param Post the post that this comment belongs to. If null, the method
     * will query for the post.
     * @return string the permalink URL for this comment
     */
    public function getUrl($post=null)
    {
        if($post===null)
            $post=$this->post;
        return $post->getUrl().'&&parent='.$this->id.'#comments';
    }

    /**
     * Approves a comment.
     */
    public function approve()
    {
        $this->status=Comment::STATUS_APPROVED;
        $this->update(['status']);
    }

    /**
     * @return string the hyperlink display for the current comment's author
     */
    public function getAuthorLink()
    {
        if(!empty($this->url))
            return Html::a(Html::encode($this->user->username),$this->url);
        else
            return Html::encode($this->user->username);
    }

    /**
     * @return integer the number of comments that are pending approval
     */
    public function getPendingCommentCount()
    {
        return $this->count('status='.self::STATUS_PENDING);
    }

    /**
     * @param integer the maximum number of comments that should be returned
     * @return array the most recently added comments
     */
    public function findRecentComments($limit=10)
    {
        return $this->with('post')->findAll(array(
            'condition'=>'t.status='.self::STATUS_APPROVED,
            'order'=>'t.create_time DESC',
            'limit'=>$limit,
        ));
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->create_time=time();
                $this->user_id = Yii::$app->user->id;
                $this->post_id = $this->post->id;
            }
            return true;
        } else {
            return false;
        }
    }

}
