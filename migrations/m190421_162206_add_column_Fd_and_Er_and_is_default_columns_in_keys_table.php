<?php

use yii\db\Migration;

/**
 * Class m190421_162206_add_column_Fd_and_Er_and_is_default_columns_in_keys_table
 */
class m190421_162206_add_column_Fd_and_Er_and_is_default_columns_in_keys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("keys","Fd", $this->boolean()->defaultValue(0));
        $this->addColumn("keys", "Er", $this->boolean()->defaultValue(0));
        $this->addColumn("keys","isDefault", $this->boolean()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("keys", "Fd");
        $this->dropColumn("keys","Er");
        $this->dropColumn("keys", "isDefault");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190421_162206_add_column_Fd_and_Er_and_is_default_columns_in_keys_table cannot be reverted.\n";

        return false;
    }
    */
}
