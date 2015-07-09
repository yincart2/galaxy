<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_083213_refund_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%refund}}', [
            'refund_id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'refund_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'reason' => Schema::TYPE_STRING . '(255) NOT NULL',
            'memo' => Schema::TYPE_STRING . '(255) NOT NULL',
            'image' => Schema::TYPE_STRING . '(255) NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%refund}}');
    }
}
