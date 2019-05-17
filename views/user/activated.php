<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 18.04.2019
 * Time: 9:08
 */
use yii\helpers\Html;
$this->params['pageID']="dashboard";
?>
<p style="color:white;">Аккаунт активирован!</p>
<?=Html::a("OK",["user/index"],["class"=>"btn btn-success", "style"=>"color:white"])?>