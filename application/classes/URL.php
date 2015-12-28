<?php defined('SYSPATH') OR die('No direct script access.');

class URL extends Kohana_URL {

    public static function parse_link ($link){

        $parse = parse_url($link);

        if (!empty($parse['host']) and !empty($parse['scheme'])) {
            return array('link' => $link, 'text' => $parse['scheme'].'://'.$parse['host']);
        } else {
            $tmp = parse_url('http://'.$link);
            return array('link' => $link, 'text' => $tmp['scheme'].'://'.$tmp['host']);
        }

    }

}
