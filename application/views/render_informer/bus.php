<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 22.02.2016
 * Time: 14:15
 */
?>


(function (widndow, document, settings) {

var $defaultInformerId = "topIsraelInformerBusiness";

var $defaults = MergeRecursive({
"container": "#" + $defaultInformerId,
"city": 0,
"category": 0,
"limit": 10
}, settings);

var $template = function (params, $defaults) {

return String()
+ "<a href=\"<?=HTML::HostSite()?>/business/"+params['url']+"\" class=\"ti-item\">\n"
    + " <span class=\"ti-image\">\n"
            + "     <img src=\"<?=HTML::HostSite()?>"+ params['image']['url'] + "\" alt=\"\" title=\"\"/>\n"
            + " </span>"
    + " <span class=\"ti-context\">"
            + "     <span class=\"ti-title\">" + params['title'] + "</span>\n"
            + "     <small class=\"ti-adress\">" + params['adress'] + "</small>\n"
            + "     <small class=\"ti-category\">" + params['category']['label'] + "</small>\n"
            + "     <span class=\"ti-text\">" + params['description'] + "</span>\n"
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

// console.log($data[i]['category']);

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
$container.innerHTML = '<span class=\"ti-header\">Новые места</span>';
$container.innerHTML += $render.join("\n");
$container.innerHTML += '<span class=\"ti-footer\"><img src="<?=HTML::HostSite()?>/public/images/logo-new.png" width="150" alt="" title=""/></span>';

function data() {

return <?=$json;?>

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




