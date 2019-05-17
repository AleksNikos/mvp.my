<?php

use yii\db\Migration;

/**
 * Class m190503_234019_add_columns_name_key_in_keys_table
 */
class m190503_234019_add_columns_name_key_in_keys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("keys","name_key", $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("keys", "name_key");
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190503_234019_add_columns_name_key_in_keys_table cannot be reverted.\n";

        return false;
    }
    */
}
