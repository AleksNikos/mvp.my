<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_APIKeys".
 *
 * @property int $id
 * @property int $userID
 * @property int $uid
 */
class UserAPIKeys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_APIKeys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'uid'], 'integer'],
            [['userID', 'uid'],'unique']
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
            'uid' => 'Uid',
        ];
    }

}
