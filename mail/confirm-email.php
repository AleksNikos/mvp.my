<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 8:21
 */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<body>

<h2>Активируйте ваш ящик</h2>

<?= Html::a('Активировать', Url::toRoute([$_SERVER['SERVER_NAME']."/user/confirm-email", "code"=>$user->email_confirm_token])) ?>
</body>
