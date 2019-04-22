<?php

namespace app\controllers;

use app\models\Register;
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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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

        return $this->goHome();
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
