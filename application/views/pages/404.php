<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 14.09.2015
 * Time: 14:49
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка 404 - страница не найдена</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?foreach ($style as $row_style):?>
        <link rel="stylesheet" href="/public/stylesheets/<?=$row_style?>.css">
    <?endforeach?>

    <?foreach ($script as $row_script):?>
        <script src="/public/javascripts/<?=$row_script?>.js"></script>
    <?endforeach?>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic">

    <link href='//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>
</head>
<body>

<div id="wrapper" class="container">




    <header>
        <div id="header">



            <a href="/" class="icons logo">TopIsrael</a>


        </div>
    </header>


    <content>

        <div id="context" class="full-text">


            <hr>
            <div style="margin: 50px;">
                <h1 style="font-size: 30pt;margin-bottom:30pt;">Ошибка 404 - страница не найдена</h1>
                Информацию которую вы ищете переместили в другой раздел. <br>Попробуйте найти ее по ссылкам ниже.
            </div>

            <hr style="margin-bottom: 50px;">



            <div class="col-sm-3">
                <nav>
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/section/entertainment">Развлечения</a></li>
                        <li><a href="/section/restaurants">Рестораны и Бары</a></li>

                    </ul>
                </nav>
            </div>


            <div class="col-sm-3">
                <nav>
                    <ul>
                        <li><a href="/section/shops">Магазины</a></li>
                        <li><a href="/section/beauty">Красота и Здоровье</a></li>
                        <li><a href="/section/hotels">Отели</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-sm-3">
                <nav>
                    <ul>
                        <li><a href="/coupons">Купоны</a></li>
                        <li><a href="/articles">Обзоры</a></li>
                        <li><a href="/maps">На карте</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-sm-3">
                <nav>
                    <ul>

                        <li><a href="/city/telaviv">Тель-Авив</a></li>
                        <li><a href="/city/jerusalem">Иерусалим</a></li>
                        <li><a href="/city/eilat">Эйлат</a></li>

                    </ul>
                </nav>
            </div>



        </div>
    </content>

</div>
</body>
</html>