/**
 * Created by Fedor on 2/7/2016.
 */
function categories(name, selected, callback) {

    var $select = document.querySelectorAll('select[name="categories[' + (name || "") + ']"]');

    var $defaults = [
        {
            "name": "Все"
        },
        {
            "name": "Развлечения"
        },
        {
            "name": "Рестораны"
        },
        {
            "name": "Покупки"
        },
        {
            "name": "Отели"
        }
    ];

    for (var i = 0; i < $select.length; i++) {

        for (var j = 0; j < $defaults.length; j++) {

            var $option = document.createElement('option');
            $option.innerText = $defaults[j]['name'];
            $option.value = (j + 1);

            $select[i].appendChild($option);
        }

        $select[i].onchange = function () {

            if (typeof callback === "function") {
                callback(this);
            }
        };

        $select[i].onchange();
    }
}

function cities(name, selected, callback) {

    var $select = document.querySelectorAll('select[name="cities[' + (name || "") + ']"]');

    var $defaults = {
        "selected": (selected !== undefined ? selected : 1),
        "cities": [
            'Все',
            'Акко',
            'Арад',
            'Ариэль',
            'Афула',
            'Ашдод',
            'Ашкелон',
            'Бат-Ям',
            'Бейт-Шеан',
            'Бейт-Шемеш',
            'Бейтар-Илит',
            'Беэр-Шева',
            'Бней-Брак',
            'Герцлия',
            'Гиват-Шмуэль',
            'Гиватаим',
            'Димона',
            'Зихрон-Яаков',
            'Иерусалим',
            'Йехуд',
            'Йокнеам',
            'Кармиэль',
            'Кирьят-Арба',
            'Кирьят-Ата',
            'Кирьят-Бялик',
            'Кирьят-Гат',
            'Кирьят-Малахи',
            'Кирьят-Моцкин',
            'Кирьят-Оно',
            'Кирьят-Тивон',
            'Кирьят-Хаим',
            'Кирьят-Шмона',
            'Кирьят-Ям',
            'Кфар-Саба',
            'Лод',
            'Маале-Адумим',
            'Маалот-Таршиха'
        ]
    };

    for (var i = 0; i < $select.length; i++) {

        for (var j = 0; j < $defaults.cities.length; j++) {

            var $option = document.createElement('option');
            $option.innerText = $defaults.cities[j];
            $option.value = j;

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

    var $select = document.querySelectorAll('select[name="category[' + (name || "") + ']"]');

    var $defaults = {
        "selected": (selected !== undefined ? selected : 1),
        "categories": [
            'Все',
            'Развлечения',
            'Рестораны',
            'Покупки',
            'Отели'
        ]
    };

    for (var i = 0; i < $select.length; i++) {

        for (var j = 0; j < $defaults.categories.length; j++) {

            var $option = document.createElement('option');
            $option.innerText = $defaults.categories[j];
            $option.value = j;

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
        + "#" + id + ".ti-container{font-family:  Arial, 'Helvetica Neue', Helvetica, sans-serif; color: " + params['font']['color']['text'] + "; background: " + params['layout']['background'] + "; border:1px solid #C7C6C6; width: " + params['layout']['width'] + "px;}"
        + "#" + id + ".ti-container .ti-header{ font-size: 20px; line-height: 1.25; margin: 5px 0; padding:5px 10px 10px; border-bottom:1px solid #ECECEC; display: block;}"
        + "#" + id + ".ti-container .ti-footer{ font-size: 20px; line-height: 1.25; margin: 5px 0; padding:10px 10px 5px 10px; border-top:1px solid #ECECEC; display: block;}"
        + "#" + id + ".ti-container .ti-item{display:block; text-decoration:none; margin:10px;}"
        + "#" + id + ".ti-container .ti-item .ti-image{float:left; margin:0 10px 0 0; width:50px; height:50px; background:#F2F2F2;}"
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