<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180425_120336_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string(),
            'password' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
