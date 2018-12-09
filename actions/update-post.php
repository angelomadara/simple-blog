<?php

require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});

$x = Query::update('posts',[
    'title' => Request::get('title'),
    'post' => Request::get('post'),
    'updated_at' => date('Y-m-d H:i:s'),
],'id',Request::get('post_id'));

$message = '?id='.Request::get('post_id').'&class=alert alert-danger&message=Error occured while saving a topic, please try to reload the page';
if($x){
    $message = '?id='.Request::get('post_id').'&class=alert alert-success&message=Topic successfully publised';
}

Redirect::to('../../edit-post.php'.$message);