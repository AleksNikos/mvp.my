<?php

use yii\db\Migration;

/**
 * Class m190509_210235_create_table_payments_informaition
 */
class m190509_210235_create_table_payments_informaition extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("payments_information", [
            "id"=>$this->primaryKey(),
            "date"=>$this->integer()->defaultValue(0), //дата списания средств
            "random_string"=>$this->string(),
            "total_price"=>$this->double(),
            "fd_price"=>$this->double(),
            "er_price"=>$this->double(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190509_210235_create_table_payments_informaition cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190509_210235_create_table_payments_informaition cannot be reverted.\n";

        return false;
    }
    */
}
