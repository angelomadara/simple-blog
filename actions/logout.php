<?php
require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});


Session::delete(Config::get('session/profile'));

Redirect::to('../../home.php');