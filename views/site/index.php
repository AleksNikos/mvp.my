<?php

/* @var $this yii\web\View */

use app\assets\ScrollAsset;
use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'My Yii Application';
?>

<div class="topbar-wrap">
    <div class="wrapper">
        <div class="row">
            <div class="topbar">
                <a href="/" class="logo">
                    <img src="img/LOGO@4x.svg" alt="logo">
                </a>
                <nav>
                    <ul>
                        <li class="docs">
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
            echo "<a data-fancybox data-src=\"#login\" href=\"javascript:;\" class=\"login-btn\">
                        Login / Sign up
                    </a>";
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
<!-- End menu -->
<div id="fullpage">
    <section id="home-first" class="home-first">
        <div class="wrapper">
            <div class="row">
                <div class="home-chart">
                    <h1 class="title">
                        API to emotions <br />
                        and behavior<br />
                        in a few lines of code
                    </h1>

                    <div class="demo">
                        <p>Run demo:</p>
                        <a data-fancybox data-src="#demo_fd" href="javascript:;" class="fd">
							<span>Face
							detector</span>
                        </a>
                        <a data-fancybox data-src="#demo_er" href="javascript:;" class="er">
							<span>Emotion
							recognition</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="bottom-row">
                    <a href="http://neurodatalab.com" target='_blank' class="powered">
                        Powered by
                        <img src="img/logo-full.svg" alt="logo">
                    </a>
                    <div class="learn-more">
                        <a href="javascript:;">
                            <span>Learn more</span>
                            <svg width="12px" height="20px" viewBox="0 0 12 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="linearGradient-1">
                                        <stop stop-color="#6673B4" offset="0%"></stop>
                                        <stop stop-color="#9EAEFF" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="ic-arr-d" transform="translate(1.000000, 0.000000)" fill="url(#linearGradient-1)">
                                        <path d="M4.47671785,19.7601199 C4.62068966,19.916042 4.81449786,20 5.00276869,20 C5.19103952,20 5.38484772,19.922039 5.52881953,19.7601199 L10.2798893,14.6146927 C10.5733702,14.2968516 10.5733702,13.7871064 10.2798893,13.4692654 C9.98640826,13.1514243 9.51573119,13.1514243 9.22225019,13.4692654 L5.75031462,17.2353823 L5.75031462,0.809595202 C5.75031462,0.35982009 5.41807199,0 5.00276869,0 C4.58746539,0 4.25522275,0.35982009 4.25522275,0.809595202 L4.25522275,17.2353823 L0.777749811,13.4692654 C0.484268814,13.1514243 0.0135917443,13.1514243 -0.279889252,13.4692654 C-0.573370249,13.7871064 -0.573370249,14.2968516 -0.279889252,14.6146927 L4.47671785,19.7601199 Z" id="Path"></path>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="home-second" class="home-second">
        <div class="overlay"></div>
        <div class="wrapper">
            <div class="row">
                <h2 class="title">
                    Simple access <br />
                    <span>to state of the art technology</span>
                </h2>

                <ul class="steps">
                    <ul class="lines">
                        <li class="first"></li>
                        <li class="second"></li>
                        <li class="third"></li>
                        <li class="forth"></li>
                    </ul>
                    <li>
                        <div class="num">1</div>
                        <a data-fancybox data-src="#login" href="javascript:;" class="title sign_up-btn">Create account</a>
                    </li>
                    <li>
                        <div class="num">2</div>
                        <div class="title">
                            Generate a key
                        </div>
                    </li>
                    <li>
                        <div class="num">3</div>
                        <div class="title">
                            Add key and API request to your service. That long:
                        </div>
                    </li>
                    <li class="code">
                        api_token = <span>'path/my.key'</span> <br />
                        api_req_base = <span>'https://api.neurodatalab.com/'</span>
                    </li>
                </ul>

                <ul class="blocks">
                    <li class="block">
                        <div class="icon">
                            <img src="img/ic-tri-cube.svg" alt="">
                        </div>
                        <div class="title">
                            Multimodal
                        </div>
                        <div class="desc">
                            Analyses facial expressions, voice, body pose and physiology
                        </div>
                    </li>
                    <li class="block">
                        <div class="icon">
                            <img src="img/ic-tri-guitar.svg" alt="">
                        </div>
                        <div class="title">
                            Real-time
                        </div>
                        <div class="desc">
                            All services can handle real-time data flow as fast as pre-recorded data
                        </div>
                    </li>
                    <li class="block">
                        <div class="icon">
                            <img src="img/ic-tri-people.svg" alt="">
                        </div>
                        <div class="title">
                            Multiperson
                        </div>
                        <div class="desc">
                            Get per-person data for up to 7 people present in the frame
                        </div>
                    </li>
                    <li class="block">
                        <div class="icon">
                            <img src="img/ic-tri-gem.svg" alt="">
                        </div>
                        <div class="title">
                            Precise
                        </div>
                        <div class="desc">
                            Works with natural data
                            ‘in the wild’ thanks to the biggest affective data set
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section id="home-third" class="home-third">
        <div class="overlay"></div>
        <div class="wrapper">
            <div class="row">
                <div class="text">
                    <ul class="blocks">
                        <li class="block fd">
                            <img src="img/icon-fd.svg" alt="">
                            <div class="title">
                                Face <br />
                                detector
                            </div>
                            <div class="num">
                                0.01 <span class="dollar">$</span>
                                <span class="description">per image</span>
                                <span class="desc">
									$ / image
								</span>
                            </div>

                        </li>
                        <li class="block er">
                            <img src="img/icon-er.svg" alt="">
                            <div class="title">
                                Emotion <br />recognition
                            </div>
                            <div class="num">
                                0.015 <span class="dollar">$</span>
                                <span class="description">per image</span>
                                <span class="desc">
									$ / image
								</span>
                            </div>
                        </li>
                    </ul>
                    <h3 class="title">
                        Monthly postpayments.<br />
                        Free trial key for 500 images. <br />
                        <span>
							Detailed statistics.<br />
							Manage team from single account.
						</span>
                    </h3>
                    <a data-fancybox data-src="#login" href="javascript:;" class="sign_up-btn d-none">
                        Sign Up now
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="footer">
                    <a href="https://neurodatalab.com" target='_blank' class="logo">
                        <svg width="178px" height="74px" viewBox="0 0 178 74" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="powered" transform="translate(-101.000000, -1.000000)" fill="#D0D8FF">
                                    <path d="M135.777501,39.1486831 C135.251951,39.1288329 134.728172,39.0458297 134.217654,38.8996477 C133.673001,38.7517702 133.158957,38.5082892 132.699492,38.1805584 C132.278409,37.8765362 131.929236,37.4837424 131.676649,37.0299357 C131.61225,36.9043182 131.556044,36.7751478 131.508212,36.643235 C129.909434,35.3328544 129.095929,34.1798409 126.726886,33.3655172 C128.101725,33.591691 129.664856,34.5547485 131.308845,35.6002291 C131.306771,35.5308207 131.30685,35.4612449 131.309103,35.3915992 L131.309103,26.4581843 L132.9712,26.4581843 L132.9712,34.7763084 C132.960046,35.2530337 133.058424,35.7259623 133.258762,36.1586932 C133.436696,36.5312361 133.69612,36.8590019 134.01784,37.1177388 C134.312876,37.3510761 134.648929,37.5272069 135.008686,37.6370569 C135.686234,37.8410088 136.408828,37.8410088 137.086376,37.6370569 C137.450331,37.5277237 137.789568,37.3486983 138.08522,37.1099375 C138.399344,36.85283 138.650739,36.5275104 138.820304,36.1586932 C139.020708,35.7259778 139.119151,35.2530486 139.108057,34.7763084 L139.108057,26.4581843 L140.778188,26.4581843 L140.778188,35.3120025 C140.792973,35.8834191 140.66376,36.4493724 140.402448,36.9577537 C140.148506,37.4242172 139.796906,37.8303972 139.37165,38.1485675 C139.089194,38.3608853 138.783395,38.5388769 138.460745,38.6793485 C138.508492,38.6785169 138.55618,38.6769865 138.603807,38.6747417 C142.507751,38.496864 152.563412,38.5423071 150.197466,27.7523793 L150.902423,27.7523793 C151.614967,27.7022183 152.311701,27.9785563 152.796159,28.5034718 C153.605939,29.4485618 153.605939,30.8428624 152.796159,31.7879523 C152.308079,32.3067558 151.613102,32.5793921 150.902453,32.5308446 L150.510915,32.5308446 L153.1639,39.003434 L154.897786,39.003434 L152.572351,33.7056568 L153.187654,33.3459188 C153.478809,33.1715891 153.749526,32.9652019 153.994743,32.7306158 C154.217271,32.4975537 154.412933,32.2402488 154.578055,31.963534 C154.747653,31.6829452 154.881852,31.382435 154.977592,31.068863 C155.06068,30.7720264 155.106359,30.4659719 155.113565,30.1578099 C155.111653,29.6866955 155.041674,29.2183294 154.905796,28.767231 C154.787188,28.3297794 154.574464,27.923513 154.282495,27.5768345 C153.998645,27.2291629 153.63741,26.9527023 153.227655,26.7695431 C152.708866,26.5448159 152.146538,26.4384547 151.581511,26.4581843 L149.826241,26.4581843 C140.856207,15.2253547 138.280361,17.2625322 136.510853,15.9398451 C134.804508,14.6571157 132.361611,12.6805669 131.895129,12.2876595 C132.785067,12.8708796 140.739826,18.0449652 141.654378,16.8113883 C142.48921,15.6880979 139.137899,10.7163123 138.204934,9.36614552 C139.113342,10.5874403 142.317323,14.9271724 144.07875,17.6828886 C146.14115,20.9116061 149.517012,26.2268518 152.991026,24.5757852 C156.471331,22.9247186 159.834911,21.9488796 157.441026,16.4247417 C155.0473,10.9066128 153.13833,6.38917531 153.212059,4.75039683 C153.224371,4.51092545 152.745576,2.06204441 152.727162,1.84715545 C153.463714,4.24091172 155.23765,10.1825394 156.231921,10.2622589 C157.692847,10.3788428 157.392094,1.34367938 157.434955,0.834482759 C157.477982,1.27624807 157.56999,21.1876595 164.782059,18.9413793 C165.088955,18.8430865 165.377567,18.7387908 165.647605,18.6222069 L165.647605,25.8834161 L165.647642,25.8834161 C161.682275,25.8672511 158.413464,28.9886298 158.246735,32.9505229 C158.080005,36.9124161 161.075006,40.2973968 165.027711,40.6144506 C165.236444,40.6327294 165.445041,40.6387261 165.647642,40.6387261 L165.647642,50.8217808 C158.159366,57.4260412 151.229642,66.3937732 152.782539,74.4650912 C152.671951,74.2316104 149.18565,66.3446084 159.073918,54.989436 C161.682539,52.0001899 159.03709,43.3639307 152.463366,40.4610023 C145.895657,37.5574725 143.77812,39.9392168 140.727568,43.3825102 C137.670891,46.8258097 133.300764,49.7659032 131.925867,49.937931 C135.393743,47.7219231 135.719072,46.4391999 136.836212,45.2238895 C137.916347,44.0514526 141.052897,41.2282192 141.24321,41.0502192 C140.905568,41.1236472 134.000396,42.7318588 130.53252,42.5109731 C129.273517,42.4033594 128.026642,42.1835028 126.806759,41.8540242 C131.336626,42.191813 136.154816,41.7251522 138.266227,40.0680888 C137.322327,39.7606169 136.500246,39.4535678 135.777501,39.1486831 Z M179.820591,56.5373977 C180.269568,56.9897629 180.268195,57.7200258 179.817521,58.1707 C179.366847,58.6213742 178.636584,58.6227469 178.184219,58.1737701 C177.88284,57.8719853 177.776301,57.4266083 177.908491,57.0211096 L168.696187,47.8088301 C168.290545,47.9400561 167.84558,47.8333861 167.543526,47.5325066 C167.094549,47.0801413 167.095922,46.3498785 167.546596,45.8992042 C167.99727,45.44853 168.727533,45.4471574 169.179899,45.8961341 C169.481498,46.1977857 169.588272,46.6431856 169.456222,47.0487946 L178.668514,56.2610864 C179.073934,56.1289431 179.519214,56.2357379 179.820591,56.5373977 Z M167.543502,42.5993839 C167.094525,42.1470186 167.095897,41.4167558 167.546572,40.9660815 C167.997246,40.5154073 168.727509,40.5140347 169.179874,40.9630114 C169.481453,41.2646841 169.588021,41.7101825 169.455602,42.1156719 L175.56714,48.2272099 C175.972726,48.0945582 176.418445,48.2014113 176.719801,48.5035395 C177.168418,48.9557967 177.167013,49.6856292 176.716656,50.1361548 C176.266299,50.5866805 175.536467,50.58836 175.084042,50.1399119 C174.782082,49.8384721 174.67505,49.3929656 174.807117,48.9872514 L168.695579,42.8757135 C168.290172,43.0080588 167.844789,42.9012299 167.543526,42.5993839 L167.543502,42.5993839 Z M167.543502,38.571962 C167.094525,38.1195967 167.095897,37.3893339 167.546572,36.9386597 C167.997246,36.4879855 168.727509,36.4866128 169.179874,36.9355896 C169.481475,37.2372404 169.588249,37.6826412 169.456198,38.0882501 L174.108798,42.7414156 L177.897651,42.7414156 C177.947713,42.6371903 178.014991,42.5421524 178.096655,42.4602983 C178.466976,42.0900926 179.039786,42.0147852 179.493212,42.2766927 C179.946637,42.5386002 180.167608,43.0724109 180.031957,43.5781667 C179.896305,44.0839225 179.437859,44.4355034 178.914228,44.4353495 C178.60735,44.4364851 178.312839,44.3144887 178.096655,44.096683 C178.014964,44.0148518 177.947683,43.919809 177.897651,43.8155658 L173.664639,43.8155658 L168.69615,38.8482794 C168.290521,38.9794948 167.845573,38.8728278 167.543526,38.571962 L167.543502,38.571962 Z M167.543502,34.0788062 C167.094525,33.6264409 167.095897,32.8961781 167.546572,32.4455039 C167.997246,31.9948297 168.727509,31.993457 169.179874,32.4424338 C169.261434,32.5242419 169.32852,32.6192969 169.378276,32.723551 L177.897651,32.723551 C177.947825,32.6190577 178.015312,32.5238037 178.097257,32.44182 C178.554902,32.0050201 179.275121,32.0052905 179.732438,32.4424338 C180.181056,32.894691 180.17965,33.6245235 179.729294,34.0750491 C179.278937,34.5255747 178.549105,34.5272543 178.09668,34.0788062 C178.015014,33.9969533 177.947736,33.9019151 177.897676,33.797689 L169.378313,33.797689 C169.328608,33.9016393 169.261737,33.9964686 169.180512,34.0781924 C168.72811,34.5291209 167.996267,34.5293953 167.543526,34.0788062 L167.543502,34.0788062 Z M167.543502,29.5856504 C167.092156,29.133561 167.092156,28.4013674 167.543502,27.949278 C167.845282,27.6478914 168.290664,27.5413516 168.696162,27.6735499 L173.66405,22.7056619 L177.897663,22.7056619 C177.947837,22.6011686 178.015324,22.5059146 178.097269,22.4239309 C178.554915,21.9871341 179.275132,21.9874045 179.732451,22.4245447 C180.026823,22.7163293 180.142606,23.1432998 180.03597,23.5438272 C179.929334,23.9443546 179.616576,24.2572308 179.216088,24.3640169 C178.815601,24.470803 178.388587,24.3551801 178.096692,24.0609171 C178.015025,23.9790654 177.947747,23.884027 177.897688,23.7797999 L174.108835,23.7797999 L169.456234,28.4335792 C169.588297,28.8390083 169.481508,29.284251 169.179911,29.5856688 C168.727904,30.0372143 167.995545,30.0372143 167.543538,29.5856688 L167.543502,29.5856504 Z M167.543502,25.5576332 C167.092156,25.1055437 167.092156,24.3733502 167.543502,23.9212608 C167.845282,23.6198742 168.290664,23.5133344 168.696162,23.6455326 L174.807123,17.5339947 C174.675057,17.1282804 174.782089,16.6827747 175.084048,16.3813342 C175.536474,15.9328861 176.266305,15.9345657 176.716662,16.3850913 C177.167019,16.835617 177.168424,17.5654495 176.719807,18.0177066 C176.418782,18.3204243 175.972703,18.4273613 175.567146,18.2940301 L169.456185,24.4055681 C169.588248,24.8109972 169.481459,25.2562399 169.179862,25.5576577 C168.727855,26.0092032 167.995496,26.0092032 167.543489,25.5576577 L167.543502,25.5576332 Z M167.543502,20.625112 C167.092156,20.1730226 167.092156,19.440829 167.543502,18.9887396 C167.845625,18.687984 168.290514,18.5813298 168.696162,18.7124099 L177.891703,9.51749462 C177.784445,9.12233046 177.89592,8.69995534 178.184213,8.40918683 C178.636552,7.95844499 179.368246,7.95844499 179.820585,8.40918683 C180.272114,8.86096072 180.272114,9.59317155 179.820585,10.0449454 C179.507523,10.358767 179.039753,10.4602921 178.624763,10.3044879 L169.456228,19.472427 C169.588278,19.8780359 169.481504,20.3234359 169.179905,20.6250874 C168.727895,21.0766262 167.995542,21.0766262 167.543532,20.6250874 L167.543502,20.625112 Z M109.46228,26.4581843 L111.124419,26.4581597 L111.124419,39.003434 L109.430289,39.003434 L106.745502,35.0560508 L104.004726,30.8768992 L102.670131,30.8768992 L102.670131,39.003434 L101,39.003434 L101,26.4581597 L102.718124,26.4581597 L104.835593,29.5265114 L107.936114,34.2331752 L108.231674,34.5925203 L109.46228,34.5925203 L109.46228,26.4581843 Z M117.221275,32.0197206 L124.532932,32.0197206 L124.532932,33.3221159 L117.221275,33.3221159 L117.221275,32.0197206 Z M117.221275,37.7092267 L125.499779,37.7092267 L125.499779,39.003434 L117.221275,39.003434 L117.221275,37.7092267 Z M117.221275,26.4581843 L125.499779,26.4581843 L125.499779,27.7523793 L117.221275,27.7523793 L117.221275,26.4581843 Z M185.366476,28.4878692 C185.592847,29.0145483 185.69933,29.5849565 185.678221,30.1578345 L185.678221,35.287819 C185.700637,35.863362 185.576875,36.4352026 185.318483,36.9499708 C185.097704,37.387873 184.784146,37.7724012 184.399635,38.0767906 C183.973748,38.3915067 183.494634,38.6269013 182.985259,38.7716903 C182.454085,38.9313955 181.901744,39.0095398 181.347113,39.0034524 L176.784421,39.0034524 L176.784421,37.7092451 L180.955574,37.7092451 C181.307853,37.7075088 181.657932,37.6536016 181.994413,37.5492783 C182.353164,37.4407201 182.68899,37.2673524 182.985259,37.0377616 C183.296312,36.7747278 183.547031,36.4477534 183.720344,36.0791027 C183.92964,35.6405227 184.031042,35.1582583 184.016094,34.6725283 L184.016094,30.7731007 C184.033721,30.2922754 183.932119,29.8145576 183.720344,29.3825217 C183.552737,29.0148783 183.297602,28.6939016 182.977256,28.4476657 C182.691323,28.2015293 182.356291,28.0190491 181.994413,27.9123461 C181.657932,27.8080229 181.307853,27.7541156 180.955574,27.7523793 L176.784421,27.7523793 L176.784421,26.4581843 L181.347101,26.4581843 C181.957092,26.4480996 182.565343,26.5261593 183.153021,26.6899464 C183.644099,26.8339464 184.104585,27.0668356 184.511603,27.3770448 C184.878868,27.6759961 185.171541,28.0562963 185.366476,28.4878692 Z M197.44857,26.4581843 L201.803493,39.003434 L200.02957,39.003434 L196.929055,28.679434 L195.658651,28.679434 L192.574132,39.003434 L190.79221,39.003434 L195.21912,26.4581843 L197.44857,26.4581843 Z M223.466517,26.4581843 L227.813442,39.003434 L226.047517,39.003434 L222.947002,28.679434 L221.6686,28.679434 L218.592079,39.003434 L216.80216,39.003434 L221.229069,26.4581843 L223.466517,26.4581843 Z M259.784458,26.4581843 L264.139382,39.003434 L262.365458,39.003434 L259.264944,28.679434 L257.994539,28.679434 L254.91002,39.003434 L253.128099,39.003434 L257.555008,26.4581843 L259.784458,26.4581843 Z M204.935808,26.4581843 L213.765639,26.4581843 L213.765639,27.7925766 L210.193793,27.7925766 L210.193793,39.003434 L208.523662,39.003434 L208.523662,27.7925705 L204.935808,27.7925705 L204.935808,26.4581843 Z M242.244792,37.7092267 L248.956945,37.7092267 L248.956945,39.003434 L240.614644,39.003434 L240.614644,26.4581843 L242.244792,26.4581843 L242.244792,37.7092267 Z M278.842292,34.9280688 C278.90207,35.1387929 278.934335,35.3563654 278.938283,35.5753688 C278.94122,36.0558695 278.865637,36.5336225 278.714519,36.9897507 C278.581284,37.3869713 278.366222,37.7518334 278.08322,38.0607767 C277.803118,38.362113 277.459082,38.5968898 277.076372,38.747869 C276.608554,38.9312832 276.10848,39.0182133 275.606209,39.003434 L269.525158,39.003434 L269.525158,26.4581843 L275.34245,26.4581843 C275.881213,26.4431289 276.417982,26.5298329 276.924606,26.7137493 C277.304444,26.859033 277.648038,27.0853885 277.931448,27.3770448 C278.180794,27.6418831 278.368991,27.9582086 278.482763,28.3037067 C278.605275,28.7052055 278.667213,29.122733 278.666532,29.5425069 C278.665228,29.7316215 278.638388,29.9196935 278.586739,30.1016233 C278.527261,30.3216038 278.441383,30.5335792 278.330978,30.7329279 C278.216558,30.931309 278.076879,31.1140036 277.91544,31.2764356 C277.759297,31.4307724 277.57834,31.557786 277.38012,31.6521752 L275.86976,32.3712645 L277.38012,33.0903538 C277.627399,33.2108816 277.853929,33.3699804 278.051217,33.5616855 C278.244127,33.754729 278.410738,33.97237 278.546738,34.2089794 C278.674269,34.4356987 278.773527,34.6771961 278.842292,34.9280688 Z M271.195283,27.7523793 L271.195283,31.9159221 L274.455378,31.9159221 C275.094861,31.961127 275.728758,31.770554 276.237299,31.3802096 C276.651768,31.0047916 276.884672,30.4691925 276.876601,29.9100339 C276.893765,29.3506497 276.693262,28.8064186 276.317288,28.3918719 C275.817352,27.9211063 275.139067,27.6881423 274.455378,27.7523793 L271.195283,27.7523793 Z M276.373279,37.0857172 C276.802701,36.6536006 277.03659,36.0645795 277.020572,35.4555871 C277.033658,34.8616288 276.832171,34.2828625 276.453066,33.8254386 C275.97901,33.3112731 275.296751,33.0407536 274.599159,33.0903538 L271.195283,33.0903538 L271.195283,37.7092144 L274.599159,37.7092144 C275.250117,37.746999 275.889082,37.5224408 276.373279,37.0857172 Z" id="Combined-Shape"></path>
                                </g>
                            </g>
                        </svg>
                        <span>© 11111100011</span>
                    </a>

                    <div class="links">
                        <a href="https://neurodatalab.com" target='_blank' class="company_name">
                            Neurodata Lab © 11111100011
                        </a>
                        <a href="mailto:support@neurodatalab.dev">support@neurodatalab.dev</a>
                        <a href="faq.html">f.a.q.</a>
                        <a href="terms.html">terms</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- modal windows -->

<!-- login -->
<?=$this->render("_form", ['model'=>$model, 'register'=>$register, 'reset'=>$reset]) ?>
<!-- Demo FD -->
<div id="demo_fd">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="img/close.svg" alt="Close">
    </a>

    <div class="demo_fd">
        <img class="demo-icon" src="img/icon-fd.svg" alt="fd">
        <div class="title-demo">
            Face detector <br />
            DEMO
        </div>
        <p>
            Choose an image to process:
        </p>
        <div class="blocks">
            <div class="block fd_1">
                <img src="img/e1.jpg" alt="">
            </div>
            <div class="block fd_2">
                <img src="img/e2.jpg" alt="">
            </div>
            <div class="block fd_3">
                <img src="img/e3.jpg" alt="">
            </div>
            <div class="block fd_4">
                <img src="img/e4.jpg" alt="">
            </div>
        </div>
        <p>
            Soon Fd will work with videos. <span>
					Be the first to know
				</span>
        </p>
    </div>
    <div class="fd1 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-fd.svg" alt="fd">
        <div class="title-demo">
            Face detector <br />
            DEMO
        </div>
        <img class="full-image" src="img/e1-res-fd.jpg" alt="image">
        <pre class="code">
				<a href="#">See documentation</a>
				<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
				</code>
			</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
				<a class="file" href="files/e1-fd.json" download>
					<img src="img/json.svg" alt="">
				</a>
				<code>
[
  {
    <span class="violet">"h"</span>: <span class="green">278</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
				</code>
			</pre>
    </div>
    <div class="fd2 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-fd.svg" alt="fd">
        <div class="title-demo">
            Face detector <br />
            DEMO
        </div>
        <img class="full-image" src="img/e2-res-fd.jpg" alt="image">
        <pre class="code">
				<a href="#">See documentation</a>
				<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
				</code>
			</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
				<a class="file" href="files/e2-fd.json" download>
					<img src="img/json.svg" alt="">
				</a>
				<code>
[
  {
    <span class="violet">"h"</span>: <span class="green">278</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
				</code>
			</pre>
    </div>
    <div class="fd3 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-fd.svg" alt="fd">
        <div class="title-demo">
            Face detector <br />
            DEMO
        </div>
        <img class="full-image" src="img/e3-res-fd.jpg" alt="image">
        <pre class="code">
				<a href="#">See documentation</a>
				<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
				</code>
			</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
				<a class="file" href="files/e3-fd.json" download>
					<img src="img/json.svg" alt="">
				</a>
				<code>
[
  {
    <span class="violet">"h"</span>: <span class="green">278</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
				</code>
			</pre>
    </div>
    <div class="fd4 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-fd.svg" alt="fd">
        <div class="title-demo">
            Face detector <br />
            DEMO
        </div>
        <img class="full-image" src="img/e4-res-fd.jpg" alt="image">
        <pre class="code">
				<a href="#">See documentation</a>
				<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
				</code>
			</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
				<a class="file" href="files/e4-fd.json" download>
					<img src="img/json.svg" alt="">
				</a>
				<code>
[
  {
    <span class="violet">"h"</span>: <span class="green">278</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
				</code>
			</pre>
    </div>
</div>
<!-- Demo ER -->
<div id="demo_er">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="img/close.svg" alt="Close">
    </a>

    <div class="demo_er">
        <img class="demo-icon" src="img/icon-er.svg" alt="er">
        <div class="title-demo">
            Emotion recognition <br />
            DEMO
        </div>
        <p>
            Choose an image to process:
        </p>
        <div class="blocks">
            <div class="block er_1">
                <img src="img/e1.jpg" alt="">
            </div>
            <div class="block er_2">
                <img src="img/e2.jpg" alt="">
            </div>
            <div class="block er_3">
                <img src="img/e3.jpg" alt="">
            </div>
            <div class="block er_4">
                <img src="img/e4.jpg" alt="">
            </div>
        </div>
        <p>
            Soon Er will work with videos. <span>
						Be the first to know
					</span>
        </p>
    </div>
    <div class="er1 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-er.svg" alt="er">
        <div class="title-demo">
            Emotion recognition <br />
            DEMO
        </div>
        <img class="full-image" src="img/e1-res-er.jpg" alt="image">
        <pre class="code">
					<a href="#">See documentation</a>
					<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
					</code>
				</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
					<a class="file" href="files/e1-er.json" download>
						<img src="img/json.svg" alt="">
					</a>
					<code>
[
  {
    <span class="green">"h"</span>: <span class="violet">278</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.9151450991630554</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.07965227961540222</span>, <span class="violet">"Happiness"</span>],
      [<span class="green">0.004168621730059385</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.0005960435955785215</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.00035987311275675893</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">7.289356290129945e-05</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">5.118385161040351e-06</span>, <span class="violet">"Disgust"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.8588149547576904</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.0784924104809761</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">0.030477698892354965</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">0.026959676295518875</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.004039310850203037</span>, <span class="violet">"Disgust"</span>],
      [<span class="green">0.0010209475876763463</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.00019492502906359732</span>, <span class="violet">"Happiness"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
					</code>
				</pre>
    </div>
    <div class="er2 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-er.svg" alt="er">
        <div class="title-demo">
            Emotion recognition <br />
            DEMO
        </div>
        <img class="full-image" src="img/e2-res-er.jpg" alt="image">
        <pre class="code">
					<a href="#">See documentation</a>
					<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
					</code>
				</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
					<a class="file" href="files/e2-er.json" download>
						<img src="img/json.svg" alt="">
					</a>
					<code>
[
  {
    <span class="green">"h"</span>: <span class="violet">278</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.9151450991630554</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.07965227961540222</span>, <span class="violet">"Happiness"</span>],
      [<span class="green">0.004168621730059385</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.0005960435955785215</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.00035987311275675893</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">7.289356290129945e-05</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">5.118385161040351e-06</span>, <span class="violet">"Disgust"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.8588149547576904</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.0784924104809761</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">0.030477698892354965</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">0.026959676295518875</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.004039310850203037</span>, <span class="violet">"Disgust"</span>],
      [<span class="green">0.0010209475876763463</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.00019492502906359732</span>, <span class="violet">"Happiness"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
					</code>
				</pre>
    </div>
    <div class="er3 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-er.svg" alt="er">
        <div class="title-demo">
            Emotion recognition <br />
            DEMO
        </div>
        <img class="full-image" src="img/e3-res-er.jpg" alt="image">
        <pre class="code">
					<a href="#">See documentation</a>
					<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
					</code>
				</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
					<a class="file" href="files/e3-er.json" download>
						<img src="img/json.svg" alt="">
					</a>
					<code>
[
  {
    <span class="green">"h"</span>: <span class="violet">278</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.9151450991630554</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.07965227961540222</span>, <span class="violet">"Happiness"</span>],
      [<span class="green">0.004168621730059385</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.0005960435955785215</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.00035987311275675893</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">7.289356290129945e-05</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">5.118385161040351e-06</span>, <span class="violet">"Disgust"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.8588149547576904</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.0784924104809761</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">0.030477698892354965</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">0.026959676295518875</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.004039310850203037</span>, <span class="violet">"Disgust"</span>],
      [<span class="green">0.0010209475876763463</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.00019492502906359732</span>, <span class="violet">"Happiness"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
					</code>
				</pre>
    </div>
    <div class="er4 d-none">
        <a href="javascript:;" class="back">
            <span>Process another image</span>
        </a>
        <img class="demo-icon" src="img/icon-er.svg" alt="er">
        <div class="title-demo">
            Emotion recognition <br />
            DEMO
        </div>
        <img class="full-image" src="img/e4-res-er.jpg" alt="image">
        <pre class="code">
					<a href="#">See documentation</a>
					<code>
<span class="grey">#example code</span>
image = Image.from_file(<span class="violet">'example1.jpg'</span>)
result, status, error_message = face_detector.on_image(image)
					</code>
				</pre>
        <a class="see_docs" href="#">See documentation</a>
        <pre class="code">
					<a class="file" href="files/e4-er.json" download>
						<img src="img/json.svg" alt="">
					</a>
					<code>
[
  {
    <span class="green">"h"</span>: <span class="violet">278</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.9151450991630554</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.07965227961540222</span>, <span class="violet">"Happiness"</span>],
      [<span class="green">0.004168621730059385</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.0005960435955785215</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.00035987311275675893</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">7.289356290129945e-05</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">5.118385161040351e-06</span>, <span class="violet">"Disgust"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.91907316"</span>,
    <span class="violet">"w"</span>: <span class="green">281</span>,
    <span class="violet">"y"</span>: <span class="green">183</span>,
    <span class="violet">"x"</span>: <span class="green">132</span>
  },
  {
    <span class="violet">"h"</span>: <span class="green">321</span>,
    <span class="violet">"emotions"</span>: [
      [<span class="green">0.8588149547576904</span>, <span class="violet">"Anger"</span>],
      [<span class="green">0.0784924104809761</span>, <span class="violet">"Sadness"</span>],
      [<span class="green">0.030477698892354965</span>, <span class="violet">"Neutral"</span>],
      [<span class="green">0.026959676295518875</span>, <span class="violet">"Anxiety"</span>],
      [<span class="green">0.004039310850203037</span>, <span class="violet">"Disgust"</span>],
      [<span class="green">0.0010209475876763463</span>, <span class="violet">"Surprise"</span>],
      [<span class="green">0.00019492502906359732</span>, <span class="violet">"Happiness"</span>]
    ],
    <span class="violet">"score"</span>: <span class="violet">"0.89893955"</span>,
    <span class="violet">"w"</span>: <span class="green">301</span>,
    <span class="violet">"y"</span>: <span class="green">175</span>,
    <span class="violet">"x"</span>: <span class="green">531</span>
  }
]
					</code>
				</pre>
    </div>
</div>

