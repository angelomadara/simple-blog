<?php
session_start();
$GLOBALS['config'] = [
	'mysql' => [
		'type' =>'mysql',
		'host' =>'127.0.0.1',
		'name' =>'blog',
		'user' =>'root',
		'pass' =>'',
	],
	'remember' => [
		'cookie_name' 	=> 'hash',
		'cookie_expiry'	=> 604800,
	],
	'session' => [
		'profile' 		=> 'user',
		'token_name' 	=> '_token'
    ],
    'address' => [
        'domain' => 'http://'.$_SERVER['HTTP_HOST'],
        'css' => 'public/css/',
        'js' => 'public/js/',
        'vendor' => 'public/vendor/',
        'image' => 'public/img/',
    ],
];