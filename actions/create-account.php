<?php

require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});

$user = (new Query())->select('users')->where('username','=',Request::get('email'))->first();

$msg = "?class=alert alert-danger&message=Email already exist";

if(!$user){
    Query::create('users',[
        'username' => Request::get('email'),
        'password' => Hash::make(Request::get('password')),
        'fullname' => Request::get('fullname'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    $msg = "?class=alert alert-success&message=Account successfully created";
}

Redirect::to('../../create-account.php'.$msg);
