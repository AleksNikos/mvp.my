<?php

use yii\db\Migration;

/**
 * Class m190427_212318_add_card_table
 */
class m190427_212318_add_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("card",[
            'id'=>$this->primaryKey(),
            'card_number'=>$this->string(),
            'expires'=>$this->string(),
            'cvc'=>$this->integer(3),
            'name_on_card'=>$this->string(),
            'payment_method'=>$this->string(),
            'user_id'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("card");
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190427_212318_add_card_table cannot be reverted.\n";

        return false;
    }
    */
}
