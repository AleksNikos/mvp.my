<?php

namespace app\models;

use Stripe\Stripe;
use Yii;

/**
 * This is the model class for table "payments_information".
 *
 * @property int $id
 * @property int $date
 * @property string $random_string
 * @property double $total_price
 * @property double $fd_price
 * @property double $er_price
 * @property double $userID
 * @property double $status
 */
class PaymentsInformation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments_information';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date','userID'], 'integer'],
            [['total_price', 'fd_price', 'er_price'], 'number'],
            [['random_string'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'random_string' => 'Random String',
            'total_price' => 'Total Price',
            'fd_price' => 'Fd Price',
            'er_price' => 'Er Price',
        ];
    }

    public $fd_count;
    public $er_count;

    public function calculate(){
        $this->fd_price = $this->fd_count*1.2;
        $this->er_price = $this->er_count*1;
        $this->total_price = $this->fd_price + $this->er_price;
    }

    public function getStripe(){
        return $this->hasOne(myStripe::className(), ["userID"=>"userID"]);
    }
}
