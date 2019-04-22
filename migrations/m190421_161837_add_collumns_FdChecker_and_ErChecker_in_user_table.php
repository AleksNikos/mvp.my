<?php

use yii\db\Migration;

/**
 * Class m190421_161837_add_collumns_FdChecker_and_ErChecker_in_user_table
 */
class m190421_161837_add_collumns_FdChecker_and_ErChecker_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*Это для User_agent*/
        $this->addColumn("user", "FdChecker", $this->boolean()->defaultValue(true));
        $this->addColumn("user", "ErChecker", $this->boolean()->defaultValue(true));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("user","FdChecker");
        $this->dropColumn("uesr","ErChecker");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190421_161837_add_collumns_FdChecker_and_ErChecker_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
