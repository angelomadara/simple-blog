<?php
require_once '../init.php';
require_once '../includes/functions.php';
spl_autoload_register(function($class){
	require_once "../app/".$class.".php";
});

if(Token::checkToken(Request::get('_token'))){
    $user = (new Query())->select('users')->where('username','=',Request::get('email'))->first();
    if($user){
        if(Hash::check($user->password, Request::get('password'))){
            Session::put(Config::get('session/profile'),$user);
            Redirect::to('../../home.php');
        }else{
            echo 'not okay';
        }
    }
    echo 'okay';
}else{
    echo 'error';
}