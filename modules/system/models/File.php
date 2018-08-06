<?php

namespace star\system\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "file".
 *
 * @property integer $file_id
 * @property string $model
 * @property integer $model_id
 * @property integer $type
 * @property string $name
 * @property string $url
 * @property string $detail
 * @property string $position
 * @property integer $create_at
 * @property integer $update_at
 */
class File extends \yii\db\ActiveRecord
{
    public $files;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'model_id', 'type'], 'required'],
            [['model_id', 'type', 'create_at', 'update_at'], 'integer'],
            [['detail'], 'string'],
            [['model'], 'string', 'max' => 60],
            [['name', 'url', 'position'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_id' => Yii::t('system', 'File ID'),
            'model' => Yii::t('system', 'Model'),
            'model_id' => Yii::t('system', 'Model ID'),
            'type' => Yii::t('system', 'Type'),
            'name' => Yii::t('system', 'Name'),
            'url' => Yii::t('system', 'Url'),
            'detail' => Yii::t('system', 'Detail'),
            'position' => Yii::t('system', 'Position'),
            'create_at' => Yii::t('system', 'Create At'),
            'update_at' => Yii::t('system', 'Update At'),
        ];
    }
    public function behaviors()
    {
        return [
            'time' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
            ],
        ];
    }

    /**
     * save images to server and get path
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @return array
     */
    public function getUploadImages(){
        $images = $this->loadUploadImages('File');
        $imagesArray = [];
        if(isset($images['files'])){
            foreach($images['files'] as $image){
                if($image['size']){
                    $imagesArray[] = $this ->saveImage($image);
                }
            }
        }
        return $imagesArray;
    }

    /**
     * Creates serializable array from $_FILE recursively.
     * if you post Items[images] with multiple files,
     * like $model->loadUploadImages('Items')
     * it should be return
     * [
     *      'images'=> [
     *              [
     *                 'name'=>xxx,
     *                 'type'=>xxx,
     *                 'size'=>xxx,
     *                 'tmp_name' =>xx,
     *                 'error'=>xx
     *              ]
     *              ...
     *      ]
     * ]
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $file
     * @return array
     */
    public function loadUploadImages($file){
        $images = [];
        if(isset($_FILES[$file])){
            foreach ($_FILES[$file] as $key => $info) {
                foreach($info as $attributes => $v){
                    foreach($v as $num=>$value){
                        $images[$attributes][$num][$key] = $value;
                    }
                }
            }
        }
        return $images;
    }

    /**
     *  save  image
     *
     * @author cangzhou.wu(wucangzhou@gmail.com)
     * @param $image
     * @return array
     */
    public function saveImage($image)
    {
        if (!in_array($image['type'], ['image/jpeg', 'image/png', 'image/gif'])) {
            $this->addError('images', Yii::t('catalog', $image['type'] . 'Type is wrong'));
            return [];
        }
        $tmp = explode('.', $image['name']);
        $suffix = end($tmp);
        $imageName = md5(time().$image['name']).'.'.$suffix;
        $DatePath = date('Y',time()).'/'.date('m',time()).'/'.date('d',time());
        $pic = $DatePath . '/' . $imageName;
        $path = Yii::getAlias('@image');

        if (!is_dir($path . '/' . $DatePath) && !mkdir($path . '/' . $DatePath, 0777, true) && chmod($path . '/' . $DatePath, 0777)) {
            $this->addError('images', Yii::t('catalog', 'Create image dir fail.'));
        }
        if (!move_uploaded_file($image["tmp_name"], $path . '/' . $pic)) {
            $this->addError('images', Yii::t('catalog', 'Remove image fail.'));
        }

        return ['type'=>$image['type'],'pic'=>$pic,'title'=>$image['name']];
    }
}
