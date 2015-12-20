<?php defined('SYSPATH') OR die('No direct script access.');

class Request extends Kohana_Request {

    public static function full_current_url()
    {
        $result = ''; // Пока результат пуст
        $default_port = 80; // Порт по-умолчанию

        // А не в защищенном-ли мы соединении?
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
            // В защищенном! Добавим протокол...
            $result .= 'https://';
            // ...и переназначим значение порта по-умолчанию
            $default_port = 443;
        } else {
            // Обычное соединение, обычный протокол
            $result .= 'http://';
        }
        // Имя сервера, напр. site.com или www.site.com
        $result .= $_SERVER['SERVER_NAME'];

        // А порт у нас по-умолчанию?
        if ($_SERVER['SERVER_PORT'] != $default_port) {
            // Если нет, то добавим порт в URL
            $result .= ':'.$_SERVER['SERVER_PORT'];
        }
        // Последняя часть запроса (путь и GET-параметры).
        $result .= $_SERVER['REQUEST_URI'];
        // Уфф, вроде получилось!
        return $result;
    }

    public function DetectUri () {
        $url = $this->uri();
        $url = explode('/', $url);

        if (isset($url[1])) {
            return '/'.$url[0] .'/'.$url[1];
        }

    }

}
