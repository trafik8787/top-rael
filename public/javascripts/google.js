/**
 * Created by Fedor on 8/29/2015.
 */
$(function () {
    initMap();
});

function initMap() {

    var markers = [];
    var map;

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 32.0650, lng: 34.7700}
    });

    var cluster = new MarkerClusterer(map, [], {ignoreHidden: true});
    var tmpl = template();

    search();

    markers = setMarkes(getData());

    cluster.addMarkers(markers);

    $('[data-markers]').off('click').on('click', function () {

        var type = $(this).data('markers');

        tmpl.ib.close();

        for (var i = 0; i < markers.length; i++) {
            if (parseInt(markers[i].key) === type) {

                var value = !markers[i].visible;
                markers[i].setVisible(value);
            }
        }
    });

    function search() {
        var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));

        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            var bounds = new google.maps.LatLngBounds();

            places.forEach(function (place) {
                if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });

            //setMarkes(getMarkers(), map);

            map.fitBounds(bounds);
        });
    }

    function getData() {
        return {

            1: {
                name: "Рестораны",
                icon: "images/map-markers/red.png",
                visible: true,

                data: [
                    {
                        title: "test1",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.063319,
                            lng: 34.771535
                        }
                    },

                    {
                        title: "test2",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.062112,
                            lng: 34.77072
                        }
                    },

                    {
                        title: "test3",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1642.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.063346,
                            lng: 34.769848
                        }
                    },

                    {
                        title: "test4",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1657.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.064374,
                            lng: 34.79881
                        }
                    },

                    {
                        title: "test5",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1650.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.061142,
                            lng: 34.7796
                        }
                    }
                ]
            },

            2: {
                name: "Покупки",
                icon: "images/map-markers/violet.png",
                visible: true,

                data: [
                    {
                        title: "test1",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.063319,
                            lng: 34.779535
                        }
                    },

                    {
                        title: "test2",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.063112,
                            lng: 34.78072
                        }
                    }
                ]
            },

            3: {
                name: "Ночьная жизнь",
                icon: "images/map-markers/blue.png",
                visible: true,

                data: [
                    {
                        title: "test1",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.066319,
                            lng: 34.771535
                        }
                    },

                    {
                        title: "test2",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.067319,
                            lng: 34.771535
                        }
                    }
                ]
            },

            4: {
                name: "Отдых",
                icon: "images/map-markers/green.png",
                visible: true,

                data: [
                    {
                        title: "test1",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.043319,
                            lng: 34.751535
                        }
                    },

                    {
                        title: "test2",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.065112,
                            lng: 34.78072
                        }
                    }
                ]
            },

            5: {
                name: "Красота",
                icon: "images/map-markers/pink.png",
                visible: true,

                data: [
                    {
                        title: "test1",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.064319,
                            lng: 34.774535
                        }
                    },

                    {
                        title: "test2",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.062112,
                            lng: 34.77272
                        }
                    }
                ]
            },

            6: {
                name: "Отели",
                icon: "images/map-markers/yellow.png",
                visible: true,

                data: [
                    {
                        title: "test1",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.061319,
                            lng: 34.770535
                        }
                    },

                    {
                        title: "test2",
                        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
                        list: [
                            {
                                key: "",
                                value: "Открыты ежедневно с 12:00-24:00"
                            },
                            {
                                key: "Адрес",
                                value: "Ha-Shunit St 2, Герцлия"
                            },
                            {
                                key: "Тел",
                                value: "09-9514000"
                            }
                        ],
                        link: "",
                        linkCoupons: "",
                        linkLuxury: "",
                        location: {
                            lat: 32.063519,
                            lng: 34.777535
                        }
                    }
                ]
            }
        };
    }

    function setMarkes(data) {

        var markers = [];

        for (var type in data) {

            for (var i = 0; i < data[type].data.length; i++) {

                (function (key, type, item) {

                    var latLng = new google.maps.LatLng(item.location.lat, item.location.lng);

                    item["type"] = {
                        icon: type.icon,
                        name: type.name
                    };

                    var marker = new google.maps.Marker({
                        position: latLng,
                        icon: type.icon,
                        key: key,
                        data: item
                    });

                    google.maps.event.addListener(marker, 'click', function () {
                        tmpl.open(map, this);
                    });

                    markers.push(marker);

                })(type, data[type], data[type].data[i]);

            }
        }

        return markers;
    }

    function template() {

        var container = document.createElement("div");
        container.setAttribute('class', 'marker-container')

        var myOptions = {
            content: container,
            alignBottom: true,
            boxClass: "marker",
            disableAutoPan: false,
            pixelOffset: new google.maps.Size(-50, -50),
            closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
            enableEventPropagation: true
        };

        var ib = new InfoBox(myOptions);

        function open(map, marker) {

            container.innerHTML = "";

            var link = document.createElement('a');
            link.setAttribute('href', marker.data.link || '#');

            var logo = logoContainer(link, marker.data.logo);
            var title = titleContainer(link, marker.data.title);
            var type = typeContainer(marker.data.type);
            var list = listContainer(marker.data.list);

            var context = document.createElement('div');
            context.setAttribute('class', 'marker-context');

            context.appendChild(title);
            context.appendChild(type);
            context.appendChild(list);

            var sidebar = document.createElement('div');
            sidebar.setAttribute('class', 'marker-sidebar');

            container.appendChild(logo);
            container.appendChild(context);
            container.appendChild(sidebar);

            ib.open(map, marker);
        }

        var logoContainer = function (link, linkLogo) {

            var $link = link.cloneNode(true);

            var $container = document.createElement('div');
            $container.setAttribute('class', 'marker-logo');

            if (linkLogo) {
                var $image = document.createElement('img');
                $image.setAttribute('src', linkLogo);

                $link.appendChild($image);
            }

            $container.appendChild($link)

            return $container;
        };

        var titleContainer = function (link, title) {
            var $link = link.cloneNode(true);

            var $container = document.createElement('div');
            $container.setAttribute('class', 'marker-title');

            $link.innerText = title;

            $container.appendChild($link);

            return $container;
        };

        var typeContainer = function (type) {

            var $container = document.createElement('div');
                $container.setAttribute('class', 'marker-type');

            if (type.icon) {
                var $image = document.createElement('img');
                $image.setAttribute('src', type.icon);

                $container.appendChild($image);
            }

             if (type.name) {
                 var $name = document.createElement('span');
                 $name.innerText = type.name;

                 $container.appendChild($name);
             }

            return $container;
        };

        var listContainer = function(list){

            var $container = document.createElement('ul');
            var $item = document.createElement('li');

            for(var i = 0; i < list.length; i++){

                var itemData  = list[i];
                var item = $item.cloneNode(true);

                if(!itemData.value)
                    continue;

                item.innerText = (itemData.key? itemData.key + ": " : "") + itemData.value;

                $container.appendChild(item);
            }

            return $container;
        };

        return {
            open: open,
            ib: ib
        };
    }


}