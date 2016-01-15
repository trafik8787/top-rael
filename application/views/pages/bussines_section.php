<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 16.07.2015
 * Time: 22:30
 */

?>


<content>

    <div id="content">

        <?=isset($top_baners) ? $top_baners: ''?>

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">

                    <div class="panel panel-thumbnails">

                        <div class="panel-heading">

                            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-restaurant"
                               aria-controls="nav-restaurant">
                                <i class="fa fa-bars"></i>
                            </a>

                            <div class="panel-title"><?=$category[0]['name']?></div>

                            <div class="panel-buttons-group">

                                <form action="" method="get" id="w-form-city" style="display: inline-block;">
                                    <select class="form-control w-select-city" name="city">
                                        <option value="">По городам</option>
                                        <?foreach($city as $key_id => $row_city):?>
                                            <option <?if ($city_id == $key_id) { echo 'selected="selected"';}?> value="<?=$key_id?>"><?=$row_city?></option>
                                        <?endforeach?>
                                    </select>
                                </form>

                                <a <?if (!empty($curent_category)) { ?>href="/maps?cat=<?=$curent_category?>" <?} else {?>
                                    href="/maps?section=<?=$curent_section?>"
                                    <?}?>
                                   class="btn btn-default" role="button">На карте</a>
                            </div>


                            <div class="collapse" id="nav-restaurant">
                                <ul class="nav nav-pills panel-navigation">
                                    <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].$pagesUrl) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url']?>" >Всё</a></li>
                                    <?foreach($category[0]['childs'] as $row_category):?>

                                        <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].'/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url'].'/'.$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                    <?endforeach?>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <?foreach($data as $key => $rows_data):?>

                                <div class="clearfix">

                                    <div class="col-sm-6">
                                        <div class="thumbnail">

                                            <?if (!empty($rows_data[0]['bussines_favorit']))://если бизнес добавлен в избранное?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="Добавлено в ваш Личный кабинет" class="pin">
                                                    <i class="fa fa-star" style="color: #E44F44"></i>
                                                </a>
                                            <?else:?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[0]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-bussines-favor">
                                                    <i class="fa fa-star"></i>
                                                </a>
                                            <?endif?>

                                            <a href="/business/<?=$rows_data[0]['url']?>" class="thumbnail-image">
                                                <img src="<?=$rows_data[0]['home_busines_foto']?>" width="240" height="150" alt="<?=$rows_data[0]['name']?>">
                                            </a>

                                            <div class="thumbnail-content">
                                                <h2 class="thumbnail-title">
                                                    <a href="/business/<?=$rows_data[0]['url']?>"><?=$rows_data[0]['name']?></a>
                                                    <small><?=$rows_data[0]['CityName'].', '.$rows_data[0]['address']?></small>
                                                </h2>
                                                <?=Text::limit_chars(strip_tags($rows_data[0]['info']), 200, null, true)?>

                                            </div>
                                        </div>
                                    </div>
                                    <?if (!empty($rows_data[1])):?>
                                        <div class="col-sm-6">
                                            <div class="thumbnail">

                                                <?if (!empty($rows_data[1]['bussines_favorit']))://если купон добавлен в избранное?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Добавлено в ваш Личный кабинет" class="pin">
                                                        <i class="fa fa-star" style="color: #E44F44"></i>
                                                    </a>
                                                <?else:?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[1]['id']?>" title="Добавить в Личный кабинет" class="pin w-add-bussines-favor">
                                                        <i class="fa fa-star"></i>
                                                    </a>
                                                <?endif?>

                                                <a href="/business/<?=$rows_data[1]['url']?>" class="thumbnail-image">
                                                    <img src="<?=$rows_data[1]['home_busines_foto']?>" width="240" height="150" alt="<?=$rows_data[1]['name']?>">
                                                </a>

                                                <div class="thumbnail-content">
                                                    <h2 class="thumbnail-title">
                                                        <a href="/business/<?=$rows_data[1]['url']?>"><?=$rows_data[1]['name']?></a>
                                                        <small><?=$rows_data[1]['CityName'].', '.$rows_data[1]['address']?></small>
                                                    </h2>
                                                    <?=Text::limit_chars(strip_tags($rows_data[1]['info']), 200, null, true)?>

                                                </div>
                                            </div>
                                        </div>
                                    <?endif?>
                                </div>

                                <br/>
                            <?endforeach?>
                        </div>

                        <div class="panel-footer text-center">
                            <nav>

                                <?=$pagination?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>