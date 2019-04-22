<?php

use yii\db\Migration;

/**
 * Class m190421_143045_add_column_in_user_table
 */
class m190421_143045_add_column_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("user","parent_unit_id", $this->integer()->defaultValue(0)); //указывает на родительского юзер-юнита
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("user","parent_unit_id");
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190421_143045_add_column_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
