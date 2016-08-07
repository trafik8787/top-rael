<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.05.2015
 * Time: 18:57
 */

?>

<!doctype html>
<html lang="ru">
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



    <?foreach ($script as $row_script):?>
        <script src="<?=URL::base();?><?=$row_script?>"></script>
    <?endforeach?>

    <?if (!empty($scripts_map)): //скрипт для карты?>
        <script src="<?=URL::base();?><?=$scripts_map?>"></script>
    <?endif?>


    <!--script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="UTF-8"></script-->
    
    
    <link href="<?=HTML::HostSite('/favicon.ico')?>" type="image/x-icon" rel="shortcut icon" />
    <link href="<?=HTML::HostSite('/iconmob.png')?>" rel="apple-touch-icon" />
    <link rel="stylesheet" href="/public/stylesheets/print.css" media="print">
    <link href="/public/stylesheets/informers.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TXF5Q3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TXF5Q3');</script>
<!-- End Google Tag Manager -->
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