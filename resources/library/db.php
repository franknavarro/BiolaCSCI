<?php

class db {

	private static function connect(){

		$config = include('resources/config.php');

		$dbuser = $config['dbuser'];
		$dbpassword = $config['dbpassword'];
		$dbhost = $config['dbhost'];
		$dbport = $config['dbport'];
		$dbname = $config['dbname'];

		try{
			$pdo = new PDO(sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8', $dbhost, $dbport, $dbname), $dbuser, $dbpassword);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e){
			print "Error!: " . $e->getMessage() . "<br/>";
    		die();
		}
	}

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
