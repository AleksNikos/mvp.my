<?php

use yii\db\Migration;

/**
 * Class m190509_204630_add_new_table_total_statistics
 */
class m190509_204630_add_new_table_total_statistics extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("total_statistics", [ //хранит общую информацию за все периоды использований ключей. а также информацию за текущий период.
            "id"=>$this->primaryKey(),
            "fd_count"=>$this->integer()->defaultValue(0),
            "er_count"=>$this->integer()->defaultValue(0),
            "userID"=>$this->integer(),
            "parentID"=>$this->integer()->defaultValue(0),//0 - если нет родителя.
            "date"=>$this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("total_statistics");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190509_204630_add_new_table_total_statistics cannot be reverted.\n";

        return false;
    }
    */
}
