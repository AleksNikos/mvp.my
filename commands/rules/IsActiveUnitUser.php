<?php
namespace app\commands\rules;
use app\models\User;
use function var_export;
use yii\rbac\Item;
use yii\rbac\Rule;

/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 13:42
 *
 * ѕровер€ет €вл€етс€ ли пользователь активным.
 */
class IsActiveUnitUser extends Rule
{
    public $name = "IsActiveUnitUser";

    /**
     * Executes the rule.
     *
     * @param string|int $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return bool a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if($params["active"]) {
            $userDB = User::findOne(["id" => $user]);
//            $this->var_export($userDB->IS_ACTIVATED);
            if ($userDB->IS_ACTIVATED) {
                return true;
            } else {
                return false;
            }
        }
    }
}