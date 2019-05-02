<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 7:55
 */
use yii\helpers\Html;
echo "hello user with email ".$user->email;

if($error==1){

    echo "<br>Неверный ключ активации или пользователь уже активен";
}
$this->params['pageID']="dashboard";
?>
<div class="responsive">

    <p>на ваш ящик было отправлено письмо.</p>
    <?= Html::a('Отправить еще раз', ['/user/hello',"code"=>"1"], ['class'=>'btn btn-primary'])?>
</div>


