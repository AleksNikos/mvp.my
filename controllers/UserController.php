<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 7:52
 */

namespace app\controllers;


use app\models\User;
use app\models\Users;
use function boolval;
use Codeception\Platform\Extension;
use function intval;
use function time;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    public $layout = "user";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['hello', 'confirm-email','index','users','ajax-checker', 'keys','settings', 'payments'],
                        'allow' => true,
                        'roles' => ['ROLE_UNIT'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'ajax-checker' => ['post'],
                ],
            ],
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
                 return $this->render("activated");
             }else{
                 return $this->redirect(["user/hello","error"=>"1"]);
             }


         }else{
             return $this->redirect(["user/hello","error"=>"1"]);
         }
    }

    /*
     * Обрабатывает главную страницу unit-пользователя. если пользователь не актиен, вылетает 403-я ошибка.
     *
     * */
    public function actionIndex(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])){
            return $this->render("index");
        }else{
           $this->accessDenied();
        }

    }

    public function actionUsers(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])){

            $agents = User::find()->where(["parent_unit_id"=>Yii::$app->user->getId()])-> all();


            return $this->render("users", ["agents"=>$agents]);
        }else{
            $this->accessDenied();
        }
    }

    /*
     * Выводит ошибку о запрещенном доступе.
     * */
    public function accessDenied(){
       throw new ForbiddenHttpException("Access denied, your account is not activated");
    }

    public function actionAjaxChecker(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])) {
            if ($data = Yii::$app->request->post()) {
                $id = intval($data['id']);
                $agent = Users::findOne($id);
//                $this->var_export($agent->loadData($data));

                if ($agent = Users::findOne($id) and $agent->loadData($data)) {
                    $agent->save();
                    echo "OK";
                } else {
                    return "NOT";
                }


            }
        }else{
            return $this->accessDenied();
        }
    }

    public function actionKeys(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])) {
            return $this->render("keys");
        }else{
            $this->accessDenied();
        }
    }

    public function actionSettings() {
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])){
            return $this->render("settings");
        }else{
            $this->accessDenied();
        }
    }
    public function actionPayments(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])) {
            return $this->render("payments");
        }else{
            $this->accessDenied();
        }
    }

}