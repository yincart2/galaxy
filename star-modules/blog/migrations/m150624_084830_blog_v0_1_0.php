<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_084830_blog_v0_1_0 extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%comment}}', [
            'id' => Schema::TYPE_PK,
            'parent_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'post_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'text' => Schema::TYPE_TEXT . ' NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL default 0',
        ],$tableOptions);

        $this->createTable('{{%lookup}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'code' => Schema::TYPE_STRING . '(11) NOT NULL',
            'type' => Schema::TYPE_SMALLINT . '(1) NOT NULL',
            'position' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%post}}', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'language_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'star_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'cluster_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'station_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'title' => Schema::TYPE_STRING . '(255) NOT NULL',
            'url' => Schema::TYPE_STRING . '(255) NOT NULL',
            'source' => Schema::TYPE_STRING . '(255) NOT NULL',
            'summary' => Schema::TYPE_TEXT . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'tags' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . '(1) NOT NULL',
            'views' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'allow_comment' => Schema::TYPE_SMALLINT . '(1) NOT NULL',
            'create_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'update_time' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);

        $this->createTable('{{%tag}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(128) NOT NULL',
            'frequency' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ],$tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
        $this->dropTable('{{%lookup}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%tag}}');
    }
}
