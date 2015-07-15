<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
    //File
	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => 'sdfsadgadfhdh867456',
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		 //'admin' => 'a2cb1ec2c6bf398e42581dbd6f0d8fdcf3f26388482e615cef4430da5f1cdaf9',
	),

);
