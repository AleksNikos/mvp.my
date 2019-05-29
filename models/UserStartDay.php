<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_start_day".
 *
 * @property int $id
 * @property int $userID
 * @property int $day
 * @property int $moth
 * @property int $year
 * @property int $time
 */
class UserStartDay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_start_day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'day', 'moth', 'year', 'time'], 'integer'],
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
            'day' => 'Day',
            'moth' => 'Moth',
            'year' => 'Year',
            'time' => 'Time',
        ];
    }
}
