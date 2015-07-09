<?php

namespace star\system\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property integer $area_id
 * @property integer $parent_id
 * @property string $path
 * @property integer $grade
 * @property string $name
 * @property string $language
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'parent_id', 'path', 'grade', 'name', 'language'], 'required'],
            [['area_id', 'parent_id', 'grade'], 'integer'],
            [['path', 'name', 'language'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => Yii::t('app', 'Area ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'path' => Yii::t('app', 'Path'),
            'grade' => Yii::t('app', 'Grade'),
            'name' => Yii::t('app', 'Name'),
            'language' => Yii::t('app', 'Language'),
        ];
    }
}
