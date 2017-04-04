<?php

$config = include('resources/config.php'); //Import Database Settings

class db {

	/* Connect Function
	Returns: PDO Database Object
	*/

	private static function connect(){
		$pdo = new PDO('mysql:host=$config['dbhost'];dbname=$config['dbname'];charset=utf8', $config['dbuser'], $config['dbpassword']);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}

	/* Query Function
	Returns: (Inprogress) Needs to return query results
	*/

	public static function query($query, $params = array()){
		$statement = self::connect()->prepare($query)
		$statement->execute($params);
	}
}
?>
