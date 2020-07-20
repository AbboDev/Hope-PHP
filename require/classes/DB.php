<?php
/**
* 
*/
class DB {
	private $dbh = null;

	public static function startConnection() {
		try {
			$dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PWD);
		} catch (PDOException $e) {
			Utilities::verbalise("Error!: ".$e->getMessage());;
			die();
		}
	}

	public static function checkConnection() {
		if (isset(self::$dbh)) {
			return is_null(self::$dbh);
		}
		return false;
	}

	public static function closeConnection() {
		if (self::checkConnection()) {
			Utilities::verbalize("Stop connection");
			$dbh = null;
		}
	}

	public static function getQueryResults($query) {
		try {
			return $pdo->query($query);
		} catch (PDOException $e) {
			Utilities::verbalise("Error!: ".$e->getMessage());;
			die();
		}
	}
}

?>