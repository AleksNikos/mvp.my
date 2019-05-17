<?php

use yii\db\Migration;

/**
 * Class m190503_224200_add_columns_Fd_and_Er_in_keys_table
 */
class m190503_224200_add_columns_Fd_and_Er_in_keys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("keys","Fd",$this->boolean()->defaultValue(false));
        $this->addColumn("keys","Er",$this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("keys","Fd");
        $this->dropColumn("keys","Er");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190503_224200_add_columns_Fd_and_Er_in_keys_table cannot be reverted.\n";

        return false;
    }
    */
}
