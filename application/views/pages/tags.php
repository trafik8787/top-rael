<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
//HTML::x($data);
?>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">
                    <input type="hidden" class="w-tags-url" value="<?=$tags_url?>"/>
                    <?foreach($data as $key => $rowsdata):?>

                        <?if (!empty($rowsdata['data'])):?>

                            <div class="row w-bloc-section">
                                <div class="panel panel-thumbnail">

                                    <div class="panel-heading">

                                        <div class="panel-title"><?=$rowsdata['category'][0]['name']?></div>

                                        <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-restaurant"
                                           aria-controls="nav-restaurant">
                                            <i class="fa fa-bars"></i>
                                        </a>

                                        <div class="panel-heading-sub form-inline">

                                            <a href="#" class="btn btn-default" role="button">На карте</a>
                                        </div>

                                        <div class="collapse" id="nav-restaurant">

                                            <ul class="nav nav-pills w-category-bloc" role="tablist">

                                                <li role="presentation" class="active"><a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>" class="w-tags-bus-cat w-cat-active">Новые</a></li>

                                                <?foreach($rowsdata['category'][0]['childs'] as $row_category):?>
                                                    <li role="presentation"><a href="/section/<?=$rowsdata['category'][0]['url'].'/'.$row_category['url']?>" data-cat="<?=$row_category['url']?>" class="w-tags-bus-cat"><?=$row_category['name']?></a></li>

                                                <?endforeach?>

                                            </ul>

                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row slider">
                                            <?foreach ($rowsdata['data'] as $rows):?>
                                                <div class="col-md-4">
                                                    <div class="thumbnail">

                                                        <?if (!empty($rows['bussines_favorit']))://если купон добавлен в избранное?>
                                                            <a href="#" data-toggle="tooltip" data-placement="left" title="Этот бизнес уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                                                <i class="fa fa-star"></i>
                                                            </a>
                                                        <?else:?>
                                                            <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows['id']?>" class="pin w-add-bussines-favor">
                                                                <i class="fa fa-star"></i>
                                                            </a>
                                                        <?endif?>


                                                        <a href="/business/<?=$rows['url']?>" class="thumbnail-image">

                                                            <img src="/uploads/img_business/thumbs/<?=basename($rows['home_busines_foto'])?>" width="240" height="150" alt="<?=$rows['name']?>">

                                                        </a>

                                                        <div class="caption">
                                                            <h3><strong><a href="/business/<?=$rows['url']?>"><?=$rows['name']?></a></strong></h3>

                                                            <p><strong><?=$rows['CityName']?>. <?=$rows['address']?></strong></p>

                                                            <?=Text::limit_chars(strip_tags($rows['info']), 150, null, true)?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?endforeach?>

                                        </div>
                                    </div>

                                    <div class="panel-footer text-center">
                                        <a href="/section/<?=$rowsdata['category'][0]['url']?>" class="btn btn-default  open-all" role="button">Открыть все</a>
                                    </div>
                                </div>
                            </div>

                            <hr/>
                        <?endif?>


                    <?endforeach?>

                </div>





                <div class="row">
                    <div class="panel panel-coupons-thumbnail">

                        <div class="panel-heading">


                            <div class="panel-title">Купоны</div>

                            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-coupons"
                               aria-controls="nav-coupons">
                                <i class="fa fa-bars"></i>
                            </a>


                            <div class="collapse" id="nav-coupons">
                                <ul class="nav nav-pills" role="tablist">

                                    <li role="presentation" class="active"><a href="/coupons" >Все</a></li>
                                    <?foreach($section as $row_category):?>

                                        <li role="presentation" class="" ><a href="/coupons/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                    <?endforeach?>

                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">

                            <?foreach($data_coupon as $rows_data):?>
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="coupon">
                                            <div class="coupon-container">
                                                <?if (!empty($rows_data[0]['coupon_favorit']))://если купон добавлен в избранное?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                                        <i class="fa fa-thumb-tack"></i>
                                                    </a>
                                                <?else:?>
                                                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[0]['id']?>" class="pin w-add-coupon-favor">
                                                        <i class="fa fa-thumb-tack"></i>
                                                    </a>
                                                <?endif?>


                                                <div class="coupon-image">
                                                    <div class="overlay">
                                                        <!--                                                            --><?//=$rows_data[0]['secondname']?>
                                                        <?=$rows_data[0]['BusName']?>
                                                    </div>
                                                    <a href="/modalcoupon/<?=$rows_data[0]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                        <img src="<?=$rows_data[0]['img_coupon']?>" width="155" height="125" alt=""
                                                             title=""/></a>
                                                </div>

                                                <div class="coupon-context">

                                                    <div class="fz large"><strong><?=$rows_data[0]['name']?></strong></div>
                                                    <small><?=$rows_data[0]['secondname']?></small>

                                                    <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[0]['dateoff']), 'j %MONTH% Y'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?if (!empty($rows_data[1])):?>
                                        <div class="col-md-6">

                                            <div class="coupon">
                                                <div class="coupon-container">

                                                    <?if (!empty($rows_data[1]['coupon_favorit']))://если купон добавлен в избранное?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Этот купон уже добавлен в Избранное" class="pin" style="background-color: #ccc">
                                                            <i class="fa fa-thumb-tack"></i>
                                                        </a>
                                                    <?else:?>
                                                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data[1]['id']?>" class="pin w-add-coupon-favor">
                                                            <i class="fa fa-thumb-tack"></i>
                                                        </a>
                                                    <?endif?>

                                                    <div class="coupon-image">
                                                        <div class="overlay">
                                                            <?=$rows_data[1]['BusName']?>
                                                        </div>
                                                        <a href="/modalcoupon/<?=$rows_data[1]['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                            <img src="<?=$rows_data[1]['img_coupon']?>"  width="155" height="125" alt=""
                                                                 title=""/></a>
                                                    </div>

                                                    <div class="coupon-context">

                                                        <div class="fz large"><strong><?=$rows_data[1]['name']?></strong></div>
                                                        <small><?=$rows_data[1]['secondname']?></small>

                                                        <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data[1]['dateoff']), 'j %MONTH% Y'); ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endif?>
                                </div>

                                <br/>
                            <?endforeach?>

                        </div>

                    </div>
                </div>




                <div class="row">
                    <div class="panel panel-media">

                        <div class="panel-heading">
                            <hr/>
                            <div class="panel-title">Обзоры</div>

                            <a class="menu-toggle" role="button" data-toggle="collapse" href="#nav-review"
                               aria-controls="nav-review">
                                <i class="fa fa-bars"></i>
                            </a>


                            <div class="collapse" id="nav-review">
                                <ul class="nav nav-pills" role="tablist">

                                    <li role="presentation" class="active"><a href="/articles" >Новые</a></li>
                                    <?foreach($section as $row_category):?>

                                        <li role="presentation" class=""><a href="/articles/<?=$row_category['url']?>" ><?=$row_category['name']?></a></li>

                                    <?endforeach?>

                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">


                            <?foreach($data_articles as $rows_data):?>

                                <div>
                                    <?if (!empty($rows_data['CatUrl'])):?>
                                        <a href="/articles/<?=$rows_data['CatUrl']?>" class="fz medium"><?=$rows_data['CatName']?></a>
                                    <?endif?>
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="/article/<?=$rows_data['url']?>">
                                                <img src="/uploads/img_articles/thumbs/<?=basename($rows_data['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$rows_data['name']?>"/>
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h2 class="media-heading"><a href="/article/<?=$rows_data['url']?>"><strong><?=$rows_data['name']?></strong></a></h2>

                                            <p class="fz medium"><strong><?=$rows_data['secondname']?></strong>
                                            </p>

                                            <?=Text::limit_chars(strip_tags($rows_data['content']), 200, null, true)?>
                                        </div>
                                    </div>
                                </div>

                                <hr/>
                            <?endforeach?>

                        </div>


                    </div>
                </div>


            </div>


            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>


    </div>

</content>