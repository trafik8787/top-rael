/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Capitalize = (function () {
        function Capitalize() {
        }
        Capitalize.first = function (value) {
            return value.charAt(0).toUpperCase() + value.slice(1);
        };
        return Capitalize;
    })();
    Orb.Capitalize = Capitalize;
})(Orb || (Orb = {}));
//# sourceMappingURL=capitalize.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.clone = function (value) {
        return JSON.parse(JSON.stringify(value));
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=clone.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Cookie = (function () {
        function Cookie() {
        }
        Cookie.prototype.get = function (name) {
            var regex = new RegExp("(?:(?:^|.*;)\\s*" + Orb.encode(name).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=\\s*([^;]*).*$)|^.*$");
            var result = Orb.decode(document.cookie.replace(regex, "$1"));
            try {
                result = JSON.parse(result);
            }
            catch (er) { }
            return result || null;
        };
        Cookie.prototype.set = function (name, value, end, path, domain, secure) {
            if (!name || /^(?:expires|max\-age|path|domain|secure)$/i.test(name)) {
                return false;
            }
            var expires = "";
            if (end) {
                switch (end.constructor) {
                    case Number:
                        expires = end === Infinity ? "; expires=Fri, 31 Dec 9999 23:59:59 GMT" : "; max-age=" + end;
                        break;
                    case String:
                        expires = "; expires=" + end;
                        break;
                    case Date:
                        expires = "; expires=" + end.toUTCString();
                        break;
                }
            }
            document.cookie = Orb.encode(name) + "=" + Orb.encode(JSON.stringify(value)) + expires + (domain ? "; domain=" + domain : "") + (path ? "; path=" + path : "") + (secure ? "; secure" : "");
        };
        Cookie.prototype.remove = function (name, path, domain) {
            if (!this.has(name)) {
                return false;
            }
            document.cookie = Orb.encode(name) + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT" + (domain ? "; domain=" + domain : "") + (path ? "; path=" + path : "");
        };
        Cookie.prototype.has = function (name) {
            return (new RegExp("(?:^|;\\s*)" + Orb.encode(name).replace(/[\-\.\+\*]/g, "\\$&") + "\\s*\\=")).test(document.cookie);
        };
        Cookie.prototype.all = function () {
            var keys = document.cookie.replace(/((?:^|\s*;)[^\=]+)(?=;|$)|^\s*|\s*(?:\=[^;]*)?(?:\1|$)/g, "").split(/\s*(?:\=[^;]*)?;\s*/);
            for (var nLen = keys.length, nIdx = 0; nIdx < nLen; nIdx++) {
                keys[nIdx] = Orb.decode(keys[nIdx]);
            }
            return keys;
        };
        return Cookie;
    })();
    Orb.Cookie = Cookie;
})(Orb || (Orb = {}));
//# sourceMappingURL=cookie.js.map;/// <reference path="../../typings/_enums.ts" />
/// <reference path="../../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var DOMContentLoaded = (function () {
        function DOMContentLoaded() {
        }
        DOMContentLoaded.prototype.add = function (callback) {
            var _this = this;
            this.callback = callback;
            this.handle = function () {
                if (_this.callback != callback) {
                    return;
                }
                try {
                    _this.callback();
                }
                catch (er) { }
            };
            if (document.addEventListener) {
                document.addEventListener("DOMContentLoaded", this.handle.bind(this), false);
            }
            else {
                document.attachEvent("onreadystatechange", this.handle.bind(this));
            }
        };
        DOMContentLoaded.prototype.remove = function (callback) {
            if (document.removeEventListener) {
                document.removeEventListener("DOMContentLoaded", this.handle.bind(this), false);
            }
            else {
                document.detachEvent("onreadystatechange", this.handle.bind(this));
            }
        };
        return DOMContentLoaded;
    })();
    Orb.DOMContentLoaded = DOMContentLoaded;
})(Orb || (Orb = {}));
//# sourceMappingURL=domcontentloaded.js.map;/// <reference path="../../typings/_enums.ts" />
/// <reference path="../../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var EventListener = (function () {
        function EventListener() {
        }
        EventListener.prototype.add = function (element, event, callback) {
            if (element.addEventListener) {
                element.addEventListener(event, callback, false);
            }
            else {
                element.attachEvent("on" + event, callback);
            }
        };
        EventListener.prototype.remove = function (element, event, callback) {
            if (element.removeEventListener) {
                element.removeEventListener(event, callback, false);
            }
            else {
                element.detachEvent("on" + event, callback);
            }
        };
        EventListener.prototype.has = function (element, event) {
            return element[event] ? true : false;
        };
        EventListener.prototype.stopPropagation = function (event) {
            if (!event)
                event = window.event;
            event.returnValue = false;
            if (event.stopPropagation)
                event.stopPropagation();
        };
        EventListener.prototype.preventDefault = function (event) {
            if (!event)
                event = window.event;
            event.cancelBubble = true;
            if (event.preventDefault)
                event.preventDefault();
        };
        return EventListener;
    })();
    Orb.EventListener = EventListener;
})(Orb || (Orb = {}));
//# sourceMappingURL=eventlistener.js.map;var Orb;
(function (Orb) {
    'use strict';
})(Orb || (Orb = {}));
//# sourceMappingURL=ieventlistener.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.decode = function (value) {
        return decodeURI(decodeURIComponent(value));
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=decode.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.encode = function (value) {
        return encodeURIComponent(encodeURI(value));
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=encode.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Events = (function () {
        function Events() {
            this.listeners = {};
        }
        Events.prototype.on = function (listener, callback) {
            if (!this.listeners.hasOwnProperty(listener)) {
                this.listeners[listener] = [];
            }
            this.listeners[listener].push(callback);
        };
        Events.prototype.off = function (listener, callback) {
            if (this.listeners.hasOwnProperty(listener)) {
                for (var i = 0, len = this.listeners[listener].length; i < len; i++) {
                    if (this.listeners[listener][i] === callback) {
                        this.listeners[listener].splice(i, 1);
                        break;
                    }
                }
            }
        };
        Events.prototype.once = function (listener, callback) {
            var _this = this;
            var handle = function () {
                var rest = [];
                for (var _i = 0; _i < arguments.length; _i++) {
                    rest[_i - 0] = arguments[_i];
                }
                _this.off(listener, handle);
                callback.apply(undefined, rest);
            };
            this.on(listener, handle);
        };
        Events.prototype.trigger = function (key) {
            var rest = [];
            for (var _i = 1; _i < arguments.length; _i++) {
                rest[_i - 1] = arguments[_i];
            }
            var args = Array.prototype.slice.call(rest);
            if (this.listeners.hasOwnProperty(key)) {
                for (var i = 0, len = this.listeners[key].length; i < len; i++) {
                    try {
                        this.listeners[key][i].apply(undefined, args);
                    }
                    catch (er) { }
                }
            }
        };
        return Events;
    })();
    Orb.Events = Events;
})(Orb || (Orb = {}));
//# sourceMappingURL=events.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.guid = function () {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=guid.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Iframe = (function () {
        function Iframe(path, name) {
            this.path = path;
            this.name = name;
            this.isReady = false;
            this.id = Orb.unique(Date.now()).toString();
            this.lock = false;
            this.EventListener = new Orb.EventListener();
            this.setAttributes();
        }
        Iframe.prototype.setAttributes = function () {
            var _this = this;
            this.el = document.createElement("IFRAME");
            this.el.setAttribute("src", "" + this.path);
            this.el.setAttribute("id", "" + this.name + this.id);
            this.el.setAttribute("name", "" + this.name + this.id);
            this.el.setAttribute("scrolling", "no");
            this.el.setAttribute("frameborder", "0");
            this.EventListener.add(this.el, "load", function () {
                _this.isReady = true;
            });
        };
        Iframe.prototype.remove = function () {
            try {
                this.el.parentNode.removeChild(this.el);
            }
            catch (er) { }
        };
        Iframe.prototype.ready = function (callback) {
            var _this = this;
            if (this.isReady) {
                callback();
            }
            else {
                if (!this.lock) {
                    this.lock = true;
                    this.EventListener.add(this.el, "load", function () {
                        _this.lock = false;
                        _this.isReady = true;
                        callback();
                    });
                }
                else {
                    setTimeout(function () { _this.ready(callback); });
                }
            }
        };
        return Iframe;
    })();
    Orb.Iframe = Iframe;
})(Orb || (Orb = {}));
//# sourceMappingURL=iframe.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.is = function (name, value) {
        return toString.call(value) === "[object " + Orb.Capitalize.first(name) + "]";
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=is.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Location = (function () {
        function Location() {
        }
        Location.parseQueryObject = function (value) {
            var result = [];
            if (!Orb.is("Object", value)) {
                return result;
            }
            for (var k in value) {
                if (value.hasOwnProperty(k)) {
                    result.push(k + "=" + Orb.encode(value[k]));
                }
            }
            return result;
        };
        Location.parseQueryString = function (value) {
            var params = {};
            if (!value || !Orb.is("String", value)) {
                return params;
            }
            var queryString = value.indexOf('?') >= 0 ? value.split('?')[1] : value;
            var queryList = queryString.split('&');
            for (var i = 0; i < queryList.length; i++) {
                var query = queryList[i].split('=');
                if (query[1] == undefined) {
                    query[1] = 'true';
                }
                try {
                    params[Orb.decode(query[0])] = JSON.parse(Orb.decode(query[1]));
                }
                catch (er) {
                    params[Orb.decode(query[0])] = Orb.decode(query[1]);
                }
            }
            return params;
        };
        Location.hash = function (value) {
            if (!value || !Orb.is("String", value)) {
                value = window.location.href;
            }
            var urlResolve = Location.resolve(value);
            var hashObject = Location.parseQueryString(urlResolve.hash);
            return hashObject;
        };
        Location.query = function (value) {
            if (!value || !Orb.is("String", value)) {
                value = window.location.href;
            }
            var urlResolve = Location.resolve(value);
            var queryObject = Location.parseQueryString(urlResolve.search);
            return queryObject;
        };
        Location.resolve = function (value) {
            var el = document.createElement("a");
            el.setAttribute('href', value);
            value = el.href;
            return {
                href: el.href,
                protocol: el.protocol ? el.protocol.replace(/:$/, '') : '',
                host: el.host,
                search: el.search ? el.search.replace(/^\?/, '') : '',
                hash: el.hash ? el.hash.replace(/^#/, '') : '',
                hostname: el.hostname,
                port: el.port,
                pathname: (el.pathname.charAt(0) === '/') ? el.pathname : '/' + el.pathname,
                origin: el.protocol + "//" + el.hostname + (el.port ? ':' + el.port : '')
            };
        };
        Location.origin = (function () {
            if (!window.location.hasOwnProperty('origin')) {
                var url = Location.resolve(window.location.href);
                return url.protocol + "://" + url.hostname + (url.port ? ':' + url.port : '');
            }
            else {
                return window.location.origin;
            }
        })();
        return Location;
    })();
    Orb.Location = Location;
})(Orb || (Orb = {}));
//# sourceMappingURL=Location.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Mobile = (function () {
        function Mobile() {
        }
        Mobile.Android = function () {
            return navigator.userAgent.match(/Android/i);
        };
        Mobile.BlackBerry = function () {
            return navigator.userAgent.match(/BlackBerry/i);
        };
        Mobile.iOS = function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        };
        Mobile.Opera = function () {
            return navigator.userAgent.match(/Opera Mini/i);
        };
        Mobile.Windows = function () {
            return navigator.userAgent.match(/IEMobile/i);
        };
        Mobile.any = function () {
            return (this.Android() || this.BlackBerry() || this.iOS() || this.Opera() || this.Windows());
        };
        return Mobile;
    })();
    Orb.Mobile = Mobile;
})(Orb || (Orb = {}));
//# sourceMappingURL=mobile.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Ready = (function () {
        function Ready(element, callback) {
            this.element = element;
            this.callback = callback;
            this.isReady = false;
            this.EventListener = new Orb.EventListener();
            this.DOMContentLoaded = new Orb.DOMContentLoaded();
            this.run();
        }
        Ready.prototype.ready = function () {
            if (this.isReady == true) {
                return;
            }
            if (!document.body) {
                return setTimeout(this.ready);
            }
            this.isReady = true;
            try {
                this.callback();
            }
            catch (er) { }
        };
        Ready.prototype.run = function () {
            if (document.readyState === "complete") {
                setTimeout(this.ready);
            }
            else {
                this.DOMContentLoaded.add(this.completed.bind(this));
                this.EventListener.add(window, 'load', this.completed.bind(this));
            }
            var top = false;
            try {
                top = window.frameElement == null && document.documentElement;
            }
            catch (e) { }
            if (top && top.doScroll) {
                (function doScrollCheck() {
                    if (!this.isReady) {
                        try {
                            top.doScroll("left");
                        }
                        catch (e) {
                            return setTimeout(doScrollCheck, 50);
                        }
                        this.detach();
                        this.ready();
                    }
                })();
            }
        };
        Ready.prototype.completed = function () {
            if (document.readyState === "complete") {
                this.detach();
                this.ready();
            }
        };
        Ready.prototype.detach = function () {
            this.DOMContentLoaded.remove(this.completed.bind(this));
            this.EventListener.remove(window, 'load', this.completed.bind(this));
        };
        return Ready;
    })();
    Orb.Ready = Ready;
})(Orb || (Orb = {}));
//# sourceMappingURL=ready.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Request = (function () {
        function Request(dataType, contentType) {
            this.dataType = dataType;
            this.contentType = contentType;
            this.reconnect = {
                timer: 5000,
                times: 0 // reconnect times
            };
            this.timer = this.reconnect.timer;
        }
        Request.prototype.get = function (url, success, fail, headers) {
            this.backend("GET", url, null, {
                success: success,
                fail: fail
            }, headers);
        };
        Request.prototype.post = function (url, data, success, fail, headers) {
            this.backend("POST", url, data, {
                success: success,
                fail: fail
            }, headers);
        };
        Request.prototype.delete = function () { };
        Request.prototype.update = function () { };
        Request.prototype.backend = function (method, url, data, callback, headers, withCredentials) {
            var _this = this;
            var xhr = new XMLHttpRequest();
            var result;
            var timeout;
            var arg = arguments;
            xhr.open(method, url, true);
            if (this.contentType) {
                xhr.setRequestHeader("Content-Type", this.contentType);
                xhr.setRequestHeader("Accept", this.contentType);
            }
            if (this.dataType) {
                xhr.responseType = this.dataType;
            }
            for (var k in headers) {
                xhr.setRequestHeader(k, headers[k]);
            }
            xhr.withCredentials = withCredentials;
            xhr.onload = function () {
                var statusText = xhr.statusText || 'Request Aborted';
                var response = ('response' in xhr) ? xhr.response : xhr.responseText;
                var status = xhr.status === 1223 ? 204 : xhr.status;
                var headers = xhr.getAllResponseHeaders();
                if (status === 0) {
                    status = response ? 200 : Orb.Location.resolve(url).protocol == 'file' ? 404 : 0;
                }
                result = {
                    status: status,
                    response: response,
                    header: headers,
                    statusText: statusText,
                    callback: callback
                };
                clearTimeout(timeout);
                if (result.status == 200) {
                    try {
                        callback.success(result);
                    }
                    catch (er) { }
                }
                else {
                    try {
                        callback.fail(result);
                    }
                    catch (er) { }
                }
            };
            xhr.onerror = function () {
                clearTimeout(timeout);
                try {
                    callback.fail(result);
                }
                catch (er) { }
            };
            xhr.onabort = function () {
                clearTimeout(timeout);
                try {
                    callback.fail(result);
                }
                catch (er) { }
            };
            timeout = setTimeout(function () {
                try {
                    if (result.status == 200 || xhr.status == 200) {
                        callback.success(result);
                        return;
                    }
                }
                catch (er) { }
                xhr.abort();
                if (_this.reconnect.times <= 1) {
                    try {
                        callback.fail(result);
                    }
                    catch (er) { }
                    return;
                }
                _this.reconnect.times--;
                setTimeout(function () {
                    _this.backend.apply(_this, arg);
                }, _this.reconnect.timer);
            }, 5000);
            xhr.send(data || null);
        };
        return Request;
    })();
    Orb.Request = Request;
})(Orb || (Orb = {}));
//# sourceMappingURL=request.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.resize = function (element, callback) {
        if (element != window) {
            try {
                var oldSize = {
                    width: element.offsetlWidth || element.scrollWidth,
                    height: element.offsetHeight || element.scrollHeight
                };
                var newSize = {
                    width: 0,
                    height: 0
                };
                callback(oldSize);
                var process = function () {
                    newSize = {
                        width: element.offsetlWidth || element.scrollWidth,
                        height: element.offsetHeight || element.scrollHeight
                    };
                    if (JSON.stringify(oldSize) != JSON.stringify(newSize)) {
                        callback(newSize);
                    }
                    oldSize = newSize;
                    setTimeout(process, 50);
                };
                setTimeout(process, 50);
            }
            catch (er) { }
            return;
        }
        var _eventListener = new Orb.EventListener();
        _eventListener.add(element, 'resize', function () {
            callback({
                width: element.outerWidth,
                height: element.outerHeight
            });
        });
    };
})(Orb || (Orb = {}));
;
//# sourceMappingURL=resize.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var Storage = (function () {
        function Storage(params) {
            this.prefix = "";
            this.separator = ".";
            this.data = localStorage;
            this.Events = new Orb.Events();
            if (params.prefix) {
                this.prefix = params.prefix;
            }
            if (params.separator) {
                this.separator = params.separator;
            }
            if (params.data === "sessionStorage") {
                this.data = sessionStorage;
            }
        }
        Storage.prototype.Enabled = function () {
            try {
                this.data.setItem("_key_", "_value_");
                this.data.removeItem("_key_");
                return true;
            }
            catch (er) {
                return false;
            }
        };
        Storage.prototype.get = function (name) {
            if (!name) {
                return this.all();
            }
            var keys = name.toLowerCase().split(this.separator);
            var process = function (keys, all) {
                var key = keys.shift();
                if (!all.hasOwnProperty(key)) {
                    return undefined;
                }
                if (keys.length) {
                    all[key] = process(keys, all[key]);
                }
                return all[key];
            };
            return process(keys, this.all());
        };
        Storage.prototype.set = function (o) {
            var key = [];
            if (o.hasOwnProperty("key") && o.hasOwnProperty("value")) {
                this.save({ key: o.key, value: o.value });
            }
            else {
                o = this.transform(o);
                for (var k in o) {
                    if (o.hasOwnProperty[k]) {
                        this.save({ key: o[k].key.join(this.separator).toLowerCase(), value: o[k].value });
                    }
                }
            }
            return true;
        };
        Storage.prototype.transform = function (o) {
            var process = function (o, k, r) {
                var keys;
                k = k || [];
                r = r || [];
                for (var i in o) {
                    if (Orb.is("Object", o[i]) && Object.keys(o[i]).length) {
                        for (var j in o[i]) {
                            keys = [];
                            keys = keys.concat(k.slice(0));
                            keys.push(i);
                            keys.push(j);
                            if (Orb.is("Object", o[i][j]) && Object.keys(o[i][j]).length) {
                                process(o[i][j], keys, r);
                            }
                            else {
                                r.push({ key: keys, value: o[i][j] });
                            }
                        }
                    }
                    else {
                        keys = k;
                        keys = keys.concat(i);
                        r.push({ key: keys, value: o[i] });
                    }
                }
                return r;
            };
            return process(o);
        };
        Storage.prototype.save = function (o) {
            if (this.Enabled()) {
                try {
                    this.data.setItem(o.key.toLowerCase(), JSON.stringify(o.value));
                }
                catch (er) {
                    this.data.setItem(o.key.toLowerCase(), o.value);
                }
            }
            if (this.Events.listeners.hasOwnProperty(o.key)) {
                this.Events.trigger(o.key, o.value);
            }
        };
        Storage.prototype.remove = function (name) {
            var key = name.toLowerCase();
            var result = [{ key: [key] }];
            var o = this.transform(this.get(key));
            for (var i = 0; i < o.length; i++) {
                o[i].key = o[i].key.splice(1, 0, key);
            }
            result = result.concat(o);
            for (var i = 0; i < result.length; i++) {
                if (this.Enabled()) {
                    this.data.removeItem(result[i].key.join(this.separator));
                    if (this.Events.listeners.hasOwnProperty("Remove")) {
                        this.Events.trigger("Remove", key);
                    }
                }
            }
        };
        Storage.prototype.all = function () {
            var _this = this;
            var result = {};
            if (!this.Enabled()) {
                return result;
            }
            var build = function (k, o, n) {
                k = k || [];
                n = n || [];
                var key = k.shift();
                o[key] = o[key] || {};
                if (k.length) {
                    o[key] = build(k, o[key], n);
                }
                else {
                    try {
                        o[key] = JSON.parse(_this.data.getItem(n.join(_this.separator)));
                    }
                    catch (er) {
                        o[key] = _this.data.getItem(n.join(_this.separator));
                    }
                }
                return o;
            };
            for (var key in this.data) {
                var keys = key.split(this.separator);
                if (keys.indexOf(this.prefix) !== -1) {
                    keys.splice(keys.indexOf(this.prefix), 1);
                }
                result = build(keys, result);
            }
            return result;
        };
        return Storage;
    })();
    Orb.Storage = Storage;
})(Orb || (Orb = {}));
//# sourceMappingURL=storage.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    Orb.unique = function (value) {
        var d = new Date();
        var hash = (function (value) {
            var hash = 0;
            if (value.length == 0)
                return hash;
            for (var i = 0; i < value.length; i++) {
                hash = ((hash << 5) - hash) + value.charCodeAt(i);
                hash = hash & hash;
            }
            return hash;
        })(value.toString());
        return parseInt(((Math.random() * hash) + d.getTime()).toString().substr(0, d.getTime().toString().length));
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=unique.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
    var WindowOpen = (function () {
        function WindowOpen(url, name, options) {
            this.url = url;
            this.name = name;
            this.options = options;
            this.Events = new Orb.Events();
            this.EventListener = new Orb.EventListener();
        }
        WindowOpen.prototype.open = function () {
            this.win = window.open(this.url, this.setName(), this.setOptions());
            if (this.win && this.win.focus) {
                this.win.focus();
            }
            this.interval();
        };
        WindowOpen.prototype.load = function (callback) {
            this.Events.once('load', function (response) {
                try {
                    callback(response);
                }
                catch (er) { }
            });
        };
        WindowOpen.prototype.exit = function (callback) {
            this.Events.once('exit', function (response) {
                try {
                    callback(response);
                }
                catch (er) { }
            });
        };
        WindowOpen.prototype.interval = function () {
            var _this = this;
            var _interval = setInterval(function () {
                try {
                    if (_this.win.location.host === document.location.host && (_this.win.location.search || _this.win.location.hash)) {
                        var hash = Orb.Location.hash(_this.win.location.hash);
                        var query = Orb.Location.query(_this.win.location.search);
                        if (query.error) {
                            _this.Events.trigger("exit", {
                                hash: hash,
                                query: query
                            });
                        }
                        else {
                            _this.Events.trigger("load", {
                                hash: hash,
                                query: query
                            });
                        }
                        _this.win.close();
                        clearInterval(_interval);
                    }
                }
                catch (er) { }
                if (!_this.win) {
                    clearInterval(_interval);
                    _this.Events.trigger("exit", Error('Provider Popup Blocked'));
                }
                else if (_this.win.closed || _this.win.closed === undefined) {
                    clearInterval(_interval);
                    _this.Events.trigger("exit", Error('Authorization Failed'));
                }
            });
        };
        WindowOpen.prototype.setName = function () {
            return this.name || "";
        };
        WindowOpen.prototype.setOptions = function () {
            var result = [];
            for (var key in this.options) {
                result.push(key + "=" + this.options[key]);
            }
            return result.join(",");
        };
        return WindowOpen;
    })();
    Orb.WindowOpen = WindowOpen;
})(Orb || (Orb = {}));
//# sourceMappingURL=windowopen.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    "use strict";
    var extendObject = (function () {
        function extendObject() {
            var rest = [];
            for (var _i = 0; _i < arguments.length; _i++) {
                rest[_i - 0] = arguments[_i];
            }
            for (var i = 0; i < rest.length; i++) {
                for (var key in rest[i]) {
                    if (rest[i].hasOwnProperty(key)) {
                        this[key] = rest[i][key];
                    }
                }
            }
        }
        return extendObject;
    })();
    Orb.extendObject = extendObject;
})(Orb || (Orb = {}));
//# sourceMappingURL=extendobject.js.map;/// <reference path="../typings/_enums.ts" />
/// <reference path="../typings/_orb.ts" />
var Orb;
(function (Orb) {
    "use strict";
    Orb.filterObject = function (o, v) {
        var result = [];
        var process = function (value) {
            if (Orb.is("Array", value)) {
                for (var i = 0; i < value.length; i++) {
                    process(value[i]);
                }
            }
            if (Orb.is("Object", value)) {
                for (var k in value) {
                    if (k === v.key && v.value != undefined && v.value && value[k] === v.value) {
                        result.push(value[k]);
                    }
                    else if (k === v.key && v.value === undefined) {
                        result.push(value[k]);
                    }
                    else if (Orb.is("Object", value)) {
                        process(value[k]);
                    }
                }
            }
        };
        return result;
    };
})(Orb || (Orb = {}));
//# sourceMappingURL=filterobject.js.map;var Orb;
(function (Orb) {
    'use strict';
})(Orb || (Orb = {}));
//# sourceMappingURL=iresize.js.map;/// <reference path="../../typings/_enums.ts" />
/// <reference path="../../typings/_orb.ts" />
var Orb;
(function (Orb) {
    'use strict';
})(Orb || (Orb = {}));
//# sourceMappingURL=iwindowopen.js.map