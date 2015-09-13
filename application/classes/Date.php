<?php defined('SYSPATH') OR die('No direct script access.');

class Date extends Kohana_Date {

    public static function fuzzy_span($timestamp, $local_timestamp = NULL)
    {
        $local_timestamp = ($local_timestamp === NULL) ? time() : (int) $local_timestamp;

        // Determine the difference in seconds
        $offset = abs($local_timestamp - $timestamp);

        if ($offset <= Date::MINUTE)
        {
            $span = 'меньше минуты';
        }
        elseif ($offset < (Date::MINUTE * 20))
        {
            $span = 'несколько минут';
        }
        elseif ($offset < Date::HOUR)
        {
            $span = 'меньше часа';
        }
        elseif ($offset < (Date::HOUR * 4))
        {
            $span = 'пару часов';
        }
        elseif ($offset < Date::DAY)
        {
            $span = 'меньше суток';
        }
        elseif ($offset < (Date::DAY * 2))
        {
            $span = 'около суток';
        }
        elseif ($offset < (Date::DAY * 4))
        {
            $span = 'пару дней';
        }
        elseif ($offset < Date::WEEK)
        {
            $span = 'меньше недели';
        }
        elseif ($offset < (Date::WEEK * 2))
        {
            $span = 'около недели';
        }
        elseif ($offset < Date::MONTH)
        {
            $span = 'менее месяца';
        }
        elseif ($offset < (Date::MONTH * 2))
        {
            $span = 'около месяца';
        }
        elseif ($offset < (Date::MONTH * 4))
        {
            $span = 'пару месяцев';
        }
        elseif ($offset < Date::YEAR)
        {
            $span = 'менее года';
        }
        elseif ($offset < (Date::YEAR * 2))
        {
            $span = 'около года';
        }
        elseif ($offset < (Date::YEAR * 4))
        {
            $span = 'пару лет';
        }
        elseif ($offset < (Date::YEAR * 8))
        {
            $span = 'несколько лет';
        }
        elseif ($offset < (Date::YEAR * 12))
        {
            $span = 'около столения';
        }
        elseif ($offset < (Date::YEAR * 24))
        {
            $span = 'пару столетий';
        }
        elseif ($offset < (Date::YEAR * 64))
        {
            $span = 'несколько столетий';
        }
        else
        {
            $span = 'много времени';
        }

        if ($timestamp <= $local_timestamp)
        {
            // This is in the past
            return $span.' назад';
        }
        else
        {
            // This in the future
            return 'через '.$span;
        }
    }


    public static function rusdate($d, $format = 'j %MONTH% Y', $offset = 0)
    {
        $montharr = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $dayarr = array('понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье');

        $d += 3600 * $offset;

        $sarr = array('/%MONTH%/i', '/%DAYWEEK%/i');
        $rarr = array( $montharr[date("m", $d) - 1], $dayarr[date("N", $d) - 1] );

        $format = preg_replace($sarr, $rarr, $format);
        return date($format, $d);
    }

    /**
     * @param null $data1
     * @param $data2
     * @return string
     * вычисляем разницу в днях между датами
     */
    public static function diffDay($data1 = null, $data2){
        if ($data1 === null) {
            $data1 = date('Y-m-d');
        }

        $datetime1 = new DateTime($data1);
        $datetime2 = new DateTime($data2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%d%');
    }
}
