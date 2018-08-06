<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_120941_account_v0_1_0 extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%withdrawal}}', [
            'withdrawal_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'withdrawal_fee' => Schema::TYPE_DOUBLE  ,
            'withdrawal_account' => Schema::TYPE_STRING . '(255) ',
            'account_name' => Schema::TYPE_STRING . '(255) ',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);

        $this->createTable('{{%user_profile}}', [
            'user_profile_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'money' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'credit' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'phone' => Schema::TYPE_INTEGER . '(11)  ',
            'pay_password' => Schema::TYPE_INTEGER . '(11)  ',
            'sex' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'avatar' => Schema::TYPE_STRING . '(255) ',
            'rank' => Schema::TYPE_INTEGER . '(11) ',
            'birthday' => Schema::TYPE_INTEGER . '(11)',
        ],$tableOptions);
        $this->createTable('{{%money_log}}', [
            'money_log_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'money' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 1',
            'info' => Schema::TYPE_STRING . '(255) ',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);
        $this->createTable('{{%recharge}}', [
            'recharge_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'money' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);

        $this->createTable('activity', [
            'activity_id' => Schema::TYPE_PK,
            'activity_type' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'activity_send_type' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'activity_send_value' => Schema::TYPE_STRING . '(45) NOT NULL',
            'vaild_date' => Schema::TYPE_INTEGER . '(11) NOT NULL default \'0\'',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11)',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',

        ],$tableOptions);
        $this->createTable('activity_record', [
            'activity_records_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'activity_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'note' => Schema::TYPE_STRING . '(50)',
            'create_time' => Schema::TYPE_STRING . '(45) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL default \'0\'',

        ],$tableOptions);

        $this->createTable('{{%member_sign_record}}', [
            'member_sign_record_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'target_date' => Schema::TYPE_STRING . '(8) NOT NULL',
            'ponit' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'is_delete' => Schema::TYPE_SMALLINT . '(1) NOT NULL',

        ],$tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%withdrawal}}');
        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%money_log}}');
    }

}
