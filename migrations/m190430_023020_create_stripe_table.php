<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stripe}}`.
 */
class m190430_023020_create_stripe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stripe}}', [
            'id' => $this->primaryKey(),
            'userID'=>$this->integer()->notNull(),
            'stripeID'=>$this->string()->notNull(),
            'cardID'=>$this->string()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stripe}}');
    }
}
