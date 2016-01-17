<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:57
 */

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=isset($seo_title)? $seo_title : ''?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?=isset($seo_keywords) ? $seo_keywords: ''?>">
    <meta name="description" content="<?=isset($seo_description)? $seo_description: ''?>">


    <?foreach ($style as $row_style):?>
        <link rel="stylesheet" href="<?=URL::base();?><?=$row_style?>">
    <?endforeach?>

    <link href='//fonts.googleapis.com/css?family=PT+Sans:400,400italic,700,700italic&subset=latin,cyrillic'
          rel='stylesheet' type='text/css'>

    <?foreach ($script as $row_script):?>
        <script src="<?=URL::base();?><?=$row_script?>"></script>
    <?endforeach?>

    <?if (!empty($scripts_map)): //скрипт для карты?>
        <script src="<?=URL::base();?><?=$scripts_map?>"></script>
    <?endif?>
<!--    <link rel="shortcut icon" href="../../public/img/favicon.ico" type="image/x-icon">-->
    <script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
    <link href="../../favicon.ico" type="image/x-icon" rel="shortcut icon" />
    <link href="../../iconmob.png" rel="apple-touch-icon" />
</head>
<body>
<?=$header;?>
<?=$content; ?>
<?=$footer;?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>