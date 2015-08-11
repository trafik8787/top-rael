<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 23.05.2015
 * Time: 16:40
 */
?>


    <footer>
        <div id="footer">

            <div id="footer-header" class="clearfix">
                <span class="icons logo white">TopIsrael</span>

                <form class="search">
                    <div class="inner-addon right-addon">
                        <i class="glyphicon glyphicon-search"></i>
                        <input type="text" class="form-control" placeholder="Что вы хотите найти?" name="srch-term"/>
                    </div>
                </form>
            </div>

            <div id="footer-content">
                <div class="row">
                    <div class="col-md-2">
                        <nav>
                            <ul>
                                <li><a href="#">Главная</a></li>
                                <?foreach($general_meny as $row_meny):?>
                                    <li><a href="/section/<?=$row_meny['url']?>"><?=$row_meny['name']?></a></li>
                                <?endforeach?>
                                <li><a href="#">LUXURY</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-md-2">
                        <nav>
                            <ul>
                                <?foreach ($top_meny as $name=>$url):?>
                                    <li><a href="<?=$url?>"><?=$name?></a></li>
                                <?endforeach?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-2">
                        <nav>
                            <ul>
                                <li><a href="/contacts">Связь с нами</a></li>
                                <li><a href="/about">О проекте</a></li>
                                <li><a href="/partners">Наши партнеры</a></li>
                                <li><a href="/informers">Информеры</a></li>
                                <li><a href="/rss">RSS лента</a></li>
                            </ul>
                            <br/>
                            <ul>
                                <li><a href="/contacts">צור קשר</a></li>
                                <li><a href="#">כניסה למפרסם</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="col-md-3 col-md-offset-1">
                        <p><strong class="title">О журнале</strong></p>

                        <p>
                            <small>С другой стороны постоянное информационно-пропагандистское обеспечение нашей
                                деятельности способствует подготовки и реализации систем массового участия. Значимость
                                этих проблем настолько очевидна, что консультация с
                            </small>
                        </p>

                        <p><i class="fa fa-arrow-right pull-right hidden-xs"></i></p>
                    </div>

                    <div class="col-md-2">
                        <img src="/public/uploade/journal.png" width="202" height="211" alt="" class="img-responsive"/>
                    </div>
                </div>
            </div>

            <div id="footer-bottom">
                Все права защищены, перепечатка контента только с разрешения компании
            </div>
        </div>
    </footer>
</div>
