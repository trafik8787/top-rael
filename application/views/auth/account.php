<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 02.08.2015
 * Time: 23:15
 */

?>
<style>
    .input-group-addon {

        padding: 6px 12px!important;
        font-size: 14px!important;
        font-weight: 400!important;
        line-height: 1!important;
        color: #555!important;
        text-align: center!important;
        background-color: #eee!important;
        border: 1px solid #ccc!important;
        border-radius: 4px!important;
    }

    .input-group-addon:last-child {
        border-left: 0!important;
    }


    .input-group {
        position: relative!important;
        display: table!important;
        border-collapse: separate!important;
    }

    .input-group-addon, .input-group-btn {
        width: 1%!important;
        white-space: nowrap!important;
        vertical-align: middle!important;
    }

    .input-group-addon, .input-group-btn, .input-group .form-control {
        display: table-cell!important;
    }
</style>
<script>
    //открытие нужной вкладки по якорю
    $(function () {
        var hash = window.location.hash;
        hash && $('ul.pull-left a[href="' + hash + '"]').tab('show');
        hash && $('ul.pull-right a[href="' + hash + '"]').tab('show');



        $(document).on('click', 'ul.pull-right a', function(){
            $('ul.pull-left li').removeClass('active');

        });

        $(document).on('click', 'ul.pull-left a', function(){
            $('ul.pull-right li').removeClass('active');

        });


       $('#myModalLotaryProfile').modal('show');

        $('.w-datetimepicer').datetimepicker({
            locale: 'ru',
            format: 'DD-MM-YYYY',
            defaultDate: 'moment'
        });

        //$.validator.setDefaults({ ignore: ":hidden:not(input)" });





        $('.w-form-profile-lotery').validate({
            rules: {

                //                old_photo: {
                //                    required:  true
                //
                //                },

                name:{
                    required: true,
                    minlength: 3
                },
                secondname:{
                    required: true,
                    minlength: 3
                },

                city:{
                    required: true
                },

                tel:{
                    required: true
                }



            },

            messages: {

                //                old_photo: {
                //                    required: "Загрузите пожалуйста"
                //                },

                name:{
                    required: "Это поле обязательно для заполнения",
                    minlength: "Имя должно быть не менее 3 символов"
                },

                secondname:{
                    required: "Это поле обязательно для заполнения",
                    minlength: "Фамилия должна быть не менее 3 символов"
                },

                city:{
                    required: "Это поле обязательно для заполнения"
                },

                tel:{
                    required: "Это поле обязательно для заполнения"
                }
            },

            submitHandler: function(form)
            {


                var progressBar = $('#progressbar');
                var $that = $('.w-form-profile-lotery');

                formData = new FormData($that.get(0));


                $.ajax({ // описываем наш запрос
                    type: "POST", // будем передавать данные через POST
                    dataType: "text", // указываем, что нам вернется JSON
                    url: '/account',
                    contentType: false, // важно - убираем форматирование данных по умолчанию
                    processData: false, // важно - убираем преобразование строк по умолчанию
                    data: formData,
                    xhr: function(){
                        var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
                        progressBar.parents('.progress').show();
                        xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
                            if(evt.lengthComputable) { // если известно количество байт
                                // высчитываем процент загруженного
                                var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                                // устанавливаем значение в атрибут value тега <progress>
                                // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
                                //progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
                                progressBar.attr('aria-valuenow', percentComplete);
                                progressBar.css('width', percentComplete+'%');
                                progressBar.text(percentComplete+'%');

                            }
                        }, false);

                        xhr.addEventListener("load", function(evt) {

                            progressBar.parents('.progress').delay(800).fadeOut();
                            $('.w-save-info').show();
                            $('#myModalLotaryProfile .modal-body').delay(3000).empty();
                            $('#myModalLotaryProfile .modal-body').html('<h3>Спасибо! Ваши данные отправлены администрации сайта. Мы скоро свяжемся с вами.</h3><p class="text-center"><button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button></p>');
                            $('.w-save-info').delay(3000).fadeOut();
                        }, false);


                        return xhr;
                    },
                    success: function(response) { // когда получаем ответ

                    }
                });

                return false;
                //$('#myModalLotaryProfile').modal('hide');

            }

        });



    });




</script>
<content>


    <div id="content">

        <?if (!empty($lotery_checen) and (empty($user->name) or empty($user->secondname) or empty($user->city) or empty($user->tel))):?>
            <div class="modal fade" id="myModalLotaryProfile" data-backdrop="static" role="dialog" aria-labelledby="W-myModalLabel"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="W-myModalLabel"><strong>Удача улыбнулась Вам!</strong></h4>
                        </div>
                        <div class="modal-body">
                            <span style="font-size: 16px">
                            <p>Поздравляем! Ваш e-mail <strong><?=$user->email?></strong> выиграл приз - <?=$lotery_checen[0]['loteryName']?></p>

                            <p>Заполните все поля в анкете и мы свяжемся с вами для вручения приза.</p>
                            </span>
                            <form role="form" method="post" class="w-form-profile-lotery" action="/account" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="inputFoto" class="control-label"><img src="<?=!empty($photo) ? $photo : '/public/uploade/no_avatar.jpg'?>" width="50" height="50" class="img-circle"/></label>
                                    <input type="hidden" name="old_photo" value="<?=$photo?>">
                                    <input  type="file"  id="inputFoto" class="form-control" value="" name="avatar">

                                </div>


                                <div class="form-group">
                                    <label for="inputName" class="control-label">Имя</label>
                                    <input name="name"  id="inputName" class="form-control" value="<?=$user->name?>" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="inputSecondname" class="control-label">Фамилия</label>
                                    <input name="secondname" id="inputSecondname" class="form-control" value="<?=$user->secondname?>" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="inputCity" class="control-label">Город</label>
                                    <input name="city" id="inputCity" class="form-control" value="<?=$user->city?>" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="inputTel" class="control-label">Телефон</label>
                                    <input name="tel" id="inputTel"  class="form-control" value="<?=$user->tel?>" pattern="(\+?\d[- .]*){7,13}"  title="Международный, государственный или местный телефонный номер" type="tel">
                                </div>

                                <div class="form-group" style="height: 55px;">
                                    <label for="bdate" class="control-label">Дата рождения</label>
                                    <div class="input-group date  w-datetimepicer">
                                        <input name="bdate" id="bdate" data-placement="bottom"  class="form-control  w-datetimepicer" value="<?=date('d-m-Y', strtotime($user->bdate))?>" type="text">
                                    </div>
                                </div>



                                <div class="checkbox">
                                    <label>
                                        <input style="position: relative;margin-left: 0;" name="lotery" <?if ($user->suses_lotery != 0):?> checked <?endif?> type="checkbox" value="<?=$lotery_checen[0]['lotery']?>"> <strong>Показать в победителях</strong>
                                    </label>
                                </div>
                                <div class="progress" style="margin-top: 5px; display: none">
                                    <div class="progress-bar" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        0%
                                    </div>
                                </div>
                                <button type="submit" name="profil" value="1" class="btn btn-primary w-modal-profil">Сохранить</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        <?endif?>


        <div class="user-container">

            <div class="user-profile">
                <?if (empty($user)):?>

                    <div class="text-center">
                        <div><strong><i>Добро пожаловать! Вы зашли как “Анонимный” пользователь. Выполните “Вход” или “Регистрацию”.</i></strong></div>
                        <div><i>Анонимно вы можете лишь временно сохранить Купоны, Места или Статьи</i></div>


                        <br/>

                        <a href="/account/login" class="btn btn-primary btn-lg btn-lg pin-aria">
                            <span class="pin"><i class="fa fa-lock"></i></span>
                            <strong><i>Вход</i></strong>
                        </a>
                        &nbsp; <strong><i>или</i></strong> &nbsp;

                        <a href="/account/registration" class="btn btn-primary btn-lg pin-aria">
                            <span class="pin"><i class="fa fa-pencil"></i></span>
                            <strong><i>Регистрация</i></strong>
                        </a>

                    </div>


                <?else:?>


                    <div class="user-object  user-avatar">
                        <?if (!empty($user->photo)):?>
                            <img src="<?=$user->photo?>" width="90" height="90" alt=""
                             class="img-circle">
                        <?else:?>
                            <img src="/public/uploade/no_avatar.jpg" width="90" height="90" alt=""
                                 class="img-circle">
                        <?endif?>
                    </div>

                    <div class="user-object">
                        <small>Добро пожаловать</small>
                        <strong class="user-name"><?=!empty($user->name) ? $user->name : $user->username?> <?=$user->secondname?></strong>
                    </div>

                    <?if (!empty($user->bdate)):?>
                        <div class="user-object">
                            <small>Год рождения</small>
                            <strong>
                                <?=$user->bdate?>
                            </strong>
                        </div>
                    <?endif?>

                    <?if (!empty($user->city)):?>
                        <div class="user-object">
                            <small>Место проживания</small>
                            <strong><?=$user->city?></strong>
                        </div>
                    <?endif?>

<!--                    <div class="user-object">-->
<!--                        <small>Семейное положение</small>-->
<!--                        <strong>Замужем</strong>-->
<!--                    </div>-->

                    <div class="user-object user-logout">
                        <a href="/account/logout" class="btn btn-primary btn-lg pin-aria">
                            <span class="pin"><i class="fa fa-sign-out"></i></span>
                            <strong><i>Выход</i></strong>
                        </a>
                    </div>


                <?endif?>

            </div>

            <div class="user-navigation">
                <ul class="pull-left">
                    <li class="active">
                        <a href="#coupons" class="pin-aria" data-toggle="tab">
                            <span class="pin"><i class="fa fa-thumb-tack"></i></span>
                            Купоны
                        </a>
                    </li>

                    <li>
                        <a href="#izbran" class="pin-aria" data-toggle="tab">
                            <span class="pin"><i class="fa fa-star"></i></span>
                            Избранные места
                        </a>
                    </li>

                    <li>
                        <a href="#articles" class="pin-aria" data-toggle="tab">
                            <span class="pin"><i class="fa fa-file-text"></i></span>
                            Статьи
                        </a>
                    </li>


                </ul>

                    <ul class="pull-right">
                        <?if (!empty($user)): //если пользователи ?>
                            <li>
                                <a href="#profile" class="pin-aria" data-toggle="tab">
                                    <span class="pin"><i class="fa fa-user"></i></span>
                                    Профиль
                                </a>
                            </li>
                        <?endif?>
                        <li>
                            <a href="#subscribers" class="pin-aria" data-toggle="tab">
                                <span class="pin"><i class="fa fa-paper-plane"></i></span>
                                Рассылка
                            </a>
                        </li>
                    </ul>

            </div>

        </div>




        <div id="context">

            <div class="tab-content">


                <!--coupons-->
                <div class="panel panel-coupons tab-pane fade in active" id="coupons">

                    <div class="panel-body">



                        <?if (!empty($favorit_coupon)):?>

                            <?foreach($favorit_coupon as $rows_data_coupon):?>

                                <div class="clearfix">

                                    <?foreach ($rows_data_coupon as $rows_data_coupon_favor):?>

                                        <div class="col-md-4 col-sm-6">

                                            <div class="coupon coupon-big">

                                                <a href="#" data-id="<?=$rows_data_coupon_favor['id']?>" class="pin w-delete-coupon-favor"><i class="fa fa-trash"></i></a>

                                                <div class="coupon-body">

                                                    <div class="coupon-content">

                                                        <div class="coupon-content-heading">
                                                            <?=$rows_data_coupon_favor['BusName']?>
                                                        </div>
                                                        <a class="coupon-image" href="/modalcoupon/<?=$rows_data_coupon_favor['id']?>" data-toggle="modal" data-target=".bs-coupon-modal-sm">
                                                            <img src="<?=$rows_data_coupon_favor['img_coupon']?>" width="155" height="125" alt="" title=""/>
                                                        </a>
                                                    </div>

                                                    <div class="coupon-sidebar">
                                                        <div class="coupon-sidebar-content">
                                                            <div class="coupon-sidebar-heading">
                                                                <div class="coupon-object-top">

                                                                    <div class="coupon-title">
                                                                        <?=$rows_data_coupon_favor['name']?>
<!--                                                                        <small class="block">--><?//=$rows_data_coupon_favor['name']?><!--</small>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="coupon-sidebar-body">
                                                                <div class="coupon-object-middle">

                                                                    <div class="coupon-title">
                                                                        <?=$rows_data_coupon_favor['secondname']?>
<!--                                                                        <span class="block">скидка</span>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="coupon-sidebar-footer">

                                                                <div class="coupon-object-bottom">

                                                                    <small class="coupon-date">до <?=Date::rusdate(strtotime($rows_data_coupon_favor['dateoff']), 'j %MONTH% Y'); ?></small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach?>

                                </div>

                            <?endforeach?>

                        <?else:?>
                        <div class="col-md-12">
                            <span class="text-center"><h2 style="color: #ccc">Здесь размещаются купоны которые вы добавите в избранное</h2></span>
                        </div>
                        <?endif?>

                        <br/>

                    </div>

                </div>


                <!--busines-->
                <div class="panel panel-thumbnails tab-pane fade" id="izbran">

                    <div class="panel-body">


                        <?if (!empty($favorits_bussines)):?>

                            <?foreach($favorits_bussines as $rows_data_bus):?>
                                <div class="clearfix">
                                    <?foreach ($rows_data_bus as $rows_business_favor):?>
                                        <div class="col-md-3 bussines">
                                            <div class="thumbnail">

                                                <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_business_favor['id']?>" class="pin w-delete-bussines-favor">
                                                    <i class="fa fa-trash"></i>
                                                </a>


                                                <a href="/business/<?=$rows_business_favor['url']?>" class="thumbnail-image">
                                                    <img src="<?=$rows_business_favor['home_busines_foto']?>" width="240" height="150" alt="<?=$rows_business_favor['name']?>">
                                                </a>


                                                <div class="thumbnail-content">
                                                    <h2 class="thumbnail-title">
                                                        <a href="/business/<?=$rows_business_favor['url']?>"><?=$rows_business_favor['name']?></a>
                                                        <small><?=$rows_business_favor['address']?></small>
                                                    </h2>

                                                    <?=Text::limit_chars(strip_tags($rows_business_favor['info']), 150, null, true)?>

                                                </div>
                                            </div>
                                        </div>
                                    <?endforeach?>
                                </div>
                            <?endforeach?>
                        <?else:?>
                            <div class="col-md-12">
                                <span class="text-center"><h2 style="color: #ccc">Здесь размещаются бизнесы которые вы добавите в избранное</h2></span>
                            </div>
                        <?endif?>


                    </div>
                </div>



                <div class="panel panel-thumbnails tab-pane fade" id="articles">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <?if (!empty($favorits_articles)):?>
                                <?foreach($favorits_articles as $rows_data_artic):?>
                                    <div class="list-item">
                                        <a href="#" data-toggle="tooltip" data-placement="left" data-id="<?=$rows_data_artic['id']?>" class="pin w-delete-article-favor">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        <div class="media">

                                            <div class="media-left">

                                                <a href="/article/<?=$rows_data_artic['url']?>">
                                                    <img src="/uploads/img_articles/thumbs/<?=basename($rows_data_artic['images_article'])?>" width="260" height="190" class="media-object" alt="<?=$rows_data_artic['name']?>"/>
                                                </a>

                                            </div>

                                            <div class="media-body">

                                                <h2 class="media-heading">
                                                    <a href="/article/<?=$rows_data_artic['url']?>"><strong><?=$rows_data_artic['name']?></strong></a>
                                                    <small><?=$rows_data_artic['secondname']?></small>
                                                </h2>

                                                <?=Text::limit_chars(strip_tags($rows_data_artic['content']), 350, null, true)?>

                                            </div>
                                        </div>
                                        <hr/>
                                    </div>

                                <?endforeach?>
                            <?else:?>
                                <div class="col-md-12">
                                    <span class="text-center"><h2 style="color: #ccc">Здесь размещаются статьи которые вы добавите в избранное</h2></span>
                                </div>
                            <?endif?>
                        </div>
                    </div>
                </div>

                <?if (!empty($user)): //если пользователи ?>
                    <div class="panel panel-thumbnails tab-pane fade" id="profile">
                        <div class="panel-body">
                            <div class="col-md-12">

                                <form class="form-horizontal w-form-profile-lotery" role="form" method="post" action="/account" enctype="multipart/form-data">
                                    <div class="form-group">

                                        <label for="inputEmail" class="col-sm-1 control-label">E-mail</label>
                                        <div class="col-md-5">
                                            <input type="text" id="inputEmail"  class="form-control" disabled="disabled" value="<?=$user->email?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFoto" class="col-sm-1 control-label"><img src="<?=!empty($photo) ? $photo : '/public/uploade/no_avatar.jpg'?>" width="50" height="50" class="img-circle"/></label>
                                        <div class="col-md-5">
                                            <input type="hidden" name="old_photo" value="<?=$photo?>">
                                            <input  type="file"  id="inputFoto" class="form-control" value="" name="avatar">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-1 control-label">Имя</label>
                                        <div class="col-md-5">
                                            <input name="name"  id="inputName" class="form-control" value="<?=$user->name?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputSecondname" class="col-sm-1 control-label">Фамилия</label>
                                        <div class="col-md-5">
                                            <input name="secondname" id="inputSecondname" class="form-control" value="<?=$user->secondname?>" type="text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCity" class="col-sm-1 control-label">Город</label>
                                        <div class="col-md-5">
                                            <input name="city" id="inputCity" class="form-control" value="<?=$user->city?>" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTel" class="col-sm-1 control-label">Телефон</label>
                                        <div class="col-md-5">
                                            <input name="tel" id="inputTel"  class="form-control" value="<?=$user->tel?>" pattern="(\+?\d[- .]*){7,13}"  title="Международный, государственный или местный телефонный номер" type="tel">

                                        </div>
                                    </div>

                                    <div class="form-group">


                                        <label for="bdate" class="col-sm-1 control-label">Дата рождения</label>
                                        <div class="col-md-5">
                                            <input name="bdate" class="form-control w-datetimepicer" value="<?=date('d-m-Y', strtotime($user->bdate))?>" type="text">
                                        </div>


                                    </div>



                                    <?if (!empty($lotery_checen)):?>


                                        <div class="form-group">
                                            <div class="col-md-offset-1 col-md-5">
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="lotery" <?if ($user->suses_lotery != 0):?> checked <?endif?> type="checkbox" value="<?=$lotery_checen[0]['lotery']?>"> Показать в победителях
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    <?endif?>

                                    <div class="form-group">
                                        <span class="col-sm-1 control-label">Последнее посещение</span>
                                        <div class="col-md-5">
                                            <span><?= Date::fuzzy_span($user->last_login); ?></span>
                                        </div>
                                    </div>

                                    <div class="form-group">


                                        <div class="col-sm-offset-1 col-sm-5">
                                            <div class="progress" style="margin-top: 5px; display: none">
                                                <div class="progress-bar" id="progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                    0%
                                                </div>
                                            </div>

                                            <button type="submit" name="profil" value="1" class="btn btn-primary">Сохранить</button>
                                            <span style="color: green; display: none" class="w-save-info"><strong>Информация сохранена!</strong></span>
                                        </div>
                                    </div>


                                </form>
                                
                                
                                <hr/>
                                <? if (isset($_GET['changeok'])) {
                                    echo "Новый пароль был успешно сохранен<hr />";
                                } ?>
                                <? if (isset($_GET['changefalse'])) {
                                    echo "Старый пароль введен не верно или новый пароль слишком слабый<hr />";
                                } ?>
                                <form class="form-horizontal" role="form" action="/account/changepass" method="post">
                                    <h3>Смена пароля</h3>
                                    <div class="form-group">
                                        <label for="inputSpas" class="col-sm-1 control-label">Старый пароль</label>
                                        <div class="col-md-5">
                                            <input name="oldpassword" id="inputSpas"  class="form-control" value="" type="password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputPas" class="col-sm-1 control-label">Новый пароль</label>
                                        <div class="col-md-5">
                                            <input name="newpassword" id="inputPas"  class="form-control" value="" type="password">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-sm-offset-1 col-sm-5">
                                            <button type="submit" class="btn btn-primary">Изменить пароль</button>
                                        </div>
                                    </div>

                                </form>



                                <hr/>
                                <a href="/account/logout" class="btn btn-primary">Выйти</a>


                            </div>
                        </div>
                    </div>
                <?endif?>

                <div class="panel panel-thumbnails tab-pane fade" id="subscribers">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <?=isset($panel_subscribe)? $panel_subscribe: ''?>
                        </div>
                    </div>
                </div>

            </div>


        </div>

    </div>

</content>