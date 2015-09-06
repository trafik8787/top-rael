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
            //die(HTML::x($data));
            Cookie::set($key, $data, Date::YEAR);
        }

    }

    /**
     * @param $key
     * @param array $value
     * Обновляем куки файл принимает масив
     */
    public static function update_Arr_set_json ($key, array $value){

        $data = json_encode($value);
        Cookie::delete($key);
        Cookie::set($key, $data, Date::YEAR);

    }

    /**
     * @param $key
     * удалить купон
     */
    public static function del_coupon ($key){

        $data = Cookie::get('favoritcoup');
        $data = json_decode($data);
        $key = array_search($key, $data);
        unset($data[$key]);

        $res = array();
        foreach ($data as $row) {
            $res[] = $row;
        }
        $data = json_encode($res);

        Cookie::delete('favoritcoup');
        Cookie::set('favoritcoup', $data, Date::YEAR);

    }

    /**
     * @param $key
     * удалить бизнес
     */
    public static function del_bussines ($key){

        $data = Cookie::get('favoritbus');
        $data = json_decode($data);
        $key = array_search($key, $data);
        unset($data[$key]);

        $res = array();
        foreach ($data as $row) {
            $res[] = $row;
        }
        $data = json_encode($res);

        Cookie::delete('favoritbus');
        Cookie::set('favoritbus', $data, Date::YEAR);

    }

    /**
     * @param $key
     * удалить обзор из кабинета
     */
    public static function del_articles ($key){

        $data = Cookie::get('favoritartic');
        $data = json_decode($data);
        $key = array_search($key, $data);

        unset($data[$key]);

        $res = array();
        foreach ($data as $row) {
            $res[] = $row;
        }
        $data = json_encode($res);

        Cookie::delete('favoritartic');
        Cookie::set('favoritartic', $data, Date::YEAR);
        //die(HTML::x($data));

    }

}
