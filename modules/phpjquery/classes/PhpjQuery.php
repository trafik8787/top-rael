<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 10.02.2016
 * Time: 16:03
 */

class PhpjQuery {

    public static function factory ($content) {

        require Kohana::find_file('vendor/phpQuery', 'phpQuery');
        return phpQuery::newDocument($content);

    }
}