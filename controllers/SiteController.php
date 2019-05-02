<?php

namespace app\controllers;

use app\models\Register;
use app\models\ResetPassword;
use app\models\SetNewPassword;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
//    public $layout = "user";

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionReset(){
        $model = new ResetPassword();

        if($model->load(Yii::$app->request->post())){
            if($user = User::findOne(["email"=>$model->email, 'IS_DEFAULT'=>0])){
                $user->reset_password_hash = Yii::$app->security->generateRandomString();
                $user->save();
                $model->sendMessage($user);
                return $this->redirect(["site/reset-ok"]);
            }
            else{
                $model->addError("email",["This email does not exist"]);
            }
        }

        return $this->render("reset", ["model"=>$model]);
    }

    public function actionResetOk(){
        return $this->render("reset-ok");
    }

    public function actionSetNewPassword($code) {
        $model = new SetNewPassword();
        $error = 0;
       if($user = User::findOne(["reset_password_hash"=>$code])){

            if($model->load(Yii::$app->request->post())){

                    if($model->setNewPassword($user)){
                        $this->redirect(["site/login"]);
                    }
            }

       }else{
           $error = "You have already recovered the password for this link.";
       }
        return $this->render("set-new-password", ["model"=>$model, "error"=>$error]);


    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        /*
         * разлогиниваем пользоавтеля
         * */
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
            if($role["ROLE_UNIT"]){
                return $this->redirect("/user/index");
            }else if($role["ROLE_AGENT"]){
                return $this->redirect("/agent/keys");
            }

        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect("/login");
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /*действие отвечающее за полный цикл регистрации
    * (Отправку писем нужно вынести в отдельный и контроллер)
    */
    public function actionRegister(){

        $model = new Register();
        Yii::$app->user->logout();
        if($model->load(Yii::$app->request->post())){
            $model->addParametersInModel();
            if($model->save(false)){// восстановить

                /*Создаем дефолтового юзера*/
                $default_user = new Register();
                $default_user->setAttributes($model->getAttributes(), false);
                $default_user->parameterDefautUser($model->id); //устанавливаем дефолтовые параметры.
                $default_user->save(false);//отключили валидаци. т.к. это полная копия изначальной модели

                /*Устанавливаем роли*/
                $ROLE_UNIT = Yii::$app->authManager->getRole("ROLE_UNIT");
                $ROLE_AGENT = Yii::$app->authManager->getRole("ROLE_AGENT");

                Yii::$app->authManager->assign($ROLE_UNIT,$model->id);
                Yii::$app->authManager->assign($ROLE_AGENT,$default_user->id);

                //аторизовать пользователя.
                $user = User::findIdentity($model->id);
                if($user->login()){
                    // сделать отправку письма
                    $user->sendConfirmEmail();
                    $this->redirect(["user/hello"]);
                }else{
                    $this->var_export($model->errors);
                }


            }else{
                $this->var_export($model->errors);
            }

        }
        $csv = $this->importCSV("country.csv"); //импортирует csv со всеми странами мира
        $countrySelect2 = $this->CountrySelect2($csv);

        return $this->render("register",["model"=>$model, "countrySelect2"=>$countrySelect2]);
    }

    public function CountrySelect2 (array $csv) {
        $country = [];
        foreach ($csv as $value){
            $country [$value[0]] = $value[0];
        }
        return $country;
    }

    /*
     * производит импорт из файла CSV
     * @param string $csv - имя фала name.csv
     * @return array $data - массив формируемый из файла csv / [..., [0=>"Russia", 1=>"ru"], ...]
     * */
    private function importCSV($csv){
        $pathToFile = Yii::getAlias("@app")."/data/".$csv;
//        $this->var_export($pathToFile);
        if (!file_exists($pathToFile) || !is_readable($pathToFile)) {
            return [];
        }
        $data = [];
        if ($handle = fopen($pathToFile, "r")) {
            while (($dataStr = fgetcsv($handle, 1000, ","))!==FALSE){
                $data[] = $dataStr;
            }
            fclose($handle);
        }else{
            return [];
        }
        array_shift($data);
        return $data;
    }

    public function actionLegalTerms(){
        return $this->render("legal-terms");
    }
}
