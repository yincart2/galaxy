<?php

use yii\db\Schema;
use yii\db\Migration;

class m150626_102323_system_v0_1_0 extends Migration
{
    public function up()
    {
        $this->createTable('{{%setting}}', [
            'setting_id' => Schema::TYPE_PK,
            'menu_code' => Schema::TYPE_STRING . '(255) NOT NULL',
            'menu_label' => Schema::TYPE_STRING . '(255) NOT NULL',
            'group_code' => Schema::TYPE_STRING . '(255) NOT NULL',
            'group_label' => Schema::TYPE_STRING . '(255) NOT NULL',
            'menu_sort' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'group_sort' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ]);

        $this->createTable('{{%setting_fields}}', [
            'setting_fields_id' => Schema::TYPE_PK,
            'setting_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'fields_code' => Schema::TYPE_STRING . '(255) ',
            'fields_label' => Schema::TYPE_STRING . '(255) ',
            'value' => Schema::TYPE_STRING . '(255) ',
            'setting_code' => Schema::TYPE_STRING . '(255) ',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ]);
    }

    public function down()
    {
        echo "m150626_102323_system_v0_1_0 cannot be reverted.\n";

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
