<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 15.09.2015
 * Time: 12:05
 */

?>

<meta charset="UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1">

<div style="border:1px solid #e3e1e1; max-width: 600px; margin: 0 auto; width:100%;">
    <div style="border:1px solid #d4d2d2">
        <div style="border:1px solid #bfbdbd; background:#ffffff;">

            <!-- Email Content -->
            <table cellspacing="0" cellpadding="0" width="100%"
                   style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size:14px;">

                <thead>
                <tr>
                    <td>
                        <div style="background-color:#ffffff;">


                            <table height="120" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="top" align="left" style="padding:0 10px;" >

                                        <!-- Header -->
                                        <table cellpadding="0" cellspacing="0" align="left" width="100%" height="120">
                                            <tr>
                                                <td valign="bottom" align="left" style="padding:0 10px 40px 10px;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="max-width:250px;">
                                                        <tr>
                                                            <td>
                                                                <a href="http://<?=$_SERVER['HTTP_HOST']?>/" target="_blank" style="display: block;">
                                                                    <img src="cid:logo-new.png" width="250" alt="logo"
                                                                         style="width:100%; height:auto;"/>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="bottom" align="right"  style="padding:0 10px;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="max-width:109px;">
                                                        <tr>
                                                            <td>
                                                                <img src="cid:2.png" width="109" height="108" alt="plane" style="width:100%; height: auto"/>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td style="padding:0 20px 30px 20px;">

                        <table cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td>

                                    <table cellpadding="0" cellspacing="0" align="left">
                                        <tr>
                                            <td>
                                                <span style="font-size:24px;">Подтвердите подписку на рассылку новинок Topisrael.ru</span>
                                            </td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" align="right">
                                        <tr>
                                            <td style="padding-top:10px;">

                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        </table>

                        <br/><br/>


                        <p>Здравствуйте!</p>

                        <p>Вы отправили запрос на получение рассылки новинок сайта TopIsrael.ru - интересные места отдыха, развлечений и покупок в Израиле.</p>

                        <p>Вы указали маил: <?=$email?></p>


                        <p> <?=$message?></p>


                        <p>Если вы не подписывались на рассылку, то просто проигнорируйте это письмо.</p>

                       <hr>

                        <p>TopIsrael.ru поможет вам отлично спланировать свой отдых, покупки и развлечения в Израиле.</p>


                        <hr>

                        <p>Это автоматическое письмо, пожалуйста, не отвечайте на него.</p>

                        <p>Если у вас есть вопросы или пожелания, <a href="http://<?=$_SERVER['HTTP_HOST']?>/contacts">пишите или звоните нам.</a></p>

                        <p>С уважением, команда TopIsrael.ru</p>

                        <br/>



                        <p align="center">

                        </p>


                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>
