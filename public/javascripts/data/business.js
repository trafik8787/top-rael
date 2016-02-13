/**
 * Created by Fedor on 2/4/2016.
 */
(function (widndow, document, settings) {

    var $defaultInformerId = "topIsraelInformerBusiness";

    var $defaults = MergeRecursive({
        "container": "#" + $defaultInformerId,
        "city": 0,
        "category": 0,
        "limit": 10
    }, settings);

    var $template = function (params, $defaults) {

        if (!$defaults['font'].hasOwnProperty('color')) {
            $defaults['font']['color'] = {};
        }

        if (!$defaults['font']['color'].hasOwnProperty('title')) {
            $defaults['font']['color']['title'] = "#113FD6";
        }

        if (!$defaults['font']['color'].hasOwnProperty('text')) {
            $defaults['font']['color']['text'] = "#000";
        }

        return String()
            + "<a href=\"#\" class=\"ti-item\">\n"
            + " <span class=\"ti-image\">\n"
            + "     <img src=\"" + params['image']['url'] + "\" width=\"50\" height=\"50\" alt=\"\" title=\"\"/>\n"
            + " </span>"
            + " <span class=\"ti-context\">"
            + "     <span class=\"ti-title\">" + params['title'] + "</span>\n"
            + "     <small class=\"ti-category\">" + params['category']['name'] + "</small>\n"
            + "     <small class=\"ti-adress\">" + params['adress'] + "</small>\n"
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

        if ($defaults['city'] && $data[i]['city'] !== $defaults['city'])
            continue;

        if ($defaults['category'] && $data[i]['category']['id'] !== $defaults['category'])
            continue;

        if ($render.length >= $defaults['limit']) {
            break;
        }

        $render.push($template($data[i], $defaults));
    }

    $container.className = "ti-container";
    $container.innerHTML = '<span class=\"ti-header\">Информер бизнеса</span>';
    $container.innerHTML += $render.join("\n");
    $container.innerHTML += '<span class=\"ti-footer\"><img src="images/logo.png" width="100" height="20" alt="" title=""/></span>';

    function data() {
        return [
            {
                'category': {
                    'id': 1,
                    'name': 'Category Name'
                },
                'city': 1,
                'image': {
                    'url': "url1"
                },
                'title': "title",
                'description': "description1",
                'adress': 'adress'
            },
            {
                'category': {
                    'id': 2,
                    'name': 'Category Name'
                },
                'city': 2,
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            },
            {
                'city': 3,
                'category': {
                    'id': 3,
                    'name': 'Category Name'
                },
                'image': {
                    'url': "url1"
                },
                'title': "title",
                'description': "description1",
                'adress': 'adress'
            },
            {
                'city': 4,
                'category': {
                    'id': 1,
                    'name': 'Category Name'
                },
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            },
            {
                'city': 5,
                'category': {
                    'id': 2,
                    'name': 'Category Name'
                },
                'image': {
                    'url': "url1"
                },
                'title': "title",
                'description': "description1",
                'adress': 'adress'
            },
            {
                'category': {
                    'id': 4,
                    'name': 'Category Name'
                },
                'city': 6,
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            },
            {
                'category': {
                    'id': 2,
                    'name': 'Category Name'
                },
                'city': 7,
                'image': {
                    'url': "url1"
                },
                'title': "title",
                'description': "description1",
                'adress': 'adress'
            },
            {
                'category': {
                    'id': 3,
                    'name': 'Category Name'
                },
                'city': 8,
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            }
        ]
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



