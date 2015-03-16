<?php defined('SYSPATH') OR die('No direct access allowed.');

return [
	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => NULL,
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',
];
