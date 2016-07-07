<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 07.07.2016
 * Time: 13:36
 */
?>


<a class="w-icon-mail" href="mailto:?Subject=<?=$type?>  <?=$name?>. <?=$busname?>, <?=$city_name?>&body=<?=$url?> <?=$name?> <?=$secondname?>. <?=$busname?>, <?=$city_name?>">
    <span></span>
</a>



<a href="http://www.facebook.com/sharer.php?s=100&p[url]=<?= urlencode($url); ?>&p[title]=<?=$name?>&p[summary]=<?=$info?>&p[images][0]=<?=$img ?>" onclick="window.open(this.href, this.title, 'toolbar=0, status=0, width=548, height=325'); return false" class="social facebook" title="Поделиться ссылкой на Фейсбук" target="_parent">
    <i class="fa fa-facebook"></i>
</a>

<!--<script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="UTF-8"></script>-->
<script type="text/javascript">
//    document.write(VK.Share.button({
//        url: '<?//=Request::full_current_url()?>//',
//        title: '<?//=$name?>//',
//        description: '<?//=$info?>//',
//        image: '<?//=$img ?>//',
//        noparse: true
//    }, {
//        type: 'custom',
//        text: '<span class="social vk"><i class="fa fa-vk"></i></span>'
//    }));
</script>

<a href="https://vk.com/share.php?url=<?=$url?>"><span class="social vk"><i class="fa fa-vk"></i></span></a>


<div id="ok_shareWidget" style="display: inline-block;position: relative;top: 19px"></div>
<script>
    !function (d, id, did, st) {
        var js = d.createElement("script");
        js.src = "https://connect.ok.ru/connect.js";
        js.onload = js.onreadystatechange = function () {
            if (!this.readyState || this.readyState == "loaded" || this.readyState == "complete") {
                if (!this.executed) {
                    this.executed = true;
                    setTimeout(function () {
                        OK.CONNECT.insertShareWidget(id,did,st);
                    }, 0);
                }
            }};
        d.documentElement.appendChild(js);
    }(document,"ok_shareWidget","http://<?=$_SERVER['HTTP_HOST']?>/","{width:40,height:40,st:'straight',sz:45,nt:1,nc:1}");
</script>




<a style="top: 1px;position: relative;" href="https://plus.google.com/share?url=<?=$url?>" onclick="javascript:window.open(this.href,
                                                        '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
        src="../../../public/images/google_icon.png" width="45" alt="Share on Google+"/></a>

<a href="https://twitter.com/intent/tweet?text=<?=$info.' '.$url?>" class="social twitter">
    <i class="fa fa-twitter"></i>
</a>
