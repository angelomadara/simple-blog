<?php

require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});

$user = (new Query())->select('users')->where('username','=',Request::get('email'))->first();


if(!$user){
    Query::create('comments',[
        'post_id' => Request::get('post_id'),
        'user_id' => Request::get('user_id'),
        'comment' => Request::get('comment'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ]);
    
    echo json_encode([
        'status' => true
    ]);
}