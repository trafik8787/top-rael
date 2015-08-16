<?php defined('SYSPATH') OR die('No direct script access.');

class Cookie extends Kohana_Cookie {

    /**
     * @param null $key
     * @param $value
     * если куки есть то обновляем его если нет то создаем
     */
    public static function update_and_set_json ($key, $value){

        $data = Cookie::get($key);


        if (!empty($data)) {

            $data = json_decode($data);
            array_push($data, $value);
            $data = json_encode($data);
            Cookie::delete($key);
            Cookie::set($key, $data, Date::YEAR);

        } else {

            $data = json_encode(array($value));
            Cookie::set($key, $data, Date::YEAR);
        }

    }
}
