<?php
namespace app\commands;
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
}