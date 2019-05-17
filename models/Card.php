<?php

namespace app\models;

use function explode;
use function json_encode;
use function str_replace;
use function strpos;
use Yii;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property string $card_number
 * @property string $expires
 * @property int $cvc
 * @property string $name_on_card
 * @property string $payment_method
 * @property int $user_id
 */
class Card extends \yii\db\ActiveRecord
{
    public $success; //��������� �� �������.

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cvc', 'user_id', 'card_number', 'expires', 'payment_method'], 'required'],
            [['cvc', 'user_id'], 'integer'],

            [['card_number', 'expires', 'name_on_card', 'payment_method'], 'string', 'max' => 255],
            [['payment_method'], 'paymentVarification'],
            [['card_number'],'validateCard',],
            [['expires'],'validateCard',],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_number' => 'Card Number',
            'expires' => 'Expires',
            'cvc' => 'Cvc',
            'name_on_card' => 'Name On Card',
            'payment_method' => 'Payment Method',
            'user_id' => 'User ID',
        ];
    }
    public function paymentVarification(){
        if($this->payment_method=="0"){
            return false;
        }else{
            return true;
        }
    }

    public function validateCard ($attribute) {
        if(!strpos($this->card_number,"_") and !strpos($this->expires,"_")){
            return true;
        }
        $this->addError($attribute, 'Incorrect card number or date.');
        return false;
    }

    public $moth;
    public $year;

    /*
     * ��������������� ������ �� ����� � ����������� �������� ����������� ��� ��������� �������.
     * */
    public function toIntInformation() {
        $this->card_number = str_replace(" - ","",$this->card_number);
        $date = explode(" / ",$this->expires);
        $this->moth = $date[0];
        $this->year = "20".$date[1];
    }


    public function setPayments() {
        $this->user_id = Yii::$app->user->getId();
        if($this->validate()) {
            $this->toIntInformation(); //�������� ������ ����� � ������ ����
            if($this->payment_method == "card" and !myStripe::findOne(["userID"=>Yii::$app->user->getId()])){



                /*�������� ������ � stripe*/
                $stripe = new myStripe(["moth" => $this->moth, "year" => $this->year, "cardNumber" => $this->card_number, "cvc" => $this->cvc]);
                $stripe->createNewConnect();
                if(!$stripe->save()){

                    return false; //�� ������ ����������� ���������� ��� ������.
                }else{
                    $this->success = "Card valid successfully added";
                }

            }else{
                $this->success="You already have linked cards.";

            }

            /*
             * �� ������ ���� ����� ���������� paypal
             * */
//            else if($this->payment_method == "paypal") {
//                /*�������� ������ � paypal*/
//                $paypal = new myPaypal(["moth" => $this->moth, "year" => $this->year, "cardNumber" => $this->card_number, "cvc" => $this->cvc]);
//                $paypal->createNewConnect();
//                $this->var_export($paypal);
//                if(!$paypal->save()){
//                    return false; //�� ������ ����������� ���������� ������.
//                }
//            }
        }
    }

    public static function deleteIt($method){
        if($method=="card"){ //���� ���������� ����� �������� ��� ������� ������
            $card = myStripe::findOne(["userID"=>Yii::$app->user->getId()]);
        }
        //���� ������ ��������� �������.

        if($card->delete()){
            return true;
        }
    }

}
