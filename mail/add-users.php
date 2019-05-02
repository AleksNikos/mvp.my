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

<h2>Вас пригласили участвовать в проекте</h2>

<?= Html::a('Зарегистрироваться в качестве агента', Url::toRoute(["mvp.my/agent/hello", "code"=>$user->verification_key])) ?>
</body>
