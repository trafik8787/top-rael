<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */
?>


    <footer>





        <div class="panel panel-footer">

            <div class="panel-heading">

                <div class="col-md-7 col-sm-6">
                    <span class="icons logo white">TopIsrael</span>
                </div>

                <div class="col-md-5 col-sm-6">
                    <form class="search">
                        <div class="inner-addon right-addon">
                            <i class="glyphicon glyphicon-search"></i>
                            <input type="text" class="form-control" placeholder="Что вы хотите найти?" name="srch-term"/>
                        </div>
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
                                </ul>
                                <br/>
                                <ul>
<!--                                    <li><a href="/contacts">צור קשר</a></li>-->
                                    <li><a href="/account_business">כניסה למפרסם</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>


                </div>

<!--                <div class="col-md-5">-->
<!--                    <div class="row">-->
<!---->
<!--                        <div class="col-md-7 col-sm-8">-->
<!--                            <p><strong class="fz big">О журнале</strong></p>-->
<!---->
<!--                            <p>-->
<!--                                <small>С другой стороны постоянное информационно-пропагандистское обеспечение нашей-->
<!--                                    деятельности способствует подготовки и реализации систем массового участия. Значимость-->
<!--                                    этих проблем настолько очевидна, что консультация с-->
<!--                                </small>-->
<!--                            </p>-->
<!---->
<!--                            <p><i class="fa fa-arrow-right pull-right hidden-xs"></i></p>-->
<!--                        </div>-->
<!---->
<!--                        <div class="col-md-5 col-sm-4">-->
<!--                            <img src="/public/uploade/journal.png" width="202" height="211" alt="" class="img-responsive"/>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
            </div>

            <div class="panel-footer">
                <div class="col-md-12">
                    Все права защищены, перепечатка контента только с разрешения компании
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
