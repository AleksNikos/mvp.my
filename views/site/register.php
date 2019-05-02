<?php
use himiklab\yii2\recaptcha\ReCaptcha2;
use kartik\select2\Select2;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;


/*----Подключение скриптов валидации-----*/

$script_validation_input = <<< JS
   //Здесь писать скрипт для проверки полей на пустоту
JS;

 // и раскомментировать эту строку
//$this->registerJs($script_validation_input, yii\web\View::POS_READY);


// или подключить готовый скрипт (вставится вконце страницы)
/*
    $this->registerJsFile('@web/js/test.js',  ['position' => yii\web\View::POS_END]); //соответствует папке /web/js/test.js
*/

/*----Подключение скриптов валидации-----*/


//управляет скрытием/открытием поля purpose
$scriptAddPurposeInput = <<< JS
    $("[name='Register[user_type]']").change(function() {
        if(this.value == 0){
            $("#purpose").prop("type", "text");
            $("#purpose").val("");
            $("[for='purpose']").prop("hidden",false)
        }else{
             $("#purpose").prop("type", "hidden");
             $("#purpose").val(0);
             $("[for='purpose']").prop("hidden",true)
        }
       
    });
JS;

$this->registerJs($scriptAddPurposeInput, View::POS_READY);

$form = ActiveForm::begin([
    "id"=>"register-form",
    "class"=>"register-from"
]);
?>
<?=$form->field($model,"username")->textInput(/*["class"=>"test1-class"]*/)?>
<?=$form->field($model,"email")->textInput(/*["class"=>"test1-class"]*/)?>

<?=$form->field($model,"password")->passwordInput()?>
<?=$form->field($model,"confirm_password")->passwordInput()?>
<?=$form->field($model, 'user_type')->radioList([0=>"Individual", 1=>"Entity", 2=>"Science organization"],["id"=>"userType"]) ?>
<?=$form->field($model,"name_organization")->textInput()?>
<?=$form->field($model,"purpose")->hiddenInput(["id"=>"purpose", "value"=>"0"])->label("Purpose",["hidden"=>"true"])?>
<?=$form->field($model,"country")->widget(Select2::className(),[
    "data" =>$countrySelect2,
    'options' => ['placeholder' => 'Select a country ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
    "class"=>"test2-class"

]) ?>
<?=$form->field($model,"city")->textInput()?>
<?=$form->field($model, "verify_code")->widget(ReCaptcha2::className(),[   'siteKey'=>'6LcozJ4UAAAAAEY1Sh9IUGx8Kq1DBVqalpgTirm0'])?>
<?= $form->field($model, 'legal_term',['template'=>"{input} {label} {error}"])->checkbox()->label(' (<a href="/legal-terms">Legal Terms</a>)') ?>
<?= $form->field($model, 'REQUESTED_FREE',['template'=>"{input} {label} {error}"])->checkbox() ?>
<?= Html::submitButton("Send")?>
<?php
    ActiveForm::end();

?>
