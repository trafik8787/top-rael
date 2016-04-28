/**
 * Created by Fedor on 2/7/2016.
 */
function cities(name, selected, callback) {
    var $CityAjaxList;
    var $select = document.querySelectorAll('select[name="cities[' + (name || "") + ']"]');

    //получаем города
    var req = new XMLHttpRequest();
    req.open("GET", '/informgetcity?page='+window.location, false);
    req.send(null);

    $CityAjaxList = JSON.parse(req.responseText);


    var $defaults = {
        "selected": (selected !== undefined ? selected : 1),
        "cities": $CityAjaxList
    };

    for (var i = 0; i < $select.length; i++) {

        for (var j = 0; j < $defaults.cities.length; j++) {

            var $option = document.createElement('option');
            $option.innerText = $defaults.cities[j].label;
            $option.value = $defaults.cities[j].value;

            if ($defaults.selected === j) {
                $option.selected = true;
            }

            $select[i].appendChild($option);
        }

        $select[i].onchange = function () {

            if (typeof callback === "function") {
                callback(this);
            }
        };
    }
}


function category(name, selected, callback) {
    var $CatAjaxList;
    var $select = document.querySelectorAll('select[name="category[' + (name || "") + ']"]');


    //получаем категории
    var req = new XMLHttpRequest();
    req.open("GET", '/informgetsection', false);
    req.send(null);

    $CatAjaxList = JSON.parse(req.responseText);


    var $defaults = {
        "selected": (selected !== undefined ? selected : 1),
        "categories": $CatAjaxList
    };

    for (var i = 0; i < $select.length; i++) {

        for (var j = 0; j < $defaults.categories.length; j++) {

            var $option = document.createElement('option');
            $option.innerText = $defaults.categories[j].label;
            $option.value = $defaults.categories[j].value;

            if ($defaults.selected === j) {
                $option.selected = true;
            }

            $select[i].appendChild($option);
        }

        $select[i].onchange = function () {

            if (typeof callback === "function") {
                callback(this);
            }
        };
    }
}

function fontSize(name, selected, callback) {

    var $input = document.querySelectorAll('input[type="number"][name="font.size[' + (name || "") + ']"]');

    var $defaults = {
        "selected": (selected !== undefined ? selected : 14),
        "min": 12,
        "max": 42
    };

    for (var i = 0; i < $input.length; i++) {

        $input[i].value = $defaults.selected;

        $input[i].onchange = function () {

            if (this.value < $defaults['min']) {
                this.value = $defaults['min'];
            }

            if (this.value > $defaults['max']) {
                this.value = $defaults['max'];
            }

            if (typeof callback === "function") {
                callback(this);
            }
        };
    }
}

function limit(name, selected, callback) {

    var $select = document.querySelectorAll('select[name="limit[' + (name || "") + ']"]');

    var $defaults = {
        "selected": (selected !== undefined ? selected : 5),
        "limit": 10
    };

    for (var i = 0; i < $select.length; i++) {

        for (var j = 0; j < $defaults.limit; j++) {

            var $option = document.createElement('option');
            var $index = (j + 1);

            $option.innerText = $index;

            if ($index === $defaults.selected) {
                $option.selected = true;
            }

            $select[i].appendChild($option);
        }

        $select[i].onchange = function () {

            if (typeof callback === "function") {
                callback(this);
            }
        };
    }
}

function layoutWidth(name, selected, callback) {

    var $input = document.querySelectorAll('input[type="number"][name="layout.width[' + (name || "") + ']"]');

    var $defaults = {
        "selected": (selected !== undefined ? selected : 200),
        "min": 100,
        "max": 600
    };

    for (var i = 0; i < $input.length; i++) {

        $input[i].value = $defaults.selected;

        $input[i].onchange = function () {

            if (this.value < $defaults['min']) {
                this.value = $defaults['min'];
            }

            if (this.value > $defaults['max']) {
                this.value = $defaults['max'];
            }

            if (typeof callback === "function") {
                callback(this);
            }
        };
    }
}

function previewScript(path, params) {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.text = "(function (w, d, t, p, e, m) {\n" +
        "_rs = " + (JSON.stringify(params)) + ";\n" +
        "e = d.createElement(t); e.async = 1; e.src = p;\n" +
        "m = d.getElementsByTagName(t)[0]; m.parentNode.insertBefore(e, m);\n" +
        "})(window, document, 'script', '" + path + "');";

    return script;
}

function previewCss(id, params) {

    var style = document.createElement('style');
    style.type = "text/css";
    style.text = String()
        + "#topIsraelInformerBusiness.ti-container .ti-item .ti-image, #topIsraelInformerReviews.ti-container .ti-item .ti-image{float:none !important; width:100% !important;}"
        + "#topIsraelInformerBusiness.ti-container .ti-item .ti-context, #topIsraelInformerReviews.ti-container .ti-item .ti-context{margin-top: -10px !important;}"
        + "#" + id + ".ti-container{font-family:  Arial, 'Helvetica Neue', Helvetica, sans-serif; color: " + params['font']['color']['text'] + "; background: " + params['layout']['background'] + "; border:1px solid #C7C6C6; width: " + params['layout']['width'] + "px;}"
        + "#" + id + ".ti-container .ti-header{ font-size: 20px; line-height: 1.25; margin: 5px 0; padding:5px 10px 10px; border-bottom:1px solid #ECECEC; display: block;}"
        + "#" + id + ".ti-container .ti-footer{ font-size: 20px; line-height: 1.25; margin: 5px 0; padding:10px 10px 5px 10px; border-top:1px solid #ECECEC; display: block;}"
        + "#" + id + ".ti-container .ti-item{display:block; text-decoration:none; margin: 10px 10px 15px 10px;}"
        + "#" + id + ".ti-container .ti-item .ti-image{float:left; margin:0 10px 0 0; width:70px; background:#F2F2F2;}"
        + "#" + id + ".ti-container .ti-item .ti-image img{display:block; width:100%; height:auto;}"
        + "#" + id + ".ti-container .ti-item .ti-context{display:block; position:relative; overflow:hidden;}"
        + "#" + id + ".ti-container .ti-item .ti-context .ti-title{display:block;  margin:0 0 5px 0; font-size:" + params['font']['size']['title'] + "px; line-height: 1.25; color: " + params['font']['color']['title'] + ";}"
        + "#" + id + ".ti-container .ti-item .ti-context .ti-text{display:block; margin:0 0 5px 0; font-size:" + params['font']['size']['text'] + "px; line-height: 1.25; color: " + params['font']['color']['text'] + ";}"
        + "#" + id + ".ti-container .ti-item .ti-context .ti-category{display:block; margin:0 0 5px 0; font-size:" + Math.round(params['font']['size']['text'] / 1.25) + "px; line-height: 1.25; color: " + params['font']['color']['text'] + ";}"
        + "#" + id + ".ti-container .ti-item .ti-context .ti-adress{display:block; margin:0 0 5px 0; font-size:" + Math.round(params['font']['size']['text'] / 1.25) + "px; line-height: 1.25; color: " + params['font']['color']['text'] + ";}"
        + "#" + id + ".ti-clear{display:block; clear:both; height:0; overflow: hidden;}";

    if (style.styleSheet) {
        style.styleSheet.cssText = style.text;
    } else {
        style.appendChild(document.createTextNode(style.text));
    }

    return style;
}

function replace(newElement, oldElement) {
    oldElement.parentNode.replaceChild(newElement, oldElement);
    return newElement;
}