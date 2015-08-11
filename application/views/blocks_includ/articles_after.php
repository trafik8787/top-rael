<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 19:34
 */
//HTML::x($data);
?>

<div>
    <h2>Обзоры</h2>

    <?foreach($data as $rows):?>
        <div class="media">
            <div class="media-left">
                <a href="/article/<?=$rows['url']?>">
                    <?if (!empty($rows['images_article'])):?>
                        <img src="/uploads/img_articles/thumbs/<?=basename($rows['images_article'])?>" width="120" height="85" class="media-object" alt="<?=$rows['name']?>"/>

                    <?else:?>
                        <img src="/public/uploade/list.png" width="120" height="85" class="media-object" alt="<?=$rows['name']?>"/>
                    <?endif?>
                </a>
            </div>
            <div class="media-body">
                <h2 class="media-heading fz normal"><a href="/article/<?=$rows['url']?>"><strong><?=$rows['name']?></strong></a>
                </h2>

                <strong class="fz small"><?=$rows['secondname']?></strong>

                <div class="fz small">
                    <?=Text::limit_chars(strip_tags($rows['content']), 100, null, true)?>
                </div>
            </div>
        </div>

        <hr/>
    <?endforeach?>


    <div class="text-center">
        <a href="/articles" class="btn btn-default open-all" role="button">Открыть все</a>
    </div>

    <br/>
</div>