<?php

namespace star\catalog\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property integer $language_id
 * @property string $code
 * @property string $name
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'language_id' => Yii::t('catalog', 'Language ID'),
            'code' => Yii::t('catalog', 'Code'),
            'name' => Yii::t('catalog', 'Name'),
        ];
    }
}
