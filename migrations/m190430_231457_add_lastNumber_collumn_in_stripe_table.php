<?php

use yii\db\Migration;

/**
 * Class m190430_231457_add_lastNumber_collumn_in_stripe_table
 */
class m190430_231457_add_lastNumber_collumn_in_stripe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn("stripe","lastNumbers",$this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn("stripe", "lastNumbers");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190430_231457_add_lastNumber_collumn_in_stripe_table cannot be reverted.\n";

        return false;
    }
    */
}
