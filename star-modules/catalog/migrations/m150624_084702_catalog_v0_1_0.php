<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_084702_catalog_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%currency}}', [
            'currency_id' => Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING . '(45) NOT NULL',
            'name' => Schema::TYPE_STRING . '(45) NOT NULL',
            'sign' => Schema::TYPE_STRING . '(45) NOT NULL',
            'rate' => Schema::TYPE_DECIMAL . '(10, 4) NOT NULL',
            'is_default' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'enabled' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);
        $this->insert('{{%currency}}', [
            'currency_id' => 1,
            'code' => 'CNY',
            'name' => '人民币',
            'sign' => '￥',
            'rate' => '0.0000',
            'is_default' => 1,
            'enabled' => 1,
        ]);
        $this->insert('{{%currency}}', [
            'currency_id' => 2,
            'code' => 'USD',
            'name' => '美元',
            'sign' => '$',
            'rate' => '0.0000',
            'is_default' => 0,
            'enabled' => 1,
        ]);
        $this->insert('{{%currency}}', [
            'currency_id' => 3,
            'code' => 'EUR',
            'name' => '欧元',
            'sign' => '€',
            'rate' => '0.0000',
            'is_default' => 0,
            'enabled' => 1,
        ]);

        $this->createTable('{{%item}}', [
            'item_id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'star_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'stock' => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'min_number' => Schema::TYPE_INTEGER . '(10) NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'currency' => Schema::TYPE_STRING . '(45) NOT NULL',
            'props' => Schema::TYPE_TEXT . ' NOT NULL',
            'props_name' => Schema::TYPE_TEXT . ' NOT NULL',
            'desc' => Schema::TYPE_TEXT . ' NOT NULL',
            'shipping_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL default 0.00',
            'is_show' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_promote' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_new' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_hot' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_best' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'click_count' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'wish_count' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'review_count' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'deal_count' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language' => Schema::TYPE_STRING . '(45) NOT NULL',
            'country' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'state' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'city' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%item_img}}', [
            'img_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'pic' => Schema::TYPE_STRING . '(255) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'position' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%item_prop}}', [
            'prop_id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'parent_prop_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'parent_value_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'prop_name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'prop_alias' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_key_prop' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_sale_prop' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'is_color_prop' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'must' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'multi' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'sort_order' => Schema::TYPE_INTEGER . '(3) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%language}}', [
            'language_id' => Schema::TYPE_PK,
            'code' => Schema::TYPE_STRING . '(45) NOT NULL',
            'name' => Schema::TYPE_STRING . '(45) NOT NULL',
        ],$tableOptions);
        $this->insert('{{%language}}', [
            'language_id' => 1,
            'code' => 'zh-cn',
            'name' => 'Chinese',
        ]);
        $this->insert('{{%language}}', [
            'language_id' => 2,
            'code' => 'en',
            'name' => 'English',
        ]);
        $this->insert('{{%language}}', [
            'language_id' => 3,
            'code' => 'de',
            'name' => 'German',
        ]);
        $this->insert('{{%language}}', [
            'language_id' => 4,
            'code' => 'ru',
            'name' => 'Russian',
        ]);
        $this->insert('{{%language}}', [
            'language_id' => 5,
            'code' => 'it',
            'name' => 'Italian',
        ]);

        $this->createTable('{{%prop_img}}', [
            'prop_img_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'item_prop_value' => Schema::TYPE_STRING . '(255) NOT NULL',
            'pic' => Schema::TYPE_STRING . '(255) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%prop_value}}', [
            'value_id' => Schema::TYPE_PK,
            'prop_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'value_name' => Schema::TYPE_STRING . '(45) NOT NULL',
            'value_alias' => Schema::TYPE_STRING . '(45) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'sort_order' => Schema::TYPE_INTEGER . '(3) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%sku}}', [
            'sku_id' => Schema::TYPE_PK,
            'item_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'tag' => Schema::TYPE_STRING . '(45) NOT NULL',
            'props' => Schema::TYPE_TEXT . ' NOT NULL',
            'props_name' => Schema::TYPE_TEXT . ' NOT NULL',
            'quantity' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'outer_id' => Schema::TYPE_STRING . '(45) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%currency}}');
        $this->dropTable('{{%item}}');
        $this->dropTable('{{%item_img}}');
        $this->dropTable('{{%item_prop}}');
        $this->dropTable('{{%language}}');
        $this->dropTable('{{%prop_img}}');
        $this->dropTable('{{%prop_value}}');
        $this->dropTable('{{%sku}}');
    }
}
