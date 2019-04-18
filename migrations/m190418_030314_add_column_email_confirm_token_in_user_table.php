<?php

use yii\db\Migration;

/**
 * Class m190418_030314_add_column_email_confirm_token_in_user_table
 */
class m190418_030314_add_column_email_confirm_token_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("user", "email_confirm_token", $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("user", "email_confirm_token");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190418_030314_add_column_email_confirm_token_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
