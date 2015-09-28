<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 26.08.2015
 * Time: 17:24
 */

?>

<?foreach ($data as $rows):?>
    <div class="clearfix">
        <div class="col-sm-4">
            <div class="thumbnail">

                <?if (!empty($rows[0]['bussines_favorit']))://если бизнес добавлен в избранное?>
                    <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                        <i class="fa fa-star"></i>
                    </a>
                <?else:?>
                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows[0]['id']?>" class="pin w-add-bussines-favor">
                        <i class="fa fa-star"></i>
                    </a>
                <?endif?>


                <a href="/business/<?=$rows[0]['url']?>" class="thumbnail-image">
                    <img src="/uploads/img_business/thumbs/<?=basename($rows[0]['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows[0]['name']?>">
                </a>


                <div class="thumbnail-content">
                    <h2 class="thumbnail-title">
                        <a href="/business/<?=$rows[0]['url']?>"><?=$rows[0]['name']?></a>
                        <small><?=$rows[0]['CityName']?>. <?=$rows[0]['address']?></small>
                    </h2>

                    <?=Text::limit_chars(strip_tags($rows[0]['info']), 150, null, true)?>


                </div>
            </div>
        </div>

        <?if (!empty($rows[1])):?>
            <div class="col-sm-4">
                <div class="thumbnail">

                    <?if (!empty($rows[1]['bussines_favorit']))://если бизнес добавлен в избранное?>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                            <i class="fa fa-star"></i>
                        </a>
                    <?else:?>
                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows[1]['id']?>" class="pin w-add-bussines-favor">
                            <i class="fa fa-star"></i>
                        </a>
                    <?endif?>


                    <a href="/business/<?=$rows[1]['url']?>" class="thumbnail-image">
                        <img src="/uploads/img_business/thumbs/<?=basename($rows[1]['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows[1]['name']?>">
                    </a>


                    <div class="thumbnail-content">
                        <h2 class="thumbnail-title">
                            <a href="/business/<?=$rows[1]['url']?>"><?=$rows[1]['name']?></a>
                            <small><?=$rows[1]['CityName']?>. <?=$rows[1]['address']?></small>
                        </h2>

                        <?=Text::limit_chars(strip_tags($rows[1]['info']), 150, null, true)?>


                    </div>
                </div>
            </div>
        <?endif?>

        <?if (!empty($rows[2])):?>
            <div class="col-sm-4">
                <div class="thumbnail">

                    <?if (!empty($rows[2]['bussines_favorit']))://если бизнес добавлен в избранное?>
                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                            <i class="fa fa-star"></i>
                        </a>
                    <?else:?>
                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows[2]['id']?>" class="pin w-add-bussines-favor">
                            <i class="fa fa-star"></i>
                        </a>
                    <?endif?>


                    <a href="/business/<?=$rows[2]['url']?>" class="thumbnail-image">
                        <img src="/uploads/img_business/thumbs/<?=basename($rows[2]['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows[2]['name']?>">
                    </a>


                    <div class="thumbnail-content">
                        <h2 class="thumbnail-title">
                            <a href="/business/<?=$rows[2]['url']?>"><?=$rows[2]['name']?></a>
                            <small><?=$rows[2]['CityName']?>. <?=$rows[2]['address']?></small>
                        </h2>

                        <?=Text::limit_chars(strip_tags($rows[2]['info']), 150, null, true)?>


                    </div>
                </div>
            </div>
        <?endif?>
    </div>
<?endforeach?>