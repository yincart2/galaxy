<?php

namespace home\modules\member\models;

use common\models\Area;
use Yii;

/**
 * This is the model class for table "member_address".
 *
 * @property integer $member_address_id
 * @property integer $user_id
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $address
 * @property string $zip_code
 * @property string $phone
 * @property string $name
 * @property integer $is_default
 */
class MemberAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'is_default'], 'integer'],
            [['province', 'city', 'district', 'address', 'zip_code', 'phone', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_address_id' => Yii::t('app', 'Member Address ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'district' => Yii::t('app', 'District'),
            'address' => Yii::t('app', 'Address'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'phone' => Yii::t('app', 'Phone'),
            'name' => Yii::t('app', 'Name'),
            'is_default' => Yii::t('app', 'Is Default'),
        ];
    }

    public function getProvinceArea(){
        return $this->hasOne(Area::className(),['area_id'=>'province']);
    }
    public function getCityArea(){
        return $this->hasOne(Area::className(),['area_id'=>'city']);
    }
    public function getDistrictArea(){
        return $this->hasOne(Area::className(),['area_id'=>'district']);
    }
}
