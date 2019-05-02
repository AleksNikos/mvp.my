<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 4:53
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if(!$error){
    $form = ActiveForm::begin();

    echo $form->field($model,"password")->passwordInput(["placeholder"=>"Enter new password"]);
    echo $form->field($model,"confirm_password")->passwordInput(["placeholder"=>"Confirm password"]);
    echo Html::submitButton("Set new pass", ["class"=>"btn"]);

    ActiveForm::end();
}else{
    echo $error;
}