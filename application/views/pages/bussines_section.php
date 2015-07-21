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
            <span>

                <form action="" method="get" id="w-form-city">
                    <select class="form-control w-select-city" name="city" style="width: 20%">
                        <option value="">По городам</option>
                        <?foreach($city as $key_id => $row_city):?>
                            <option <?if ($city_id == $key_id) { echo 'selected="selected"';}?> value="<?=$key_id?>"><?=$row_city?></option>
                        <?endforeach?>
                    </select>
                </form>
            </span>

            <li class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].$pagesUrl) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url']?>" >Все</a></li>
            <?foreach($category[0]['childs'] as $row_category):?>

                <li class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].'/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url'].'/'.$row_category['url']?>" ><?=$row_category['name']?></a></li>

            <?endforeach?>
        </ul>

    </div>

    <div class="w-business-list">
        <?=$business_list?>
    </div>


</div>