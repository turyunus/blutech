<?php
	class DatabaseConnection{
		public $mysql_host;
		public $mysql_database;
		public $mysql_user;
		public $mysql_password;
		public $conn;
		function connection(){
			$mysql_host = 'localhost';
			$mysql_database = 'blutech';
			$mysql_user = 'root';
			$mysql_password = '';
			$conn = new mysqli($mysql_host, $mysql_user, $mysql_password,$mysql_database);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 
			else{
				return $conn;
			}
			return NULL;
			}
	}

?>