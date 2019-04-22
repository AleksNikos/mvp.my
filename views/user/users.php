<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 18:47
 */
$script = <<<JS
    $('input[type=checkbox]').change(function() {
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

$this->registerJS($script);


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
    $i = 0;
    $engTotal = 0;
    $FdTotal = 0;
    $ErTotal =0;
    $keysTotal =0;
           foreach ($agents as $agent){
               $i++;
               ?>
               <tr class="users">
                   <td class="users" data-fancybox="" data-src="#modal-user">
                       <span><?=$i?></span>
                       <?=$agent->name_organization?>
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

                    // тут нужно определитьс€ что делать с defaul пользовател€ми
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
                    if($engines == $countKeys){ //≈сли все ключи работают
                        $engines = "all";
                    }
                    if($countKeys ==0 ){ // если у пользовател€ нет ключей
                        $engines = "-";
                    }
                   ?>
                   <td><?=$engines?></td>
                   <td>
                       <label class="switch">
                           <span class="number"><?=$FdCount?></span>
                           <input data-id="<?=$agent->id?>" data-type="fd" type="checkbox" <?=$agent->FdChecker?"checked":""?>>
                           <span class="slider"></span>
                       </label>
                   </td>
                   <td>
                       <label class="switch">
                           <span class="number"><?=$ErCount?></span>

                           <input data-id="<?=$agent->id?>" data-type="er" type="checkbox" <?=$agent->ErChecker?"checked":""?>>
                           <span class="slider"></span>
                       </label>
                   </td>
               </tr>
               <?php
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
