<?php

$config = include('resources/config.php'); //Import Database Settings

$dbhost = $config['dbhost'];
$dbport = $config['dbport'];
$dbname = $config['dbname'];
$dbuser = $config['dbuser'];
$dbpassword = $config['dbpassword'];

class db {

	/* Connect Function
	Returns: PDO Database Object
	*/

	private static function connect(){
		try{
			$pdo = new PDO('mysql:host=$dbhost;port=$dbport;dbname=$dbname;charset=utf8', $dbuser, $dbpassword);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e){
			print "Error!: " . $e->getMessage() . "<br/>";
    		die();
		}
	}

	/* Query Function
	Returns: (Inprogress) Needs to return query results
	*/

	public static function query($query, $params = array()){
		$statement = self::connect()->prepare($query);
		$statement->execute($params);

		if (explode(' ', $query)[0] == 'SELECT'){
			$data = $statement->fetchALL();
			return $data;
		}
	}
}
?>
