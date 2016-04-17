<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 03.08.2015
 * Time: 18:05
 */

?>

<content>
    <div id="content">

        <div class="top">

            <div class="top-image">
                <a href="/article/<?=$articles['top_articles']['url']?>"><img src="<?=$articles['top_articles']['images_article']?>" width="600" height="420" class="img-responsive" alt="<?=$articles['top_articles']['secondname']?>"/></a>

                <div class="top-image-text">
                    <h2><a href="/article/<?=$articles['top_articles']['url']?>"><?=$articles['top_articles']['name']?></a></h2>
                    <?=$articles['top_articles']['secondname']?>
                </div>
            </div>

            <div class="top-list">

                <?foreach($articles['articles'] as $rows_articles):?>
                    <div class="media">
                        <div class="media-left">
                            <a href="/article/<?=$rows_articles['url']?>">
                                <img src="/uploads/img_articles/thumbs/<?=basename($rows_articles['images_article'])?>" width="120" height="85" class="media-object" alt="<?=$rows_articles['name']?>"/>
                            </a>
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading"><a href="/article/<?=$rows_articles['url']?>"><strong><?=$rows_articles['name']?></strong></a></h2>

                            <p class="hidden-xs"><?=$rows_articles['short_previev']?></p>                        
                        </div>
                        
                    </div>
                <?endforeach?>
                
                
                
                <!-- четвертый анонс, показывать только на 1200  --> 
                <div class="media-left hidden-xs">
                <br>
                            <a href="/article/telaviv_big_trip">
                                <img src="/uploads/img_articles/thumbs/artic_570408dddc6a9.jpg" width="120" height="85" class="media-object" alt="<?=$rows_articles['name']?>"/>
                            </a>
                        </div>
                        <div class="media-body hidden-xs">
                        <br>
                            <h2 class="media-heading"><a href="/article/telaviv_big_trip"><strong>Большой Тель-Авив – не только шопинг</strong></a></h2>

                            <p class="hidden-xs">В каждом городе, даже самом большом, есть заветные уголки, не отмеченные на туристических картах, которые известны даже не всем его жителям, не говоря уже о приезжих и туристах.</p>                        
                        </div>
                        
                      
                        
                        
                        
                        

                <div class="text-center media">
                    <a href="/articles" class="btn open-all" role="button">Открыть все</a>
                </div>
            </div>
        </div>

        <div class="panel panel-micronews gallery w-bloc-micronews">

            <div class="panel-heading">

                <div class="panel-title">Новости</div>
                
            </div>

            <div class="panel-body">
                <div class="owl-carousel w-micronews-carusel">

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">

                                        <div class="micronews-title"><a href="/business/RZR_extrim_dead_sea">RZR на Мертвом море</a></div>
                                        <div class="micronews-text">Остались последние места для самостоятельной семейной прогулки на квадроциклах в дни Песаха. Поспешите записаться по телефону: 054-4980941. Условие: наличие водительских прав.</div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">
                                        
                                        <div class="micronews-title">Monic kids - новая коллекция детской одежды </div>
                                        <div class="micronews-text">Новая коллекция к весенне-летнему сезону зарубежного производства. Телефон: 03-5182145. </div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">

                                        <div class="micronews-title">В магазине  одежды Carhartt</div>
                                        <div class="micronews-text">Сезонная распродажа зимних курток с большими скидками! Телефон: 04-6767640.</div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">

                                        <div class="micronews-title">Магазин велосипедов Pinky Park </div>
                                        <div class="micronews-text">Электровелосипеды к летнему сезону по выгодным ценам. Телефон: 03-5059520.</div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">

                                        <div class="micronews-title">City boutique - распродажа - 99 шекелей</div>
                                        <div class="micronews-text"> Платьев, одежды, обуви, сумок  и аксессуаров по цене не выше 99 шекелей. Телефон: 03-5606061.</div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">

                                        <div class="micronews-title">Qumran - скидки на косметические препараты</div>
                                        <div class="micronews-text">REVIVAL, AHAVA, PREMIER, AROMA, DEAD SEA, EDOM. Телефон: 02-9936330.</div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="micronews-layer">
                            <div class="micronews micronews-small">
                                <div class="micronews-body">

                                    <div class="micronews-content">

                                        <div class="micronews-title">Ravkat - самые дешевые цены в Израиле на товары для малышей</div>
                                        <div class="micronews-text"> - tax free: полный комплект для роженицы и новорожденного, коляски лучших фирм детские кресла саль-каль для машины, постельные комплекты HELLO KITTY, одежда и обувь для мальчиков и девочек.</div>

                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                </div>
            </div>

        </div>  

        <div class="panel panel-coupons gallery w-bloc-coupons">

            <div class="panel-heading">

                <a class="menu-toggle" role="button" data-toggle="collapse" href="#coupons-gallery-navigation"
                   aria-controls="coupons-gallery-navigation">
                    <i class="fa fa-bars"></i>
                </a>

                <a class="panel-title" href="/coupons">Купоны</a>

                <div class="collapse" id="coupons-gallery-navigation">

                    <ul class="nav nav-pills panel-navigation">

                        <li class="active"><a class="w-coupon-section" href="#">Новые</a></li>
                        <?foreach ($section_coupons as $row_section):?>
                            <li><a href="/coupons/<?=$row_section['url']?>" class="w-coupon-section" data-sectcop="<?=$row_section['url']?>"><?=$row_section['name']?></a></li>
                        <?endforeach?>

                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <div class="owl-carousel w-coupon-carusel">


                    <?foreach ($coupons['data'] as $rows_coupon):?>

                        <div class="coupon-layer">
                            <div class="coupon coupon-small">

                                <?if (!empty($rows_coupon['coupon_favorit']))://если купон добавлен в избранное?>
                                    <a href="#" data-toggle="tooltip" data-placement="left" title="Купон уже в Избранном" class="pin">
                                        <i class="fa fa-star" style="color: #E44F44"></i>
                                    </a>
                                <?else:?>
                                    <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_coupon['id']?>" title="Добавить в Личный кабинет" class="pin w-add-coupon-favor">
                                        <i class="fa fa-star"></i>
                                    </a>
                                <?endif?>

                                <div class="coupon-body">

                                    <div class="coupon-content">

                                        <div class="coupon-content-heading">
                                            <?=$rows_coupon['BusName']?>
                                        </div>
                                        <a href="/modalcoupon/<?=$rows_coupon['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image">
                                            <img src="<?=$rows_coupon['img_coupon']?>" width="155" height="125" alt="" title="Посмотреть полный купон"/>
                                        </a>

                                    </div>

                                    <div class="coupon-sidebar">
                                        <a href="/modalcoupon/<?=$rows_coupon['id']?>"  data-toggle="modal" data-target=".bs-coupon-modal-sm" class="coupon-image" title="Посмотреть полный купон">
                                            <div class="coupon-sidebar-content">
                                                <div class="coupon-sidebar-heading">
                                                    <div class="coupon-object-top">

                                                        <div class="coupon-title">
                                                            <?=$rows_coupon['name']?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="coupon-sidebar-body">
                                                    <div class="coupon-object-middle">

                                                        <div class="coupon-title">
                                                            <?=$rows_coupon['secondname']?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="coupon-sidebar-footer">

                                                    <div class="coupon-object-bottom">

                                                        <!--<small class="coupon-date">до <?=Date::rusdate(strtotime($rows_coupon['dateoff']), 'j %MONTH% Y'); ?></small>-->
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?endforeach?>


                </div>
            </div>

        </div>

        <br/>

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">

                <div id="context">
                    <?foreach($data as $key => $rowsdata):?>


                        <div class="panel panel-thumbnails w-bloc-section">

                            <div class="panel-heading">

                                <a class="menu-toggle" role="button" data-toggle="collapse"
                                   href="#<?=$rowsdata['category'][0]['url']?>-thumbnails-navigation"
                                   aria-controls="<?=$rowsdata['category'][0]['url']?>-thumbnails-navigation">
                                    <i class="fa fa-bars"></i>
                                </a>

                                <a class="panel-title" href="/section/<?=$rowsdata['category'][0]['url']?>"><?=$rowsdata['category'][0]['name']?></a>

                                <div class="panel-buttons-group">

                                    <select class="form-control w-select-city" name="city">
                                        <option value="">По городам</option>
                                        <?foreach($rowsdata['city'] as $key_id => $row_city):?>
                                            <option value="<?=$key_id?>"><?=$row_city?></option>
                                        <?endforeach?>
                                    </select>

                                    <a href="/maps?section=<?=$rowsdata['category'][0]['url']?>" class="btn btn-default" role="button">На карте</a>
                                </div>

                                <div class="collapse" id="<?=$rowsdata['category'][0]['url']?>-thumbnails-navigation">

                                    <ul class="nav nav-pills panel-navigation w-category-bloc">
                                        <li class="active"><a href="/section/<?=$rowsdata['category'][0]['url']?>" data-section="<?=$rowsdata['category'][0]['url']?>" class="w-home-cat w-cat-active">Новые</a></li>

                                        <?foreach($rowsdata['category'][0]['childs'] as $row_category):?>
                                            <li><a href="/section/<?=$rowsdata['category'][0]['url'].'/'.$row_category['url']?>" data-cat="<?=$row_category['url']?>" class="w-home-cat"><?=$row_category['name']?></a></li>

                                        <?endforeach?>
                                        <li><a href="/section/<?=$rowsdata['category'][0]['url']?>">ещё...</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body slider">

                                <?//die(HTML::x($rowsdata['data']))?>
                                <?foreach ($rowsdata['data'] as $rows):?>
                                    <div class="col-sm-4">
                                        <div class="thumbnail">

                                            <?if (!empty($rows['bussines_favorit']))://если бизнес добавлен в избранное?>
                                                <a href="#" data-toggle="tooltip" data-placement="left" title="Место уже в Избранном" class="pin">
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
                                
                                <a href="/section/<?=$rowsdata['category'][0]['url']?>" class="btn open-all" role="button">Открыть все</a>
                            </div>


                        </div>
                        <hr/>

                    <?endforeach?>

                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>
        
        
          <!-- partners 
      
        
        <div class="panel panel-partners w-bloc-partners">

            <div class="panel-heading">

                <div class="panel-title">Наши партнеры</div>
                
            </div>

            <div class="panel-body">

                <div class="partners-content">
                                        
                    <div class="partners-img"><img src="/public/images/logo-new.png"></div>
                    <div class="partners-line"></div>
                    <div class="partners-title">ТОПизраиль</div>

                </div>
                
                <div class="partners-content">
                                        
                    <div class="partners-img"><img src="https://tpc.googlesyndication.com/simgad/2172393764281850819"></div>
                    <div class="partners-line"></div>
                    <div class="partners-title">Интернет магазин</div>

                </div>

                <div class="partners-content">
                                        
                    <div class="partners-img">
                        <img src="http://4.bp.blogspot.com/-FY2aK-Z2tdA/TWcI4_z5jUI/AAAAAAAAACs/yPR1Hm6ITmE/s1600/ebay+logo.png">
                    </div>
                    <div class="partners-line"></div>
                    <div class="partners-title">Что то еще</div>

                </div>

                <div class="partners-content">
                                        
                    <div class="partners-img"><img src="/public/images/logo-new.png"></div>
                    <div class="partners-line"></div>
                    <div class="partners-title">ТОПизраиль</div>

                </div>

                <div class="partners-content">
                                        
                    <div class="partners-img">
                        <img src="http://4.bp.blogspot.com/-FY2aK-Z2tdA/TWcI4_z5jUI/AAAAAAAAACs/yPR1Hm6ITmE/s1600/ebay+logo.png">
                    </div>
                    <div class="partners-line"></div>
                    <div class="partners-title">Что то еще</div>

                </div>
                
                
                
            </div>
            
            

        </div>
        
                    --->


    </div>
</content>