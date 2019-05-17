<?php

use yii\db\Migration;

/**
 * Class m190417_222531_add_keys_table
 */
class m190417_222531_add_keys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("keys",[
            "id"=>$this->primaryKey(),
            "created"=>$this->integer(), //���� ��������
            "updated"=>$this->integer()->defaultValue(time()), //���� ����������
            "value"=>$this->integer()->notNull(), //�������� �����
            "userID"=>$this->integer()->notNull(), // ID ������������ � �������� ����������� ����
            "IS_ACTIVATED"=>$this->boolean()->defaultValue(false), //������� �� ����.

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable("keys");

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_222531_add_keys_table cannot be reverted.\n";

        return false;
    }
    */
}
