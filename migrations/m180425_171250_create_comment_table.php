<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comment`.
 */
class m180425_171250_create_comment_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'status' => $this->integer(),
            'create_time' => $this->date(),
            'author' => $this->string(),
            'email' => $this->string(),
            'post_id' => $this->integer(),
        ]);
        $this->createIndex(
            'idx-comment-post_id',
            'comment',
            'post_id'
        );
        $this->addForeignKey(
            'fk-comment-post_id',
            'comment',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comment-post_id',
            'comment'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-comment-post_id',
            'oomment'
        );
        $this->dropTable('comment');
    }
}
