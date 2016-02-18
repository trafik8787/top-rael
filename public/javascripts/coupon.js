/**
 * Created by Fedor on 2/7/2016.
 */

if (!Array.isArray) {
    Array.isArray = function (arg) {
        return Object.prototype.toString.call(arg) === '[object Array]';
    };
}

var $couponSettings = {
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

var $path = "http://"+location.hostname+"/public/javascripts/data/coupon.js";
var $id = "topIsraelInformerCoupon";

var $reviewScript = previewScript($path, $couponSettings);
var $reviewCss = previewCss($id, $couponSettings);

$(function () {

    document.body.appendChild($reviewScript);
    document.body.appendChild($reviewCss);

    $('.minicolors').minicolors({
        change: function (value) {

            //Css

            var key = this.name.replace(/font.color\[(.*)\]/gi, "$1");

            switch (key) {

                case "title":
                    $couponSettings['font']['color']['title'] = value;
                    break;

                case "text":
                    $couponSettings['font']['color']['text'] = value;
                    break;

                case "background":
                    $couponSettings['layout']['background'] = value;
                    break;
            }

            $reviewCss = replace(previewCss($id, $couponSettings), $reviewCss);
        }
    });

    layoutWidth(null, $couponSettings['layout']['width'], function (element) {
        //Css
        $couponSettings['layout']['width'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $couponSettings), $reviewCss);
    });

    limit(null, $couponSettings['limit'], function (element) {
        //Reload js
        $couponSettings['limit'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $couponSettings), $reviewScript);
    });

    fontSize('text', $couponSettings['font']['size']['text'], function (element) {
        //Css
        $couponSettings['font']['size']['text'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $couponSettings), $reviewCss);
    });

    fontSize('title', $couponSettings['font']['size']['title'], function (element) {
        //Css
        $couponSettings['font']['size']['title'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $couponSettings), $reviewCss);
    });

    cities(null, $couponSettings['city'], function (element) {
        //Reload js
        $couponSettings['city'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $couponSettings), $reviewScript);
    });

    category(null, $couponSettings['category'], function (element) {
        //Reload js
        $couponSettings['category'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $couponSettings), $reviewScript);
    });

    $('#showCode').off('click').on('click', function () {

        var script = document.createElement('div');
        script.appendChild(previewScript($path, {
            "container": '#' + $id,
            "city": $couponSettings['city'],
            "category": $couponSettings['category'],
            "limit": $couponSettings['limit']
        }));

        var style = document.createElement('div');
        style.appendChild(previewCss($id, $couponSettings));

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