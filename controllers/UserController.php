<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 7:52
 */

namespace app\controllers;


use function boolval;
use function time;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['hello', 'confirm-email'],
                        'allow' => true,
                        'roles' => ['ROLE_UNIT'],
                    ],
                ],
            ]
        ];
}

    /*Окно приветствия после регистрации*/

    public function actionHello($code = null,$error=null){

        if($code){
            $currentUser = Yii::$app->user->identity;
            $currentUser->sendConfirmEmail();
        }else if($error){
            return $this->render("hello",["user"=>Yii::$app->user->identity,"error"=>1]);
        }


        return $this->render("hello",["user"=>Yii::$app->user->identity]);

    }
    /*
     * @param string $code - код активации учетной записи
     * @return вернет рендер activited в случаее успеха
     * перенаправит на user/hello, с ошибкой в случае провала
     * */
    public function actionConfirmEmail($code){
         $currentUser = Yii::$app->user->identity;
         if($currentUser->email_confirm_token==$code and $currentUser->email_confirm_token!="1"){
             $currentUser->IS_ACTIVATED = true;
             $currentUser->email_confirm_token = true;
             $currentUser->update_at = time();
             if($currentUser->save()){
//                 $auth = Yii::$app->authManager->getRole()
                 return $this->render("activated");
             }else{
                 return $this->redirect(["user/hello","error"=>"1"]);
             }


         }else{
             return $this->redirect(["user/hello","error"=>"1"]);
         }
    }





}