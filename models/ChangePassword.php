<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 1:43
 */

namespace app\models;


use function var_export;
use Yii;
use yii\base\Model;

class ChangePassword extends Model
{
    public $oldPassword;
    public $password;
    public $confirmPassword;

    public function rules(){
        return [
            [['oldPassword', 'password', 'confirmPassword'], 'required'],

            /*требования для пароля взяты из register*/
            [['password'],'string','min'=>6,'message'=>'New password must contain at least 6 characters.'],
            [['password'],  'match', 'pattern' => '#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$#', 'message'=>'New password must contain numbers, upper and lower case characters.'],
            [['confirmPassword'], "compare", "compareAttribute"=>"password", "message"=>"Passwords don't match"],
            [['oldPassword'],'validateOldPassword']
        ];
    }

    /*Проверяет пароль на соответствие старому*/
    public function validateOldPassword(){
        $user = User::findOne(["id"=>Yii::$app->user->getId()]);
        if($user->validatePassword($this->oldPassword)){
            return true;
        }else{
            return false;
        }
    }

    public function setPassword(){
        $user = User::findOne(["id"=>Yii::$app->user->getId()]);
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        if($user->save()){
            return true;
        }else{
            return false;
        }
    }
}