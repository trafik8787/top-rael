<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 19.07.2015
 * Time: 18:09
 */

?>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills">
            <h2>Обзоры</h2>
<!--            --><?//=HTML::x($data)?>
            <li class="<? if (Controller_BaseController::$detect_uri == URL::site('articles')) { echo 'active'; }?>"><a href="/articles" >Все</a></li>
            <?foreach($category as $row_category):?>

                <li class="<? if (Controller_BaseController::$detect_uri == '/articles/'.$row_category['url']) { echo 'active'; }?>"><a href="/articles/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

            <?endforeach?>
        </ul>

    </div>


    <div class="row">
        <div class="col-md-9">

            <?foreach($data as $rows_data):?>
                <div style="border: 1px solid #000;">
                    <img src="" alt="sdf"/>
                    <h4><a href="/article/<?=$rows_data['url']?>"><?=$rows_data['name']?></a></h4>
                    <?if (!empty($rows_data['CatUrl'])):?>
                        <h5><a href="/articles/<?=$rows_data['CatUrl']?>"><?=$rows_data['CatName']?></a></h5>
                    <?endif?>
                    <p><?=Text::limit_chars(strip_tags($rows_data['content']), 200, null, true)?></p>
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