<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 4:27
 */
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();
echo $form->field($model, 'email')->input("text", ['placeholder'=>'Enter your email']);
echo $form->field($model, "verify_code")->widget(ReCaptcha2::className(),[   'siteKey'=>'6LcozJ4UAAAAAEY1Sh9IUGx8Kq1DBVqalpgTirm0']);
echo Html::submitButton("Send me link",["class"=>"btn btn-success"]);

ActiveForm::end();
