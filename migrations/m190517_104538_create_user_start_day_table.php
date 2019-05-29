<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_start_day}}`.
 */
class m190517_104538_create_user_start_day_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_start_day}}', [
            'id' => $this->primaryKey(),
            'userID'=>$this->integer(),
            'day'=>$this->integer(),
            'moth'=>$this->integer(),
            'year'=>$this->integer(),
            'time'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_start_day}}');
    }
}
