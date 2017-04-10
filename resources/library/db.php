<?php

class db {

	/* Connect Function
	Returns: PDO Database Object
	*/

	// 'dbhost' => '127.0.0.1',
	// 'dbname' => 'cscidb',
	// 'dbuser' => 'root',
	// 'dbpassword' => 'root',
	// 'dbport' => '8889'

	private static function connect(){

		$dbuser = "root";
		$dbpassword = "root";

		try{
			$pdo = new PDO('mysql:host=127.0.0.1;port=8889;dbname=cscidb;charset=utf8', $dbuser, $dbpassword);
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

	// Multi line connection
}
?>
