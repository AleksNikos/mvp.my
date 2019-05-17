<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demo".
 *
 * @property int $id
 * @property int $userID
 * @property int $fd_count
 * @property int $er_count
 * @property int $parentID
 * @property int $is_activated
 * @property int $period_start
 */
class Demo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userID', 'fd_count', 'er_count', 'parentID', 'is_activated', 'period_start'], 'integer'],
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
            'fd_count' => 'Fd Count',
            'er_count' => 'Er Count',
            'parentID' => 'Parent ID',
            'is_activated' => 'Is Activated',
            'period_start' => 'Period Start',
        ];
    }

    /*
     * Запускает демо режим
     * */
    public function start(User $user){
        $this->userID = $user->id;
        $this->is_activated = 1;
        $this->period_start = time();
        $this->parentID = $user->parent_unit_id;
        return $this->save();
    }

    /*
     * Останавливает демо режим
     * */
    public static function stop(User $user){
        $demo = static::findOne(["userID"=>$user->id]);
        $demo->is_activated = 0;
       return $demo->save();
    }
}
