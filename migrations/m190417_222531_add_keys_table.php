<?php

use yii\db\Migration;

/**
 * Class m190417_222531_add_keys_table
 */
class m190417_222531_add_keys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("keys",[
            "id"=>$this->primaryKey(),
            "created"=>$this->integer(), //дата создания
            "updated"=>$this->integer()->defaultValue(time()), //дата обновления
            "value"=>$this->integer()->notNull(), //значение ключа
            "userID"=>$this->integer()->notNull(), // ID пользователя к которому пренадлежит ключ
            "IS_ACTIVATED"=>$this->boolean()->defaultValue(false), //активен ли ключ.

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("keys");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_222531_add_keys_table cannot be reverted.\n";

        return false;
    }
    */
}
