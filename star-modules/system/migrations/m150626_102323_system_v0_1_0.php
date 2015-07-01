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

        $this->batchInsert('{{%setting}}', ['setting_id', 'menu_code', 'menu_label', 'group_code', 'group_label', 'menu_sort','group_sort'],
            [
                [1,'system','系统','module','模块','1','1']
            ]);

        $this->batchInsert('{{%setting_fields}}', ['setting_id', 'fields_code', 'fields_label', 'value', 'setting_code', 'type','status'],
            [
                [1,'auth','Auth',1,'system_module_auth',2,1],
                [1,'auth','Auth',0,'system_module_auth',2,0],
                [1,'cart','Cart',1,'system_module_cart',2,1],
                [1,'cart','Cart',0,'system_module_cart',2,0],
                [1,'catalog','Catalog',1,'system_module_catalog',2,1],
                [1,'catalog','Catalog',0,'system_module_catalog',2,0],
                [1,'marketing','Marketing',1,'system_module_marketing',2,1],
                [1,'marketing','Marketing',0,'system_module_marketing',2,0],
                [1,'member','Member',1,'system_module_member',2,1],
                [1,'member','Member',0,'system_module_member',2,0],
                [1,'order','Order',1,'system_module_order',2,1],
                [1,'order','Order',0,'system_module_order',2,0],
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
