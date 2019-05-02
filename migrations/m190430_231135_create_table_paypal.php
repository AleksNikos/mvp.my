<?php

use yii\db\Migration;

/**
 * Class m190430_231135_create_table_paypal
 */
class m190430_231135_create_table_paypal extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("paypal",[
            "id"=>$this->primaryKey(),
            "userID"=>$this->integer()->notNull(), //ID юзера в системе
            "paypalID"=>$this->string()->notNull(),
            "cardID"=>$this->string()->notNull(),
            "lastNumbers"=>$this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropTable("paypal");
       return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190430_231135_create_table_paypal cannot be reverted.\n";

        return false;
    }
    */
}
