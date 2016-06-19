<?php defined('SYSPATH') OR die('No direct access allowed.');

class Email {

    private static $instance = null;


	public static function factory () {

        if (self::$instance === null) {
            require Kohana::find_file('vendor', 'libmail');
            self::$instance = new Mail;
        }
        return self::$instance;

	}

} // End email