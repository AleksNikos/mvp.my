<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 22.04.2019
 * Time: 4:31
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
$user = Yii::$app->user->identity;
$this->params['pageID']="settings";
?>
    <div class="settings-title">
        <h2 class="title">
            Settings
        </h2>
        <?=Html::a("Log out",["/site/logout"],["class"=>"logout", 'data'=>['method'=>'post']])?>
<!--        <a href="" class="logout">Log out</a>-->
    </div>
    <div class="user-card">
        <div class="photo">
            <?php
            Pjax::begin([
                'id'=>'PjaxImage',
            ]);
            ?>
            <img src="<?="/usersImage/".$user->image?>" alt="">
            <a style="cursor: pointer;">Edit photo</a>
            <?php

            $form = ActiveForm::begin([
                'fieldConfig' => [
                    'template' => "{input}",
                    ],
                'id'=>'activeImage',
                'options' => ['data' => ['pjax' => true]],

            ]);

            echo $form->field($image,'image')->fileInput(['hidden'=>true,'class'=>'uploadImage'])->label(false);
//            echo Html::submitButton("send");
            ActiveForm::end();
            $jsUploadImage = <<<JS

    $('.photo a').click(function() {
      $('input.uploadImage').trigger('click');
    });
    $('input.uploadImage').change(function() {
       $('#activeImage').submit();
    });
    // $(document).on('change', 'input.uploadImage', function() {
    //    $('#activeImage').submit();
    // });
      
JS;
            $this->registerJS($jsUploadImage);
            Pjax::end();



            ?>
        </div>

        <div class="user-form">
            <div class="inp-wr">
                <div class="inp-name">
                    User name
                </div>
                <input type="text" value="<?=$user->username?>" disabled="true" placeholder="Enter your name" name="name">
            </div>
            <div class="inp-wr">
                <div class="inp-name">
                    Company
                </div>
                <input type="text" value="<?=$user->name_organization?>"  disabled="true" placeholder="Enter your company name" name="company">
            </div>
            <div class="mail">
                <div class="icon">
                    <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 1C0 0.447715 0.447715 0 1 0H14C14.5523 0 15 0.447715 15 1V9C15 9.55228 14.5523 10 14 10H1C0.447715 10 0 9.55229 0 9V1ZM7.19727 5.23845C7.37615 5.37453 7.62385 5.37453 7.80273 5.23845L13.8672 0.625H1.13281L7.19727 5.23845ZM0.625 8.875C0.625 9.15114 0.848858 9.375 1.125 9.375H13.875C14.1511 9.375 14.375 9.15114 14.375 8.875V1.01562L9.88281 4.45312L12.5391 7.46094L12.4609 7.53906L9.375 4.80469L7.80525 6.0147C7.62537 6.15336 7.37463 6.15336 7.19475 6.0147L5.625 4.80469L2.53906 7.53906L2.46094 7.46094L5.11719 4.45312L0.625 1.01562V8.875Z" fill="#A9B2E1"/>
                    </svg>
                </div>
                <div class="email">
                    <?=$user->email?>
                </div>
                <div class="text">
                    Contact <a href="#">support@neurodatalab.com</a> to change
                </div>
                <?php if($unit) { ?>
                    <div class="text">
                        Your unit that invited you <a href="#"><?=$unit->email?></a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php $form = ActiveForm::begin([
                    'id'=>'changePassword',
            ]);?>


            <div class="change_pass-btn">
                <svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.375 6.25H14C14.5523 6.25 15 6.69772 15 7.25V15.5C15 16.0523 14.5523 16.5 14 16.5H1C0.447715 16.5 0 16.0523 0 15.5V7.25C0 6.69772 0.447715 6.25 1 6.25H2.625V4.875C2.625 3.53124 3.10156 2.38282 4.05469 1.42969C5.00782 0.476558 6.15624 0 7.5 0C8.84376 0 9.99218 0.476558 10.9453 1.42969C11.8984 2.38282 12.375 3.53124 12.375 4.875V6.25ZM3.375 4.875V6.25H11.625V4.875C11.625 3.71874 11.2266 2.74219 10.4297 1.94531C9.63281 1.14843 8.65626 0.75 7.5 0.75C6.34374 0.75 5.36719 1.14843 4.57031 1.94531C3.77343 2.74219 3.375 3.71874 3.375 4.875ZM13.75 15.75C14.0261 15.75 14.25 15.5261 14.25 15.25V7.5C14.25 7.22386 14.0261 7 13.75 7H1.25C0.973857 7 0.75 7.22386 0.75 7.5V15.25C0.75 15.5261 0.973858 15.75 1.25 15.75H13.75Z" fill="#9EAEFF"/>
                </svg>
                <a id="change-pass" href="#">Change password</a>
            </div>
            <div class="password d-none">

                <div class="inp-wr">
                    <?=$form->field($changePass,'oldPassword')->passwordInput(['placeholder'=>'Current password'])->label(false)?>
                    <!--                    <input type="password" placeholder="Current password">-->
                </div>
                <div class="inp-wr">
                    <?=$form->field($changePass,'password')->passwordInput(['placeholder'=>"New password"])->label(false)?>
                    <!--                    <input type="password" placeholder="New password">-->
                </div>
                <div class="inp-wr">
                    <?=$form->field($changePass, 'confirmPassword')->passwordInput(['placeholder'=>"Repeat new password"])->label(false)?>
                    <!--                    <input type="password" placeholder="Repeat new password">-->
                </div>


                <div class="buttons">
                    <div class="cancel">
                        <a href="#">cancel</a>
                    </div>

                    <?php

                    ?>
                    <div class="change">
                        <a style="cursor: pointer" onclick="$('#changePassword').submit();">change password</a>
                    </div>
                </div>
            </div>




            <?php ActiveForm::end();?>
        </div>
    </div>


