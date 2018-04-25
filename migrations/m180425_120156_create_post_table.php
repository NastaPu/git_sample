<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m180425_120156_create_post_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
            'content' => $this->text(),
            'create_time' => $this->date(),
            'update_time' => $this->date(),
            'author_id' => $this->integer(),
            'tag_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable('post');
    }
}
