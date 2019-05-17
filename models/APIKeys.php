<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "APIKeys".
 *
 * @property int $id
 * @property int $userID
 * @property int $systemID
 * @property int $token_id
 * @property int $key_id
 * @property string $key_data
 * @property string $expired
 * @property string $active
 */
class APIKeys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'APIKeys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'systemID', 'token_id', 'key_id'], 'integer'],
            [['key_data', 'expired', 'active'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userID' => 'User ID',
            'systemID' => 'System ID',
            'token_id' => 'Token ID',
            'key_id' => 'Key ID',
            'key_data' => 'Key Data',
            'expired' => 'Expired',
            'active' => 'Active',
        ];
    }

    public function setParams($lastToken,$currentToken,$system_name){
        $this->userID = $currentToken->uid;
        $this->systemID = $system_name;
        $this->token_id = $lastToken->getTokenId();
        $this->key_id = $lastToken->getKeyId();
        $this->key_data = $lastToken->getKeyData();
        $this->expired = $lastToken->getExpired();
        $this->active = $lastToken->getActive();

    }
}
