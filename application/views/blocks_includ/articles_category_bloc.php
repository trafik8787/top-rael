<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.07.2015
 * Time: 19:48
 */
?>

<?if (!empty($content)):?>

    <div>
        <h2>Обзоры</h2>
        <?foreach ($content as $row):?>
            <div class="media">
                <div class="media-left">
                    <a href="/article/<?=$row['url']?>">
                        <img src="/public/uploade/list.png" width="120" height="85" class="media-object"/>
                    </a>
                </div>
                <div class="media-body">
                    <h2 class="media-heading fz normal"><a href="/article/<?=$row['url']?>"><strong><?=$row['name']?></strong></a>
                    </h2>

                    <strong class="fz small"><?=$row['secondname']?></strong>

                    <div class="fz small"><?=Text::limit_chars(strip_tags($row['content']), 100, null, true)?></div>
                </div>
            </div>

            <hr/>
        <?endforeach?>


        <div class="text-center">
            <a href="/articles" class="btn btn-default open-all" role="button">Открыть
                все</a>
        </div>

        <br/>
    </div>


<?endif?>