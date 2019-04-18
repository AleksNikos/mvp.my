<?php

use yii\db\Migration;

/**
 * Class m190416_174143_addUserTable
 */
class m190416_174143_addUserTable extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable("user",[
            "id"=>$this->primaryKey(), //+
            "email"=>$this->string()->notNull(), //+
            "password_hash"=>$this->string()->notNull(), //+
            "access_token"=>$this->string()->notNull(),//+
            "reset_password_hash"=>$this->string()->defaultValue(null), //��� ��� ����� ������
            "purpose"=>$this->string()->notNull(), //���� ����������� //+
            "country"=>$this->string()->notNull(), //������ //+
            "city"=>$this->string()->notNull(),// +
            "user_type"=>$this->integer()->notNull(), //��� ������������ //+
            /*
             * 0 - ���. ����
             * 1 - ��. ����
             * 2 - ����. �����������
             * */
            "name_organization"=>$this->string()->notNull(), //������������ ����������� //+
            "position"=>$this->string(), // ���������, ���� ���� ������� ���. ����. //+
            "REQUESTED_FREE"=>$this->boolean()->defaultValue(false), // checkbox "free_category_account"
            "FREE_STATUS"=>$this->string()->defaultValue("PENDING"), // ��������� ����� �������� //+
            "IS_ACTIVATED"=>$this->boolean()->defaultValue(false), // ��������� ������� �� ������������ //+
            "IS_DEFAULT"=>$this->boolean()->defaultValue(false), // ��������� �������� �� ������������ ���������� //+
            /*
             * � ����������� ������������ � ����-������������ ���� � ��� �� email - ��� �� � ������.
             * */
            "register_date"=>$this->integer()->notNull(), //���� ����������� //+
            "update_at"=>$this->integer()->notNull(),//���� ���������� ������ �������� //+
            "last_visit"=>$this->integer(), //���� ���������� ������//*

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropTable("user");
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190416_174143_addUserTable cannot be reverted.\n";

        return false;
    }
    */
}
