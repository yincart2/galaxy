<?php

use yii\db\Schema;
use yii\db\Migration;

class m150703_062557_payment_v0_1_0 extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%payment}}', [
            'payment_id' => Schema::TYPE_PK,
            'order_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'payment_method' => Schema::TYPE_INTEGER . ' NOT NULL',
            'payment_fee' => Schema::TYPE_DECIMAL . '(10, 2) NOT NULL',
            'transcation_no' => Schema::TYPE_STRING . ' NOT NULL',
            'create_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
        ],$tableOptions);
    }

    public function down()
    {
        echo "m150703_062557_payment_v0_1_0 cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
