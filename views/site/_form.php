<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 06.05.2019
 * Time: 23:33
 */
use app\widgets\myAjaxWidget;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>

<div id="login">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="img/close.svg" alt="">
    </a>
    <div class="tab">
        <button class="tablinks login-btn-tab" onclick="tab_login(event, 'login-popup')">Login</button>
        <button class="tablinks create-btn-tab" onclick="tab_login(event, 'create-popup')">Create account</button>
    </div>

    <div id="login-popup" class="tabcontent">

        <form id = "login-form1" onsubmit="LoginForm(event, this)" class="col-lg-1 control-label">
    <?=Html :: hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->getCsrfToken(), []);?>
<div class="inp-wr email">
    <span>Email</span>
    <?=Html::activeInput("email",$model, "email",["placeholder"=>"Enter your E-mail address", "autofocus"=>"true"])?>

</div>
<div class="inp-wr password">
    <span>Password</span>
    <?=Html::activeInput("password",$model,"password", ['placeholder'=>'Enter your password'])?>
</div>
<div class="inp-wr remember">
    <label>Remember me
        <input type="checkbox">
        <span class="checkmark"></span>
    </label>
</div>
<a href="javascript:;" class="cant_login">Can’t log in?</a>
<div class="inp-wr btn">
    <?= Html::submitButton('Login', ['class' => 'login', 'name' => 'login-button']) ?>
    <!--                <button class="login">Login</button>-->
</div>
</form>
</div>
<!-- add class "invited" to "tabcontent" bellow if user was invited -->
<div id="create-popup" class="tabcontent invited">
    <div class="inviter">
        <img src="img/Bitmap.png" alt="photo">
        <p>
            Johnathan Lassels invited you to their team and will control
            access and pay expences of the account you about to create
        </p>
    </div>
        <?php
//    myAjaxWidget::begin([
//        "link" => "/register",
//        "formSelector" => "#registerForm",
//        "submitSelector" => ".login",
//        "afterMethod" => "setWarnings('#registerForm')",
//        "successMethod" => "ajaxSuccess()",
//
//    ]);

    ?>
    <form id="registerForm" onsubmit="RegisterForm(event,this);">
        <?=Html::hiddenInput(Yii::$app->getRequest()->csrfParam,Yii::$app->request->csrfToken)?>
    <div class="inp-wr username">
        <span>Name</span>
        <?=Html::activeInput("text",$register, "username", ["placeholder"=>"Enter your name"])?>

    </div>
    <div class="inp-wr name_organization">
        <span>Company</span>
        <?=Html::activeInput("text", $register,"name_organization", ["placeholder"=>"Enter your company"])?>

    </div>
    <div class="inp-wr email">
        <span>Email</span>
        <?=Html::activeInput("email", $register,"email", ["placeholder"=>"Enter your E-mail address"])?>

    </div>
    <div class="inp-wr password">
        <span>Password</span>
        <?=Html::activeInput("password", $register,"password", ["placeholder"=>"Enter your password"])?>

    </div>
    <div class="verify_code">
        <span style="color: #6673b4;">Google captcha</span>
            <?php
            echo \himiklab\yii2\recaptcha\ReCaptcha2::widget([
                'name' => 'Register[verify_code]',
                'siteKey' => '6LcozJ4UAAAAAEY1Sh9IUGx8Kq1DBVqalpgTirm0', // unnecessary is reCaptcha component was set up
                'widgetOptions' => ['class' => ''],
            ])
        ?>
    </div>
    <div class="inp-wr remember">
        <span></span>
        <label>I agree with <a href="terms.html">Terms</a>
            <?=Html::activeInput("checkbox", $register, "legal_term",['value'=>1,'checked'=>false])?>
            <span class="checkmark"></span>

        </label>
    </div>

    <div class="inp-wr btn">
        <input type="submit" value="CREATE ACCOUNT" class="login">
    </div>
    </form>
<!--    <p class="informer">Have an account? Login</p>-->
</div>

<div id="reset">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="img/close.svg" alt="">
    </a>
    <a href="javascript:;" class="back">
        <span>Back</span>
    </a>
    <div class="title">
        Reset password
    </div>
    <form id="resetForm" onsubmit="ResetForm(event,this)">
        <?= Html::hiddenInput(Yii::$app->getRequest()->csrfParam, Yii::$app->getRequest()->csrfToken)?>
    <div class="inp-wr email">
        <span>Email</span>
        <?=Html::activeInput("email",$reset,"email",["placeholder"=>"E-mail"])?>
    </div>
    <div class="inp-wr btn">
        <?=Html::submitButton("Reset",["class"=>"reset"])?>
    </div>
    </form>
    <p class="informer">
        If you forgot your email, please, contact
        <br />
        <a href="#">support@neurodatalab.dev</a>
    </p>
</div>




</div>
<div id="success" style="
    border-radius: 8px;
    background-color: rgba(30, 37, 73, 0.9);
    padding: 25px 30px 30px 30px;
    display: none;
    overflow-x: hidden;
    font-size: 18px;
    font-family: inherit;
    font-weight: 300;
    line-height: 1.39;
    letter-spacing: 0.5px;
    color: #6673b4;

">
    <div class="title">
        Information for you
    </div>

    <p class="informer" style="    margin-top: 20px;">

    </p>
</div>

