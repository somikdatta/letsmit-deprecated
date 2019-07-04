<?php
session_start();
$GLOBALS['config']=array(
  'mysql'=>array(
    'host'=>'127.0.0.1',
    'username'=>'root',
    'password'=>'fb1kQlqBU6Oa412Q',
    'db'=>'user'
  ),
  'remember'=>array(
    'cookie_name'=>'_rmstr_',
    'cookie_expiry'=>2592000
  ),
  'session'=>array(
    'session_name'=>'user',
    'token_name'=>'token'
  )
);

spl_autoload_register(function($class){
  require_once (realpath(dirname(__FILE__). '/../classes/' . $class . '.php'));
});

require_once (realpath(dirname(__FILE__). '/../functions/sanitize.php'));

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))){
    $hash=Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck=DB::getInstance()->get('sessions',array('hash','=',$hash));
    if($hashCheck->count()){
      $user=new User($hashCheck->first()->uid);
      $user->login();
    }
}
