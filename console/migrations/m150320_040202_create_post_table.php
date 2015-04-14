<?php

use yii\db\Schema;
use yii\db\Migration;

class m150320_040202_create_post_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'language_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'star_id' => Schema::TYPE_INTEGER,
            'cluster_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'station_id' => Schema::TYPE_INTEGER . ' NOT NULL',

            'title' => Schema::TYPE_STRING . '(200) NOT NULL',
            'url' => Schema::TYPE_STRING . '(100) NOT NULL',
            'source' => Schema::TYPE_STRING . '(50) NOT NULL',
            'summary' => Schema::TYPE_TEXT . ' NULL',
            'content' => Schema::TYPE_TEXT . ' NULL',
            'tags' => Schema::TYPE_TEXT . ' NULL',

            'status' => Schema::TYPE_INTEGER . ' NOT NULL',
            'views' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'allow_comment' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_time' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_time' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function down()
    {
//        echo "m150320_040202_create_post_table cannot be reverted.\n";
//
//        return false;
        $this->dropTable('{{%post}}');
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
