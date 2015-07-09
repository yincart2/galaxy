<?php
/**
 * Created by changhai.lin.
 * Date: 11/27/2014 10:05 AM
 */

namespace star\payment\forms;

use yii\base\Model;

class AlipayForm extends Model
{
    public $seller_email;
    public $out_trade_no;
    public $subject;
    public $price;
    public $body;
    public $show_url;
    public $receive_name;
    public $receive_address;
    public $receive_zip;
    public $receive_phone;
    public $receive_mobile;

    public function attributeLabels()
    {
        return [
            'seller_email' => \Yii::t('app', '卖家支付宝帐户'),
            'out_trade_no' => \Yii::t('app', '商户订单号'),
            'subject' => \Yii::t('app', '订单名称'),
            'price' => \Yii::t('app', '付款金额'),
            'body' => \Yii::t('app', '订单描述'),
            'show_url' => \Yii::t('app', '商品展示地址'),
            'receive_name' => \Yii::t('app', '收货人姓名'),
            'receive_address' => \Yii::t('app', '收货人地址'),
            'receive_zip' => \Yii::t('app', '收货人邮编'),
            'receive_phone' => \Yii::t('app', '收货人电话号码'),
            'receive_mobile' => \Yii::t('app', '收货人手机号码'),
        ];
    }
} 