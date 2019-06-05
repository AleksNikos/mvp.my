<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 15:54
 */
use app\assets\UserAsset;
use app\models\AddUserByEmail;
use app\models\StatisticsDays;
use app\models\TotalStatistics;
use app\widgets\myAjaxWidget;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Pjax;

UserAsset::register($this);

$scriptAddUser=<<<JS

$(".add-user-form [type=mail]").keyup(function() {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = $(this);
   if(reg.test($(this).val()) == false || checkerr(".add-user-form") == false) {
      console.log('Введите корректный e-mail');
      $('.add-user-form button').prop("disabled",true);
       $('.add-user-form button').addClass("inactive");
       
       
      return false;
   }else{
       $('.add-user-form button').prop("disabled",false);
       $('.add-user-form button').removeClass("inactive");
   }
});
function checkerr (form){
    var checker = false;
    console.log(form);
    $(form+' input[type=checkbox]').each(function(){
       if ( $(this).is(':checked') ){
          checker = true;
       }
    });
    return checker;
}

$(".add-key-form [type=text]").keyup(function() {
   var reg = /^([a-z0-9A-Z]{1,})$/;
   var address = $(this);
   // console.log($(this));
   if(reg.test($(this).val()) == false || checkerr(".add-key-form") == false) {
      console.log('Введите имя');
      $('.add-key-form button').prop("disabled",true);
       $('.add-key-form button').addClass("inactive");
      return false;
   }else{
       $('.add-key-form button').prop("disabled",false);
       $('.add-key-form button').removeClass("inactive");
   }
});

$(".add-key-form input[type=checkbox], .add-user-form input[type=checkbox]").change(function() {
    form = this.parentNode.form;
    if($(form)[0].className=="add-user-form"){
        textinput = $(form)[0][0];
    }else{
        textinput = $(form)[0][1];
    }
    
    type = textinput.getAttribute("type");
    if(type == "mail"){
          reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    }else if(type == "text"){
         reg = /^([a-z0-9]{1,})$/;
    }
    selector = "."+form.classList[0];
    if(reg.test($(textinput).val()) == false || checkerr(selector) == false) {
      console.log('Введите корректный e-mail');
      $(selector+' button').prop("disabled",true);
       $(selector+ ' button').addClass("inactive");
       
       
      return false;
   }else{
       $(selector+' button').prop("disabled",false);
       $(selector+' button').removeClass("inactive");
   }
});


//$("button.add-user").click(function() {
//   event.preventDefault();
//   var data = $(".add-user-form").serialize();
//  responce = "";
//  errors = "";
//  
//  
//   $.ajax({
//            url: '/user/ajax-add-user',
//            type: 'POST',
//            data: data,
//            success: function(res){
//                responce = JSON.parse(res);
//                if (responce.errors){
//                  for(var r in responce){
//                        var respArr = responce[r];
//                        for(var i in respArr){
//                            errors = errors + respArr[i] + '\\n\\r';
//                        }
//                  }
//                  alert(errors); 
//                }
//                if(responce.save){
//                    alert("User added");
//                    $.fancybox.close();
//                }
//            },
//            error: function(er){
//                console.log(er);
//            }
//        });
//});
//   
JS;
$this->registerJS($scriptAddUser);

//script Graph
$stat = new StatisticsDays();
$statDays = $stat->getPeriodStatistics();
$time = $stat->graph->time;
$fdTime = $stat->graph->fd;
$erTime = $stat->graph->er;
$bad = $stat->percentDay["bad"];

$better = $stat->percentDay["better"];

$fd_circle = $stat->percentCircle->fd;
$er_circle = $stat->percentCircle->er;

$fotterGraph = <<<JS
    time = $time;
    er = $erTime;
    fd = $fdTime;
    mini_time = $time;
    mini_er = $erTime;
    mini_fd = $fdTime;
    
    badDay = $bad;
    betterDay = $better;
    
    fd_circle = $fd_circle;
    er_circle = $er_circle;
JS;
$this->registerJS($fotterGraph,View::POS_BEGIN);

$role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
$controllerID = Yii::$app->controller->id;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section>
    <div class="topnav">
        <div id="menu">
            <a href="/">Home</a>
            <a href="/docs">Docs</a>
            <?php
            $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
            if($role['ROLE_UNIT']){
                echo "<a href='/user/' class=\"active\">Dashboard</a>";
            }else if($role['ROLE_AGENT']){
                echo "<a href='/agent/' class=\"active\">Dashboard</a>";
            }else{
                echo "<a href=\"/login\" class=\"active\">Dashboard</a>";
            }
            ?>
        </div>
    </div>
<style>
    form .inp-wr span{
        padding: 5px 0 0 10px;
        letter-spacing: 0.5px;
        font-size: 10px;
        color: #6673b4;
    }
    form .inp-wr.error span {
        color: #ff495f!important;
    }

</style>
<div id="<?=$this->params['pageID']?>" class="<?=$this->params['pageID']?>">
    <div class="wrapper">
        <div class="row">
            <div class="block-wrapper svg">
                <div class="payment-period">
                    <div class="period">
                        <?=$statDays["moths"]["start"]["moth"].' '.$statDays["moths"]["start"]["day"].' - '.$statDays["moths"]["finish"]["moth"].' '.$statDays["moths"]["finish"]["day"]?>
                    </div>
                    <div class="period_after">
                        current payment period
                    </div>
                    <a href="javascript:void(0);" class="menu icon">
                        <svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                    <stop stop-color="#6673B4" offset="0%"></stop>
                                    <stop stop-color="#9EAEFF" offset="100%"></stop>
                                </linearGradient>
                                <linearGradient x1="100%" y1="0%" x2="0%" y2="100%" id="pink">
                                    <stop stop-color="#feb4b4" offset="0%"></stop>
                                    <stop stop-color="#ff729a" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="ic-menu-m" transform="translate(-25.000000, -15.000000)">
                                    <g id="Group-3" transform="translate(25.000000, 15.000000)">
                                        <rect id="Rectangle" fill="#D0D8FF" x="0" y="13" width="15" height="2"></rect>
                                        <rect id="Rectangle" fill="url(#linearGradient-1)" x="0" y="6.5" width="15" height="2"></rect>
                                        <rect id="Rectangle" fill="#D0D8FF" x="0" y="0" width="15" height="2"></rect>
                                    </g>
                                    <g id="Group-4" transform="translate(25.000000, 15.000000)">
                                        <rect id="Rectangle" fill="url(#pink)" x="0" y="13" width="15" height="2"></rect>
                                        <rect id="Rectangle" fill="url(#pink)" x="0" y="6.5" width="15" height="2"></rect>
                                        <rect id="Rectangle" fill="url(#pink)" x="0" y="0" width="15" height="2"></rect>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="<?=$this->params['pageID']?>-info">
                <div class="dashboard_left-bar">
                    <div class="logo">
                        <img src="/img/LOGO@4x.svg" alt="Logo">
                    </div>
                    <nav class="nav">
                        <ul class="list">
                            <?php
                                if($role["ROLE_UNIT"]) {
                                    ?>
                                    <li class="list_item <?= $this->params['pageID'] == "dashboard" ? "active" : "" ?>">
                                        <a href="/<?=$controllerID?>/">Summary</a></li>
                                    <li class="list_item <?= $this->params['pageID'] == "users" ? "active" : "" ?>">
                                        <a href="/<?=$controllerID?>/users">Users</a>
                                        <a data-fancybox data-src="#add-user" href="javascript:;" class="add">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10ZM9.27955 5.36273C9.27996 4.96348 9.60044 4.64299 9.9997 4.64259C10.399 4.64218 10.7188 4.96202 10.7184 5.36128L10.7144 9.27412L14.6197 9.2777C15.019 9.27729 15.3388 9.59713 15.3384 9.99638C15.342 10.196 15.2627 10.3731 15.1307 10.5051C15.0025 10.6333 14.8179 10.7126 14.622 10.7128L10.7092 10.7167L10.7052 14.6296C10.7086 15.0251 10.4482 15.3455 9.98884 15.346C9.58959 15.3464 9.26975 15.0265 9.27016 14.6273L9.27412 10.7144L5.36128 10.7184C4.96202 10.7188 4.64218 10.399 4.64259 9.9997C4.64299 9.60044 4.96348 9.27996 5.36273 9.27955L9.27558 9.27558L9.27955 5.36273Z"
                                                      fill="url(#paint0_linear)"/>
                                                <defs>
                                                    <linearGradient id="paint0_linear" x1="10" y1="30" x2="30" y2="10"
                                                                    gradientUnits="userSpaceOnUse">
                                                        <stop stop-color="#6673B4"/>
                                                        <stop offset="1" stop-color="#9EAEFF"/>
                                                    </linearGradient>
                                                </defs>
                                            </svg>
                                        </a>
                                    </li>
                                    <?php
                                }
                            ?>
                            <li class="list_item <?=$this->params['pageID']=="keys"?"active":""?>"><a href="/<?=$controllerID?>/keys">Keys</a>
                                <a data-fancybox data-src="#add-key" href="javascript:;" class="add">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20 10C20 15.5228 15.5228 20 10 20C4.47715 20 0 15.5228 0 10C0 4.47715 4.47715 0 10 0C15.5228 0 20 4.47715 20 10ZM9.27955 5.36273C9.27996 4.96348 9.60044 4.64299 9.9997 4.64259C10.399 4.64218 10.7188 4.96202 10.7184 5.36128L10.7144 9.27412L14.6197 9.2777C15.019 9.27729 15.3388 9.59713 15.3384 9.99638C15.342 10.196 15.2627 10.3731 15.1307 10.5051C15.0025 10.6333 14.8179 10.7126 14.622 10.7128L10.7092 10.7167L10.7052 14.6296C10.7086 15.0251 10.4482 15.3455 9.98884 15.346C9.58959 15.3464 9.26975 15.0265 9.27016 14.6273L9.27412 10.7144L5.36128 10.7184C4.96202 10.7188 4.64218 10.399 4.64259 9.9997C4.64299 9.60044 4.96348 9.27996 5.36273 9.27955L9.27558 9.27558L9.27955 5.36273Z" fill="url(#paint0_linear)"/>
                                        <defs>
                                            <linearGradient id="paint0_linear" x1="10" y1="30" x2="30" y2="10" gradientUnits="userSpaceOnUse">
                                                <stop stop-color="#6673B4"/>
                                                <stop offset="1" stop-color="#9EAEFF"/>
                                            </linearGradient>
                                        </defs>
                                    </svg>
                                </a>
                            </li>

                            <?php
                                if($role["ROLE_UNIT"]) {
                                    ?>
                                    <li class="list_item <?= $this->params['pageID'] == "payments" ? "active" : "" ?>">
                                        <a href="/<?=$controllerID?>/payments">Payments</a></li>
                                    <?php
                                }
                            ?>
                            <li class="list_item <?=$this->params['pageID']=="settings"?"active":""?>"><a href="/<?=$controllerID?>/settings">Settings</a></li>
                        </ul>

                        <div class="nav_more">
                            <a href="#"></a>
                        </div>
                    </nav>
                    <nav class="mobile-nav">
                        <ul>
                            <?php if ($role["ROLE_UNIT"]){ ?>
                            <li class=" <?=$this->params['pageID']=="dashboard"?"active":""?>">
                                <a href="/<?=$controllerID?>/index">
                                    <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ic-table" fill="url(#linearGradient-1)">
                                                <path d="M6.4,12.8 L6.4,8.2 L2.9,8.2 C2.40294373,8.2 2,7.79705627 2,7.3 C2,6.80294373 2.40294373,6.4 2.9,6.4 L6.4,6.4 L6.4,2.9 C6.4,2.40294373 6.80294373,2 7.3,2 C7.79705627,2 8.2,2.40294373 8.2,2.9 L8.2,6.4 L12.8,6.4 L12.8,2.9 C12.8,2.40294373 13.2029437,2 13.7,2 C14.1970563,2 14.6,2.40294373 14.6,2.9 L14.6,6.4 L18.1,6.4 C18.5970563,6.4 19,6.80294373 19,7.3 C19,7.79705627 18.5970563,8.2 18.1,8.2 L14.6,8.2 L14.6,12.8 L18.1,12.8 C18.5970563,12.8 19,13.2029437 19,13.7 C19,14.1970563 18.5970563,14.6 18.1,14.6 L14.6,14.6 L14.6,18.1 C14.6,18.5970563 14.1970563,19 13.7,19 C13.2029437,19 12.8,18.5970563 12.8,18.1 L12.8,14.6 L8.2,14.6 L8.2,18.1 C8.2,18.5970563 7.79705627,19 7.3,19 C6.80294373,19 6.4,18.5970563 6.4,18.1 L6.4,14.6 L2.9,14.6 C2.40294373,14.6 2,14.1970563 2,13.7 C2,13.2029437 2.40294373,12.8 2.9,12.8 L6.4,12.8 Z M8.2,12.8 L12.8,12.8 L12.8,8.2 L8.2,8.2 L8.2,12.8 Z" id="Combined-Shape"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li class=" <?=$this->params['pageID']=="users"?"active":""?>">
                                <a href="/<?=$controllerID?>/users">
                                    <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ic-users" fill="url(#linearGradient-1)">
                                                <path d="M4.24623086,9.38801481 C3.52357119,8.55337719 3.08823529,7.47618745 3.08823529,6.30022635 C3.08823529,3.64930501 5.30047535,1.50030866 8.02941176,1.50030866 C10.7583482,1.50030866 12.9705882,3.64930501 12.9705882,6.30022635 C12.9705882,7.47618745 12.5352523,8.55337719 11.8125927,9.38801481 C13.817768,10.3094243 15.3291618,12.0790379 15.8559782,14.2200905 L16.5350475,14.2200905 L18.2705882,14.2200905 C18.822873,14.2200905 19.2705882,13.7723753 19.2705882,13.2200905 L19.2705882,13.0201111 C19.2705882,10.6453741 17.2980423,8.71817887 14.8577548,8.70031046 C14.3624901,8.70515989 13.8631004,8.61388091 13.390875,8.4211141 C13.390875,8.4211141 13.4905408,7.83840669 13.6898725,6.67299188 C14.0354147,6.90802625 14.4314707,7.02070925 14.8235294,7.0203779 C14.8306273,7.02021401 14.8377223,7.02022564 14.8448146,7.02024888 C15.4599412,7.0133119 16.0627886,6.72835831 16.4425593,6.2014948 C17.0686608,5.33289175 16.8513519,4.13570438 15.9571864,3.52750197 C15.1129505,2.95326121 13.9671814,3.10937562 13.3148899,3.85967085 C13.3148899,3.85967085 12.306934,2.45664085 12.306934,2.45664085 C13.5596059,1.32915255 15.4934378,1.16119869 16.9491362,2.15135014 C18.6256966,3.29172965 19.0331507,5.53645597 17.8592105,7.16508669 C17.7450838,7.32341694 17.6202127,7.47009563 17.4862243,7.60484403 C19.5645099,8.57088598 21,10.6326527 21,13.0201111 L21,13.9000617 C21,15.0046312 20.1045695,15.9000617 19,15.9000617 L16.7160356,15.9000617 L16.0588235,15.9000617 L16.0588235,17.5 C16.0588235,18.6045695 15.163393,19.5 14.0588235,19.5 L2,19.5 C0.8954305,19.5 -3.68798443e-15,18.6045695 -3.55271368e-15,17.5 L-3.55271368e-15,15.9000617 C-3.19010101e-15,13.0237527 1.73627452,10.5413791 4.24623086,9.38801481 Z M6.60205155,9.09590875 C7.03203396,9.30346649 7.51669265,9.42017285 8.02941176,9.42017285 C8.52872994,9.42017285 9.00143536,9.30948747 9.42294505,9.1119969 C10.4988324,8.60790979 11.2411765,7.5382816 11.2411765,6.30022635 C11.2411765,4.57712748 9.80322043,3.18027985 8.02941176,3.18027985 C6.2556031,3.18027985 4.81764706,4.57712748 4.81764706,6.30022635 C4.81764706,7.52526377 5.54446212,8.58539745 6.60205155,9.09590875 Z M5.82639476,10.5978526 C3.45960059,11.2644877 1.72941176,13.3859974 1.72941176,15.9000617 L1.72941176,16.8200288 C1.72941176,17.3723136 2.17712701,17.8200288 2.72941176,17.8200288 L13.3294118,17.8200288 C13.8816965,17.8200288 14.3294118,17.3723136 14.3294118,16.8200288 L14.3294118,15.9000617 C14.3294118,13.3859974 12.5992229,11.2644877 10.2324288,10.5978526 C9.56915988,10.9193121 8.82102508,11.100144 8.02941176,11.100144 C7.23779845,11.100144 6.48966365,10.9193121 5.82639476,10.5978526 Z" id="Combined-Shape"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <?php
                                } //закончилось условие ROLE_UNIT
                            ?>
                            <li class=" <?=$this->params['pageID']=="keys"?"active":""?>">
                                <a href="/<?=$controllerID?>/keys">
                                    <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ic-keys" fill="url(#linearGradient-1)">
                                                <path d="M4.60666667,12.2930513 L4.60666667,2.79333333 C4.60666667,2.35518743 4.9618541,2 5.4,2 C5.8381459,2 6.19333333,2.35518743 6.19333333,2.79333333 L6.19333333,4.26666667 L6.78,4.26666667 C7.33228475,4.26666667 7.78,4.71438192 7.78,5.26666667 L7.78,6.66666667 C7.78,7.21895142 7.33228475,7.66666667 6.78,7.66666667 L6.19333333,7.66666667 L6.19333333,12.2930513 C7.68844302,12.6504133 8.8,13.9953976 8.8,15.6 C8.8,17.4777681 7.27776815,19 5.4,19 C3.52223185,19 2,17.4777681 2,15.6 C2,13.9953976 3.11155698,12.6504133 4.60666667,12.2930513 Z M16.3933333,8.70694872 L16.3933333,18.2066667 C16.3933333,18.6448126 16.0381459,19 15.6,19 C15.1618541,19 14.8066667,18.6448126 14.8066667,18.2066667 L14.8066667,16.7333333 L14.22,16.7333333 C13.6677153,16.7333333 13.22,16.2856181 13.22,15.7333333 L13.22,14.3333333 C13.22,13.7810486 13.6677153,13.3333333 14.22,13.3333333 L14.8066667,13.3333333 L14.8066667,8.70694872 C13.311557,8.34958671 12.2,7.00460238 12.2,5.4 C12.2,3.52223185 13.7222319,2 15.6,2 C17.4777681,2 19,3.52223185 19,5.4 C19,7.00460238 17.888443,8.34958671 16.3933333,8.70694872 Z M15.6,7.21333333 C16.6014763,7.21333333 17.4133333,6.40147635 17.4133333,5.4 C17.4133333,4.39852365 16.6014763,3.58666667 15.6,3.58666667 C14.5985237,3.58666667 13.7866667,4.39852365 13.7866667,5.4 C13.7866667,6.40147635 14.5985237,7.21333333 15.6,7.21333333 Z M5.4,17.4133333 C6.40147635,17.4133333 7.21333333,16.6014763 7.21333333,15.6 C7.21333333,14.5985237 6.40147635,13.7866667 5.4,13.7866667 C4.39852365,13.7866667 3.58666667,14.5985237 3.58666667,15.6 C3.58666667,16.6014763 4.39852365,17.4133333 5.4,17.4133333 Z" id="Combined-Shape"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <?php
                                if($role["ROLE_UNIT"]) {
                                    ?>
                                    <li class="<?= $this->params['pageID'] == "payments" ? "active" : "" ?>">
                                        <a href="/<?=$controllerID?>/payments">
                                            <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <defs>
                                                    <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                        <stop stop-color="#6673B4" offset="0%"></stop>
                                                        <stop stop-color="#9EAEFF" offset="100%"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <g id="ic-card-sm" fill="url(#linearGradient-1)">
                                                        <path d="M1.575,6.75 L19.425,6.75 L19.425,5 C19.425,4.72385763 19.1899495,4.5 18.9,4.5 L2.1,4.5 C1.81005051,4.5 1.575,4.72385763 1.575,5 L1.575,6.75 Z M1.575,8.75 L1.575,16 C1.575,16.2761424 1.81005051,16.5 2.1,16.5 L18.9,16.5 C19.1899495,16.5 19.425,16.2761424 19.425,16 L19.425,8.75 L1.575,8.75 Z M2.1,3 L18.9,3 C20.059798,3 21,3.8954305 21,5 L21,16 C21,17.1045695 20.059798,18 18.9,18 L2.1,18 C0.940202025,18 1.42034288e-16,17.1045695 0,16 L0,5 C-1.42034288e-16,3.8954305 0.940202025,3 2.1,3 Z" id="Combined-Shape"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    </li>
                                    <?php
                                }
                            ?>
                            <li class="<?=$this->params['pageID']=="settings"?"active":""?>">
                                <a href="/<?=$controllerID?>/settings">
                                    <svg width="21px" height="21px" viewBox="0 0 21 21" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="ic-gear" fill="url(#linearGradient-1)" fill-rule="nonzero">
                                                <path d="M10.5,15.0504641 C11.1035221,15.0504641 11.6890341,14.933452 12.233464,14.7089286 C13.3519938,14.247646 14.247646,13.3519938 14.7089286,12.233464 C14.933452,11.6890341 15.0504641,11.1035221 15.0504641,10.5 C15.0504641,9.89647787 14.933452,9.31096594 14.7089286,8.76653598 C14.247646,7.64800624 13.3519938,6.752354 12.233464,6.29107138 C11.6890341,6.06654801 11.1035221,5.94953595 10.5,5.94953595 C9.89647787,5.94953595 9.31096594,6.06654801 8.76653598,6.29107139 C7.64800624,6.752354 6.752354,7.64800624 6.29107139,8.76653598 C6.06654801,9.31096594 5.94953595,9.89647787 5.94953595,10.5 C5.94953595,11.1035221 6.06654801,11.6890341 6.29107139,12.233464 C6.752354,13.3519938 7.64800624,14.247646 8.76653598,14.7089286 C9.31096594,14.933452 9.89647787,15.0504641 10.5,15.0504641 Z M10.5,17.0482288 C9.96060453,17.0482288 9.42966569,16.9827753 8.91622621,16.8551771 L8.18605707,18.4150839 C7.62143535,19.6213213 5.81207938,18.7743887 6.3767011,17.5681514 L7.07293049,16.0807522 C6.1970815,15.5419328 5.45806718,14.8029185 4.91924779,13.9270695 L3.43184864,14.6232989 C2.22561133,15.1879206 1.37867875,13.3785647 2.58491606,12.8139429 L4.14482285,12.0837738 C4.0172247,11.5703343 3.95177124,11.0393955 3.95177124,10.5 C3.95177124,9.96060453 4.0172247,9.42966569 4.14482285,8.91622621 L2.58491606,8.18605707 C1.37867875,7.62143535 2.22561133,5.81207938 3.43184864,6.3767011 L4.91924779,7.07293049 C5.45806718,6.1970815 6.1970815,5.45806718 7.07293049,4.91924779 L6.3767011,3.43184864 C5.81207938,2.22561133 7.62143535,1.37867875 8.18605707,2.58491606 L8.91622621,4.14482285 C9.42966569,4.0172247 9.96060453,3.95177124 10.5,3.95177124 C11.0393955,3.95177124 11.5703343,4.0172247 12.0837738,4.14482285 L12.8139429,2.58491606 C13.3785647,1.37867875 15.1879206,2.22561133 14.6232989,3.43184864 L13.9270695,4.91924779 C14.8029185,5.45806718 15.5419328,6.1970815 16.0807522,7.07293049 L17.5681514,6.3767011 C18.7743887,5.81207938 19.6213213,7.62143535 18.4150839,8.18605707 L16.8551771,8.91622621 C16.9827753,9.42966569 17.0482288,9.96060453 17.0482288,10.5 C17.0482288,11.0393955 16.9827753,11.5703343 16.8551771,12.0837738 L18.4150839,12.8139429 C19.6213213,13.3785647 18.7743887,15.1879206 17.5681514,14.6232989 L16.0807522,13.9270695 C15.5419328,14.8029185 14.8029185,15.5419328 13.9270695,16.0807522 L14.6232989,17.5681514 C15.1879206,18.7743887 13.3785647,19.6213213 12.8139429,18.4150839 L12.0837738,16.8551771 C11.5703343,16.9827753 11.0393955,17.0482288 10.5,17.0482288 Z" id="Combined-Shape"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="main-info">
                    <?=$content?>
                </div>
            </div>
            <div id="right-bar" class="right-bar">
                <div class="block-wrapper svg">
                    <div class="payment-period">
                        <div class="period">
                            <?=$statDays["moths"]["start"]["moth"].' '.$statDays["moths"]["start"]["day"].' - '.$statDays["moths"]["finish"]["moth"].' '.$statDays["moths"]["finish"]["day"]?>
                        </div>
                        <div class="period_after">
                            current payment period
                        </div>
                        <canvas id="bar-chart-horizontal"  height="4"></canvas>
                        <a href="/docs" class="goto_docs" id="menuDesctop">
                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H22V2H0V0ZM8 16H22V18H8V16ZM22 8H12V10H22V8Z" fill="#D0D8FF"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="block-wrapper">
                    <div class="round-chart">
                        <div class="chart-container">
                            <div class="val"><?=$statDays["stats"]["total"];//см. @var StatisticDays->getPeriodStatistics(); ?></div>
                            <div class="desc">times used</div>
                            <canvas id="doughnut-chartcanvas-1"></canvas>
                        </div>
                        <div class="review">
                            <div class="fd">
                                <div class="val">
                                    <?=$statDays["stats"]["fd"]; //см. @var StatisticDays->getPeriodStatistics();  ?>
                                </div>
                                <div class="percent <?=$statDays["percent"]["fd"]>0?"green":"red" ?>">
                                    <?= $statDays["percent"]["fd"]>0?"+".$statDays["percent"]["fd"]."%":$statDays["percent"]["fd"]."%" ?>
                                    <?php
                                    if($statDays["percent"]["fd"]>0){

                                        echo "
                                          <span>
											<svg width=\"6\" height=\"10\" viewBox=\"0 0 6 10\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
											<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M5.93782 2.79063C5.97927 2.75104 6 2.69167 6 2.6125C6 2.53333 5.97927 2.47396 5.93782 2.43437C4.13471 0.870825 3.2228 0.0791664 3.20207 0.0593748C3.16062 0.0197916 3.09845 0 3.01554 0C2.93264 0 2.87047 0.0197916 2.82902 0.0593748L0.0932647 2.43437C-0.0310882 2.55313 -0.0310882 2.67187 0.0932647 2.79063C0.217618 2.90938 0.341969 2.90938 0.466322 2.79063L2.76684 0.801562V9.2625C2.76684 9.42083 2.84974 9.5 3.01554 9.5C3.18135 9.5 3.26425 9.42083 3.26425 9.2625V0.801562L5.56477 2.79063C5.68912 2.90938 5.81347 2.90938 5.93782 2.79063Z\" fill=\"#b8e986\"/>
											</svg>
										</span>
                                        ";
                                    }else{
                                        echo "
                                        <span>
											<svg width=\"6\" height=\"10\" viewBox=\"0 0 6 10\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
											<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M5.93782 6.70937C5.97927 6.74896 6 6.80833 6 6.8875C6 6.96667 5.97927 7.02604 5.93782 7.06563C4.13471 8.62918 3.2228 9.42083 3.20207 9.44063C3.16062 9.48021 3.09845 9.5 3.01554 9.5C2.93264 9.5 2.87047 9.48021 2.82902 9.44063L0.0932647 7.06563C-0.0310882 6.94687 -0.0310882 6.82813 0.0932647 6.70937C0.217618 6.59062 0.341969 6.59062 0.466322 6.70937L2.76684 8.69844V0.2375C2.76684 0.0791659 2.84974 0 3.01554 0C3.18135 0 3.26425 0.0791659 3.26425 0.2375V8.69844L5.56477 6.70937C5.68912 6.59062 5.81347 6.59062 5.93782 6.70937Z\" fill=\"#ff729a\"/>
											</svg>
										</span>
                                        ";
                                    }
                                    ?>
                                </div>
                                <div class="title">
                                    Face detector
                                </div>
                            </div>
                            <div class="er">
                                <div class="val">
                                    <?= $statDays["stats"]["er"];//см. @var StatisticDays->getPeriodStatistics(); ?>
                                </div>
                                <div class="percent <?=$statDays["percent"]["er"]>0?"green":"red" ?>">
                                    <?= $statDays["percent"]["er"]>0?"+".$statDays["percent"]["er"]."%":$statDays["percent"]["er"]."%" ?>
                                    <?php
                                    if($statDays["percent"]["er"]>0){

                                        echo "
                                          <span>
											<svg width=\"6\" height=\"10\" viewBox=\"0 0 6 10\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
											<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M5.93782 2.79063C5.97927 2.75104 6 2.69167 6 2.6125C6 2.53333 5.97927 2.47396 5.93782 2.43437C4.13471 0.870825 3.2228 0.0791664 3.20207 0.0593748C3.16062 0.0197916 3.09845 0 3.01554 0C2.93264 0 2.87047 0.0197916 2.82902 0.0593748L0.0932647 2.43437C-0.0310882 2.55313 -0.0310882 2.67187 0.0932647 2.79063C0.217618 2.90938 0.341969 2.90938 0.466322 2.79063L2.76684 0.801562V9.2625C2.76684 9.42083 2.84974 9.5 3.01554 9.5C3.18135 9.5 3.26425 9.42083 3.26425 9.2625V0.801562L5.56477 2.79063C5.68912 2.90938 5.81347 2.90938 5.93782 2.79063Z\" fill=\"#b8e986\"/>
											</svg>
										</span>
                                        ";
                                    }else{
                                        echo "
                                        <span>
											<svg width=\"6\" height=\"10\" viewBox=\"0 0 6 10\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
											<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M5.93782 6.70937C5.97927 6.74896 6 6.80833 6 6.8875C6 6.96667 5.97927 7.02604 5.93782 7.06563C4.13471 8.62918 3.2228 9.42083 3.20207 9.44063C3.16062 9.48021 3.09845 9.5 3.01554 9.5C2.93264 9.5 2.87047 9.48021 2.82902 9.44063L0.0932647 7.06563C-0.0310882 6.94687 -0.0310882 6.82813 0.0932647 6.70937C0.217618 6.59062 0.341969 6.59062 0.466322 6.70937L2.76684 8.69844V0.2375C2.76684 0.0791659 2.84974 0 3.01554 0C3.18135 0 3.26425 0.0791659 3.26425 0.2375V8.69844L5.56477 6.70937C5.68912 6.59062 5.81347 6.59062 5.93782 6.70937Z\" fill=\"#ff729a\"/>
											</svg>
										</span>
                                        ";
                                    }

                                    ?>
                                </div>
                                <div class="title">
                                    Emotion recognition
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-mobile">
                        <div class="chart-container mobile-container">
                            <canvas id="mobile-chart" style="width: 100%; height: auto;margin: 0;padding: 0;"></canvas>
                        </div>
                    </div>
                    <a data-fancybox data-src="#full-width-mobile-chart" href="javascript:;" id="full-width-chart">
                        <svg width="25px" height="25px" viewBox="0 0 25 25" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <desc>Created with sketchtool.</desc>
                            <defs>
                                <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                    <stop stop-color="#6673B4" offset="0%"></stop>
                                    <stop stop-color="#9EAEFF" offset="100%"></stop>
                                </linearGradient>
                            </defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="ic-btn-expand-m">
                                    <rect id="Rectangle" fill-opacity="0.5" fill="#1E2549" x="3" y="3" width="20" height="20" rx="10"></rect>
                                    <path d="M12.5,25 C19.4035594,25 25,19.4035594 25,12.5 C25,5.59644063 19.4035594,0 12.5,0 C5.59644063,0 0,5.59644063 0,12.5 C0,19.4035594 5.59644063,25 12.5,25 Z M17.5,7.5 L12.5,7.5 L12.5,6.5 L18.5,6.5 L18.5,12.5 L17.5,12.5 L17.5,7.5 Z M7.5,17.5 L12.5,17.5 L12.5,18.5 L6.5,18.5 L6.5,12.5 L7.5,12.5 L7.5,17.5 Z" id="Combined-Shape" fill="url(#linearGradient-1)"></path>
                                </g>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="block-wrapper mini-chart d-none">
                    <div class="chart-mini">
                        <div class="title">
                            Engines usage
                        </div>
                        <canvas id="myChartMini"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <div id="chart-full" class="chart-full">
        <div class="wrapper">
            <div class="row">
                <div class="block-wrapper">
                    <div class="charts">
                        <div class="title-row">
                            <h3 class="title">
                                Engines usage
                            </h3>
                            <div class="right">
                                <div class="tabs">
                                    <a data-time="month" class="active" href="javascript:void(0)">Month</a>
                                    <a data-time="year" class="" href="javascript:void(0)">Year</a>
                                    <a data-time="ever" class="" href="javascript:void(0)">Ever</a>
                                </div>
                                <div class="icon-btn">
                                    <a href="javascript:void(0)" class="icon" data-fill="false">
                                        <svg width="30px" height="30px" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5 25L9.21113 5L16.0965 15L21.5459 11.2764L25 25H5Z" fill="#6673B4"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5 25L10.1095 14L16.0199 19L21.0371 18.4322L25 25H5Z" fill="#9EAEFF"/>
                                        </svg>
                                        <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <g id="ic-plot-line" transform="translate(-5.000000, -5.000000)">
                                                    <g id="Group" transform="translate(5.000000, 5.000000)">
                                                        <path d="M0.976291303,19.5 L19.3215418,19.5 L16.4145969,10.1220233 L11.3004224,17.4207218 L5.26629598,13.5434818 L0.976291303,19.5 Z" id="Path-2" stroke="#6673B4"></path>
                                                        <path d="M0.648778402,19.5 L19.0833129,19.5 L15.8651458,14.5025821 L10.736998,12.6185306 L5.40488815,1.44605567 L0.648778402,19.5 Z" id="Path" stroke="#9EAEFF"></path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="result"></div>
                        <div class="canvas-container">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="add-user">

    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="/img/close.svg" alt="">
    </a>
    <div class="title">
        Add user
    </div>
    <div class="text">
        You control your teammates access and their expenses will be charged from your account.
    </div>
<?php
myAjaxWidget::begin([
    "formSelector" =>".add-user-form",
    "submitSelector" => ".add-user",
    "link"=>"/user/ajax-add-user",
    "successMethod" => "ajaxSuccess()",
    "afterMethod" => "setWarnings('.add-user-form')"
]);
?>

    <form class="add-user-form">
        <div class="inp-wr">
           <span>Teammate email</span>
            <input type="mail" name="AddUserByEmail[email]" placeholder="Enter e-mail for new user">
        </div>
        <div class="text">
            Choose engines your teammate will be granted access to:
        </div>
        <div class="checkboxes">
            <label class="fd">
					<span class="icon">
						<img src="/img/icon-fd.svg" alt="">
					</span>
                <span class="name">
						Face <br />detector
					</span>
                <input class="hidden" name="AddUserByEmail[fd]" type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="er">
					<span class="icon">
						<img src="/img/icon-er.svg" alt="">
					</span>
                <span class="name">
						Emotion <br />recognition
					</span>
                <input class="hidden" name="AddUserByEmail[er]" type="checkbox">
                <input class="hidden" name="AddUserByEmail[parent]" value="<?=Yii::$app->user->getId()?>">
                <span class="checkmark"></span>
            </label>
        </div>
<!--        <div class="inp-wr" style="border: none; margin-bottom: 0">-->
<!--            <input type="mail" name="AddUserByEmail[Er]"  disabled>-->
<!--        </div>-->
        <button disabled="true" class="add-user inactive">
            add user
        </button>
    </form>
    <?php myAjaxWidget::end();?>
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

<div id="add-key">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="/img/close.svg" alt="">
    </a>
    <div class="title">
        Add key
    </div>
    <?
        myAjaxWidget::begin([
            "formSelector" =>".add-key-form",
            "submitSelector" => ".create",
            "link"=>"/user/add-key",
            "afterMethod" => "setWarnings('.add-key-form')",
            "successMethod" => "ajaxSuccess()",


        ]);

        $form = ActiveForm::begin([

                "options" => [
                        "class"=>"add-key-form",
                    "action"=>"/user/users",
                ]
        ])
    ?>
<!--    <form class="add-key-form">-->
        <div class="inp-wr">
            <input type="text" name="Keys[name_key]" placeholder="Name in dashboard">
        </div>
        <div class="text">
            Choose engines the key will use:
        </div>
        <div class="checkboxes">
            <label class="fd">
					<span class="icon">
						<img src="/img/icon-fd.svg" alt="">
					</span>
                <span class="name">
						Face <br />
						detector
					</span>
                <input class="hidden" name="Keys[Fd]" value="1" type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="er">
					<span class="icon">
						<img src="/img/icon-er.svg" alt="">
					</span>
                <span class="name">
						Emotion <br />
						recognition
					</span>
                <input class="hidden" name="Keys[Er]" value="1" type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>
        <button class="create inactive" disabled="true">
            create
        </button>
<!--    </form>-->
    <?php
        ActiveForm::end();
        myAjaxWidget::end();
    ?>
</div>


<div id="full-width-mobile-chart">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="/img/close.svg" alt="">
    </a>
    <div class="title">
        Engine usage
    </div>
    <ul class="tabs-chart">
        <li><a href="#">Month</a></li>
        <li class="active"><a href="#">Year</a></li>
        <li><a href="#">Ever</a></li>
        <li class="graph">
            <a href="#">
                <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <desc>Created with sketchtool.</desc>
                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="ic-plot-line" transform="translate(-5.000000, -5.000000)">
                            <g id="Group" transform="translate(5.000000, 5.000000)">
                                <path d="M0.976291303,19.5 L19.3215418,19.5 L16.4145969,10.1220233 L11.3004224,17.4207218 L5.26629598,13.5434818 L0.976291303,19.5 Z" id="Path-2" stroke="#6673B4"></path>
                                <path d="M0.648778402,19.5 L19.0833129,19.5 L15.8651458,14.5025821 L10.736998,12.6185306 L5.40488815,1.44605567 L0.648778402,19.5 Z" id="Path" stroke="#9EAEFF"></path>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
        </li>
    </ul>
    <div class="graph-mobile">
        <canvas id="graph-mobile"></canvas>
    </div>
    <div class="info">
        <div class="block date">
            <div class="date">
					<span class="month">
						Nov
					</span>
                <span class="year">
						2019
					</span>
            </div>
            <div class="show">
                Daily
            </div>
        </div>
        <div class="block times">
            <div class="val">
                23154
            </div>
            <div class="desc">
                times total
            </div>
        </div>
        <div class="block fd">
            <div class="val">
                12839
                <span class="percent green">
						+15%
						<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M5.93782 6.70937C5.97927 6.74896 6 6.80833 6 6.8875C6 6.96667 5.97927 7.02604 5.93782 7.06563C4.13471 8.62918 3.2228 9.42083 3.20207 9.44063C3.16062 9.48021 3.09845 9.5 3.01554 9.5C2.93264 9.5 2.87047 9.48021 2.82902 9.44063L0.0932647 7.06563C-0.0310882 6.94687 -0.0310882 6.82813 0.0932647 6.70937C0.217618 6.59062 0.341969 6.59062 0.466322 6.70937L2.76684 8.69844V0.2375C2.76684 0.0791659 2.84974 0 3.01554 0C3.18135 0 3.26425 0.0791659 3.26425 0.2375V8.69844L5.56477 6.70937C5.68912 6.59062 5.81347 6.59062 5.93782 6.70937Z" fill="#D0D8FF"/>
						</svg>
					</span>
            </div>
            <div class="desc">
                Face detector
            </div>
        </div>
        <div class="block er">
            <div class="val">
                10315
                <span class="percent red">
						-4%
						<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M5.93782 6.70937C5.97927 6.74896 6 6.80833 6 6.8875C6 6.96667 5.97927 7.02604 5.93782 7.06563C4.13471 8.62918 3.2228 9.42083 3.20207 9.44063C3.16062 9.48021 3.09845 9.5 3.01554 9.5C2.93264 9.5 2.87047 9.48021 2.82902 9.44063L0.0932647 7.06563C-0.0310882 6.94687 -0.0310882 6.82813 0.0932647 6.70937C0.217618 6.59062 0.341969 6.59062 0.466322 6.70937L2.76684 8.69844V0.2375C2.76684 0.0791659 2.84974 0 3.01554 0C3.18135 0 3.26425 0.0791659 3.26425 0.2375V8.69844L5.56477 6.70937C5.68912 6.59062 5.81347 6.59062 5.93782 6.70937Z" fill="#D0D8FF"/>
						</svg>

					</span>
            </div>
            <div class="desc">
                Em. recognition
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
