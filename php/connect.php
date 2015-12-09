<?php
	class Connect
	{	
		// put live connection settings here
		static function getProdConn() { 
			$host = "localhost";
			$user = "root";
			$pass = "password";
			$db = "NHVBSR";
			return mysqli_connect($host, $user, $pass, $db);
		}
		
		//put dev connection settings here
		static function getDevConn() {
			$host = "localhost";
			$user = "root";
			$pass = "";
			$db = "NHVBSR";
			return mysqli_connect($host, $user, $pass, $db);
		}
	}
?>