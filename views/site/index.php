<?php

/* @var $this yii\web\View */

use himiklab\yii2\recaptcha\ReCaptcha2;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'My Yii Application';


?>

<div class="topbar-wrap">
    <div class="wrapper">
        <div class="row">
            <div class="topbar">
                <div class="logo">
                    <img src="img/LOGO@4x.svg" alt="logo">
                </div>
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
<div id="fullpage">
    <section id="home-first" class="home-first">
        <div class="wrapper">
            <div class="row">
                <div class="home-chart">
                    <h1 class="title">
                        API to emotions
                        and behavior
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
                    <p class="powered">
                        Powered by
                        <img src="img/logo-full.svg" alt="logo">
                    </p>
                    <div class="learn-more">
                        <a href="#home-second">
                            <span>Learn more</span>
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
                        <div class="title">Create account</div>
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
                        Monthly postpayments.
                        Free trial key for 500 images. <br />
                        <span>
							Detailed statistics.
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

