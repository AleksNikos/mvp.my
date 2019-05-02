<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 18:47
 */
$sliderChecker = <<<JS
    $('.sliderCheck[type=checkbox]').change(function() {
        var type = $(this).data("type");
        var id = $(this).data("id");
        if($(this).is(":checked")){
		    var checked = 1;
        }else{
            var checked =0;
        }
        data = {
            type:type,
            id:id,
            checked:checked,
        };
        $.ajax({
            url: '/user/ajax-checker',
            type: 'POST',
            data: data,
            success: function(res){
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
JS;

$this->registerJS($sliderChecker);


$this->params['pageID']="users";
?>
<table class="table_info">
    <tbody><tr class="table_title">
        <th class="user_name"><?=count($agents)?> users</th>
        <th class="period_title">Keys</th>
        <th class="engines">Engines</th>
        <th class="fd"><img src="/img/icon-fd.svg" alt=""></th>
        <th class="er"><img src="/img/icon-er.svg" alt=""></th>
    </tr>
    <?php
    $i = 0; //связать с page
    $engTotal = 0;
    $FdTotal = 0;
    $ErTotal =0;
    $keysTotal =0;
    $agentsJs = []; //для карточки пользователя
           foreach ($agents as $agent){
               $i++;
               ?>
               <tr class="users" data-id="<?=$agent->id?>">
                   <td class="users">
                       <span><?=$i?></span>
                       <?=Yii::$app->user->identity->username == $agent->username?"You":$agent->username ?>
                   </td>
                   <td><?

                       $countKeys = count($agent->keys);
                       $keysTotal = $countKeys+$keysTotal;
                       if($countKeys == 0){
                           echo "-";
                       }else{
                           echo $countKeys;
                       }
                       ?></td>
                   <?php
                   $engines = 0;
                   $FdCount = 0;
                   $ErCount = 0;

                    // тут нужно определиться что делать с defaul пользователями
                    foreach ($agent->keys as $key){
                        if($key->IS_ACTIVATED and !$key->isDefault){
                            $engines++;
                            $engTotal++;
                        }
                        if($key->Fd){
                            $FdCount++;
                            $FdTotal++;
                        }
                        if($key->Er){
                            $ErTotal++;
                            $ErCount++;
                        }
                    }
                    if($engines == $countKeys){ //Если все ключи работают
                        $engines = "all";
                    }
                    if($countKeys ==0 ){ // если у пользователя нет ключей
                        $engines = "-";
                    }
                   ?>
                   <td><?=$engines?></td>
                   <td>
                       <label class="switch">
                           <span class="number"><?=$FdCount?></span>
                           <input class="sliderCheck" data-id="<?=$agent->id?>" data-type="fd" type="checkbox" <?=$agent->FdChecker?"checked":""?>>
                           <span class="slider"></span>
                       </label>
                   </td>
                   <td>
                       <label class="switch">
                           <span class="number"><?=$ErCount?></span>

                           <input class="sliderCheck" data-id="<?=$agent->id?>" data-type="er" type="checkbox" <?=$agent->ErChecker?"checked":""?>>
                           <span class="slider"></span>
                       </label>
                   </td>
               </tr>
               <?php

               /*Создаем данные для карточки пользователя*/
               $agentsJs[$agent->id]["username"] = $agent->username;
               $agentsJs[$agent->id]["name_organization"] = $agent->name_organization;
               $agentsJs[$agent->id]["position"] = $agent->position;
               $agentsJs[$agent->id]["email"] = $agent->email;
               $agentsJs[$agent->id]["image"] = $agent->image;




           }
    ?>
    <tr class="users total-users">
        <td>Total</td>
        <td><?=$keysTotal?></td>
        <td><?=$engTotal?></td>
        <td><?=$FdTotal?> keys</td>
        <td><?=$ErTotal?> keys</td>
    </tr>
    </tbody></table>

<!-- modal windows -->
<?php
//Здесь загружаются данные в попАП информации о пользователе
$agentsJs = json_encode($agentsJs);
$parentID = Yii::$app->user->getId();
$JsInfoUser = <<<JS
 agents = $agentsJs;
 currentUserInfo = 0;
 parentID = 
//обрабатываем клик по элементу таблицы
$("tr.users .users").click(function() {
    var user = $(this).closest('tr.users');
    var userID = user.data('id');
    currentUserInfo = userID; //необходимо для удаления юзера.
    if(userID == $parentID){
        $('#modal-user .remove').css("display", "none");
    }else{
        $('#modal-user .remove').css("display", "block");
    }
    $('#modal-user .name').html(agents[userID]['username']);
    $('#modal-user .company').html(agents[userID]['name_organization']);
    $('#modal-user .email').html(agents[userID]['email']);
    $('#modal-user .photo img').prop("src", "/usersImage/"+agents[userID]['image']);
    $.fancybox.open({
        src  : '#modal-user',
        opts : {
            afterShow : function( instance, current ) {
                console.info( 'done!' );
            }
        }
    });
});
 
JS;
$this->registerJS($JsInfoUser);
?>
<div id="modal-user">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="/img/close.svg" alt="">
    </a>
    <div class="title">
        User details
    </div>
    <div class="photo">
        <img src="/img/Bitmap.png" alt="">
    </div>
    <div class="user-info">
        <div class="name">
            Kyle Broflovski
        </div>
        <div class="company">
            Awesome company
        </div>
        <div class="email">
            k.broflovski@awesome.com
        </div>
    </div>
    <div class="user-activity">
        <div class="block-wrapper">
            <div class="num">
                1
            </div>
            <div class="desc">
                engine accessable
            </div>
        </div>
        <div class="block-wrapper">
            <div class="num">
                2
            </div>
            <div class="desc">
                active keys
            </div>
        </div>
        <div class="block-wrapper">
            <div class="num">
                $ 8.1
            </div>
            <div class="desc">
                avg. monthly expenses
            </div>
        </div>
    </div>
    <a data-fancybox data-src="#approve-user" href="javascript:;" class="remove">Remove user</a>
</div>


<?php
$JsRemoveUser = <<<JS
    $('#approve-user .remove').click(function () {
        var data = "removeUserId="+currentUserInfo;
        $.ajax({
            url: '/user/ajax-remove-user',
            type: 'POST',
            data: data,
            success: function(res){
                responceRemoveUser = JSON.parse(res);
                if(responceRemoveUser.errors){
                    var errorsString = "";
                   for(var r in responceRemoveUser){
                        var errors = responceRemoveUser[r];
                        for (var i=0; i<errors.length; i++){
                            console.log(errors[i]);	
                            errorsString = errorsString+errors[i]+"\\n\\r";
                        } 
                    }
                    alert(errorsString);
                }
                if(responceRemoveUser.success){
                    alert(responceRemoveUser.success);
                     $.fancybox.close();
                     $.fancybox.close();
                }
            },
            error: function(er){
                console.log(er);
            }
        });
    });
JS;
$this->registerJS($JsRemoveUser);
?>
<div id="approve-user">
    <a class="close-btn" onclick="$.fancybox.close();" href="javascript:;">
        <img src="/img/close.svg" alt="">
    </a>
    <div class="title">Are you sure you want to remove Jane Doe from your team?</div>
    <div class="text">They have 2 active keys that will be stopped. We recommend to contact them first.</div>
    <div class="buttons">
        <button class="cancel">cancel</button>
        <button class="remove">remove</button>
    </div>
</div>
