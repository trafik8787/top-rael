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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?=isset($seo_keywords) ? $seo_keywords: ''?>">
    <meta name="description" content="<?=isset($seo_description)? $seo_description: ''?>">

    <?foreach ($style as $row_style):?>
        <link rel="stylesheet" href="<?=URL::base();?>public/css/<?=$row_style?>.css">
    <?endforeach?>

    <?foreach ($script as $row_script):?>
        <script src="<?=URL::base();?>public/js/<?=$row_script?>.js"></script>
    <?endforeach?>
<!--    <link rel="shortcut icon" href="../../public/img/favicon.ico" type="image/x-icon">-->
</head>
<body>
<?=$header;?>
<?=$content; ?>
<?=$footer;?>
</body>
</html>