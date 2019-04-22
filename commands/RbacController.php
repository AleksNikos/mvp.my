<?php
namespace app\commands;
use app\commands\rules\IsActiveUnitUser;
use Yii;
use yii\console\Controller;

/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 4:08
 */
class RbacController extends Controller {
    public function actionInit() {

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        /*Создали роль юнит пользователя*/

        $role1 = $auth->createRole("ROLE_UNIT");
        $auth->add($role1);

        /*Создаем роль пользователя-агента*/

        $role2 = $auth->createRole("ROLE_AGENT");
        $auth->add($role2);

        /*Создали право просмотра страницы*/
        $view = $auth->createPermission("view");
        $auth->add($view);

        /*Даем пользователям право на просмотр*/
        $auth->addChild($role1,$view);
        $auth->addChild($role2,$view);



    }

    /*
     * Добавляет разрешение на просмотр страницы юнит-пользователzv
     * */
    public function actionAddIsActiveRule(){
        $auth = Yii::$app->authManager;

        $ActiveRule = $auth->createPermission("ActiveUnitUser");
//        $ActiveRule->description = "";
        $auth->add($ActiveRule);

        //само правило
        $rule =new  IsActiveUnitUser;
        $auth->add($rule);

        $ActiveRule->ruleName = $rule->name;

        $view = $auth->getPermission("view");
        $auth->addChild($view,$ActiveRule);


    }
}