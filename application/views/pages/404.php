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
    <title>404</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?foreach ($style as $row_style):?>
        <link rel="stylesheet" href="/public/stylesheets/<?=$row_style?>.css">
    <?endforeach?>

    <?foreach ($script as $row_script):?>
        <script src="/public/javascripts/<?=$row_script?>.js"></script>
    <?endforeach?>

</head>
<body>
<content>
    <div id="content">

        <div class="row">
           <div class="col-md-12">
               <div class="text-center">
                   <h1 style="font-size: 100pt">404</h1>
               </div>
           </div>
        </div>

    </div>

</content>
</body>
</html>