<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>

<!doctype html>
<html lang="he">
<head>
    <meta charset="UTF-8">
    <title>טופ ישראל - קבוצת המדיה בשפה הרוסית</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="keywords" content="טופ ישראל top israel">
    <meta name="description" content="טופ ישראל מכסה את זירת הפנאי הישראלית בזווית רחבה ביותר, על ידי סקירות, ראיונות, כתבות, המלצות ומתן כל מידע שימושי אחר לקהל דוברי הרוסית.">


    <? foreach ($style as $row_style): ?>
        <link rel="stylesheet" href="<?= URL::base(); ?><?= $row_style ?>">
    <? endforeach ?>



    <? foreach ($script as $row_script): ?>
        <script src="<?= URL::base(); ?><?= $row_script ?>"></script>
    <? endforeach ?>

    <style>
        img {
            width: 100%;
        }
        #wrapper {
            padding-bottom: 130px!important;
        }
    </style>
</head>
<body>

    <div id="wrapper" class="container">
    
    
            <a href="/" class=""><img src="http://topisrael.ru/public/images/logo-new-h.png" style="width:250px;float:right;margin:30px 0px;" title="top israel" alt="טופ ישראל"></a>
            
            <p style="clear:both;border:1px solid #ccc;"></p>
            
            

        <content>
            <div id="content">

                <div class="row">
                    <!-- Context -->
                    <div class="col-md-10">
                        <div id="context" class="full-text" style="direction:rtl">


                            <h1>
                                <?=$name?>
                            </h1>

                            <?=$description?>


                        </div>
                    </div>

                    <!-- Bloc Right -->
                </div>

            </div>

        </content>
        
        
         <footer>
        <div class="panel panel-footer">

            <div class="panel-heading">

                <div class="col-md-7 col-sm-6">
                   <a href="/" class="logo"><img src="http://topisrael.ru/public/images/logo-new-h.png" style="width:200px;" title="top israel" alt="טופ ישראל"></a>
                </div>

<div class="col-md-4 col-sm-4">
                   לשליחת מידע ובירורים 
 <br>                  
               
&#032;&#032;&#116;&#111;&#112;&#064;&#116;&#111;&#112;&#105;&#115;&#114;&#097;&#101;&#108;&#046;&#114;&#117;
               :הדוא"ל
    <br>               
                    או לחייג: 
                    03-5604505
                </div>

            </div>




        </div>
    </footer>



    </div>


</body>
</html>