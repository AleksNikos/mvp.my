<?php

/* @var $this \yii\web\View */
/* @var $content string */
use app\assets\DocsAsset;
use app\assets\MainAsset;
use app\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

MainAsset::register($this);
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
<div class="topbar-wrap docs">
    <div class="wrapper">
        <div class="row">
            <div class="topbar">
                <div class="logo">
                    <img src="img/LOGO@4x.svg" alt="logo">
                </div>
                <nav>
                    <ul>
                        <li class="docs active">
                            <a class="docs-btn" href="/docs">
                                <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="ic-text" fill="#D0D8FF">
                                            <path d="M0,0 L20,0 L20,2 L0,2 L0,0 Z M4,12 L20,12 L20,14 L4,14 L4,12 Z M12,18 L20,18 L20,20 L12,20 L12,18 Z M8,6 L20,6 L20,8 L8,8 L8,6 Z" id="Combined-Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                DOCS
                            </a>
                        </li>
                        <li  class="login-btn">
                            <a data-fancybox data-src="#login" href="javascript:;">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M18 0h2v20h-8v-2h6V2H8V0h10zM0 9h12V7l3 2.924L12 13v-2H0V9z" fill="#D0D8FF" fill-rule="evenodd"/></svg>
                                Login
                            </a>
                        </li>
                        <li class="sign_up-btn"><a data-fancybox data-src="#login" href="javascript:;">Sign up</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="topbar-wrap docs">
    <div class="wrapper">
        <div class="row">
            <div class="topbar">
                <div class="logo">
                    <img src="img/LOGO@4x.svg" alt="logo">
                </div>
                <nav>
                    <ul>
                        <li class="docs active">
                            <a class="docs-btn" href="/docs">
                                <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="ic-text" fill="#D0D8FF">
                                            <path d="M0,0 L20,0 L20,2 L0,2 L0,0 Z M4,12 L20,12 L20,14 L4,14 L4,12 Z M12,18 L20,18 L20,20 L12,20 L12,18 Z M8,6 L20,6 L20,8 L8,8 L8,6 Z" id="Combined-Shape"></path>
                                        </g>
                                    </g>
                                </svg>
                                DOCS
                            </a>
                        </li>
                        <li  class="login-btn">
                            <a data-fancybox data-src="#login" href="javascript:;">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"><path d="M18 0h2v20h-8v-2h6V2H8V0h10zM0 9h12V7l3 2.924L12 13v-2H0V9z" fill="#D0D8FF" fill-rule="evenodd"/></svg>
                                Login
                            </a>
                        </li>
                        <li class="sign_up-btn"><a data-fancybox data-src="#login" href="javascript:;">Sign up</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Menu -->
<div class="topnav">
    <div id="menu">
        <a class="active" href="/">Home</a>
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
<!-- End menu -->
<section id="docs" class="docs">
    <div class="wrapper">
        <div class="row">
            <nav class="vertical-nav">
                <div class="title">
                    Documentation
                </div>
                <ul>
                    <li class="api_client"><a href="#api_client"><span>API client</span></a></li>
                    <li><a href="#installation">Installation</a></li>
                    <li><a href="#usage">Usage</a></li>
                    <li><a href="#classes">Classes</a></li>
                    <li class="fd"><a href="#fd"><span>Face detector module</span></a></li>
                    <li class="er"><a href="#er"><span>Emotion recognition module</span></a></li>
                </ul>
            </nav>
            <?=$content?>
        </div>
    </div>
</section>
<footer id="footer" class="footer">
    <div class="wrapper">
        <div class="row">
            <div class="logo">
                <img src="img/logo-full.svg" alt="logo">
                <span>© 11111100011</span>
            </div>
            <div class="links">
                <div class="company_name">
                    Neurodata Lab © 11111100011
                </div>
                <a href="#">support@neurodatalab.dev</a>
                <a href="#">f.a.q.</a>
                <a href="#">terms</a>
            </div>
        </div>
    </div>
</footer>
<!-- login -->



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
