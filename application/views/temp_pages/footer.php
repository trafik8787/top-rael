<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */
?>






<style>

    #email-error {
        display: block!important;
    }

</style>

<footer>





    <div class="panel panel-footer">

        <div class="panel-heading">

            <div class="col-md-7 col-sm-6">
                <span class="w-logo-footer"></span>
            </div>
            <div class="col-md-5 text-right hidden-xs" style="top: -10px;">

                <h4 class="text-right"><a href="/newsletter" style="color: #ffffff">Почтовая рассылка &mdash; новое за неделю</a></h4>
                <form role="form" class="form-inline w-bloc-futer-subscribe">

                    <div class="form-group" style="height: 33px;">
                        <input type="email" style="width: 236px;" class="form-control w-input-email-subcribe" name="email" placeholder="Email">
                    </div>
                    <button value="1" type="submit" class="btn btn-default w-subskrip-buton">Подписатся</button>
                </form>
            </div>
        </div>

        <div class="panel-body">
            <div class="col-md-7">

                <div class="row">

                    <div class="col-sm-4">
                        <nav>
                            <ul>
                                <li><a href="/">ГЛАВНАЯ</a></li>
                                <?foreach($general_meny as $row_meny):?>
                                    <li><a href="/section/<?=$row_meny['url']?>"><?=$row_meny['name']?></a></li>
                                <?endforeach?>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-sm-4">
                        <nav>
                            <ul>
                                <li style="margin-left:-20px;"><a href="/group_bookings" title="Групповые заказы с скидкой на развлечения и отдых в израиле"><span class="glyphicon glyphicon-flag" aria-hidden="true" ></span> Групповые заказы</a></li>
                                <?foreach ($top_meny as $name=>$url):?>
                                    <li><a href="<?=$url?>"><?=$name?></a></li>
                                <?endforeach?>
                                <li><a href="/maps" title="Развлечения, еда и шопинг израиля на карте">На карте</a></li>


                            </ul>
                        </nav>
                    </div>

                    <div class="col-sm-4">
                        <nav>
                            <ul>

                                <li style="margin-left:-20px;"><a href="/informers"><span class="glyphicon glyphicon-th-large" aria-hidden="true" ></span> Информеры</a></li>
                                <li><a href="/rss">RSS лента</a></li>
                                <li><a href="/map">Карта сайта</a></li>
                                <li><a href="/contacts">Связь с нами</a></li>
                                <li><a href="/about">О проекте</a></li>
                            </ul>

                            <ul>
                                <li><a href="/profile_he" title="טופ ישראל">
                                        פרופיל
                                    </a></li>
                                <li><a href="/account_business">כניסה למפרסם</a></li>
                            </ul>
                        </nav>



                    </div>
                </div>


            </div>
            <?if (!empty($jornal)):?>
                <div class="col-md-5">
                    <div class="row">

                        <div class="col-md-7 col-sm-8">
                            <p><strong class="fz big">О журнале</strong></p>

                            <p>
                                <small>Печатный журнал TopIsrael является уникальным принт-изданием Израиля на русском языке, ориентированном на туристов из стран СНГ. Выходит ежеквартально.

                                </small>

                            </p>
                            <a style="color: #fff" href="/jornal">Архив журналов</a>

                            <p><i class="fa fa-arrow-right pull-right hidden-xs"></i></p>
                        </div>

                        <div class="col-md-5 col-sm-4">
                            <a href="/jornal"><img src="<?=$jornal[0]['img']?>" width="202" height="211" alt="" class="img-responsive"/></a>
                        </div>

                    </div>
                </div>
            <?endif?>
        </div>






        <div class="panel-footer">
            <div class="col-md-10">
                &copy; 2008 &mdash; <?=date('Y')?> г. &nbsp; Все права защищены, перепечатка контента только с разрешения компании.
            </div>

            <div class="col-md-2">
                <div id="google_translate_element"></div><script type="text/javascript">
                    function googleTranslateElementInit() {
                        new google.translate.TranslateElement({pageLanguage: 'ru', includedLanguages: 'de,en,es,fr,it,iw,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, gaTrack: true, gaId: 'UA-69897111-1'}, 'google_translate_element');
                    }
                </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

            </div>
        </div>



    </div>




    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter33493833 = new Ya.Metrika({
                        id:33493833,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true,
                        trackHash:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/33493833" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->


</footer>
</div>
