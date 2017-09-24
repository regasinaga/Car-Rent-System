<?php
class dbmanager{
	private static $instance = NULL;
	private function __construct(){}
	public static function getInstance(){
		if(!isset(self::$instance)){
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			self::$instance = new PDO('mysql:host=localhost;dbname=rpl-oot', 'root', 'root', $pdo_options);
		}
		return self::$instance;
	}
}
?>