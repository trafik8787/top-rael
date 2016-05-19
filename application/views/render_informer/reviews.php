<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.02.2016
 * Time: 14:15
 НА СЛЕДУЮЩУЕЙ СТРОКЕ ПОСЛЕ 31, ПРИ НЕОБХОДИМОСТИ МОЖНО ДОБАВИТЬ ОПИСАНИЕ: + "     <span class=\"ti-text\">" + params['description'] + "</span>\n"
 */
?>


(function (widndow, document, settings) {

var $defaultInformerId = "topIsraelInformerReviews";

var $defaults = MergeRecursive({
"container": "#" + $defaultInformerId,
"city": 0,
"category": 0,
"limit": 10
}, settings);

var $template = function (params, $defaults) {

return String()
+ "<a href=\"<?=HTML::HostSite()?>/article/"+params['url']+"\" class=\"ti-item\">\n"
    + " <span class=\"ti-image\">\n"
            + "     <img src=\"<?=HTML::HostSite()?>" + params['image']['url'] + "\" alt=\"\" title=\"\"/>\n"
            + " </span>"
    + " <span class=\"ti-context\">"
            + "     <span class=\"ti-title\">" + params['title'] + "</span>\n"
            + " </span>\n"
    + " <span class=\"ti-clear\"></span>\n"
    + "</a>";
};

var $data = data();

var $container;

if (!($container = document.querySelector($defaults.container))) {

$container = document.createElement('DIV');
$container.id = $defaultInformerId;

document.body.appendChild($container);
}

var $render = [];

for (var i = 0; i < $data.length; i++) {

if ($defaults['city'] && parseInt($data[i]['city']['value']) !== parseInt($defaults['city']))
continue;

if ($defaults['category'] && parseInt($data[i]['category']['value']) !== parseInt($defaults['category']))
continue;

if ($render.length >= $defaults['limit']) {
break;
}

$render.push($template($data[i], $defaults));
}

$container.className = "ti-container";
$container.innerHTML = '<span class=\"ti-header\">Обзоры интересных мест</span>';
$container.innerHTML += $render.join("\n");
$container.innerHTML += '<span class=\"ti-footer\"><img src="<?=HTML::HostSite()?>/public/images/logo-new.png" width="150" alt="" title=""/></span>';

function data() {

 return <?=!empty($json) ? $json : ''?>;
}

/*
* Recursively merge properties of two objects
*/
function MergeRecursive(obj1, obj2) {

for (var p in obj2) {
try {
// Property in destination object set; update its value.
if (obj2[p].constructor == Object) {
obj1[p] = MergeRecursive(obj1[p], obj2[p]);

} else {
obj1[p] = obj2[p];

}

} catch (e) {
// Property in destination object not set; create it and set its value.
obj1[p] = obj2[p];

}
}

return obj1;
}

})(window, document, _rs);