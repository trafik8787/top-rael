/**
 * Created by Fedor on 8/29/2015.
 */
$(function () {
    initMap();
});

function initMap() {

    var EventListener = new Orb.EventListener();
    var geocoder = new google.maps.Geocoder();
    var markers = [];
    var map;

    function favoritesClick() {
        console.log(arguments);
    }

    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: 32.0650, lng: 34.7700}
    });

    var cluster = new MarkerClusterer(map, [], {ignoreHidden: true});
    var tmpl = template();

    markers = setMarkes(getData());

    cluster.addMarkers(markers);

    for (var i = 0; i < markers.length; i++) {
        google.maps.event.addListener(markers[i], 'click', function () {
            tmpl.open(map, this);
        });
    }

    showMarkerByHash(map, markers);
    search(tmpl.ib);

    EventListener.add(window, 'hashchange', function (response) {
        showMarkerByHash(map, markers)
    });

    $('[data-map-filter] input').off('click').on('click', function () {

        var checked = this.checked;
        var section = this.value;

        tmpl.ib.close();

        var $markers = getMarkersBySection(section, markers);

        for (var i = 0; i < $markers.length; i++) {
            var value = !$markers[i].visible;
            $markers[i].setVisible(value);
        }
    });

    $('[data-map-shortkey]').off('click').on('click', function () {

        var $this = $(this);
        var term = $this.data('map-shortkey');

        if (!term) {
            return false;
        }

        tmpl.ib.close();

        workerSearchAdress(term, geocoder, function (results) {
            map.setZoom(14);
            map.setCenter(results[0].geometry.location);
        });
    });

    function search(infobox) {

        var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));

        searchBox.addListener('places_changed', function () {

            var places = searchBox.getPlaces();

            infobox.close();

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

            //TODO load markers by adress

            map.fitBounds(bounds);
        });
    }

    function getData() {

        return window.dataMapsBus;
        //return [
        //    {
        //        id: 1,
        //        title: "test1",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
        //        section: {
        //            id: 1,
        //            name: "Рестораны",
        //            icon: "/public/images/map-markers/red.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "http://google.com",
        //        linkCoupons: "http://google.com",
        //        linkLuxury: "http://google.com",
        //        location: {
        //            lat: 32.063319,
        //            lng: 34.771535
        //        }
        //    },
        //
        //    {
        //        id: 2,
        //        title: "test2",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
        //        section: {
        //            id: 1,
        //            name: "Рестораны",
        //            icon: "/public/images/map-markers/red.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.062112,
        //            lng: 34.77072
        //        }
        //    },
        //
        //    {
        //        id: 3,
        //        title: "test3",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1642.png",
        //        section: {
        //            id: 1,
        //            name: "Рестораны",
        //            icon: "/public/images/map-markers/red.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.063346,
        //            lng: 34.769848
        //        }
        //    },
        //
        //    {
        //        id: 4,
        //        title: "test4",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1657.png",
        //        section: {
        //            id: 1,
        //            name: "Рестораны",
        //            icon: "/public/images/map-markers/red.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.064374,
        //            lng: 34.79881
        //        }
        //    },
        //
        //    {
        //        id: 5,
        //        title: "test5",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1650.png",
        //        section: {
        //            id: 1,
        //            name: "Рестораны",
        //            icon: "/public/images/map-markers/red.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.061142,
        //            lng: 34.7796
        //        }
        //    },
        //
        //    {
        //        id: 6,
        //        title: "test1",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
        //        section: {
        //            id: 2,
        //            name: "Покупки",
        //            icon: "/public/images/map-markers/violet.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.063319,
        //            lng: 34.779535
        //        }
        //    },
        //
        //    {
        //        id: 7,
        //        title: "test2",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
        //        section: {
        //            id: 2,
        //            name: "Покупки",
        //            icon: "/public/images/map-markers/violet.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.063112,
        //            lng: 34.78072
        //        }
        //    },
        //
        //    {
        //        id: 8,
        //        title: "test1",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
        //        section: {
        //            id: 2,
        //            name: "Покупки",
        //            icon: "/public/images/map-markers/violet.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.066319,
        //            lng: 34.771535
        //        }
        //    },
        //
        //    {
        //        id: 9,
        //        title: "test2",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
        //        section: {
        //            id: 2,
        //            name: "Покупки",
        //            icon: "/public/images/map-markers/violet.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.067319,
        //            lng: 34.771535
        //        }
        //    },
        //
        //    {
        //        id: 10,
        //        title: "test1",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
        //        section: {
        //            id: 3,
        //            name: "Отдых",
        //            icon: "/public/images/map-markers/green.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.043319,
        //            lng: 34.751535
        //        }
        //    },
        //
        //    {
        //        id: 11,
        //        title: "test2",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
        //        section: {
        //            id: 3,
        //            name: "Отдых",
        //            icon: "/public/images/map-markers/green.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.065112,
        //            lng: 34.78072
        //        }
        //    },
        //
        //    {
        //        id: 12,
        //        title: "test1",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
        //        section: {
        //            id: 4,
        //            name: "Красота",
        //            icon: "/public/images/map-markers/pink.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.064319,
        //            lng: 34.774535
        //        }
        //    },
        //
        //    {
        //        id: 13,
        //        title: "test2",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
        //        section: {
        //            id: 4,
        //            name: "Красота",
        //            icon: "/public/images/map-markers/pink.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.062112,
        //            lng: 34.77272
        //        }
        //    },
        //
        //    {
        //        id: 14,
        //        title: "test1",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1664.png",
        //        section: {
        //            id: 5,
        //            name: "Отели",
        //            icon: "/public/images/map-markers/yellow.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.061319,
        //            lng: 34.770535
        //        }
        //    },
        //
        //    {
        //        id: 15,
        //        title: "test2",
        //        logo: "http://pngimg.com/upload/small/car_logo_PNG1641.png",
        //        section: {
        //            id: 5,
        //            name: "Отели",
        //            icon: "/public/images/map-markers/yellow.png",
        //            visible: true
        //        },
        //        list: [
        //            {
        //                key: "",
        //                value: "Открыты ежедневно с 12:00-24:00"
        //            },
        //            {
        //                key: "Адрес",
        //                value: "Ha-Shunit St 2, Герцлия"
        //            },
        //            {
        //                key: "Тел",
        //                value: "09-9514000"
        //            }
        //        ],
        //        link: "",
        //        linkCoupons: "",
        //        linkLuxury: "",
        //        location: {
        //            lat: 32.063519,
        //            lng: 34.777535
        //        }
        //    }
        //];
    }

    function setMarkes(data) {

        var $markers = [];

        for (var i = 0; i < data.length; i++) {

            var item = data[i];

            var latLng = new google.maps.LatLng(item.location.lat, item.location.lng);

            var marker = new google.maps.Marker({
                position: latLng,
                icon: item.section.icon,
                data: item
            });

            $markers.push(marker);
        }

        return $markers;
    }

    function getMarkersBySection(sectionId, markers) {

        var $markers = [];

        for (var i = 0; i < markers.length; i++) {

            if (markers[i].data.section.id == sectionId) {
                $markers.push(markers[i]);
            }
        }

        return $markers;
    }

    function getMarkerById(markerId, markers) {

        var $marker = null;

        for (var i = 0; i < markers.length; i++) {

            if (markers[i].data.id == markerId) {
                $marker = markers[i];
                break;
            }
        }

        return $marker;
    }

    function showMarkerByHash(map, markers) {
        var $hash = Orb.Location.hash(window.location.href);

        if ($hash.hasOwnProperty('marker')) {

            var marker = getMarkerById($hash.marker, markers);

            if (!marker) {
                tmpl.ib.close();
                return;
            }

            if (!marker.visible) {
                return;
            }

            map.setZoom(17);
            map.panTo(marker.position);
            tmpl.open(map, marker);
        }
    }

    function workerSearchAdress(term, geocoder, callback) {

        geocoder.geocode({'address': term}, function (results, status) {

            if (status === google.maps.GeocoderStatus.OK) {
                try {
                    callback(results);
                } catch (er) {
                }
            }
        });
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
            //closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
            enableEventPropagation: true
        };

        var ib = new InfoBox(myOptions);

        function open(map, marker) {

            container.innerHTML = "";

            var link = document.createElement('a');
            link.setAttribute('href', marker.data.link || '#');

            var logo = logoContainer(link, marker.data.logo);
            var title = titleContainer(link, marker.data.title);
            var type = typeContainer(marker.data.section);
            var list = listContainer(marker.data.list);
            var favorite = favoritBtn(marker, favoritesClick);
            var luxury = luxuryBtn(marker.data.linkLuxury);
            var coupon = couponBtn(marker.data.linkCoupons);

            var context = document.createElement('div');
            context.setAttribute('class', 'marker-context');

            context.appendChild(title);
            context.appendChild(type);
            context.appendChild(list);

            var sidebar = document.createElement('div');
            sidebar.setAttribute('class', 'marker-sidebar');
            sidebar.appendChild(favorite);

            if (luxury) {
                sidebar.appendChild(luxury);
            }

            if (coupon) {
                sidebar.appendChild(coupon);
            }

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
            $link.setAttribute('target', '_blank');

            $container.appendChild($link);

            return $container;
        };

        var typeContainer = function (section) {

            var $container = document.createElement('div');
            $container.setAttribute('class', 'marker-type');

            if (section.icon) {
                var $image = document.createElement('img');
                $image.setAttribute('src', section.icon);
                $image.setAttribute('class', 'marker-type-icon');

                $container.appendChild($image);
            }

            if (section.name) {
                var $name = document.createElement('span');
                $name.innerText = section.name;

                $container.appendChild($name);
            }

            return $container;
        };

        var listContainer = function (list) {

            var $container = document.createElement('ul');
            var $item = document.createElement('li');

            for (var i = 0; i < list.length; i++) {

                var itemData = list[i];
                var item = $item.cloneNode(true);

                if (!itemData.value)
                    continue;

                item.innerText = (itemData.key ? itemData.key + ": " : "") + itemData.value;

                $container.appendChild(item);
            }

            return $container;
        };

        var favoritBtn = function (marker, callback) {

            var $container = document.createElement('div');
            $container.setAttribute('class', 'marker-favorites');

            var $href = document.createElement('a');

            $href.innerHTML = '<i class="fa fa-star"></i> Сохранить в Избранное';

            EventListener.add($href, 'click', function () {
                try {
                    callback(marker);
                } catch (er) {
                }
            });

            $container.appendChild($href);

            return $container;
        };

        var luxuryBtn = function (link) {

            var $container = document.createElement('div');
            $container.setAttribute('class', 'marker-luxury');
            $container.innerHTML = '<a href="' + (link || '#') + '" class="button" target="_blank"><span>LUXURY</span></a>';

            return link ? $container : false;
        };

        var couponBtn = function (link) {

            var $container = document.createElement('div');
            $container.setAttribute('class', 'marker-coupon');
            $container.innerHTML = '<a href="' + (link || '#') + '" target="_blank"><i class="fa fa-scissors"></i> Есть купон</a>';

            return link ? $container : false;
        };

        return {
            open: open,
            ib: ib
        };
    }
}