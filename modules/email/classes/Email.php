<?php defined('SYSPATH') OR die('No direct access allowed.');

class Email {

    public static function factory () {

        require_once Kohana::find_file('vendor', 'libmail');
        return new Mail;

    }

} // End email