<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 27.04.2019
 * Time: 10:32
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if(!$error){
    $form = ActiveForm::begin();

    echo $form->field($model,"password")->passwordInput(["placeholder"=>"Set new password"]);
    echo $form->field($model,"confirm_password")->passwordInput(["placeholder"=>"Set new password"]);
    echo $form->field($model, 'legal_terms')->checkbox(["value"=>1]);
    echo Html::submitButton("Activate account");

    ActiveForm::end();

}else{
    echo $error;
}
?>


