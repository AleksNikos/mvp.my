<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "total_statistics".
 *
 * @property int $id
 * @property int $fd_count
 * @property int $er_count
 * @property int $userID
 * @property int $parentID
 * @property int $date
 */
class TotalStatistics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'total_statistics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fd_count', 'er_count', 'userID', 'parentID', 'date'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fd_count' => 'Fd Count',
            'er_count' => 'Er Count',
            'userID' => 'User ID',
            'parentID' => 'Parent ID',
            'date' => 'Date',
        ];
    }

    /*
     * Устанавливает статистику для определнного пользователя за день.
     * */
    public static function setStatistics(User $user, $fd_count, $er_count){
        $total = new TotalStatistics();
        $total->userID = $user->id;
        $total->parentID = $user->parent_unit_id;
        $total->date = time();
        $total->er_count = $er_count;
        $total->fd_count = $fd_count;
        return $total->save();
    }
}
