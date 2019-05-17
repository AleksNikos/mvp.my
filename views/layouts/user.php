<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 15:54
 */
use app\assets\UserAsset;
use app\models\AddUserByEmail;
use app\widgets\myAjaxWidget;
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
   // console.log($(this));
   if(reg.test($(this).val()) == false) {
      console.log('Введите корректный e-mail');
      return false;
   }else{
       $('.add-user-form button').prop("disabled",false);
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
<div class="topnav">
    <div id="menu">
        <a href="/">Home</a>
        <a href="/docs">Docs</a>
        <?php
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        if($role['ROLE_UNIT']){
            echo "<a href='/user/'>Dashboard</a>";
        }else if($role['ROLE_AGENT']){
            echo "<a href='/agent/'>Dashboard</a>";
        }else{
            echo "<a href=\"/login\">Dashboard</a>";
        }
        ?>
    </div>
</div>

<div id="<?=$this->params['pageID']?>" class="<?=$this->params['pageID']?>">
    <div class="wrapper">
        <div class="row">
            <div class="block-wrapper svg">
                <div class="payment-period">
                    <div class="period">
                        Mar 15 - Apr 15
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
                            </defs>
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="ic-menu-m" transform="translate(-25.000000, -15.000000)">
                                    <g id="Group-3" transform="translate(25.000000, 15.000000)">
                                        <rect id="Rectangle" fill="#D0D8FF" x="0" y="13" width="15" height="2"></rect>
                                        <rect id="Rectangle" fill="url(#linearGradient-1)" x="0" y="6.5" width="15" height="2"></rect>
                                        <rect id="Rectangle" fill="#D0D8FF" x="0" y="0" width="15" height="2"></rect>
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
                                    <svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="tab-menu-m" transform="translate(-31.000000, -15.000000)" fill="url(#linearGradient-1)">
                                                <path d="M31,18.75 L31,15 L34.75,15 L34.75,18.75 L31,18.75 Z M36.625,30 L36.625,26.25 L40.375,26.25 L40.375,30 L36.625,30 Z M31,30 L31,26.25 L34.75,26.25 L34.75,30 L31,30 Z M31,24.375 L31,20.625 L34.75,20.625 L34.75,24.375 L31,24.375 Z M36.625,24.375 L36.625,20.625 L40.375,20.625 L40.375,24.375 L36.625,24.375 Z M42.25,15 L46,15 L46,18.75 L42.25,18.75 L42.25,15 Z M36.625,18.75 L36.625,15 L40.375,15 L40.375,18.75 L36.625,18.75 Z M42.25,24.375 L42.25,20.625 L46,20.625 L46,24.375 L42.25,24.375 Z M42.25,30 L42.25,26.25 L46,26.25 L46,30 L42.25,30 Z" id="ion-android-apps---Ionicons"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li class=" <?=$this->params['pageID']=="users"?"active":""?>">
                                <a href="/<?=$controllerID?>/users">
                                    <svg width="18px" height="15px" viewBox="0 0 18 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="tab-menu-m" transform="translate(-105.000000, -15.000000)" fill="url(#linearGradient-1)">
                                                <path d="M120.351562,25.1953125 C121.679694,25.6901066 122.369791,26.1197898 122.421875,26.484375 L122.5,30 L118.671875,30 C118.671875,28.1510324 118.658854,27.1484383 118.632812,26.9921875 C118.606771,26.7838531 118.574219,26.614584 118.535156,26.484375 C118.496094,26.354166 118.307293,26.1458348 117.96875,25.859375 C117.630207,25.5729152 117.13542,25.2994805 116.484375,25.0390625 C116.40625,25.0130207 116.282553,24.9674482 116.113281,24.9023438 C115.94401,24.8372393 115.820313,24.7916668 115.742188,24.765625 C115.846355,24.7135414 115.9375,24.6614586 116.015625,24.609375 C116.09375,24.5572914 116.158854,24.5117189 116.210938,24.4726562 C116.263021,24.4335936 116.295573,24.3750004 116.308594,24.296875 C116.321615,24.2187496 116.328125,24.1601564 116.328125,24.1210938 L116.328125,23.671875 C116.328125,23.4374988 116.250001,23.1966158 116.09375,22.9492188 C115.937499,22.7018217 115.820313,22.3307316 115.742188,21.8359375 C115.716146,21.6796867 115.670573,21.536459 115.605469,21.40625 C115.540364,21.276041 115.46875,21.0546891 115.390625,20.7421875 C115.338541,20.6119785 115.332031,20.4687508 115.371094,20.3125 C115.410156,20.1562492 115.429688,20.0651043 115.429688,20.0390625 C115.429688,19.9609371 115.416667,19.8307301 115.390625,19.6484375 C115.364583,19.4661449 115.351562,19.3098965 115.351562,19.1796875 C115.325521,18.7630188 115.49479,18.3203148 115.859375,17.8515625 C116.22396,17.3828102 116.796871,17.1484375 117.578125,17.1484375 C118.359379,17.1484375 118.9388,17.3893205 119.316406,17.8710938 C119.694012,18.352867 119.869792,18.7890605 119.84375,19.1796875 C119.84375,19.3098965 119.830729,19.4661449 119.804688,19.6484375 C119.778646,19.8307301 119.765625,19.9609371 119.765625,20.0390625 C119.765625,20.0911461 119.785156,20.1757807 119.824219,20.2929688 C119.863281,20.4101568 119.856771,20.5598949 119.804688,20.7421875 C119.726562,21.0546891 119.654948,21.276041 119.589844,21.40625 C119.524739,21.536459 119.479167,21.6796867 119.453125,21.8359375 C119.375,22.3307316 119.251303,22.708332 119.082031,22.96875 C118.91276,23.229168 118.828125,23.4635406 118.828125,23.671875 C118.828125,24.2187527 118.893229,24.5442703 119.023438,24.6484375 C119.075521,24.6744793 119.518225,24.8567691 120.351562,25.1953125 Z M117.695312,30 L105,30 C105,28.3072832 105.026041,27.3046891 105.078125,26.9921875 C105.182292,26.5234352 106.080721,25.9635449 107.773438,25.3125 C108.815109,24.921873 109.401041,24.6549486 109.53125,24.5117188 C109.661459,24.3684889 109.726562,23.9192746 109.726562,23.1640625 C109.726562,22.9036445 109.622397,22.6497408 109.414062,22.4023438 C109.205728,22.1549467 109.04948,21.7057324 108.945312,21.0546875 C108.919271,20.8463531 108.860678,20.6640633 108.769531,20.5078125 C108.678385,20.3515617 108.59375,20.0651062 108.515625,19.6484375 C108.463541,19.4401031 108.457031,19.2513029 108.496094,19.0820312 C108.535156,18.9127596 108.554688,18.8020836 108.554688,18.75 C108.502604,18.3854148 108.463542,18.0078145 108.4375,17.6171875 C108.385416,17.0963516 108.600258,16.529951 109.082031,15.9179688 C109.563804,15.3059865 110.312495,15 111.328125,15 C112.343755,15 113.098956,15.3124969 113.59375,15.9375 C114.088544,16.5625031 114.309896,17.1223934 114.257812,17.6171875 C114.231771,18.0078145 114.192709,18.3854148 114.140625,18.75 C114.140625,18.8020836 114.166666,18.9062492 114.21875,19.0625 C114.270834,19.2187508 114.270834,19.4140613 114.21875,19.6484375 C114.140625,20.0651062 114.04948,20.3515617 113.945312,20.5078125 C113.841145,20.6640633 113.776042,20.8463531 113.75,21.0546875 C113.645833,21.7057324 113.489584,22.1549467 113.28125,22.4023438 C113.072916,22.6497408 112.96875,22.9036445 112.96875,23.1640625 L112.96875,23.9453125 C112.96875,24.0494797 113.007812,24.1927074 113.085938,24.375 C113.164063,24.5572926 113.281249,24.6809893 113.4375,24.7460938 C113.593751,24.8111982 113.841144,24.9088535 114.179688,25.0390625 C114.257813,25.0651043 114.505206,25.1562492 114.921875,25.3125 C116.614592,25.9635449 117.51302,26.5234352 117.617188,26.9921875 C117.669271,27.3046891 117.695312,27.9166621 117.695312,28.828125 L117.695312,30 Z" id="ion-person-stalker---Ionicons"></path>
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
                                    <svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <desc>Created with sketchtool.</desc>
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="tab-menu-m" transform="translate(-181.000000, -15.000000)" fill="url(#linearGradient-1)">
                                                <path d="M185.821429,24.0066964 C186.892862,24.6540211 187.428571,25.5803511 187.428571,26.7857143 C187.428571,27.6785759 187.116075,28.4374969 186.491071,29.0625 C185.866068,29.6875031 185.107147,30 184.214286,30 C183.321424,30 182.562503,29.6875031 181.9375,29.0625 C181.312497,28.4374969 181,27.6785759 181,26.7857143 C181,25.535708 181.535709,24.5982174 182.607143,23.9732143 C182.763394,23.6160696 182.897321,23.1584849 183.008929,22.6004464 C183.008929,22.5558033 183.070312,22.49442 183.19308,22.4162946 C183.315849,22.3381693 183.377232,22.2656253 183.377232,22.1986607 L183.377232,21.5290179 C183.377232,21.4620532 183.33817,21.3895093 183.260045,21.3113839 C183.181919,21.2332585 183.142857,21.1830358 183.142857,21.1607143 L183.142857,20.625 C183.142857,20.5357138 183.154018,20.4687502 183.176339,20.4241071 L183.209821,20.390625 L183.209821,20.3571429 L183.276786,20.3236607 L183.410714,20.1897321 L183.410714,20.15625 C183.477679,20.0892854 183.511161,20.0223218 183.511161,19.9553571 L183.544643,19.8214286 L183.544643,19.6540179 C183.544643,19.5647317 183.5,19.4754469 183.410714,19.3861607 L183.209821,19.1852679 C183.142857,19.1183032 183.109375,19.0290184 183.109375,18.9174107 L183.109375,18.6830357 C183.109375,18.571428 183.154017,18.4709826 183.243304,18.3816964 L183.410714,18.2142857 C183.5,18.1249996 183.544643,18.0580359 183.544643,18.0133929 L183.544643,17.2098214 C183.544643,17.1205353 183.5,17.0312504 183.410714,16.9419643 L183.410714,16.9084821 L183.243304,16.7410714 C183.176339,16.6741068 183.142857,16.584822 183.142857,16.4732143 L183.142857,15.8705357 C183.142857,15.4464265 183.243303,15.1897326 183.444196,15.1004464 C183.64509,15.0334818 183.901784,15 184.214286,15 C184.57143,15 184.833705,15.0892848 185.001116,15.2678571 C185.168528,15.4464295 185.263393,15.7589263 185.285714,16.2053571 C185.441965,18.0134019 185.54241,19.6093681 185.587054,20.9933036 L185.821429,24.0066964 Z M183.444196,28.6272321 C183.64509,28.828126 183.901784,28.9285714 184.214286,28.9285714 C184.526787,28.9285714 184.783481,28.828126 184.984375,28.6272321 C185.185269,28.4263383 185.285714,28.1696444 185.285714,27.8571429 C185.285714,27.5446413 185.185269,27.2879474 184.984375,27.0870536 C184.783481,26.8861597 184.526787,26.7857143 184.214286,26.7857143 C183.901784,26.7857143 183.64509,26.8861597 183.444196,27.0870536 C183.243303,27.2879474 183.142857,27.5446413 183.142857,27.8571429 C183.142857,28.1696444 183.243303,28.4263383 183.444196,28.6272321 Z M191.177143,20.9933036 C190.105709,20.3459789 189.57,19.4196489 189.57,18.2142857 C189.57,17.3214241 189.882497,16.5625031 190.5075,15.9375 C191.132503,15.3124969 191.891424,15 192.784286,15 C193.677147,15 194.436068,15.3124969 195.061071,15.9375 C195.686075,16.5625031 195.998571,17.3214241 195.998571,18.2142857 C195.998571,19.464292 195.462863,20.4017826 194.391429,21.0267857 C194.235178,21.3839304 194.101251,21.8415151 193.989643,22.3995536 C193.989643,22.4441967 193.92826,22.50558 193.805491,22.5837054 C193.682723,22.6618307 193.621339,22.7343747 193.621339,22.8013393 L193.621339,23.4709821 C193.621339,23.5379468 193.660401,23.6104907 193.738527,23.6886161 C193.816652,23.7667415 193.855714,23.8169642 193.855714,23.8392857 L193.855714,24.375 C193.855714,24.4642862 193.844554,24.5312498 193.822232,24.5758929 L193.78875,24.609375 L193.78875,24.6428571 L193.721786,24.6763393 L193.587857,24.8102679 L193.587857,24.84375 C193.520893,24.9107146 193.487411,24.9776782 193.487411,25.0446429 L193.453929,25.1785714 L193.453929,25.3459821 C193.453929,25.4352683 193.498571,25.5245531 193.587857,25.6138393 L193.78875,25.8147321 C193.855715,25.8816968 193.889196,25.9709816 193.889196,26.0825893 L193.889196,26.3169643 C193.889196,26.428572 193.844554,26.5290174 193.755268,26.6183036 L193.587857,26.7857143 C193.498571,26.8750004 193.453929,26.9419641 193.453929,26.9866071 L193.453929,27.7901786 C193.453929,27.8794647 193.498571,27.9687496 193.587857,28.0580357 L193.587857,28.0915179 L193.755268,28.2589286 C193.822232,28.3258932 193.855714,28.415178 193.855714,28.5267857 L193.855714,29.1294643 C193.855714,29.5535735 193.755269,29.8102674 193.554375,29.8995536 C193.353481,29.9665182 193.096787,30 192.784286,30 C192.427141,30 192.164867,29.9107152 191.997455,29.7321429 C191.830044,29.5535705 191.735179,29.2410737 191.712857,28.7946429 C191.556606,26.9865981 191.456161,25.3906319 191.411518,24.0066964 L191.177143,20.9933036 Z M193.554375,16.3727679 C193.353481,16.171874 193.096787,16.0714286 192.784286,16.0714286 C192.471784,16.0714286 192.21509,16.171874 192.014196,16.3727679 C191.813303,16.5736617 191.712857,16.8303556 191.712857,17.1428571 C191.712857,17.4553587 191.813303,17.7120526 192.014196,17.9129464 C192.21509,18.1138403 192.471784,18.2142857 192.784286,18.2142857 C193.096787,18.2142857 193.353481,18.1138403 193.554375,17.9129464 C193.755269,17.7120526 193.855714,17.4553587 193.855714,17.1428571 C193.855714,16.8303556 193.755269,16.5736617 193.554375,16.3727679 Z" id="Combined-Shape"></path>
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
                                            <svg width="20px" height="15px" viewBox="0 0 27 20" version="1.1"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <desc>Created with sketchtool.</desc>
                                                <defs>
                                                    <linearGradient x1="0%" y1="100%" x2="100%" y2="0%"
                                                                    id="linearGradient-1">
                                                        <stop stop-color="#6673B4" offset="0%"></stop>
                                                        <stop stop-color="#9EAEFF" offset="100%"></stop>
                                                    </linearGradient>
                                                </defs>
                                                <g id="Symbols" stroke="none" stroke-width="1" fill="none"
                                                   fill-rule="evenodd">
                                                    <g id="ic-card" fill="url(#linearGradient-1)">
                                                        <path d="M25.3125,0 C25.7946453,0 26.196427,0.166665 26.5178571,0.5 C26.8392873,0.833335 27,1.2499975 27,1.75 L27,18.25 C27,18.7500025 26.8392873,19.166665 26.5178571,19.5 C26.196427,19.833335 25.7946453,20 25.3125,20 L1.6875,20 C1.20535473,20 0.803573036,19.833335 0.482142857,19.5 C0.160712679,19.166665 0,18.7500025 0,18.25 L0,1.75 C0,1.2499975 0.160712679,0.833335 0.482142857,0.5 C0.803573036,0.166665 1.20535473,0 1.6875,0 L25.3125,0 Z M2.23889803,1.42857143 C1.77754704,1.42857143 1.50493463,1.78571071 1.42105263,2.5 L1.42105263,4.28571429 L25.5789474,4.28571429 L25.5789474,2.5 C25.4950654,1.78571071 25.222453,1.42857143 24.761102,1.42857143 L2.23889803,1.42857143 Z M24.761102,18.5714286 C25.222453,18.5714286 25.4950654,18.2589317 25.5789474,17.6339286 L25.5789474,8.57142857 L1.42105263,8.57142857 L1.42105263,17.6339286 C1.50493463,18.2589317 1.77754704,18.5714286 2.23889803,18.5714286 L24.761102,18.5714286 Z"
                                                              id="card"></path>
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
                                    <svg width="15px" height="15px" viewBox="0 0 15 15" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <desc>Created with sketchtool.</desc>
                                        <defs>
                                            <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                                <stop stop-color="#6673B4" offset="0%"></stop>
                                                <stop stop-color="#9EAEFF" offset="100%"></stop>
                                            </linearGradient>
                                        </defs>
                                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="tab-menu-m" transform="translate(-331.000000, -15.000000)" fill="url(#linearGradient-1)">
                                                <path d="M346,20.3125 C345.036454,20.8854195 344.554688,21.6145789 344.554688,22.5 C344.554688,23.3854211 345.036454,24.1145805 346,24.6875 C345.869791,25.1041687 345.66146,25.5989555 345.375,26.171875 C344.489579,25.9635406 343.682295,26.2239547 342.953125,26.953125 C342.30208,27.6041699 342.093749,28.4114535 342.328125,29.375 C341.755205,29.6614598 341.260419,29.869791 340.84375,30 C340.27083,29.0364535 339.489588,28.5546875 338.5,28.5546875 C337.510412,28.5546875 336.72917,29.0364535 336.15625,30 C335.687498,29.8437492 335.17969,29.635418 334.632812,29.375 C334.867189,28.3854117 334.671878,27.5781281 334.046875,26.953125 C333.421872,26.3281219 332.614588,26.1328113 331.625,26.3671875 C331.364582,25.8203098 331.156251,25.3125023 331,24.84375 C331.963546,24.2708305 332.445312,23.4895883 332.445312,22.5 C332.445312,21.6145789 331.963546,20.8854195 331,20.3125 C331.182293,19.7395805 331.390624,19.2447937 331.625,18.828125 C332.510421,19.0364594 333.317705,18.7760453 334.046875,18.046875 C334.671878,17.4218719 334.867189,16.6145883 334.632812,15.625 C335.17969,15.364582 335.687498,15.1562508 336.15625,15 C336.72917,15.9635465 337.510412,16.4453125 338.5,16.4453125 C339.489588,16.4453125 340.27083,15.9635465 340.84375,15 C341.312502,15.1562508 341.82031,15.364582 342.367188,15.625 C342.132811,16.6145883 342.328122,17.4218719 342.953125,18.046875 C343.682295,18.7760453 344.489579,19.0364594 345.375,18.828125 C345.66146,19.4010445 345.869791,19.8958313 346,20.3125 Z M335.804688,25.1953125 C336.5599,25.9505246 337.458328,26.328125 338.5,26.328125 C339.541672,26.328125 340.4401,25.9505246 341.195312,25.1953125 C341.950525,24.4401004 342.328125,23.5416719 342.328125,22.5 C342.328125,21.4583281 341.950525,20.5598996 341.195312,19.8046875 C340.4401,19.0494754 339.541672,18.671875 338.5,18.671875 C337.458328,18.671875 336.5599,19.0494754 335.804688,19.8046875 C335.049475,20.5598996 334.671875,21.4583281 334.671875,22.5 C334.671875,23.5416719 335.049475,24.4401004 335.804688,25.1953125 Z" id="ion-gear-a---Ionicons"></path>
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
                            Mar 15 - Apr 15
                        </div>
                        <div class="period_after">
                            current payment period
                        </div>
                        <canvas id="bar-chart-horizontal"  height="4"></canvas>
                        <a href="javascript:void(0);" class="menu" id="menuDesctop">
                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H22V2H0V0ZM8 16H22V18H8V16ZM22 8H12V10H22V8Z" fill="#D0D8FF"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="block-wrapper">
                    <div class="round-chart">
                        <div class="chart-container">
                            <div class="val">1847</div>
                            <div class="desc">times used</div>
                            <canvas id="doughnut-chartcanvas-1"></canvas>
                        </div>
                        <div class="review">
                            <div class="fd">
                                <div class="val">
                                    1347
                                </div>
                                <div class="percent green">
                                    +15%
                                    <span>
											<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M5.93782 2.79063C5.97927 2.75104 6 2.69167 6 2.6125C6 2.53333 5.97927 2.47396 5.93782 2.43437C4.13471 0.870825 3.2228 0.0791664 3.20207 0.0593748C3.16062 0.0197916 3.09845 0 3.01554 0C2.93264 0 2.87047 0.0197916 2.82902 0.0593748L0.0932647 2.43437C-0.0310882 2.55313 -0.0310882 2.67187 0.0932647 2.79063C0.217618 2.90938 0.341969 2.90938 0.466322 2.79063L2.76684 0.801562V9.2625C2.76684 9.42083 2.84974 9.5 3.01554 9.5C3.18135 9.5 3.26425 9.42083 3.26425 9.2625V0.801562L5.56477 2.79063C5.68912 2.90938 5.81347 2.90938 5.93782 2.79063Z" fill="#b8e986"/>
											</svg>
										</span>
                                </div>
                                <div class="title">
                                    Face detector
                                </div>
                            </div>
                            <div class="er">
                                <div class="val">
                                    500
                                </div>
                                <div class="percent red">
                                    -4%
                                    <span>
											<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M5.93782 6.70937C5.97927 6.74896 6 6.80833 6 6.8875C6 6.96667 5.97927 7.02604 5.93782 7.06563C4.13471 8.62918 3.2228 9.42083 3.20207 9.44063C3.16062 9.48021 3.09845 9.5 3.01554 9.5C2.93264 9.5 2.87047 9.48021 2.82902 9.44063L0.0932647 7.06563C-0.0310882 6.94687 -0.0310882 6.82813 0.0932647 6.70937C0.217618 6.59062 0.341969 6.59062 0.466322 6.70937L2.76684 8.69844V0.2375C2.76684 0.0791659 2.84974 0 3.01554 0C3.18135 0 3.26425 0.0791659 3.26425 0.2375V8.69844L5.56477 6.70937C5.68912 6.59062 5.81347 6.59062 5.93782 6.70937Z" fill="#ff729a"/>
											</svg>
										</span>
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

<section id="chart-full" class="chart-full">
    <div class="wrapper">
        <div class="row">
            <div class="block-wrapper">
                <div class="charts">
                    <h3 class="title">
                        Engines usage
                    </h3>
                    <div class="tabs">
                        <a class="active" href="#">Month</a>
                        <a class="" href="#">Year</a>
                        <a class="" href="#">Ever</a>
                        <a href="#" class="icon">
                            <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="30" height="30" rx="2" fill="#1E2549" fill-opacity="0.5"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 25L9.21113 5L16.0965 15L21.5459 11.2764L25 25H5Z" fill="#6673B4"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 25L10.1095 14L16.0199 19L21.0371 18.4322L25 25H5Z" fill="#9EAEFF"/>
                            </svg>
                        </a>
                    </div>
                    <div class="canvas-container">
                        <canvas id="myChart"></canvas>
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
            <div class="info">
                Teammate email
            </div>
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
        <div class="inp-wr" style="border: none; margin-bottom: 0">
            <input type="mail" name="AddUserByEmail[Er]"  disabled>
        </div>
        <button disabled="true" class="add-user">
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
    <a class="close-btn" onclick="$.fancybox.close()" href="javascript:$.fancybox.close();">
        <img src="/img/close.svg" alt="">
    </a>

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
        <button class="create">
            create
        </button>
<!--    </form>-->
    <?php
        ActiveForm::end();
        myAjaxWidget::end();
    ?>
</div>
<?php $this->endBody() ?>

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

</body>
</html>
<?php $this->endPage() ?>
