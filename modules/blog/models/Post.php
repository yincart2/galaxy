<?php

namespace star\blog\models;

use matter\behaviors\ArrayToStringBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use star\system\models\Tree;
use dektrium\user\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use core\models\Station;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $user_id
 * @property integer $language_id
 * @property integer $star_id
 * @property integer $cluster_id
 * @property integer $station_id
 * @property string $title
 * @property string $url
 * @property string $source
 * @property string $summary
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $views
 * @property integer $allow_comment
 * @property integer $create_time
 * @property integer $update_time
 */
class Post extends \yii\db\ActiveRecord
{

    private $_oldTags;

    const STATUS_DRAFT=1;
    const STATUS_PUBLISHED=2;
    const STATUS_ARCHIVED=3;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id', 'language_id', 'star_id', 'cluster_id', 'station_id', 'status', 'views', 'allow_comment'], 'integer'],
            [['title', 'content'], 'required'],
            [['summary', 'content'], 'string'],
            [['title'], 'string', 'max' => 200],
            [['url'], 'string', 'max' => 100],
            [['source'], 'string', 'max' => 50],
            ['tags', 'safe'],
            ['status', 'in', 'range'=>[1,2,3]]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => Yii::t('post', 'Category ID'),
            'user_id' => 'User ID',
            'language_id' => 'Language ID',
            'star_id' => 'Star ID',
            'cluster_id' => 'Cluster ID',
            'station_id' => 'Station ID',
            'title' => Yii::t('post', 'Title'),
            'url' => 'Url',
            'source' => Yii::t('post', 'Source'),
            'summary' => Yii::t('post', 'Summary'),
            'content' => Yii::t('post', 'Content'),
            'tags' => Yii::t('post', 'Tags'),
            'status' => Yii::t('post', 'Status'),
            'views' => 'Views',
            'allow_comment' => Yii::t('post', 'Allow Comment'),
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
//            [
//                'class' => ArrayToStringBehavior::className(),
//                'attributes' => ['tags'],
//            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id']);
    }

    /**
     * @return int|string
     */
    public function getCommentCount()
    {
        return $this->hasMany(Comment::className(), ['post_id' => 'id'])->count('post_id');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Tree::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStation()
    {
        return $this->hasOne(Station::className(), ['id' => 'station_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return Status
     */
//    public function getStatus()
//    {
//        if ($this->_status === null) {
//            $this->_status = new Status($this->status);
//        }
//        return $this->_status;
//    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // add your code here
        Tag::updateFrequency($this->_oldTags, $this->tags);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        // add your code here
        Tag::updateFrequencyOnDelete($this->_oldTags);
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTags = $this->tags;
        $this->views++;
        $this->save();
    }

//    public static function getArrayCatalog()
//    {
//        return ArrayHelper::map(BlogCatalog::find()->all(), 'id', 'title');
//    }

    /**
     * @return array a list of links that point to the post list filtered by every tag of this post
     */
    public function getTagLinks()
    {
        $links=[];
        foreach(Tag::string2array($this->tags) as $tag)
            $links[]=Html::a(Html::encode($tag), ['/blog/home/default/index', 'tag'=>$tag]);
        return $links;
    }

    public function getUrl()
    {
        return Url::to(['/blog/home/post/view', 'id'=>$this->id]);
    }

    /**
     * Adds a new comment to this post.
     * This method will set status and post_id of the comment accordingly.
     * @param Comment the comment to be added
     * @return boolean whether the comment is saved successfully
     */
    public function addComment($comment)
    {
        if(Yii::$app->params['commentNeedApproval'])
            $comment->status=Comment::STATUS_PENDING;
        else
            $comment->status=Comment::STATUS_APPROVED;
        $comment->user_id = Yii::$app->user->id;
        $comment->post_id = $this->id;
        $comment->create_time = time();
        if(!isset($comment->parent_id))
            $comment->parent_id = 0;
        return $comment->save();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->create_time = $this->update_time = time();
                $this->user_id = Yii::$app->user->id;
                $this->station_id = 2;
            }
            return true;
        } else {
            return false;
        }
    }
}
