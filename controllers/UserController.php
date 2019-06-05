<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 7:52
 */

namespace app\controllers;


use app\models\AddUserByEmail;
use app\models\Card;
use app\models\ChangePassword;
use app\models\Demo;
use app\models\Keys;
use app\models\PaymentsInformation;
use app\models\TotalStatistics;
use app\models\UploadImage;
use app\models\User;
use app\models\Users;
use function array_merge;
use function boolval;
use function file_exists;
use function intval;
use function is_int;
use function json_encode;
use const null;
use const SORT_ASC;
use const SORT_DESC;
use function time;
use const true;
use function unlink;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use ZipArchive;

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
                        'actions' => ['hello', 'confirm-email','index','users','ajax-checker', 'keys','settings', 'payments','ajax-add-user','ajax-remove-user', 'delete-payment-method', 'add-key','download-key','update-key', 'stop-key','replace-settings', 'change-password'],
                        'allow' => true,
                        'roles' => ['ROLE_UNIT'],
                    ],
                    [
                        'actions' => [ 'add-key','download-key','update-key', 'stop-key','replace-settings','change-password'],
                        'allow' => true,
                        'roles' => ['ROLE_AGENT'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'ajax-checker' => ['post'],
                    'ajax-add-user' => ['post'],
                    'ajax-remove-user' => ['post'],
                    'delete-payment-method'=>['post'],
                    'update-key'=>['post'],
                    'add-key'=>['post'],
                    'stop-key'=>['post'],
                    'replace-settings'=>['post'],
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
     * Метод подтверждения почтового ящика
     * @param string $code - код активации учетной записи
     * @return вернет рендер activited в случаее успеха
     * перенаправит на user/hello, с ошибкой в случае провала
     * */
    public function actionConfirmEmail($code){
        $currentUser = User::find()->where(["email_confirm_token"=>$code])->one();

        if($currentUser and $currentUser->email_confirm_token!=1){
            $currentUser->IS_ACTIVATED = true;
            $currentUser->email_confirm_token = true;
            $currentUser->update_at = time();

            $demo = new Demo();
            if($demo->start($currentUser)/*активируем демо режим.*/){
                if($currentUser->save()){ //чтобы информация не сохранялась без запуска демо режима.
                    return $this->render("activated");
                }else{
                    return $this->redirect(["user/hello","error"=>"1"]);
                }

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

            $user = Yii::$app->user->identity;
            $userChilds = User::find()->select(["username","id"])->where(["parent_unit_id"=>$user->getId(), "IS_DEFAULT"=>0])->asArray()->all();
            $userChilds2 = [];
            $allTotal = [];
            foreach ($userChilds as $child){
                $query = (new \yii\db\Query())->from('total_statistics')->where(["userID"=>$child["id"]]); //нужно учитывать период

                $child["fd_count"] = $query->sum('fd_count');
                $child["er_count"] = $query->sum('er_count');
                $child["total_count"] = $child["fd_count"]+$child["er_count"];

                $allTotal["total_count"] = $allTotal["total_count"] + $child["total_count"];
                $allTotal["er_count"]=$allTotal["er_count"] + $child["er_count"];
                $allTotal["fd_count"]=$allTotal["fd_count"] + $child["fd_count"];


                $query2 = (new \yii\db\Query())->from('payments_information')->where(["userID"=>$child["id"]]);//нужно учитывать период
                $child["fd_price"] = $query2->sum('fd_price');
                $child["er_price"] = $query2->sum('er_price');
                $child["total_price"] = $child["fd_price"]+$child["er_price"];

                $allTotal["total_price"] = $allTotal["total_price"] + $child["total_price"];
                $allTotal["er_price"]=$allTotal["er_price"] + $child["er_price"];
                $allTotal["fd_price"]=$allTotal["fd_price"] + $child["fd_price"];

                $userChilds2 [] = $child;
            }


                $userTotal = [];
                $query = (new \yii\db\Query())->from('total_statistics')->where(["userID"=>$child["id"]]);//нужно учитывать период

            $userTotal["fd_count"] = $query->sum('fd_count');
            $userTotal["er_count"] = $query->sum('er_count');
            $userTotal["total_count"] = $child["fd_count"]+$child["er_count"];

                $query2 = (new \yii\db\Query())->from('payments_information')->where(["userID"=>$child["id"]]);//нужно учитывать период
            $userTotal["fd_price"] = $query2->sum('fd_price');
            $userTotal["er_price"] = $query2->sum('er_price');
            $userTotal["total_price"] = $child["fd_price"]+$child["er_price"];


            $user = User::findOne(["id"=>$user->id]);
            return $this->render("index", ["userTotal"=>$userTotal, "userChild"=>$userChilds2, "allTotal"=>$allTotal, "user"=>$user]);
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
     * Вызывается из шаблона.
     * */
    public function actionAjaxAddUser(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model= new AddUserByEmail();
            if($model->load(Yii::$app->request->post())){
                if(!$model->addOtherParametres()){
//                    $result["errors"]['No_checked'] = "Select \"Face detector\" or \"Emotion recognition\"";
                    $model->addError("Er","Select \"Face detector\" or \"Emotion recognition\"");
                    $response['error']=$model->errors;
                    return $response;
                }
                if($model->save() and $model->addAgent()){
                    $response['success']="User ".$model->email." added.";
                    return $response;
                }

            }
            $response['error']= $model->errors;
            return $response;
        }else{
            $this->accessDenied();
        }
    }

    /*
     * Если пользователь вдруг является агентом, то перенаправляем его в личный кабинет.
     * */
    function beforeAction($action)
    {
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if($role["ROLE_AGENT"]){
            $actID = $action->id;
            //'download-key','update-key', 'stop-key'
            if($actID!="add-key" and $actID!="download-key" and $actID!="update-key" and $actID!="stop-key") {
                $this->redirect("/agent/" . $action->id);
            }
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /*
     * Удаляет пользователя (вызывается из users)
     * */
    public function actionAjaxRemoveUser(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])) {
            $userID = intval(Yii::$app->request->post()['removeUserId']);
            $response = [];
            if(is_int($userID)){
                $user = User::findOne(['id'=>$userID]);
                if($user->parent_unit_id == Yii::$app->user->getId() and $user->id!=Yii::$app->user->getId()){
                    $email = AddUserByEmail::findOne(['email'=>$user->email]);
                    $user->delete();
                    $email->delete();
                    $response["success"]= "The agent has been successfully removed.";
                }else{
                    $response["errors"][] = "You are not a unit of this agent.";
                }

            }else{
                $response["errors"][] = "Sorry an error occurred, please contact support.";

            }
            return json_encode($response);
        }else{
            return $this->accessDenied();
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

    public function actionKeys($id=null){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])) {
            $model = Keys::find()->where(["user_id"=>Yii::$app->user->getId()])->all();

            if($id){

            }

            return $this->render("keys", ['model'=>$model]);
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
            }
            return $this->render("settings",["image"=>$image,'changePass'=>$model]);
        }else{
            $this->accessDenied();
        }
    }

    /*
     * Действие ответственное за смену пароля в настройках.
     * */
    public function actionChangePassword(){
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        Yii::$app->response->format=Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax){
            $model = new ChangePassword();
            if($model->load(Yii::$app->request->post()) and $model->validateOldPassword() and $model->setPassword()){
                return true;
            }else{
                return $model->errors;
            }

        }

        if($role["ROLE_UNIT"]){
            $this->redirect("/user/settings");
        }else if($role["ROLE_AGENT"]){
            $this->redirect("/agent/settings");
        }else{
            $this->redirect("/");
        }
    }


    public function actionPayments(){
        if(Yii::$app->user->can("ActiveUnitUser", ['active'=>'1'])) {
            $card = new Card();

            //Обрабатываем Pjax
//            if(Yii::$app->request->isPjax){
//                //Обрабатываем загрузку данных карты
//                if($card->load(Yii::$app->request->post())){
//                    $card->setPayments();
//                }
//
//            }

            //Обрабатываем Ajax
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = Response::FORMAT_JSON;
                if($card->load(Yii::$app->request->post())){
                    $card->setPayments();
                }
                $response['error'] = $card->errors;
                $response['success']=$card->success;
                return $response;
            }

            $user= Yii::$app->user->identity;
            //Получаем все платежки для данного пользователя и все платежки где родителем является данный пользователь
            $payments1 = PaymentsInformation::find()->where(["userID"=>$user->getId()])->andWhere([">","total_price","0"])->orderBy(["date"=>SORT_DESC])->asArray()->all(); //юниты
            $payments2 = PaymentsInformation::find()->where(["parentID"=>$user->getId()])->andWhere([">","total_price","0"])->orderBy(["date"=>SORT_DESC])->asArray()->all(); //агенты
            $payments = array_merge($payments1,$payments2);

            $maxTime = PaymentsInformation::find()->max("date");
//            $this->var_export($payments1);
            return $this->render("payments", ["card"=>$card, "paymentsYou"=>$payments1, "paymentsAgent"=>$payments2,"paymentsAll"=>$payments, "maxTime"=>$maxTime]);
        }else{
            $this->accessDenied();
        }
    }

    /*Удаляет метод оплаты из базы*/
    public function actionDeletePaymentMethod()
    {
        if (Yii::$app->user->can("ActiveUnitUser", ['active' => '1'])) {
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $post = Yii::$app->request->post();
                if ($post['understand'] == "yes" and Card::deleteIt($post['pay-method-edit'])) {
                    $response['success'] = "Card successfully deleted";
                }else{
                    $response['error'] = ["understandChecked"=>["Please accept the terms offered by ticking"]];
                }
                return $response;
            }
        }
    }


    /*
     * Добавляет ключ
     * */
    public function actionAddKey(){
        @include_once Yii::getAlias("@app/model/APIConnector.php");
        if (Yii::$app->user->can("ActiveUnitUser", ['active' => '1']) and Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
                $key = new Keys();
                if($key->load(Yii::$app->request->post())){
                    $error = $key->createKey();
                    if($error===true and $key->save()){
                        $response['success'] = "The key was successfully created, please update the page.";
                    }else{
                        if($error=="file"){
                            $response["success"] = "At the moment it is not possible to create a key, contact the site administration.";
                        }
                        if($error=="array"){
                            $response['success'] = "Sorry, you do not have access to create this token type. Please contact with your unit user.";
                        }else{
                            $response['error'] = $key->errors;
                        }
                    }
                }
            $response['error'] = $key->errors;
            return $response;
        }
    }

    /*
     * Обновляет текущий ключ
     * @param $post[id] - id Текущего ключа в таблице Keys
     *
     * */
    public function actionUpdateKey(){
        @include_once Yii::getAlias("@app/model/APIConnector.php");
        if (Yii::$app->user->can("ActiveUnitUser", ['active' => '1']) and Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $key = Keys::findOne(["id"=>$post['id'], "user_id"=>Yii::$app->user->getId()]);
            if($key!= null and $key->updateKey() and $key->save(false)){
                $response['success'] = "The key was successfully updated!";
            }else{
                $response["success"] = "At the moment it is not possible to update a key, contact the site administration.";
            }
            $response['error'] = $key->errors;
            return $response;
        }
    }

    public function actionStopKey(){
        @include_once Yii::getAlias("@app/model/APIConnector.php");
        if (Yii::$app->user->can("ActiveUnitUser", ['active' => '1']) and Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $key = Keys::findOne(["id"=>$post['id'], "user_id"=>Yii::$app->user->getId()]);
            if($key!= null and $key->stopKey() and $key->save(false)){
                $response['success'] = "The key was successfully stoped!";
            }else{
                $response["success"] = "At the moment it is not possible to stop a key, contact the site administration.";
            }
            $response['error'] = $key->errors;
            return $response;
        }
    }

    /*
     * Дает возможность пользователю скачать файлы ключа
     * */
    public function actionDownloadKey($id){

        $user = Yii::$app->user->identity;
        if($key = Keys::findOne(['id'=>$id, "user_id"=>$user->getId()])){
//            $zipLink = $key->generateZipArchive("74ec5c57bf162e70065d9b3988ccaf15"); //отладочный
           if( $zipLink = $key->generateZipArchive($key->value)){
               Yii::$app->response->sendFile($zipLink);
           }else{
            //надо чтото придумать если файл отсутствует.

           }


        }else{
            $response["console"] = "File not exist";
        }
    }

    /*
     * меняет имя или имя организации в настройках.
     *
     * */
    public function actionReplaceSettings(){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii::$app->request->post();
            $user=User::findOne(["id"=>Yii::$app->user->id]);
            if($post["name"]=="company"){
                $user->name_organization=$post["val"];
                if($user->save()){
                    return true;
                }
            }else if($post["name"]=="name"){
                $user->username=$post["val"];
                if($user->save()){
                    return true;
                }
            }
        }
        return false;
    }





}