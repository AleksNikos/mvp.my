<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 4:54
 */

namespace app\models;


use function var_export;
use Yii;
use yii\base\Model;

class SetNewPassword extends Model
{
    public $password;
    public $confirm_password;
    public $legal_terms;

    public function rules()
    {
        return [
            [['confirm_password', 'password'], 'required'],
            [['password'],'string','min'=>6,'message'=>'New password must contain at least 6 characters.'],
            [['password'],  'match', 'pattern' => '#^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$#', 'message'=>'New password must contain numbers, upper and lower case characters.'],
            [['confirm_password'], "compare", "compareAttribute"=>"password", "message"=>"Passwords don't match"],

            /*Это необходимо для активации агента*/
            ['legal_term','safe'],
        ];
    }


    function setNewPassword(User $user){

        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->reset_password_hash = null;
        return $user->save();
    }

    function validateLegalterms(){
        if($this->legal_terms==1){
            return true;
        }else{
            return false;
        }
    }
}