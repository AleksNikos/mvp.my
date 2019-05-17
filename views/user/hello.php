<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 7:55
 */
use yii\helpers\Html;
echo "<p style='color:white'>hello user with email ".$user->email."</p>";

if($error==1){

    echo "<br><p style='color:white'>Неверный ключ активации или пользователь уже активен</p>";
}
$this->params['pageID']="dashboard";
?>
<div class="responsive">

    <p style="color:white">на ваш ящик было отправлено письмо.</p>
    <?= Html::a('Отправить еще раз', ['/user/hello',"code"=>"1"], ['class'=>'btn btn-primary', "style"=>"color:white"])?>
</div>


