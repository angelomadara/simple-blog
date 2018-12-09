<?php

require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});

$x = Query::update('posts',[
    'deleted_at' => date('Y-m-d H:i:s')
],'id',Request::get('id'));

$message = '?class=alert alert-danger&message=Error occured while removing the topic, please try to reload the page';
if($x){
    $message = '?class=alert alert-success&message=Topic successfully removed';
}

Redirect::to('../../profile.php'.$message);