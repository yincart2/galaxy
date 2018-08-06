<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_084411_member_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%delivery_address}}', [
            'delivery_address_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'province' => Schema::TYPE_STRING . '(255) NOT NULL',
            'city' => Schema::TYPE_STRING . '(255) NOT NULL',
            'district' => Schema::TYPE_STRING . '(255) NOT NULL',
            'address' => Schema::TYPE_STRING . '(255) NOT NULL',
            'zip_code' => Schema::TYPE_STRING . '(255) NOT NULL',
            'phone' => Schema::TYPE_STRING . '(45) NOT NULL',
            'name' => Schema::TYPE_STRING . '(45) NOT NULL',
            'is_default' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);

        $this->createTable('{{%wishlist}}', [
            'wishlist_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'desc' => Schema::TYPE_TEXT . ' NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%delivery_address}}');
        $this->dropTable('{{%wishlist}}');
    }
}
