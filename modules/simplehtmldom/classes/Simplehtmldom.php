<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 10.02.2016
 * Time: 15:10
 */

class Simplehtmldom {

    public static function factory ($content) {

        require Kohana::find_file('vendor', 'simple_html_dom');
        $dom = new domDocument;

        @$dom->loadHTML($content);
        $dom->preserveWhiteSpace = false;
//        $dom = new domDocument;
//        $dom->loadHTML($html);
//        $dom->preserveWhiteSpace = false;
        return $dom;

    }

}