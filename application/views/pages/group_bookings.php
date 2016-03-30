<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 31.07.2015
 * Time: 15:20
 */

?>

<style>
    .error{
        color: red;
    }
</style>

<content>
    <div id="content">

        <div class="page-contacts">


            <div class="page-heading">

                <span class="w-convert-contact plane hidden-xs"></span>

                <div>
                    <div class="page-title">Групповые заказы</div>
                    <?if (empty($_GET['susses'])):?>
                        <div class="page-context">

                            <p>Команда TopIsrael поможет вам организовать самый лучший отдых в Израиле, по привлекательным ценам.</p>

                            <p>Если у вас группа от 10 человек и более, мы сможем приятно удивить вас. Подходит для туристов и израильтян.</p>

                            <p>Только мы имеем эксклюзивные договора с более 500 бизнесами из сфере отдыха и развлечений, по всему Израилю, которые предоставили нам особые, выгодные цены для групп. Подробная информация о каждом бизнесе представлена на сайте, в соответствующих разделах.</p>

                            <p>Предоставьте нам возможность спланировать ваши развлечения, вкусную еду, покупки и проживание. Получите удовольствие и сэкономьте на групповых заказах.</p>

                            <p>Отправьте нам письмо или позвоните по телефону <nobr>+972-52-5512121</nobr>.</p>

                            <p>Пожалуйста, напишите подробнее ваши пожелания и мы предоставим наиболее точную информацию с подходящими для вас вариантами.</p>

                        </div>
                    <?endif?>
                </div>

            </div>

            <?if (empty($_GET['susses'])):?>
                <form class="row" method="post" id="w-form-contact">

                    <div class="col-md-12">
                        <div class="form-title">Форма связи</div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-5">
                            <label>Ваше полное имя:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" value="<?=isset($post['fullname']) ? $post['fullname'] : ''?>" name="fullname" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-md-5">
                            <label>Страна проживания:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" value="<?=isset($post['city']) ? $post['city'] : ''?>" name="city" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group  clearfix">
                        <div class="col-md-5">
                            <label>Email:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" value="<?=isset($post['email']) ? $post['email'] : ''?>" name="email" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group  clearfix">
                        <div class="col-md-5">
                            <label>Телефон:</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" value="<?=isset($post['tel']) ? $post['tel'] : ''?>" name="tel" class="form-control input-lg">
                        </div>
                    </div>

                    <div class="form-group  clearfix">
                        <div class="col-md-4">
                            <label>Ваше сообщение:</label>
                        </div>
                        <div class="col-md-8">
                            <textarea class="form-control input-lg" name="desc" cols="3" rows="7"><?=isset($post['desc']) ? $post['desc'] : ''?></textarea>
                        </div>
                    </div>
                    <div class="form-group  clearfix">
                        <div class="col-md-5">
                            <label>Код</label>
                        </div>
                        <div class="col-md-7">
                            <span style="display: inline-block;"><?=$captcha; ?></span> <input type="text" name="captcha" class="form-control input-lg" style="width: 49%;display: inline-block;"/>
                            <?if (!empty($err_cap)):?>
                                <label id="captcha-error" class="error" for="captcha">Неверно введен проверочный код</label>
                            <?endif?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-danger btn-lg pull-right">Отправить</button>
                    </div>

                </form>
            <?else:?>

                <h2 style="color: #009900"><i> Ваш запрос отправлен. Спасибо за обращение к нам!</i></h2>
            <?endif?>
        </div>

    </div>
</content>

