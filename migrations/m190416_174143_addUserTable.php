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
            "reset_password_hash"=>$this->string()->defaultValue(null), //хеш дл€ смена парол€
            "purpose"=>$this->string()->notNull(), //цель регистрации //+
            "country"=>$this->string()->notNull(), //—трана //+
            "city"=>$this->string()->notNull(),// +
            "user_type"=>$this->integer()->notNull(), //тип пользовател€ //+
            /*
             * 0 - физ. лицо
             * 1 - юр. лицо
             * 2 - науч. организаци€
             * */
            "name_organization"=>$this->string()->notNull(), //наименование организации //+
            "position"=>$this->string(), // должность, если было выбрано физ. лицо. //+
            "REQUESTED_FREE"=>$this->boolean()->defaultValue(false), // checkbox "free_category_account"
            "FREE_STATUS"=>$this->string()->defaultValue("PENDING"), // мен€еетс€ после проверки //+
            "IS_ACTIVATED"=>$this->boolean()->defaultValue(false), // указывает активен ли пользователь //+
            "IS_DEFAULT"=>$this->boolean()->defaultValue(false), // указывает €вл€етс€ ли пользователь дефолтовым //+
            /*
             * ” дефолтового пользовател€ и юнит-пользовател€ один и тот же email - так их и искать.
             * */
            "register_date"=>$this->integer()->notNull(), //дата регистрации //+
            "update_at"=>$this->integer()->notNull(),//дата обновлени€ данных аккаунта //+
            "last_visit"=>$this->integer(), //дата последнего визита//*

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
