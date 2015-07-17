<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */
?>

<div class="container">

    <div class="row">
        <div class="col-md-3">Logo</div>
        <div class="col-md-9">
            <ul class="list-inline">
                <?foreach ($top_meny as $name=>$url):?>
                    <li><a href="<?=$url?>" class="normal8Tahoma <? if (Controller_BaseController::$detect_uri == $url) { echo 'active'; }?>"><?=$name?></a></li>

                <?endforeach?>
            </ul>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <ul class="list-inline">
                <?foreach($general_meny as $row_meny):?>

                        <li><a href="/section/<?=$row_meny['url']?>" class="normal8Tahoma <? if (Controller_BaseController::$detect_uri == '/section/'.$row_meny['url']) { echo 'active'; }?>"><?=$row_meny['name']?></a></li>

                <?endforeach?>
            </ul>
        </div>

    </div>