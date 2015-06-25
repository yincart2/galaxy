<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_120941_account_v0_1_0 extends Migration
{
    public function up()
    {
        $this->createTable('{{%withdrawal}}', [
            'withdrawal_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'withdrawal_fee' => Schema::TYPE_DOUBLE  ,
            'withdrawal_account' => Schema::TYPE_STRING . '(255) ',
            'account_name' => Schema::TYPE_STRING . '(255) ',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ]);

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
        ]);
        $this->createTable('{{%money_log}}', [
            'money_log_id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'money' => Schema::TYPE_INTEGER . '(11) NOT NULL default 0',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 1',
            'info' => Schema::TYPE_STRING . '(255) ',
            'create_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%withdrawal}}');
        $this->dropTable('{{%user_profile}}');
        $this->dropTable('{{%money_log}}');
    }

}
