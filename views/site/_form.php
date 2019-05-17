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

        <?php
        myAjaxWidget::begin([
                "link" => "/login",
                "formSelector" => "#login-form1",
            "submitSelector" => ".login",
            "afterMethod" => "setWarnings('#login-form1')"

        ]);
        $form = ActiveForm::begin([
    'id' => 'login-form1',
    'layout' => 'horizontal',
//    'action' => '/login', //this is post action
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<div class="inp-wr">
    <span>Email</span>
    <?=Html::activeInput("email",$model, "email",["placeholder"=>"Enter your E-mail address", "autofocus"=>"true"])?>

</div>
<div class="inp-wr">
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
<?php

    ActiveForm::end();
myAjaxWidget::end();
?>
<p class="informer">First time here? Create an account</p>
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
    myAjaxWidget::begin([
        "link" => "/register",
        "formSelector" => "#registerForm",
        "submitSelector" => ".login",
        "afterMethod" => "setWarnings('#registerForm')",
        "successMethod" => "ajaxSuccess()",

    ]);

    $registerForm = ActiveForm::begin([
            'id'=>'registerForm'
    ])?>
    <div class="inp-wr">
        <span>Name</span>
        <?=Html::activeInput("text",$register, "username", ["placeholder"=>"Enter your name"])?>

    </div>
    <div class="inp-wr">
        <span>Company</span>
        <?=Html::activeInput("text", $register,"name_organization", ["placeholder"=>"Enter your company"])?>

    </div>
    <div class="inp-wr">
        <span>Email</span>
        <?=Html::activeInput("email", $register,"email", ["placeholder"=>"Enter your E-mail address"])?>

    </div>
    <div class="inp-wr">
        <span>Password</span>
        <?=Html::activeInput("password", $register,"password", ["placeholder"=>"Enter your password"])?>

    </div>
    <div>
        <span></span>
        <?=$registerForm->field($register, "verify_code",["options"=>[
            "style"=>"margin-bottom:20px;"
        ]])->widget(ReCaptcha2::className(),[   'siteKey'=>'6LcozJ4UAAAAAEY1Sh9IUGx8Kq1DBVqalpgTirm0'])->label(false)?>
    </div>
    <div class="inp-wr remember">
        <span></span>
        <label>I agree with <a href="terms.html">Terms</a>
            <?=Html::activeInput("checkbox", $register, "legal_term",['value'=>1,'checked'=>false])?>
            <span class="checkmark"></span>

        </label>
    </div>

    <div class="inp-wr btn">
        <button class="login">CREATE ACCOUNT</button>
    </div>
    <?php ActiveForm::end();
    myAjaxWidget::end();

    ?>
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
    <?php
    myAjaxWidget::begin([
        "link" => "/reset",
        "formSelector" => "#resetForm",
        "submitSelector" => ".reset",
        "afterMethod" => "setWarnings('#resetForm')",
        "successMethod" => "ajaxSuccess()",

    ]);

    $resetForm = ActiveForm::begin([
        'id'=>'resetForm'
    ])?>
    <div class="inp-wr">
        <?=Html::activeInput("email",$reset,"email",["placeholder"=>"E-mail"])?>
    </div>
    <div class="inp-wr btn">
        <?=Html::submitButton("Reset",["class"=>"reset"])?>
        <!--                <button class="reset">Reset</button>-->
    </div>
    <?php ActiveForm::end();
        myAjaxWidget::end();
    ?>
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
    <a class="close-btn" onclick="$.fancybox.close()" href="javascript:$.fancybox.close();">
        <img src="img/close.svg" alt="">
    </a>

    <p class="informer" style="    margin-top: 20px;">

    </p>
</div>

