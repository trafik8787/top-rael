/**
 * Created by Fedor on 2/4/2016.
 */
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
            + "<a href=\"#\" class=\"ti-item\">\n"
            + " <span class=\"ti-image\">\n"
            + "     <img src=\"" + params['image']['url'] + "\" width=\"50\" height=\"50\" alt=\"\" title=\"\"/>\n"
            + " </span>"
            + " <span class=\"ti-context\">"
            + "     <span class=\"ti-title\">" + params['title'] + "</span>\n"
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

        if ($defaults['city'] && $data[i]['city']['value'] !== $defaults['city'])
            continue;

        if ($defaults['category'] && $data[i]['category']['value'] !== $defaults['category'])
            continue;

        if ($render.length >= $defaults['limit']) {
            break;
        }

        $render.push($template($data[i], $defaults));
    }

    $container.className = "ti-container";
    $container.innerHTML = '<span class=\"ti-header\">Информер обзора</span>';
    $container.innerHTML += $render.join("\n");
    $container.innerHTML += '<span class=\"ti-footer\"><img src="images/logo.png" width="100" height="20" alt="" title=""/></span>';

    function data() {
        return [
            {
                'category': {
                    'value': 1,
                    'label': 'Category Name'
                },
                'city': {
                    'value': 1,
                    'label': 'City'
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
                    'value': 2,
                    'label': 'Category Name'
                },
                'city': {
                    'value': 1,
                    'label': 'City'
                },
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            },
            {
                'city': {
                    'value': 1,
                    'label': 'City'
                },
                'category': {
                    'value': 3,
                    'label': 'Category Name'
                },
                'image': {
                    'url': "url1"
                },
                'title': "title",
                'description': "description1",
                'adress': 'adress'
            },
            {
                'city': {
                    'value': 1,
                    'label': 'City'
                },
                'category': {
                    'value': 1,
                    'label': 'Category Name'
                },
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            },
            {
                'city': {
                    'value': 1,
                    'label': 'City'
                },
                'category': {
                    'value': 2,
                    'label': 'Category Name'
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
                    'value': 4,
                    'label': 'Category Name'
                },
                'city': {
                    'value': 1,
                    'label': 'City'
                },
                'image': {
                    'url': "url2"
                },
                'title': "title",
                'description': "description2",
                'adress': 'adress'
            },
            {
                'category': {
                    'value': 2,
                    'label': 'Category Name'
                },
                'city': {
                    'value': 1,
                    'label': 'City'
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
                    'value': 3,
                    'label': 'Category Name'
                },
                'city': {
                    'value': 1,
                    'label': 'City'
                },
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



