<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "keys".
 *
 * @property int $id
 * @property int $created
 * @property int $updated
 * @property int $value
 * @property int $user_id
 * @property int $IS_ACTIVATED
 */
class Keys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'keys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'updated', 'value', 'user_id', 'IS_ACTIVATED'], 'integer'],
            [['value', 'user_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'updated' => 'Updated',
            'value' => 'Value',
            'user_id' => 'User ID',
            'IS_ACTIVATED' => 'Is Activated',
        ];
    }
}
