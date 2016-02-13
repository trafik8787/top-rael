/**
 * Created by Fedor on 2/7/2016.
 */

if (!Array.isArray) {
    Array.isArray = function (arg) {
        return Object.prototype.toString.call(arg) === '[object Array]';
    };
}

var $businessSettings = {
    "city": 0,
    "category": 0,
    "limit": 5,
    "font": {
        "size": {
            "title": 18,
            "text": 14
        },
        "color": {
            "title": "#103DD3",
            "text": "#000000"
        }
    },
    "layout": {
        "width": 300,
        "background": "#fff"
    }
};

var $path = "/public/javascripts/data/business.js";
var $id = "topIsraelInformerBusiness";

var $reviewScript = previewScript($path, $businessSettings);
var $reviewCss = previewCss($id, $businessSettings);

$(function () {

    document.body.appendChild($reviewScript);
    document.body.appendChild($reviewCss);

    $('.minicolors').minicolors({
        change: function (value) {

            //Css

            var key = this.name.replace(/font.color\[(.*)\]/gi, "$1");

            switch (key) {

                case "title":
                    $businessSettings['font']['color']['title'] = value;
                    break;

                case "text":
                    $businessSettings['font']['color']['text'] = value;
                    break;

                case "background":
                    $businessSettings['layout']['background'] = value;
                    break;
            }

            $reviewCss = replace(previewCss($id, $businessSettings), $reviewCss);
        }
    });

    layoutWidth(null, $businessSettings['layout']['width'], function (element) {
        //Css
        $businessSettings['layout']['width'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $businessSettings), $reviewCss);
    });

    limit(null, $businessSettings['limit'], function (element) {
        //Reload js
        $businessSettings['limit'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $businessSettings), $reviewScript);
    });

    fontSize('text', $businessSettings['font']['size']['text'], function (element) {
        //Css
        $businessSettings['font']['size']['text'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $businessSettings), $reviewCss);
    });

    fontSize('title', $businessSettings['font']['size']['title'], function (element) {
        //Css
        $businessSettings['font']['size']['title'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $businessSettings), $reviewCss);
    });

    cities(null, $businessSettings['city'], function (element) {
        //Reload js
        $businessSettings['city'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $businessSettings), $reviewScript);
    });

    category(null, $businessSettings['category'], function (element) {
        //Reload js
        $businessSettings['category'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $businessSettings), $reviewScript);
    });

    $('#showCode').off('click').on('click', function () {

        var script = document.createElement('div');
        script.appendChild(previewScript($path, {
            "container": $id,
            "city": $businessSettings['city'],
            "category": $businessSettings['category'],
            "limit": $businessSettings['limit']
        }));

        var style = document.createElement('div');
        style.appendChild(previewCss($id, $businessSettings));

        var value = "<!-- Display Informer -->\n";
        value += "<div id=\"" + $id + "\"></div>\n";
        value += "<!-- Css -->\n";
        value += style.innerHTML + "\n";
        value += "<!-- Script -->\n";
        value += script.innerHTML;

        $('textarea[name=code]').val(value);
        return false;
    });
});