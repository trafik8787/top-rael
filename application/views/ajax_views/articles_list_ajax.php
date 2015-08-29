<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 29.08.2015
 * Time: 19:47
 */

?>

<?foreach($data as $rows_data):?>
    <div class="list-item">
        <?if (!empty($rows_data['CatUrl'])):?>
            <a href="/articles/<?=$rows_data['CatUrl']?>"><?=$rows_data['CatName']?></a>
        <?endif?>
        <div class="media">

            <div class="media-left">

                <a href="/article/<?=$rows_data['url']?>">
                    <img src="/uploads/img_articles/thumbs/<?=basename($rows_data['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$rows_data['name']?>"/>
                </a>

            </div>

            <div class="media-body">

                <h2 class="media-heading">
                    <a href="/article/<?=$rows_data['url']?>"><strong><?=$rows_data['name']?></strong></a>
                    <small><?=$rows_data['secondname']?></small>
                </h2>

                <?=Text::limit_chars(strip_tags($rows_data['content']), 350, null, true)?>

            </div>
        </div>
    </div>

    <hr/>
<?endforeach?>