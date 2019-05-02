<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 4:35
 */
use yii\helpers\Html;
use yii\helpers\Url;

?>
<body>

<h2>Восстановление пароля</h2>

<?= Html::a('Восстановите свой пароль по следующей ссылке', Url::toRoute(["mvp.my/set-new-password", "code"=>$user->reset_password_hash])) ?>
</body>

