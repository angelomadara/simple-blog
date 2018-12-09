<?php

require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});

$x = Query::create('posts',[
    'title' => Request::get('title'),
    'post' => Request::get('post'),
    'user_id' => Session::get(Config::get('session/profile'))->id,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s'),
]);

$message = '?class=alert alert-danger&message=Error occured while saving a topic, please try to reload the page';
if($x){
    $message = '?class=alert alert-success&message=Topic successfully publised';
}

Redirect::to('../../profile.php'.$message);