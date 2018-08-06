<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_084610_marketing_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%coupon}}', [
            'coupon_id' => Schema::TYPE_PK,
            'coupon_no' => Schema::TYPE_STRING . '(255) NOT NULL',
            'rule_id' => Schema::TYPE_INTEGER . '(11) NOT NULL  default 0',
            'order_id' => Schema::TYPE_INTEGER . '(11) NOT NULL  default 0',
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL  default 0',
            'star_id' => Schema::TYPE_INTEGER . '(11) NOT NULL  default 0',
            'start_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'end_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);

        $this->createTable('{{%coupon_rule}}', [
            'rule_id' => Schema::TYPE_PK,
            'desc' => Schema::TYPE_STRING . '(255) NOT NULL',
            'condition' => Schema::TYPE_STRING . '(255) NOT NULL',
            'result' => Schema::TYPE_STRING . '(255) NOT NULL',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%coupon}}');
        $this->dropTable('{{%coupon_rule}}');
    }
}
