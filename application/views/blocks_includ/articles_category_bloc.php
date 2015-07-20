<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.07.2015
 * Time: 19:48
 */
?>

<?if (!empty($content)):?>
    <div class="panel panel-default">
        <div class="panel-heading">Обзоры</div>
        <div class="panel-body">
            <ul class="media-list">
                <?foreach ($content as $row):?>
                    <li class="media">
                        <a class="pull-left" href="/article/<?=$row['url']?>">
                            <img class="media-object" src="" alt="фото обзора">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="/article/<?=$row['url']?>"><?=$row['name']?></a></h5>
                            <?=Text::limit_chars(strip_tags($row['content']), 100, null, true)?>
                        </div>
                    </li>
                <?endforeach?>
            </ul>
        </div>
    </div>
<?endif?>