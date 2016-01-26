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

                <div class="col-md-8 col-sm-6">
                    <span class="w-logo-footer"></span>
                </div>
                <div class="col-md-4 text-right hidden-xs" style="top: -10px;">

                    <h4 class="text-left"><a href="/newsletter" style="color: #ffffff">РАССЫЛКА НОВИНОК САЙТА</a></h4>
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
                                    <?foreach ($top_meny as $name=>$url):?>
                                        <li><a href="<?=$url?>"><?=$name?></a></li>
                                    <?endforeach?>
                                </ul>
                            </nav>
                        </div>

                        <div class="col-sm-4">
                            <nav>
                                <ul>
                                    <li><a href="/contacts">Связь с нами</a></li>
                                    <li><a href="/about">О проекте</a></li>
<!--                                    <li><a href="/partners">Наши партнеры</a></li>-->
<!--                                    <li><a href="/informers">Информеры</a></li>-->
                                    <li><a href="/rss">RSS лента</a></li>
                                    <li><a href="/map">Карта сайта</a></li>
                                </ul>
                                <br/>
                                <ul>
<!--                                    <li><a href="/contacts">צור קשר</a></li>-->
                                    <li><a href="/account_business">כניסה למפרסם</a></li>
                                </ul>
                            </nav>

                            <div id="google_translate_element"></div><script type="text/javascript">
                                function googleTranslateElementInit() {
                                    new google.translate.TranslateElement({pageLanguage: 'ru', includedLanguages: 'de,en,es,fr,it,iw,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false, gaTrack: true, gaId: 'UA-69897111-1'}, 'google_translate_element');
                                }
                            </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                        </div>
                    </div>


                </div>
                <?if (!empty($jornal)):?>
                    <div class="col-md-5">
                        <div class="row">

                            <div class="col-md-7 col-sm-8">
                                <p><strong class="fz big">О журнале</strong></p>

                                <p>
                                    <small>Печатный журнал TopIsrael.ru является уникальным принт-изданием Израиля на русском языке, ориентированном на туристов из стран СНГ. Выходит ежеквартально.

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
                <div class="col-md-12">
                    &copy; 2008-<?=date('Y')?> г. Все права защищены, перепечатка контента только с разрешения компании.
                </div>
            </div>
        </div>



        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-69897111-1', 'auto');
            ga('send', 'pageview');

        </script>


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
