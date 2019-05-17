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
<!--<a href="http://nlabapi.devlained.ru">test</a>-->
<?php
$link = $_SERVER['SERVER_NAME']."/set-new-password?code=".$user->reset_password_hash;
?>
<?//=$link;?>
 <a href="<?=$link?>" target="_blank">Восстановите свой пароль по следующей ссылке</a>
</body>

