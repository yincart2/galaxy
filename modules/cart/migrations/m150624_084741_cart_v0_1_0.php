<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_084741_cart_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%cart}}', [
            'cart_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'sku_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'star_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'qty' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'data' => Schema::TYPE_TEXT . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%cart}}');
    }
}
