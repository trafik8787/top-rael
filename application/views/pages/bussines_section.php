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

        <div class="discount">
            <div class="owl-carousel">
                <a href="#"><img src="/public/uploade/banner-top.jpg" width="1200" height="200" alt=""
                                 class="img-responsive"></a>

                <a href="#"><img src="/public/uploade/banner-top.jpg" width="1200" height="200" alt=""
                                 class="img-responsive"></a>
            </div>
        </div>

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">

                    <div class="row">
                        <div class="panel panel-thumbnail">

                            <div class="panel-heading">

                                <div class="panel-title"><?=$category[0]['name']?></div>

                                <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-restaurant"
                                   aria-controls="nav-restaurant">
                                    <i class="fa fa-bars"></i>
                                </a>

                                <div class="panel-heading-sub">

                                    <div class="dropdown pull-left">

                                        <form action="" method="get" id="w-form-city">
                                            <select class="form-control w-select-city" name="city">
                                                <option value="">По городам</option>
                                                <?foreach($city as $key_id => $row_city):?>
                                                    <option <?if ($city_id == $key_id) { echo 'selected="selected"';}?> value="<?=$key_id?>"><?=$row_city?></option>
                                                <?endforeach?>
                                            </select>
                                        </form>

                                    </div>

                                    <a href="#" class="btn" role="button">На карте</a>
                                </div>


                                <div class="collapse" id="nav-restaurant">
                                    <ul class="nav nav-pills" role="tablist">

                                        <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].$pagesUrl) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url']?>" >Новые</a></li>
                                        <?foreach($category[0]['childs'] as $row_category):?>

                                            <li role="presentation" class="<? if (Controller_BaseController::$detect_uri == '/section/'.$category[0]['url'].'/'.$row_category['url'].$pagesUrl) { echo 'active'; }?>"><a href="/section/<?=$category[0]['url'].'/'.$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                        <?endforeach?>

                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">

                                <?foreach($data as $key => $rows_data):?>

                                    <?
                                        //получаем следующий элемент масива
                                        if (!empty($data[$key+1])) {
                                            $rows_data_next = $data[$key+1];
                                        }

                                    ?>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="thumbnail">

                                                <a href="#" class="pin">
                                                    <i class="fa fa-star"></i>
                                                </a>

                                                <a href="/business/<?=$rows_data['url']?>" class="thumbnail-image">
                                                    <img src="/public/uploade/thumbnail.jpg" width="240" height="150" alt="">
                                                </a>

                                                <div class="caption">
                                                    <h3><strong><a href="/business/<?=$rows_data['url']?>"><?=$rows_data['name']?></a></strong></h3>

                                                    <p><strong><?=$rows_data['CityName'].', '.$rows_data['address']?></strong></p>

                                                    <?=Text::limit_chars(strip_tags($rows_data['info']), 200, null, true)?>
                                                </div>
                                            </div>
                                        </div>

                                        <?if (!empty($rows_data_next)):?>
                                            <div class="col-md-6">
                                                <div class="thumbnail">

                                                    <a href="#" class="pin">
                                                        <i class="fa fa-star"></i>
                                                    </a>

                                                    <a href="/business/<?=$rows_data_next['url']?>" class="thumbnail-image">
                                                        <img src="/public/uploade/thumbnail2.jpg" width="240" height="150" alt="">
                                                    </a>

                                                    <div class="caption">
                                                        <h3><strong><a href="/business/<?=$rows_data_next['url']?>"><?=$rows_data_next['name']?></a></strong></h3>

                                                        <p><strong><?=$rows_data_next['CityName'].', '.$rows_data_next['address']?></strong></p>

                                                        <?=Text::limit_chars(strip_tags($rows_data_next['info']), 200, null, true)?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endif?>
                                    </div>
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
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>
</content>