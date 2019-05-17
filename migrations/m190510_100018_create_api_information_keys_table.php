<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%api_information_keys}}`.
 */
class m190510_100018_create_api_information_keys_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%api_information_keys}}', [
            'id' => $this->primaryKey(),
            "userID"=>$this->integer(),
            "systemID"=>$this->integer(),//индефикатор созданный системой (нашей) для связи с таблицей Keys
            /*далее идут поля передаваемые из АПИ*/
            "token_id"=>$this->integer(),
            "key_id"=>$this->integer(),
            "key_data"=>$this->string(),
            "expired"=>$this->string(),
            "active"=>$this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%api_information_keys}}');
    }
}
