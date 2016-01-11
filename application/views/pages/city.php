<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 12.08.2015
 * Time: 14:14
 */
//HTML::x($_SERVER);
//[REMOTE_ADDR] => 178.94.172.183
?>

<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">
                    <input type="hidden" class="w-city-id" value="<?=$city_id?>"/>
                    <?foreach($data as $key => $rowsdata):?>
                        <?if (!empty($rowsdata['data'])):?>
                            <div class="panel panel-thumbnails w-bloc-section">

                                <div class="panel-heading">

                                    <a class="menu-toggle" role="button" data-toggle="collapse"
                                       href="#restaurants-thumbnails-navigation"
                                       aria-controls="restaurants-thumbnails-navigation">
                                        <i class="fa fa-bars"></i>
                                    </a>

                                    <div class="panel-title"><?=$rowsdata['category'][0]['name']?></div>

                                    <div class="panel-buttons-group">

                                        <a href="/maps?section=<?=$rowsdata['category'][0]['url']?>&city=<?=$city_id?>" class="btn btn-default" role="button">На карте</a>
                                    </div>

                                    <div class="collapse" id="restaurants-thumbnails-navigation">

                                        <ul class="nav nav-pills panel-navigation w-category-bloc">
                                            <li class="active"><a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>" class="w-home-cat w-cat-active">Всё</a></li>

                                            <?foreach($rowsdata['category'][0]['childs'] as $row_category):?>
                                                <li><a href="/section/<?=$rowsdata['category'][0]['url'].'/'.$row_category['url']?>" data-cat="<?=$row_category['url']?>" class="w-home-cat"><?=$row_category['name']?></a></li>

                                            <?endforeach?>
                                            <li><a href="/section/<?=$rowsdata['category'][0]['url']?>?city=<?=$city_id?>">ещё...</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body slider">


                                    <?foreach ($rowsdata['data'] as $rows):?>
                                        <div class="col-md-4">
                                            <div class="thumbnail">

                                                <?if (!empty($rows['bussines_favorit']))://если купон добавлен в избранное?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin">
                                                        <i class="fa fa-star" style="color: #E44F44"></i>
                                                    </a>
                                                <?else:?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows['id']?>" title="Добавить в Личный кабинет" class="pin w-add-bussines-favor">
                                                        <i class="fa fa-star"></i>
                                                    </a>
                                                <?endif?>


                                                <a href="/business/<?=$rows['url']?>" class="thumbnail-image">
                                                    <img src="/uploads/img_business/thumbs/<?=basename($rows['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows['name']?>">
                                                </a>


                                                <div class="thumbnail-content">
                                                    <h2 class="thumbnail-title">
                                                        <a href="/business/<?=$rows['url']?>"><?=$rows['name']?></a>
                                                        <small><?=$rows['CityName']?>. <?=$rows['address']?></small>
                                                    </h2>

                                                    <?=Text::limit_chars(strip_tags($rows['info']), 150, null, true)?>


                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>

                                <div class="panel-footer text-center">
                                    <a href="/section/<?=$rowsdata['category'][0]['url']?>?city=<?=$city_id?>" class="btn open-all" role="button">Открыть все</a>
                                </div>


                            </div>
                            <hr/>
                        <?endif?>
                    <?endforeach?>

                    <hr/>

                </div>

            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>