<?php
class DB{
	static $pdo = NULL;
	public static function pdo(){
		if(NULL===self::$pdo) {
			try{
				//self::$pdo = new PDO('odbc:'.DBNAME,DBUSER,DBPASS);
				self::$pdo = new PDO('mysql:host=localhost;dbname=pipeline','pipeline','pipeline');
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				self::$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
			}
			catch(PDOException $ex){
				echo $ex->getMessage();
				echo '<h2>There was a problem connecting to the database.  Please refresh.</h2>';
			}
		}
		return self::$pdo;
	}
}
