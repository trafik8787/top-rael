<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 20.07.2015
 * Time: 19:48
 */
?>

<?if (!empty($content)):?>

    <!-- Reviews -->
    <div class="sidebar-reviews">

        <div class="sidebar-reviews-heading">
            <div class="sidebar-reviews-title">Обзоры</div>
        </div>

        <div class="sidebar-reviews-body">

            <?foreach ($content as $row):?>
                <div class="media">
                    <div class="media-left">
                        <a href="/article/<?=$row['url']?>">
                            <img src="/uploads/img_articles/thumbs/<?=basename($row['images_article'])?>" width="120" height="85" alt="<?=$row['name']?>" class="media-object"/>
                        </a>
                    </div>
                    <div class="media-body">
                        <h3 class="media-heading">
                            <a href="/article/<?=$row['url']?>">
                                <strong><?=$row['name']?></strong>
                            </a>
                        </h3>

                        <strong class="fz small"><?=$row['secondname']?></strong>

                        <p><?=Text::limit_chars(strip_tags($row['content']), 100, null, true)?></p>
                    </div>
                </div>

            <?endforeach?>

        </div>

        <div class="sidebar-reviews-footer">
            <a href="/articles" class="btn btn-default open-all" role="button">Открыть все</a>
        </div>
    </div>


<?endif?>