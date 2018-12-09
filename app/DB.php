<?php 

/**
* 
*/
class DB
{	
	private static $_instance = null;
	public $_pdo;

	private function __construct(){
		$host = Config::get('mysql/host');
		$user = Config::get('mysql/user');
		$pass = Config::get('mysql/pass');
		$name = Config::get('mysql/name');

		// set timezone to asia/manila +8
		try{
            date_default_timezone_set('Asia/Manila');
			$this->_pdo = new PDO('mysql:host='.$host.';dbname='.$name,$user,$pass, array(PDO::ATTR_PERSISTENT => true));
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_pdo->exec('set names utf8');
			// echo "Connected";
		}catch(PDOException $e){
			die($e->getMessage());
			// echo $e->getMessage();
		}
	}

	public static function ready(){
		if(!isset(self::$_instance)){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
}
