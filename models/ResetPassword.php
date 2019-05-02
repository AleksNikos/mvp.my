<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 4:25
 */

namespace app\models;


use himiklab\yii2\recaptcha\ReCaptchaValidator2;
use Yii;
use yii\base\Model;

class ResetPassword extends Model
{
    public $email;
    public $verify_code;
    public function rules(){
        return [
            [['email','verify_code'],'required'],
            [['email'],'email'],

            /*êàï÷à îò ãóãë*/
            [['verify_code'], ReCaptchaValidator2::className(), 'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }
    public function sendMessage($user){
        Yii::$app->mailer->compose("reset",["user"=>$user])
            ->setFrom('from@domain.com')
            ->setTo($this->email)
            ->setSubject('You are invited to participate')
            ->send();
    }
}