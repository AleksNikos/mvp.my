<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_APIKeys}}`.
 */
class m190511_154700_create_user_APIKeys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_APIKeys}}', [ //связующая таблица между APIKeys и Users
            'id' => $this->primaryKey(),
            'userID'=>$this->integer(),
            'uid'=>$this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_APIKeys}}');
    }
}
