Yincart2 Galaxy System
===================================

终极电商系统解决方案：

基础版本提供多商户平台商城(B2B2C)，可用于垂直电商平台或者综合电商平台。若要作为B2C商城使用，关闭商家后台即可

根据自己需要，可以扩展为分销、C2C、移动电商、微信小程序、社区团购等电商解决方案

目录结构说明
-----------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
matter                   电商引擎核心基础
    base/                基础类
    behaviors/           行为类
    helpers/             助手类
modules                  公用模块
    account              账户模块
    auth                 权限模块
    blog                 博客文章模块
    cart                 购物车模块
    catalog              商品模块
    marketing            市场营销模块
    member               会员模块
    order                订单模块
    payment              支付模块
    refund               退货模块
    shipment             物流模块
    store                商店模块
    system               系统模块
star-center              平台后台      
star-cms                 内容管理平台：可用于公司官方网站
star-mall                商城前台：如天猫、京东
star-merchant            商家后台   
star-store               商店前台  
star-upload              上传的文件图片等（新安装需要自己创建此目录）
themes                   主题皮肤          
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```

虚拟域名配置说明
----------------

命名规则为xxx.star对应star-xxx，遵循“见名知意”的原则

本地测试hosts：
```
127.0.0.1 center.star
127.0.0.1 cms.star
127.0.0.1 mall.star
127.0.0.1 merchant.star
127.0.0.1 store.star
127.0.0.1 upload.star

```

apache httpd-vhosts.conf:

```
<VirtualHost *:80>
  ServerName center.star
  ServerAlias center.star
  DocumentRoot "E:\wamp64\www\galaxy\star-center\web"
  <Directory "E:\wamp64\www\galaxy\star-center\web">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
<VirtualHost *:80>
  ServerName cms.star
  ServerAlias cms.star
  DocumentRoot "E:\wamp64\www\galaxy\star-cms\web"
  <Directory "E:\wamp64\www\galaxy\star-cms\web">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
<VirtualHost *:80>
  ServerName store.star
  ServerAlias store.star
  DocumentRoot "E:\wamp64\www\galaxy\star-store\web"
  <Directory "E:\wamp64\www\galaxy\star-store\web">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
<VirtualHost *:80>
  ServerName mall.star
  ServerAlias mall.star
  DocumentRoot "E:\wamp64\www\galaxy\star-mall\web"
  <Directory "E:\wamp64\www\galaxy\star-mall\web">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
<VirtualHost *:80>
  ServerName merchant.star
  ServerAlias merchant.star
  DocumentRoot "E:\wamp64\www\galaxy\star-merchant\web"
  <Directory "E:\wamp64\www\galaxy\star-merchant\web">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>
<VirtualHost *:80>
  ServerName upload.star
  ServerAlias upload.star
  DocumentRoot "E:\wamp64\www\galaxy\star-upload"
  <Directory "E:\wamp64\www\galaxy\star-upload">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>

```

数据库
-------

数据库位于console/data/galaxy_latest.sql

Migration
--------
yii migrate/up system_v0_1_0 --migrationPath=@star/system/migrations

安装流程
---------

1. composer update(目前暂停使用compose更新，可直接使用根目录的vendor.zip解压到当前目录即可)

2. php init （本地选择 0 - 开发环境，线上选择 1 - 生产环境）

3. 修改数据库连接 账号

4. yii migrate/up system_v0_1_0 --migrationPath=@star/system/migrations

5. 将 console/data/galaxy_latest.sql 导入数据库

账户
---------

平台后台：admin 123456

REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install the application using the following command:

~~~
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"
php composer.phar create-project --prefer-dist --stability=dev yiisoft/yii2-app-advanced advanced
~~~