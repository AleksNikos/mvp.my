<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 10:28
 */

namespace app\controllers;


use app\models\AddUserByEmail;
use app\models\ChangePassword;
use app\models\Keys;
use app\models\SetNewPassword;
use app\models\UploadImage;
use app\models\User;
use function throwException;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;

class AgentController extends Controller
{
    public $layout = "user";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['confirm-email','index','users','ajax-checker', 'keys','settings', 'payments','ajax-add-user','ajax-remove-user'],
                        'allow' => true,
                        'roles' => ['ROLE_AGENT'],
                    ],
                    [
                        'actions'=>['hello'],
                        'allow'=>true,
                        'roles'=>['?']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'ajax-checker' => ['post'],
                    'ajax-add-user' => ['post'],
                    'ajax-remove-user' => ['post'],
                ],
            ],
        ];
    }

    public function actionHello($code){
        $this->layout = "main";
        $model = new SetNewPassword();
        $error = 0;
        if($model->load(Yii::$app->request->post())){
            if($email = AddUserByEmail::findOne(['verification_key'=>$code]) and $user = User::findOne(['email'=>$email->email])){
                $user->FdChecker = $email->fd;
                $user->ErChecker = $email->er;
                $user->password_hash = $user->generatePasswordHash($model->password);
                $user->email_confirm_token = 0;
                $user->IS_ACTIVATED = 1;

                if($user->save()){
                    $this->redirect("/");

                }else{
                    $error = "Возникла непридвиденная ошибка при сохранении данных";
                }

            }
        }

        return $this->render("activate-agent", ['model'=>$model,"error"=>$error]);
    }

    public function actionKeys () {
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])){
            $model = Keys::find()->where(["user_id"=>Yii::$app->user->getId()])->all();
            return $this->render('/user/keys', ["model"=>$model]);
        }else{
            $this->accessDenied();
        }

    }

    public function actionSettings() {
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])){
            $image = new UploadImage();
            $model = new ChangePassword();//Для смены пароля.

            if (Yii::$app->request->isPost){
                if($file = UploadedFile::getInstance($image,'image')){
                    $image->upload($file);
                }

                if($model->load(Yii::$app->request->post())){
                    $model->setPassword();
                }


            }
            $unit = User::findOne(["id"=>Yii::$app->user->identity->parent_unit_id]);
            return $this->render("/user/settings",["image"=>$image,'changePass'=>$model, "unit"=>$unit]);
        }else{
            $this->accessDenied();
        }


    }
}