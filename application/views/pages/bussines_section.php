<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 22:30
 */
?>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <h2><?=$category[0]['name']?></h2>

            <li class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url']) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url']?>" >Все</a></li>
            <?foreach($category[0]['childs'] as $row_category):?>

                <li class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].'/'.$row_category['url']) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url'].'/'.$row_category['url']?>" ><?=$row_category['name']?></a></li>

            <?endforeach?>
        </ul>

    </div>

    <?//HTML::x($data)?>

    <div class="row">
        <div class="col-md-9">

            <?foreach($data as $rows_data):?>
                <div style="width: 200px; border: 1px solid #000; display: inline-block">
                    <img src="" alt="sdf"/>
                    <h3><a href="/business/<?=$rows_data['url']?>"><?=$rows_data['name']?></a></h3>
                    <h4><?=$rows_data['address']?></h4>
                    <p><?=Text::limit_chars(strip_tags($rows_data['info']), 200, null, true)?></p>
                </div>
            <?endforeach?>
        </div>
        <div class="col-md-3">
            ssdf
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?=$pagination?>
        </div>
    </div>



</div>