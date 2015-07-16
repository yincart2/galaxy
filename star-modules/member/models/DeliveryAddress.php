<?php

namespace star\member\models;

use star\system\models\Area;
use Yii;

/**
 * This is the model class for table "delivery_address".
 *
 * @property integer $delivery_address_id
 * @property integer $user_id
 * @property string $province
 * @property string $city
 * @property string $district
 * @property string $address
 * @property string $zip_code
 * @property string $phone
 * @property string $name
 * @property integer $is_default
 *
 * @property \star\system\models\Area $provinceArea
 * @property \star\system\models\Area $cityArea
 * @property \star\system\models\Area $districtArea
 */
class DeliveryAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'delivery_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['province', 'city', 'district', 'address', 'zip_code', 'phone', 'name'], 'required'],
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
            'delivery_address_id' => Yii::t('member', 'Delivery Address ID'),
            'user_id' => Yii::t('member', 'User ID'),
            'province' => Yii::t('member', 'Province'),
            'city' => Yii::t('member', 'City'),
            'district' => Yii::t('member', 'District'),
            'address' => Yii::t('member', 'Address'),
            'zip_code' => Yii::t('member', 'Zip Code'),
            'phone' => Yii::t('member', 'Phone'),
            'name' => Yii::t('member', 'Name'),
            'is_default' => Yii::t('member', 'Is Default'),
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

    public static function getAddressList()
    {
        /** @var \yii\web\user $customer */
        $customer = Yii::$app->user->identity;
        $deliveryAddresses = DeliveryAddress::find()->where(['user_id' => $customer->id])->all();
        $addressList = array_map(function($address) {
            /** @var \home\modules\member\models\DeliveryAddress $address */
            $addressInfo = [$address->provinceArea->name . $address->cityArea->name . $address->districtArea->name . $address->address,
                $address->zip_code, $address->name, $address->phone];
            $addressInfo = implode(' ', $addressInfo);
            return $addressInfo;
        }, $deliveryAddresses);
        $defaultAddress = array_filter($deliveryAddresses, function($address) {
            /** @var \home\modules\member\models\DeliveryAddress $address */
            return $address->is_default;
        });
        if(!empty($defaultAddress)){
            $defaultKey = array_keys($defaultAddress)[0];
            $defaultAddress = $addressList[$defaultKey];
        }


        return [array_combine($addressList, $addressList), $defaultAddress];
    }
}
