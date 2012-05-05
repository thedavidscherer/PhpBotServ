<?php
class DB {
	private $statements;
	private $good;
	private $conn;
	function __construct() {
		$this->statements = array();
		try {
			$this->conn = mysqli_connect(get_option('mysql', 'mysql_server'), get_option('mysql', 'mysql_user'), get_option('mysql', 'mysql_pass'));
			mysqli_select_db($this->conn, get_option('mysql', 'mysql_db'));
			$this->good = true;
		} catch (Exception $e) {
			echo "Failed to make Database connection. Try again.\r\n";
			$this->good = false;
		}
	}
	function isConnected() {
		return $this->good;
	}
	function ping() {
		//this will make sure the connection is still good
		//if it's not, and automatic reconnection is enabled in php.ini
		//it will reconnect the database automagically
		$this->conn->ping();
	}
	function storeStatement($name, $stmt) {
		$res = $this->conn->prepare($stmt);
		$this->statements[$name] = $res;
	}
	function getStatement($name) {
		if(isset($this->statements[$name])) {
			return $this->statements[$name];
		}
		return null;
	}
}
?>
