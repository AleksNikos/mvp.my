<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 21.04.2019
 * Time: 15:05
 */

$this->params['pageID']="dashboard";
?>
<table class="table_info">
    <tr class="table_title">
        <th class="user_name">Agent Name</th>
        <th class="period_title">Period total</th>
        <th class="fd"><img src="/img/icon-fd.svg" alt=""></th>
        <th class="er"><img src="/img/icon-er.svg" alt=""></th>
    </tr>
    <tr class="users">

        <td class="all-users">All <?=count($userChild)?> users</td>

        <td><span class="val"><?=$allTotal["total_count"]+$userTotal["total_count"]?null:0 ?></span><span class="price">$<?=$allTotal["total_price"]+$userTotal["total_price"]?null:0?></span></td>
        <td><span class="val"><?=$allTotal["fd_count"]+$userTotal["fd_count"]?null:0?></span> <span class="price">$<?=$allTotal["fd_price"]+$userTotal["fd_price"]?null:0?></span></td>
        <td><span class="val"><?=$allTotal["er_count"]+$userTotal["er_count"]?null:0?></span> <span class="price">$<?=$allTotal["er_price"]+$userTotal["er_price"]?null:0?></span></td>
    </tr>
    <?php
        foreach ($userChild as $child){
            ?>

            <tr>
                <td><?=$child["username"]?></td>
                <td><span class="val"><?=$child["total_count"]?null:0 ?></span><span class="price">$<?=$child["total_price"]?null:0 ?></span></td>
                <td><span class="val"><?=$child["fd_count"]?null:0 ?></span><span class="price">$<?=$child["fd_price"]?null:0 ?></span></td>
                <td><span class="val"><?=$child["er_count"]?null:0 ?></span><span class="price">$<?=$child["er_price"]?null:0 ?></span></td>
            </tr>

            <?php
        }

    ?>


    <tr>
        <td>You (<?=count($user->keys)?> key)</td>
        <td><span class="val"><?=$userTotal["total_count"]?null:0?></span><span class="price">$<?=$userTotal["total_price"]?null:0?></span></td>
        <td><span class="val"><?=$userTotal["fd_count"]?null:0?></span><span class="price">$<?=$userTotal["fd_price"]?null:0?></span></td>
        <td><span class="val"><?=$userTotal["er_count"]?null:0?></span><span class="price">$<?=$userTotal["er_price"]?null:0?></span></td>
    </tr>
<!--    <tr class="key">-->
<!--        <td>My awesome key 1</td>-->
<!--        <td><span class="val">120</span><span class="price">$1.30</span></td>-->
<!--        <td><span class="val">100</span><span class="price">$1.00</span></td>-->
<!--        <td><span class="val">20</span><span class="price">$0.30</span></td>-->
<!--    </tr>-->
<!--    <tr class="key">-->
<!--        <td>My awesome key 2</td>-->
<!--        <td><span class="val">50</span><span class="price">$0.75</span></td>-->
<!--        <td><span class="val">-</span><span class="price">-</span></td>-->
<!--        <td><span class="val">50</span><span class="price">$0.75</span></td>-->
<!--    </tr>-->
</table>

