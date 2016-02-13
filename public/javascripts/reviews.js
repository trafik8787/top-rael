/**
 * Created by Fedor on 2/7/2016.
 */

if (!Array.isArray) {
    Array.isArray = function (arg) {
        return Object.prototype.toString.call(arg) === '[object Array]';
    };
}

var $reviewsSettings = {
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

var $path = "./javascripts/data/reviews.js";
var $id = "topIsraelInformerReviews";

var $reviewScript = previewScript($path, $reviewsSettings);
var $reviewCss = previewCss($id, $reviewsSettings);

$(function () {

    document.body.appendChild($reviewScript);
    document.body.appendChild($reviewCss);

    $('.minicolors').minicolors({
        change: function (value) {

            //Css

            var key = this.name.replace(/font.color\[(.*)\]/gi, "$1");

            switch (key) {

                case "title":
                    $reviewsSettings['font']['color']['title'] = value;
                    break;

                case "text":
                    $reviewsSettings['font']['color']['text'] = value;
                    break;

                case "background":
                    $reviewsSettings['layout']['background'] = value;
                    break;
            }

            $reviewCss = replace(previewCss($id, $reviewsSettings), $reviewCss);
        }
    });

    layoutWidth(null, $reviewsSettings['layout']['width'], function (element) {
        //Css
        $reviewsSettings['layout']['width'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $reviewsSettings), $reviewCss);
    });

    limit(null, $reviewsSettings['limit'], function (element) {
        //Reload js
        $reviewsSettings['limit'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $reviewsSettings), $reviewScript);
    });

    fontSize('text', $reviewsSettings['font']['size']['text'], function (element) {
        //Css
        $reviewsSettings['font']['size']['text'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $reviewsSettings), $reviewCss);
    });

    fontSize('title', $reviewsSettings['font']['size']['title'], function (element) {
        //Css
        $reviewsSettings['font']['size']['title'] = Number(element.value);
        $reviewCss = replace(previewCss($id, $reviewsSettings), $reviewCss);
    });

    cities(null, $reviewsSettings['city'], function (element) {
        //Reload js
        $reviewsSettings['city'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $reviewsSettings), $reviewScript);
    });

    category(null, $reviewsSettings['category'], function (element) {
        //Reload js
        $reviewsSettings['category'] = Number(element.value);
        $reviewScript = replace(previewScript($path, $reviewsSettings), $reviewScript);
    });

    $('#showCode').off('click').on('click', function () {

        var script = document.createElement('div');
        script.appendChild(previewScript($path, {
            "container": $id,
            "city": $reviewsSettings['city'],
            "category": $reviewsSettings['category'],
            "limit": $reviewsSettings['limit']
        }));

        var style = document.createElement('div');
        style.appendChild(previewCss($id, $reviewsSettings));

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