<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?=Html::a("Login",["site/login"])?><br>
    <?=Html::a("Register",["site/register"])?><br>
    <?=Html::a("Forgot your password?",["site/reset"])?><br>
</div>
