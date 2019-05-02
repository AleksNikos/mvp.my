<?php

use yii\db\Migration;

/**
 * Class m190425_221316_add_new_table_add_user_email
 */
class m190425_221316_add_new_table_add_user_email extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("add_user_by_email",[
            "id"=>$this->primaryKey(),
            "parent"=>$this->string()->notNull(),
            "email"=>$this->string()->notNull(),
            "fd"=>$this->string()->defaultValue(0),
            "er"=>$this->string()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("add_user_by_email");
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190425_221316_add_new_table_add_user_email cannot be reverted.\n";

        return false;
    }
    */
}
