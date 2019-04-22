<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 15:54
 */
use app\assets\UserAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

UserAsset::register($this);
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

<section id="<?=$this->params['pageID']?>" class="<?=$this->params['pageID']?>">
    <div class="wrapper">
        <div class="row">
            <div class="<?=$this->params['pageID']?>-info">
                <div class="dashboard_left-bar">
                    <div class="logo">
                        <img src="/img/LOGO@4x.svg" alt="Logo">
                    </div>
                    <nav class="nav">
                        <ul class="list">
                            <li class="list_item <?=$this->params['pageID']=="dashboard"?"active":""?>"><a href="/user/">Summary</a></li>
                            <li class="list_item <?=$this->params['pageID']=="users"?"active":""?>">
                                <a href="/user/users">Users</a>
                                <a data-fancybox data-src="#add-user" href="javascript:;" class="add">
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
                            <li class="list_item <?=$this->params['pageID']=="keys"?"active":""?>"><a href="/user/keys">Keys</a>
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
                            <li class="list_item <?=$this->params['pageID']=="payments"?"active":""?>"><a href="/user/payments">Payments</a></li>
                            <li class="list_item <?=$this->params['pageID']=="settings"?"active":""?>"><a href="/user/settings">Settings</a></li>
                        </ul>

                        <div class="nav_more">
                            <a href="#"></a>
                        </div>
                    </nav>
                </div>
                <div class="main-info">
                    <?=$content?>
                </div>
            </div>
            <div id="right-bar" class="right-bar">
                <div class="block-wrapper">
                    <div class="payment-period">
                        <div class="period">
                            Mar 15 - Apr 15
                        </div>
                        <div class="period_after">
                            current payment period
                        </div>
                        <canvas id="bar-chart-horizontal"  height="4"></canvas>
                        <a href="#" class="menu">
                            <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H22V2H0V0ZM8 16H22V18H8V16ZM22 8H12V10H22V8Z" fill="#D0D8FF"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="block-wrapper">
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
</section>

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
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
