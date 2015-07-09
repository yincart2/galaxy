<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_083721_order_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%order}}', [
            'order_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'star_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'order_no' => Schema::TYPE_STRING . '(45) NOT NULL',
            'total_price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'shipping_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'payment_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'address' => Schema::TYPE_STRING . '(255) NOT NULL',
            'memo' => Schema::TYPE_STRING . '(255) NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);

        $this->createTable('{{%order_item}}', [
            'order_item_id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'item_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'qty' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'name' => Schema::TYPE_STRING . '(255) NOT NULL',
            'picture' => Schema::TYPE_STRING . '(255) NOT NULL',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%order}}');
        $this->dropTable('{{%order_item}}');
    }
}
