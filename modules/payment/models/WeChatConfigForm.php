<?php
/**
 * Created by PhpStorm.
 * User: Cangzhou.Wu
 * Date: 15-6-23
 * Time: 下午1:43
 */

namespace star\payment\models;


use yii\base\Model;

class WeChatConfigForm extends Model{
    /**
     * 微信公众号信息配置
     *
     * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
     *
     * MCHID：商户号（必须配置，开户邮件中可查看）
     *
     * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
     * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
     *
     * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
     * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
     * @var string
     */
    public $APPID;
    public $MCHID;
    public $KEY;
    public $APPSECRET;

    //=======【证书路径设置】=====================================
    /**
     * TODO：设置商户证书路径
     * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
     * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
     * @var path
     */
    public $SSLCERT_PATH;
    public $SSLKEY_PATH;
    //=======【curl代理设置】===================================
    /**
     * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
     * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
     * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
     * @var unknown_type
     */
    public $CURL_PROXY_HOST;
    public $CURL_PROXY_PORT;

    public function rules()
    {
        return [
            [['APPID', 'MCHID', 'KEY', 'APPSECRET'], 'required', 'on' => ['insert']],
            [['APPID', 'MCHID', 'KEY', 'APPSECRET','SSLCERT_PATH','SSLKEY_PATH','CURL_PROXY_HOST','CURL_PROXY_PORT',],'string'],
        ];
    }
} 